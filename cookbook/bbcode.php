<?php
	if (!defined('PmWiki')) {	
		exit();
	}
	
	$RecipeInfo['bbcode']['Version'] = '080326';


	// Basic formatting
	Markup ('bbcode_bold'     , '<inline', '/\[b\](.*?)\[\/b\]/'              , "'''$1'''");
	Markup ('bbcode_undeline' , '<inline', '/\[u\](.*?)\[\/u\]/'              , "{+$1+}");
	Markup ('bbcode_italics'  , '<inline', '/\[i\](.*?)\[\/i\]/'              , "''$1''");
	Markup ('bbcode_color'    , '<inline', '/\[color=(.*?)\](.*?)\[\/color\]/', "%color=$1%\$2%color%");
	Markup ('bbcode_size'     , 'inline' , '/\[size=(\\d+)\](.*?)\[\/size\]/' , "<span style=\"font-size:$1px;\">$2</span>");

	// Links
	Markup ('bbcode_link_text', '<links' , '/\[url=(.*?)\](.*?)\[\/url\]/'     , "[[$1|$2]]");
	Markup ('bbcode_link'     , '<links' , '/\[url\](.*?)\[\/url\]/'           , "[[$1]]");
	Markup ('bbcode_email'    , '<links' , '/\[email\](.*?)\[\/email\]/'       , "[[mailto:$1|$1]]");

	// Code blocks
	SDV ($BbCodeCodeFmt,   '(:table border=1 width=90% align=center:)' . "\n" 
	                     . '(:cell:)\'\'\'Code:\'\'\'' . "\n" 
	                     . '[@$2@]' . "\n" 
	                     . '(:tableend:)');

	Markup ('bbcode_code'     , '<[='    , '/(\n[^\\S\n]*)?\\[code\\](.*?)\\[\\/code\\]/s', $BbCodeCodeFmt);

	// For supported image types: just strip off the [img] and [/img] tags
	$ImageTypes = array ('gif','jpg','jpeg','png','bmp','ico','wbmp');
	foreach ($ImageTypes as $ImageType) {
		Markup ("bbcode_img_$ImageType", '<inline', '/\[img\](.*?)\.' . $ImageType . '\[\/img\]/', "$1.$ImageType");
	}

	// Quoted text
	SDV ($BbCodeQuoteFmt,   '(:table border=1 width=90% align=center:)' . "\n" 
	                      . '(:cell:)\'\'\'$caption\'\'\'' . "\n" 
	                      . '$quote' . "\n" 
	                      . '(:tableend:)');

	Markup ('bbcode_quote_name'  , '>[=', '/\[quote=\"(.*?)\"\](.*?)\[\/quote\]/es', "BbCodeQuote('$1', '$2')");
	Markup ('bbcode_quote_noname', '>[=', '/\[quote\](.*?)\[\/quote\]/se', "BbCodeQuote('', '$1')");

	function BbCodeQuote($quotee, $quote) {
		global $BbCodeQuoteFmt;

		if ($quotee == '') {
			$caption = 'Quote:';
		}
		else {
			$caption = "$quotee wrote:";
		}

		$search  = array ('$caption', '$quote');
		$replace = array ($caption  , $quote  );
		return str_replace ($search, $replace, $BbCodeQuoteFmt);
	}
