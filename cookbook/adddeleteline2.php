<?php if (!defined('PmWiki')) exit();

$AdlVersion = '2.0.3, 29.10.2006';

/*
   Adds markup to add lines using a form and delete lines from a wiki page.

   Copyright 2005-2008 Nils Knappmeier (nk@knappi.org)

   Permission is hereby granted, free of charge, to any person obtaining 
   a copy of this software and associated documentation files (the 
   "Software"), to deal in the Software without restriction, including 
   without limitation the rights to use, copy, modify, merge, publish, 
   distribute, sublicense, and/or sell copies of the Software, and to 
   permit persons to whom the Software is furnished to do so, subject to 
   the following conditions:

   The above copyright notice and this permission notice shall be 
   included in all copies or substantial portions of the Software.

   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND 
   NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS 
   BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN 
   ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN 
   CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE 
   SOFTWARE.

   
   Contributors:
   
   * Code review (using htmlentities instead of urlencode) and some of the code
     for processing {name[]} markup in the template by Martin Fick (2006)

   Version 2.0unstable5: Support for (:adl deletelink:) directive by Petko Yotov (2006)
   Version 2.0.3: Declared stable after a year of no changes.
   
 */



# Utility function to facilitate debugging
function AdlInspect($variable="") {
   Header('Content-type: text/plain');
   if ($variable=="") {
        print_r($GLOBALS);
   } else {
        print_r($variable);
   }
   exit;
}


