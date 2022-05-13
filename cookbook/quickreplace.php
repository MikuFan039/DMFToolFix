<?php if (!defined('PmWiki')) exit();
/*  Copyright 2006 Stirling Westrup (sti@pooq.com)

    This file is an add-on to PmWiki; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as
    published by the Free Software Foundation; either version 2 of the
    License, or (at your option) any later version.  See pmwiki.php
    for full details.

    This script provides a simple way to manage large numbers of
    similar text replacements, and control them via wiki pages.

    To activate this script, copy it into the cookbook/ directory and
    add a line to your local/config.php file to load it, like this:

        include_once('cookbook/quickreplace.php');

    Without further configuration, the above will cause QuickReplace
    to read the Site.QuickReplace page looking for entries to turn
    into markup. If that page had the following entries:

        '#xx#' => 'XX Replacement Text'
        '#zz#' => 'ZZ Replacement Text'

    Then wherever the symbols #xx# and #yy# appeared in the markup
    they would be replaced with given replacement texts.

    Much more sophisticated processing is also possible, and examples
    with explanations are given at:

      http://www.pmwiki.org/wiki/Cookbook/QuickReplace

    This page explains how to:

      1) Set up replacements that take place when a page is saved,
      2) Use regular expressions for the search and replace values,
      3) Generate HTML output from the replacements, and
      4) Define replacements in the config file instead of a wiki page.

    [Change Log]
      Oct 13, 2006 - First version started.
      Oct 26, 2006 - First version released.
      Oct 27, 2006 - Security update. The defaults were changed when
                     flags contain 'e', to make it harder for a
                     wiki-page to contain arbitrary code that gets
                     executed. Also added the 'html' and 'convfunc'
                     parameters.
*/

// Standard Recipe Information for PmWiki
$RecipeInfo['QuickReplace'] = array
  ( 'Version' => '20061027'
  , 'Author'  => 'Stirling Westrup'
  , 'Email'   => 'sti@pooq.com'
  );

// Default function to apply the patterns so they are used during 
// ROS (Replace On Save).
function QuickReplace_ApplyROS($pats,$conf)
  { global $ROSPatterns;

    foreach((array)$pats as $pat => $rep)
      $ROSPatterns[$pat] = $rep;
  }

// Default function Apply the patterns so they are active
// during standard markup processing.
function QuickReplace_ApplyMarkup($pats,$conf)
  { $base = $conf['tag'];
    $ord  = $conf['ordered'];
    $last = $conf['when'];
    
    $i = 0;      
    foreach((array)$pats as $pat => $rep )
      { $name = $base.$i++;
        
	Markup($name,$last,$pat,$rep);
	if($ord)
	  $last = ">$name";
      }
  }

// Increment all pattern capture references by 1 in the replacement,
// modulo 100. Thus $0 -> $1, $1 -> $2,...$99 -> $0. This compensates
// for the extra capture being added in QuickReplace_PatternList
function QuickReplace_refinc($n) 
  { return "\${".(($n+1)%100)."}"; 
  }

// Generates a list of patterns and replacements from the list of
// replacement keys and values, based on configured parameters.
function QuickReplace_PatternList($list,$conf)
  { 
    // Regex to match \1, $1 or ${1} markup, and replacement func.
    static $refpat = '/(?:[\\\\$](\d\d?))|(?:\${(\d\d?)})/e';
    static $refrep = 'QuickReplace_refinc($1$2)';

    $match = preg_quote($conf['match']);
    $beg   = $conf['ends'][0];
    $end   = $conf['ends'][1].$conf['flags'];
    $output= $conf['output'];

    // Convert each key into a regex that matches occurances of that
    // key surrounded by the $match marker. Convert each value into a
    // replacement string that has adjusted capture references and is
    // imbedded in the $output string.
    foreach((array)$list as $k => $v)
      {	$pat = $beg.str_replace('\$1',"($k)",$match).$end;
	$val = preg_replace($refpat,$refrep,$v);
	$rep = str_replace('$2',$val,$output);

	$pats[$pat] = $rep;
      }
    return $pats;
  }


// Perform value quoting and any necessary string conversions.
function QuickReplace_Convert($list,$conf)
  { $regex = $conf['regex'];
    $html  = $conf['html'];
    $ends  = $conf['ends'];

    foreach((array)$list as $k=>$v)
      {
	if( !$regex )
	  $k = preg_quote($k,implode("",$ends));
	if( !$html )
	  $v = preg_replace( array('/</','/>/'), array('&lt;','&gt;'), $v );
	$ret[$k] = $v;
      }
    return $ret;
  }


// This is the default function for retrieving the list of search keys
// and replacement patterns. It loads them the configured wiki pages
// and combines them with the entries in the replace array. 
function QuickReplace_GetReplaceList($conf)
  { global $XL,$XLLangs,$pagename;
    $lang = $conf['tag'];
    $larr = $XLLangs;
    
    // Load replacement list for given pages.
    // In reverse order so last named page has precedence
    foreach(array_reverse((array)$conf['page']) as $v)
      XLPage($lang, FmtPageName($v,$pagename));

    // Add in any given replacements from replace array
    if( count($conf['replace']) )
      XLSDV( $lang, $conf['replace']);

    // grab the list we've created
    $list = $XL[$lang];

    // erase our fake 'lang' from the list
    $XLLangs = $larr;

    return $list;
  }


// Defaults for ROS operation
$QuickReplaceMode['ROS'] = array
  ( 'action'    => 'edit'
  , 'applyfunc' => 'QuickReplace_ApplyROS'
  );

// Defaults for Markup operation
$QuickReplaceMode['markup'] = array
  ( 'applyfunc' => 'QuickReplace_ApplyMarkup'
  , 'when'      => 'inline'
  );


// This is the main routine. It runs through the list of defined
// QuickReplace entries, applies defaults for all missing values,
// loads the list of search keys and replacement values and applies
// them so they are executed at the right time.

// First we ensure there is at least one entry
if(!count($QuickReplace))
  $QuickReplace['QuickReplace'] = array();

// Then we process the entries.
foreach( $QuickReplace as $key => $conf )
  { $name = PageVar(MakePageName($pagename, $key), '$Name');
    $conf = (array)$conf;

    // Set our simple defaults.
    SDVA
      ( $conf
      , array
         ( 'name'      => $name
         , 'tag'       => "QuickReplace:$name:"
	 , 'mode'      => 'markup'
	 , 'match'     => '$1'
	 , 'flags'     => ''
	 , 'regex'     => false
         , 'html'      => false
	 , 'ordered'   => false
	 , 'ends'      => array( '/', '/')
	 , 'sortfunc'  => ''
	 , 'listfunc'  => 'QuickReplace_GetReplaceList'
	 , 'pattfunc'  => 'QuickReplace_PatternList'
	 , 'convfunc'  => 'QuickReplace_Convert'
	 )
      );

    // Some defaults depend on previous ones.
    $eval = strpos($conf['flags'],'e') !== false;
    $html = $conf['html'];
   
    SDVA
      ( $conf
      , array
         ( 'output'    => ($eval ? 'Keep(PSS(\'$2\'))' : '$2')
	 , 'page'      => (($eval || $html) ? '' : "{\$SiteGroup}.$name")
	 )
      );

    // Merge in all mode-specific defaults
    SDVA($conf, $QuickReplaceMode[$conf['mode']]);

    // 'key' isn't defaultable.
    $conf['key'] = $key;

    // Find out what actions trigger this list. (blank = ALL)
    $when = (array)$conf['action'];

    // If we meet the criteria, apply the list.
    if( !count($when) || in_array( $action, $when) )
      { 
        // Load list of search/replace pairs.
	$list = (array)$conf['listfunc']($conf);

	// Save the raw list, just in case.
	$conf['list'] = $list;

	// Sort the list if necessary.
        if( $conf['sortfunc'] )
	  {
            $conf['sortfunc']($list);
	    $conf['ordered'] = true;
          }

	// perform character conversion, if necessary
	if( $conf['convfunc'] )
	  $list = (array)$conf['convfunc']($list,$conf);

	// Generate search/replace patterns from the list.
	$pats = $conf['pattfunc']($list,$conf);

	// Save the patterns, if needed later.
	$conf['pats'] = $pats;

	// Apply the patterns, so they get executed later.
        $conf['applyfunc']($pats,$conf);

	// Cache our updated conf in a global variable in case some
	// replace function wants access to this data some day.
	$QuickReplaceCache[$key] = $conf;
      }
  }


