<?php if (!defined('PmWiki')) exit();
$HandleActions['setdef'] = 'Handlesetdef';
$HandleAuth['setdef'] = 'admin';
function Handlesetdef($pn,$auth = 'admin')
{
	global $FmtPV;
	
	$page = RetrieveAuthPage($pn, $auth, true, READPAGE_CURRENT);
	if (!$page) Abort("?cannot source $pn");
	if ($_GET['Player']) {$page['DP_P0'.$_GET['PartEX']] = $_GET['Player'];}
	WritePage($pn,$page);
	
	header("HTTP/1.1 301 Moved Permanently");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	header("Location: ".PageVar($pn,'$PageUrl'));
}