# Creates the HTML code for the (:adl form:) directive
function AdlFormMarkup($targetname,$adlname) {
    global $pagename;

    $targetname = MakeLink($pagename,$targetname,NULL,'','$FullName');

    return FmtPageName("<form action='{\$PageUrl}' method='post'>
            <input type='hidden' value='$targetname' name='n'/>
            <input type='hidden' value='$adlname' name='adlname'/>
            <input type='hidden' value='addline' name='action'/>",$targetname);
}

Markup('adlform','directives','/\(:adl form (.*?):\)/e',"Keep(AdlFormMarkup(\$pagename,PSS('$1')))");
Markup('adlform2','<adlform','/\(:adl form (.*?) target=(.*?):\)/e',"Keep(AdlFormMarkup(PSS('$2'),PSS('$1')))");



SDV($HTMLStylesFmt['adddeleteline2'],'
.adldeletebutton {
   display: inline;
}
.adldeletebutton input {
   font-size: 80%;
}
');


# Creates the HTML code for delete buttons (:adl delete:) and (:adl delrange:)
function AdlDeleteMarkup($key='dummy',$targetpagename="",$deletelink=false) {
    global $pagename;
    if ($targetpagename=="") {
        $targetpagename = $pagename;
    }
    if(!$deletelink)
    {
	    return FmtPageName("<form class='adldeletebutton' action='{\$PageUrl}' method='post'>
            <input type='hidden' name='n' value='$targetpagename'>
            <input type='hidden' name='action' value='deleteline'>
            <input type='hidden' name='linekey' value='$key'>
            <input type='submit' name='doit' value='$[Delete]'>
            </form></span>",$targetpagename);
    }
    else
    {
    	return FmtPageName("<a onclick='if(confirm(\"$[Really delete this line?]\")) self.open(\"{\$PageUrl}?n=$targetpagename&amp;action=deleteline&amp;linekey=$key\", \"_self\")' href='javascript:void(0);' rel='nofollow'>$[Delete]</a>",$targetpagename);
	
    }
    
}

Markup('adldeleteline','directives','/\(:adl delete (\w+) (.*?):\)/e',"Keep(AdlDeleteMarkup(PSS('$1'),PSS('$2')))");
Markup('adldeletelink','directives','/\(:adl deletelink (\w+) (.*?):\)/e',"Keep(AdlDeleteMarkup(PSS('$1'),PSS('$2'), true))");
Markup('adldeleterange','directives','/\(:adl delrange (\w+) (.*?):\)/e',"Keep(AdlDeleteMarkup(PSS('$1'),PSS('$2')))");
Markup('adldeletedummy','directives','/\(:adl delete:\)/e','Keep(AdlDeleteMarkup())');
Markup('adldeleterangedummy','directives','/\(:adl delrange:\)/e','Keep(AdlDeleteMarkup())');

# Creates the HTML code for (:adl template:)
# $fieldname is the name of the hidden form field, that is created by this function
# $template is the page template
function AdlTemplateMarkup($fieldname,$template) {
    return '<input type="hidden" name="'.$fieldname.'" value="'.htmlentities($template, ENT_QUOTES).'"/>';
}
Markup('adltemplate','[=','/\(:adl template "(.*)":\)/e',"Keep(AdlTemplateMarkup('adltemplate',PSS('$1')))");

# Creates the HTML code for (:adl templatepage:)
# $fieldname is the name of the hidden form field, that should be the result
# $pagename is the name of the current page
# $templatepage is the name of the template page
function AdlTemplatePageMarkup($fieldname, $pagename, $templatepage) {
    $templatepage = MakeLink($pagename,$templatepage,NULL,'','$FullName');
    $page = RetrieveAuthPage($templatepage,"read");
    if (!$page) { Abort("?cannot read $templatepage"); }
    return AdlTemplateMarkup($fieldname,$page['text']);
}
Markup('adltemplatepage', 'directives','/\\(:adl templatepage\\s+(\\S.*?):\\)/ei', # This line is a modified version of PMs (:redirect:)
        "Keep(AdlTemplatePageMarkup('adltemplate',\$pagename, PSS('$1')))");


# (:adl version:)
Markup('adlversion','directives','/\(:adl version:\)/e',"Keep('$AdlVersion')");

# (:adl end:)
Markup('adlendform','directives','/\(:adl end:\)/',"</form>");

# (:adl prepend:) and (:adl append:) just vanish because they are only used later in  AdlHandleAddLine
Markup('adlprepend','directives','/\(:adl prepend (.*?):\)/e','');
Markup('adlappend','directives','/\(:adl append (.*?):\)/e','');

# Markup for the #adl begin# and #adl end# marks. These marks should vansih as early as possible in the markup processing
# in order to allow markup like "! Header" to be process (which needs the stand at the beginning of the line.
Markup('adlentrybegin','_begin','/#adl begin( \w+)?#/','');
Markup('adlentryend','_begin','/#adl end( \w+)?#/','');



# Posts the text to the current page (calls the edit handler)
function AdlPost($text) {
    global $HandleActions, $pagename;

    $_POST['text']=get_magic_quotes_gpc()?addslashes($text):$text;
    $handle = $HandleActions['edit'];
    $_POST['post']='Save ';
    return $handle($pagename);
}


# Delete one line from the wiki page
$HandleActions['deleteline']='AdlHandleDeleteLine';
function AdlHandleDeleteLine($pagename) {

    $page = RetrieveAuthPage($pagename,"read");
    if (!$page) { Abort("?cannot edit $pagename"); } 

    if(isset($_POST['linekey'])) $key = stripmagic($_POST['linekey']);  # Retrieve the line-key
    else $key = stripmagic($_GET['linekey']);

    $newtext = $page['text']."\n"; # Add a newline so the the following regexes also work for the last line.

    # Remove the line containing the delete statement with the provided line-key (if it exists)
    $newtext = preg_replace("/^.*\(:adl delete(link)? $key $pagename:\).*\\n/m","",$newtext);

    # Remove the range containing the delrange statement with the provided line-key (if it exists)
    $newtext = preg_replace('/#adl begin '.$key.'#.*?\(:adl delrange '.$key.' '.$pagename.':\).*?#adl end '.$key.'#\n/s',"",$newtext);

    # Remove the added newline character: This is either the newline we inserted, or the newline in front of the
    # line we removed. Or, if the text was only one line with no newline at all, it is now empty, which should not be a problem.
    chop($newtext);

    return AdlPost($newtext);
}


# Processes the $template and inserts the values of $fields[].
# $fields is an array that is filled into the template
# $template is the template
# $linekeyseed is an optional parameter that allows the caller to specify a seed for the linekey
#     that is used to identify the range in the delete-action.
# $targetpagename an optional parameter that is name of the page, where the data is to be stored. This 
#     is mainly used in order to fill in the pagename into the (:adl del[ete|range]:) directives.
#
# The engine returns an array of entries each of which contains a string. If no markup of the form {name[]}
# is present in the template, the array will contain exactly one entry, where the usual text substitutions have
# been performed.
# If a {name[]} markup is present, $fields['name'] has to be an array. For each element of $fields['name'],
# one entry is found in the array, where all the other fields are replicated, but {name[]} is subsituted 
# by each element of $fields['name'].
# If more than one markups {name[]} are present, the outcome is undefined...
#
function AdlTemplateEngine($fields, $template,$linekeyseed=NULL,$targetpagename=NULL) {
    global $pagename;

    if ($targetpagename == NULL) { $targetpagename = $pagename; }
    
    $string = $template;
    # create the data to be added, from template and variables
    $string = preg_replace('/\\\\n/',"\n",$string);  # replace \n by newlines
    $string = preg_replace('/\{date\:(.*?)\}/e',"date(PSS('$1'))",$string);  # replace {date:fmt}
    $string = preg_replace('/\{strftime\:(.*?)\}/e',"strftime(PSS('$1'))",$string);  # replace {strftime:fmt}
    $string = preg_replace('/\{([^[]*?)\}/e',"stripmagic(\$fields[PSS('$1')])",$string);  # replace {name} fields

    if(preg_match('/\{(.*?)\[\]\}/', $string, $m)) {
        list($x, $name) = $m;
        $result = Array();
        foreach((array)$_POST[$name] as $val) {
            if ($val) {
                $result[] = preg_replace("/\{$name\[\]\}/", $val, $string);
            }
        }
    } else {
        $result = Array($string);
    }
    
    # Create a unique linekeyseed, if necessary
    if ($linekeyseed==NULL) {
        $linekeyseed=time().'a'.rand(0,100000);
    }
    foreach ($result as $index => $entry) {
        $linekey = $linekeyseed.'b'.$index;
        $entry = str_replace('(:adl delete:)',"(:adl delete $linekey $targetpagename:)",$entry);  # Add linekey to delete statements
        $entry = str_replace('(:adl deletelink:)',"(:adl deletelink $linekey $targetpagename:)",$entry);  # for link-delete
        $entry = str_replace('(:adl delrange:)',"(:adl delrange $linekey $targetpagename:)",$entry);  # Add linekey to delete statements
        $entry = str_replace('#adl begin#',"#adl begin $linekey#",$entry);  # Add line-key to delete statements
        $entry = str_replace('#adl end#',"#adl end $linekey#",$entry);  # Add line-key to delete statements
        $result[$index] = $entry;
    }
    return $result;
}



# Insert text into the wiki page
$HandleActions['addline']='AdlHandleAddLine';
function AdlHandleAddLine($pagename) {
    global $HandleActions,$action,$ScriptUrl;

    $page = RetrieveAuthPage($pagename,"read");
    if (!$page) { Abort("?cannot edit $pagename"); }


    $newentries = AdlTemplateEngine($_POST,html_entity_decode(stripmagic($_POST['adltemplate'])));  # Decode the template

    $addstring = join("\n",$newentries);
   

    # Handle the special names #top and #bottom
    if ($_POST['adlname'] == '#top') {
         return AdlPost($addstring."\n".$page['text']);
    }
    if ($_POST['adlname'] == '#bottom') {
        return AdlPost($page['text']."\n".$addstring);
    }

    # Handle locations specified by 'adl prepend' and 'adl append'
    $text = split("\n",$page['text']);

    # Look for (:adl append:) statements and append the $
    $appendcmd='(:adl append '.stripmagic($_POST['adlname']).':)';
    foreach ($text as $nr => $line) {
        if ($line==$appendcmd) {
            $text[$nr]=$addstring."\n$line";
        }
    }

    $prependcmd='(:adl prepend '.stripmagic($_POST['adlname']).':)';
    foreach ($text as $nr => $line) {
        if ($line==$prependcmd) {
            $text[$nr] = "$line\n".$addstring;
        }
    }
    return AdlPost(join("\n",$text));
}




# vi:shiftwidth=4:autoindent:softtabstop=4:expandtab: