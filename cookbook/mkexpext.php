<?php if (!defined('PmWiki')) exit();

$RecipeInfo['MarkupExpressionsExtensions']['Version'] = '2007-04-15';

## DESCRIPTION:  Several Markup Expression Extensions from the Acme Toolbox available for general use.  Do not use if you have the Acme toolbox enabled on your system!  Author: Dan Vis  <editor àt fast döt st>, Copyright 2007.  

## LICENSE:  You can redistribute this software and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

Markup('textarea', 'inline', '/\\(:textarea (.*?):\\)/e', "Keep('<textarea '.PQA(PSS('$1')).' class=inputbox>')");
Markup('textareaend', 'inline', '/\(:textareaend:\\)/', '</textarea>');
$MarkupExpr['source'] = 'MkExpExtSource($args[0])';
function MkExpExtSource($p) {
	global $pagename, $HandleAuth;
	if (substr($p, 0, 1) != "+") $t = "</textarea>";
	if ($p == '') $p = $pagename;
	if (strpos($p, "#ID") !== false) {
		$a = "[[" . substr($p, strpos($p, "#ID")) . "]]";
		$p = substr($p, 0, strpos($p, "#ID"));
		}
	if (! CondAuth($p, $HandleAuth['source'])) return '';
	$page = ReadPage($p);
	$source = $page['text'];
	if ($a != '') {
		$source = substr($source, strpos(" $source", $a) - 1);
		if (strpos(substr($source,5), "[[#ID")) $source = substr($source, 0, strpos(substr($source,5), "[[#ID") + 5);
		}
	if ($t != "</textarea>") return Keep(substr($source, strlen($a)));
	return Keep(substr("$source$t", strlen($a)));
	}

$FmtPV['$Keywords'] = 'MkExpExtAttr("keywords", $pagename)';
$FmtPV['$PasswdRead'] = 'MkExpExtAttr("passwdread", $pagename)';
$FmtPV['$PasswdEdit'] = 'MkExpExtAttr("passwdedit", $pagename)';
function MkExpExtAttr($attr, $page) {
	global $pagename;
	if ((!CondAuth($pagename, "admin")) && (substr($attr, 0, 6) == "passwd")) return;
	if (($attr == 'keywords') || (substr($attr, 0, 6) == "passwd")) {
		if ($page == '') $page = $pagename;
		$page = ReadPage($page);
		return $page[$attr];
		}			
	return '';
	}

$FmtPV['$Now'] = "'" . time() . "'";
$FmtPV['$ReturnLink'] = "'" . substr($_SERVER[HTTP_REFERER], strpos($_SERVER[HTTP_REFERER], "?n=") + 3) . "'";
$FmtPV['$Browser'] = "'" . $_SERVER[HTTP_USER_AGENT] . "'";
$FmtPV['$IPAddress'] = "'" . $_SERVER[REMOTE_ADDR] . "'";
$FmtPV['$DomainName'] = "'" . $_SERVER[SERVER_NAME] . "'";

SDV($MkExpExtMath, "/^[-+*\\/% ()0-9.]+$/");
$MarkupExpr['math'] = 'MkExpExtMath($args[0])';
function MkExpExtMath($p) {
	global $MkExpExtMath;
	if ($p == '') return;
	if (!preg_match($MkExpExtMath, $p)) return;
	eval("\$r = $p;");
	return $r;
	}

$MarkupExpr['wiki'] = 'MkExpExtWiki(preg_replace($rpat, $rrep, $params))';
SDV($MkExpExtDirectives, 'table,tableend,cell,cellnr,include,if,pagelist,input,messages,redirect,title');
SDV($MkExpExtZap, false);
function MkExpExtWiki($p) {
	global $MkExpExtDirectives, $MkExpExtZap;
	$p = substr($p, 1);
	$c = substr($p, 0, strpos($p, " "));
	$p = substr($p, strpos($p, " "));
	$pmlist = explode(",", $MkExpExtDirectives);
	if (in_array($c, $pmlist)) return stripslashes("(:$c $p:)");
	if ((substr($c, 0, 3) == 'zap') && ($MkExpExtZap == true)) return stripslashes("(:$c $p:)");
	return false;
	}

$MarkupExpr['count'] = 'MkExpExtCount($args[0], $args[1])';
SDV($MkExpExtExclude, 'RecentChanges,GroupHeader,GroupFooter,GroupAttributes,SideBar,SideMenu');
function MkExpExtCount($g, $x) {
	global $MkExpExtExclude, $pagename;
	if ($g == '') $g = substr($pagename, 0, strpos($pagename, "."));
	if ($x != '') $MkExpExtExclude .= "," . $x;
	$count = count(ListPages("/^$g\./"));
	if (substr($MkExpExtExclude, -3) == "all") return $count;
	$ex = explode(",", $MkExpExtExclude);
	foreach($ex as $exx) {
		if (PageExists("$g.$exx")) $count = $count - 1;
		}
	return $count;
	}

$MarkupExpr['thread'] = 'MkExpExtThread($args[0])';
SDV($MkExpExtThreadstart,'1000');
function MkExpExtThread($g) {
	global $MkExpExtThreadstart, $pagename;
	if ($g == '') $g = substr($pagename, 0, strpos($pagename, "."));
	$e = $MkExpExtThreadstart - 1;
	$gg = explode(",", $g);
	foreach($gg as $ggg) {
	foreach(ListPages("/^$ggg\\.\\d/") as $n) {
		$n = substr($n,strlen($ggg)+1);
		if (! preg_match("/^[0-9]+$/", $n)) continue;
		$e = max($e,$n);
		}
	}
	$e = $e + 1;
	return $e;
	}

$MarkupExpr['random'] = 'rand($args[0], $args[1])';
$FmtPV['$Captcha'] = "'" . rand(1000,9999) . "'";

$MarkupExpr['list'] = 'MkExpExtList($args[0], $args[1])';
function MkExpExtList($l, $x) {
	if ($l == '') return;
	$ll = explode(",", $l);
	$xx = explode("^", $x);
	foreach($ll as $lll) $list .= str_replace('{item}', $lll, $xx[0]) . $xx[1];
	$list = substr($list, 0, - strlen($xx[1]));
	return $list;
	}