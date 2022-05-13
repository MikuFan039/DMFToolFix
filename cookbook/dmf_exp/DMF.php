<?php if (!defined('PmWiki')) exit();
libxml_use_internal_errors(true);
spl_autoload_register(function ($class) {
    $p = DMF_ROOT_PATH."inc/class.{$class}.php";
    
    if (file_exists($p)) {
        $f = $p;
    } else if (stripos($class,  'GroupConfig') !== FALSE) {
        $c = substr($class, 0, stripos($class,  'GroupConfig'));
        $f = DMF_ROOT_PATH."config/config.{$c}.php";
    }
    

    if (file_exists($f)) {
        include $f;
        return;
    } else {
        //echo $class."||||".$f;
        //exit;
    }
    
});


//弹幕权限表
$BilibiliAuthLevel = new DefinedEnum( array
(
    'DefaultLevel' => '10000,1001',
	'Guest'	=> '0',
	'User'	=> '10000,1001',
	'Danmakuer' => '20000,1001'
));

Markup("PlayerPageDisplay", 'directives', "/\\(:PlayerPageDisplay:\\)/e", 'DMF_PlayerPageDisplay()');

function DMF_PlayerPageDisplay() {
    global $pagename, $LOCALVERSION;
    $VDN = new VideoPageData($pagename);
    
    //不是视频页面
    if (empty($VDN->VideoStr) || empty($VDN->VideoType) || empty($VDN->DanmakuId)) {
        return;
    }
    
    $xtpl = new XTemplate(DMF_ROOT_PATH.'view/playPage.xpl');
    
    if ($LOCALVERSION) {
        $xtpl->set_null_block('', 'main.source');
    } else {
        $xtpl->assign('SOURCE', $VDN->SourceLink);
        $xtpl->parse("main.source");
    }
    
    $tags = strip_tags(MarkupToHTML($pagename, '(:includeTag:)'), "<a>");
    $xtpl->assign('TAGS', $tags);
    if (CondAuth($pagename, 'edit')) {
        //$xtpl->set_null_block('', 'main.tagListNormal');
        $xtpl->parse("main.tagListEditable");
    } else {
        //$xtpl->set_null_block('', 'main.tagListEditable');
        $xtpl->parse("main.tagListNormal");
    }
    $GLOBALS['MessagesFmt'] = "{$VDN->Player->desc} -> {$VDN->VideoType->getType()}( \"{$VDN->DanmakuId}\" )";
    $messages = MarkupToHTML($pagename, "(:messages:)");
    $xtpl->assign('MESSAGES', $messages);
    $xtpl->parse("main.messages");
    
    $playerParams = $VDN->GroupConfig->GenerateFlashVarArr($VDN);
    foreach ($playerParams->params as $name => $value) {
        $xtpl->assign("FLASHVARS", array("Name" => $name, "Value" => $value));
        $xtpl->parse("main.FlashVars");
    }
    $xtpl->assign("URL", $playerParams->url);
    $xtpl->assign("HEIGHT", $playerParams->height);
    $xtpl->assign("WIDTH", $playerParams->width);
    $xtpl->parse("main.PlayerLoader");
    
    $isAdmin = CondAuth($pagename, 'admin');
    foreach ($VDN->GroupConfig->PlayersSet as $playerId => $playerObj)
    {
        if ($playerId == 'default')
        {
            continue;
        }
        
        if ($VDN->Player->playerUrl == $playerObj->playerUrl)
        {
            $xtpl->assign("NAME", $playerObj->desc);
            $xtpl->parse("main.PlayerLoaderCurrent");
            continue;
        }
        $player = array(
            "Name" => $playerObj->desc,
            "URL" => "?Player=$playerId",
            "SetDefaultUrl" => "?Player=$playerId?&action=setdef");
        $xtpl->assign("PLAYER", $player);
        if ($isAdmin)  {
            $xtpl->parse("main.PlayerLoaderAdmin");
        } else {
            $xtpl->parse("main.PlayerLoaderNormal");
        }
    }
    
    $partText = MarkupToHTML($pagename, RetrieveAuthSection($pagename, '#partinfo#partend'));
    $linkedPartText = preg_replace("|<dt>P([0-9]+)</dt>|", "<dt><a class='urllink' href='?Part=$1'>P$1</a></dt>", $partText);
    if (!empty($linkedPartText)) {
        $xtpl->assign("PARTTEXT", $linkedPartText);
        $xtpl->parse("main.PARTDATA");
    }
    $descText = MarkupToHTML($pagename, RetrieveAuthSection($pagename, '#comment#commentend'));
    $xtpl->assign("DESCTEXT", $descText);
    $xtpl->parse("main.DESC");
    
    
    /*
     * 弹幕控制需要:
     *   $GROUP
     *   $DANMAKUID
     *   $SUID
     */
    $xtpl->assign("GROUP", $VDN->GroupConfig->GroupString);
    $xtpl->assign("DANMAKUID", $VDN->DanmakuId);
    $xtpl->assign("SUID", $VDN->GroupConfig->SUID);
    
    foreach ($VDN->GroupConfig->AllowedXMLFormat as $format) {
        $xtpl->assign("FORMAT", $format);
        $xtpl->parse("main.DanmakuBar.Download.Format");
    }
    $xtpl->parse("main.DanmakuBar.Download");
    $xtpl->parse("main.DanmakuBar.Refresh");
    
    if (CondAuth($pagename, 'edit')) {
        $xtpl->parse("main.DanmakuBar.NewLine");
        $xtpl->parse("main.DanmakuBar.Upload");
        $xtpl->parse("main.DanmakuBar.DynamicPool");
        if ($VDN->IsMuti) $xtpl->parse("main.DanmakuBar.PageOperation");
        $xtpl->parse("main.DanmakuBar.PoolOperation");
    }
    $xtpl->parse("main.DanmakuBar");
    $xtpl->parse("main");
    return keep($xtpl->text());
}

