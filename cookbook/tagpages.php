<?php if (!defined('PmWiki')) exit();

/*   
TagPages was created by The Crisses (XES).  Originally created for Similepedia.com.  

This is released under the GPL, always code responsibly!

--------- Usage:

-- Add to config.php:

include_once 'cookbook/tagpages.php';

-- Optionally add before include line:

$XESTagAuth = 'read';

-- Add to GroupFooter in wiki:

(:messages:)
(:if !auth edit:)
!!Please [[{*$PageUrl}?action=login | log in]] to help tag this page
(:ifend:)
(:if auth edit:)Tag this page: (:input form action={*$PageUrl}:) (:input hidden action xestagpages:)
Tags:	(:input text "Tags" size="40":)	(:input submit value="Go":)
(:input end:) (:ifend:)

-- Add to your CSS file (change as desired):

div.category { 
  border: 1px solid #666;
  padding: 0.5em;
  background-color:  #EEE;
}
;
*/
SDV( $XESTagAuth, "edit");

Markup('includeTag', 'fulltext',
  '/\\(:includeTag:\\)/ei',
  "str_replace('\n', '', RetrieveAuthSection(\$pagename, '#tagInfo#tagEnd'))");

if (CondAuth($pagename, 'edit')) {
		$HandleActions['xestagpages'] = 'XESTagPages';
    }


function XESTagPages () {
	global $pagename, $DataKey, $ScriptUrl, $data, $MessagesFmt;
	// fix magic quotes
	if (get_magic_quotes_gpc()) {
	   foreach ($_POST as $key=>$value) {
   			$_POST[$key]= stripslashes($value);
   		} 
   	}	
	//Create categories from entered data
	if (isset($_POST['Tags']) && $_POST['Tags'] != "") {

		$newtext = XESTag2Cat($_POST['Tags']);
		// Append the actual Simile group page with the new Category markup
	    # change 'false' to 'true' if you want a password prompt
		$oldpage = RetrieveAuthPage($pagename, 'edit', true);
		if (!$oldpage) { Abort("You don't have permission to edit $pagename"); }
		$newpage = $oldpage;
		// dupe check, remove blanks & sort
		$newpage['text'] = XESMergeCats($newpage['text'], $newtext);
		UpdatePage($pagename, $oldpage, $newpage);
	}
	HandleBrowse($pagename);
}

// This function grabs all the categories on the page
// and eliminates dupes, sorts...and spits it out in a nice div.
function XESMergeCats($oldtext, $newtext){
	preg_match_all('/\[\[!(.*?)]]/', $oldtext, $oldmatch);
	preg_match_all('/\[\[!(.*?)]]/', $newtext, $newmatch);
	$output = (array_merge($oldmatch[0], $newmatch[0]));
/*
	print_r($output);
	exit();
*/
	array_walk($output,trim);
	sort($output);
	$output = implode (" | ", array_unique($output));
	$search = array ('/([A-Z-])/', '/([\d]+)/', '/[-][\d\w]/','/[ ]{2,}/');
	$replace = array ('$1', '$1', '- ', ' ');
	$output = trim(preg_replace($search, $replace, $output));
	
	#$other = preg_replace('/\(:div class\=category:\)(.*?)$\n\(:divend:\)/m', '', $oldtext);
	#echo "$other\n\n\n\n\n$output";exit;
	#return $other . "\n(:div class=category:)"  . $output . "\n(:divend:)";
	$other = preg_replace('/\(:if false:\)\n\[\[#tagInfo\]\] (.*?)\[\[#tagEnd\]\]\n\(:ifend:\)/m', '', $oldtext);
	return $other . "\n(:if false:)\n[[#tagInfo]] "  . $output . "[[#tagEnd]]\n(:ifend:)";
}

// This function creates the category info
// Turns value into category tags
function XESTag2Cat($Tags) {
	$Tags = preg_split('/[\s,，]+/u', $Tags);
	#$Tags = explode(',', $Tags);
	$cat_clean = array();
	// clean up the array
	foreach ($Tags as $tag) {
		$tag = ucwords(trim($tag));
		// don't allow messing with tags - allowed characters
		#$clean = preg_replace("/[]/us","",$tag);
		$clean = $tag;
		if (($clean != "") && ($clean != "[[!]]")  ) $cat_clean[] = $clean;
	}
	// prep the return value
	$text = "[[!" . (implode (']] [[!', $cat_clean)) . "]] ";
	// pass return value
	return $text;
}
