<?php if (!defined('PmWiki')) exit();

$AuthUser['Admin'] = crypt('/n/n/n/n');
$AuthUser['@admins'] = array('Admin', 'dm.mikufans@gmail.com');
$DefaultPasswords['edit'] = 'id:*';
$DefaultPasswords['admin'] = array('@admins');
$DefaultPasswords['upload'] = array('@admins');
$HandleAuth['delete'] = 'admin';

include_once("$FarmD/cookbook/openid/KAuth.php");
include_once("$FarmD/scripts/authuser.php");


$EnablePostAttrClearSession = 0;
$Skin = 'pmwikiGPT';
$MarkupCss = true;
$EnableIMSCaching = 0;
$EnableRelativePageVars = 1;
$EnableUndefinedTemplateVars = 0;
$EnablePostAuthorRequired = 1;
$EnableDiffInline = 1;
$FarmPubDirUrl = 'http://'.$_SERVER['HTTP_HOST'].'/pub';
$EnablePathInfo = 1;
$ScriptUrl = "http://".$_SERVER['HTTP_HOST'];
$HTMLPNewline = '<br />'; 
$SearchPatterns['default'][] = '!^PmWiki\\.!';
//调试
if (CondAuth($pagename, 'admin')) $EnableDiag = 1;
//添加属性
include_once("$FarmD/scripts/forms.php");
$InputAttrs[] = 'onclick';
$InputAttrs[] = 'onsubmit';
$InputAttrs[] = 'onchange';
$InputAttrs[] = 'target';
$InputAttrs[] = 'onkeyup';
$InputAttrs[] = 'maxlength';

# 广告屏蔽
$BlocklistDownload["$SiteAdminGroup.Blocklist-MoinMaster"] = array(
'url' => 'http://master.moinmo.in/BadContent?action=raw',
'format' => 'regex',
'refresh' => 8640000000);
# END

# 页面储存
$WikiDir = new PageStore('./wiki.d/{$Group}/{$FullName}');
$WikiLibDirs = array( &$WikiDir,
	new PageStore('$FarmD/dmflib.d/{$Group}/$FullName'),
	new PageStore('$FarmD/wikilib.d/$FullName')
);
# END

# 附件
$EnableUpload = 1;
$UploadMaxSize = 1000000;
$EnableUploadVersions=1;
$UploadExts['xml'] = 'text/xml';
# END

# i18n
include_once($FarmD.'/scripts/xlpage-utf-8.php');
XLPage('ZhCn','PmWikiZhCn.XLPage');
if(date_default_timezone_get() != "Asia/Shanghai") date_default_timezone_set("Asia/Shanghai");
# END

include_once($FarmD.'/cookbook/expirediff.php');
include_once($FarmD.'/scripts/guiedit.php');
include_once($FarmD.'/cookbook/bbcode.php');
include_once($FarmD.'/cookbook/newpageboxplus.php');
include_once($FarmD.'/cookbook/pagetoc.php');
include_once($FarmD.'/cookbook/mkexpext.php');
include_once($FarmD.'/cookbook/fplcount.php');
include_once($FarmD.'/cookbook/deletepage.php');
include_once($FarmD.'/cookbook/adddeleteline2.php');
include_once($FarmD.'/cookbook/quickreplace.php');
include_once("$FarmD/cookbook/uploadform.php");
include_once("$FarmD/cookbook/PageGenerationTime.php");
include_once("$FarmD/cookbook/HtmlMarkup.php");
include_once("$FarmD/cookbook/CreatedBy.php");
if ($action=='diff') {
    $DiffCountPerPage = 10;
    include_once("$FarmD/cookbook/limitdiffsperpage2.php");
}
$XESTagAuth = 'edit';
include_once("$FarmD/cookbook/tagpages.php");
include_once("./cookbook/QueryExpr.php");
$WikiStyleCSS[] = 'line-height';

if (empty($Author) && !empty($AuthId)) $Author = $AuthId;
$RecentChangesFmt = array(
  '$SiteGroup.AllRecentChanges' => 
    '* [[{$Group}.{$Name}]]  . . . $CurrentTime $[by] $Author: [=$ChangeSummary=]',
  '$Group.RecentChanges' =>
    '* [[{$Group}/{$Name}]]  . . . $CurrentTime $[by] $Author: [=$ChangeSummary=]');

//include_once("$FarmD/scripts/urlapprove.php");
$UrlLinkFmt = "<a class='urllink' href='\$LinkUrl' >\$LinkText</a>";
$GroupHeaderFmt =
  '(:include {$SiteGroup}.AllGroupHeader:)(:nl:)'
  .'(:include {$Group}.GroupHeader:)(:nl:)';

if ( !(bool)preg_match("/^\/([A-Z0-9\xa0-\xff\?].*)/", $_SERVER['REQUEST_URI'])
      && !($_SERVER['REQUEST_URI'] == "/") ) {
    $pagename = $_REQUEST['n'] = $_REQUEST['pagename'] = 'Main/HomePage';
    //$EnableCodeIgniter = TRUE;
    $action = 'mvc';
}

define("DMF_ROOT_PATH", './cookbook/dmf_exp/');
include(DMF_ROOT_PATH."DMF.php");
include(DMF_ROOT_PATH."mvc_bootstrap.php");