include_once(DMF_ROOT_PATH."inc/class.VideoSource.php");
include_once(DMF_ROOT_PATH."inc/action.SetDefaultPlayer.php");
if (file_exists(DMF_ROOT_PATH."DMF_Version.php")) 
    include_once(DMF_ROOT_PATH."DMF_Version.php");
Player::$playerBase = $ScriptUrl.'/static/players/';
SafeEnum::Create('PoolMode', 'S', 'D', 'A');
SafeEnum::Create("XmlErrorType", "NoError", "Auth", "Broken");

/*
 * 基础设定
 */
$LOCALVERSION = true;
$DEBUGMODE = true;
$ACFUN = TRUE;
$ACFUN2011 = TRUE;
$BILIBILI = TRUE;
$TWODLAND = TRUE;
$CheckPerfs = FALSE;
$EnableSysLog = TRUE;
$EnableAutoTimeShift = TRUE;
$TimeShiftDelta = 0.0001;

//权限设定
$HandleAuth['xmlread'] = 'read';
$HandleAuth['xmledit'] = 'edit';
$HandleAuth['xmladmin'] = 'admin';
if ($LOCALVERSION) {
	$HandleAuth['dmpost'] = 'edit';
} else {
	$HandleAuth['dmpost'] = 'admin`';
}

$HTMLHeaderFmt['javascripts'] = "\n".'<script type="text/javascript" src="/javascripts/jquery-1.6.1.min.js"></script><script type="text/javascript" src="/javascripts/jquery-ui-1.8.14.custom.min.js"></script><script type="text/javascript" src="/javascripts/swfobject.js"></script><script type="text/javascript" src="/javascripts/page.arc.js"></script><script type="text/javascript" src="/javascripts/jq.bilibili.js"></script>'."\n";

//处理投稿请求
if ($_POST["xVerify"]=="fca654cb-60ac-4f9c-b751-16ef296227b2")  {
    $_POST["xVideoStr"] = preg_replace('/\s/','',$_POST["xVideoStr"]);
}

if ($LOCALVERSION) {
	include(DMF_ROOT_PATH."DMF_local.php");
} else {
	include(DMF_ROOT_PATH."DMF_main.php");
}

//$p = new DanmakuPool('Bilibili3', '1000', PoolMode::D);