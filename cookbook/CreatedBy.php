<?php if (!defined('PmWiki')) exit();
# add cauthor to page attributes as extra field for ?action=attr
#$PageAttributes['cauthor'] = '$[Page created by:]';

# add page variable {$CreatedBy} 
$FmtPV['$CreatedBy'] = '@$page["cauthor"]';

# automatically set page creator to $Author for every new page
function SetPageCreator($pagename, &$page, &$new) {
	global $EnablePost, $Author, $PageCreator, $Now;
	SDV($PageCreator, $Author);
	if ($EnablePost && !$new["author"])
		$new["cauthor"] = $PageCreator; 
}
array_unshift($EditFunctions, 'SetPageCreator');