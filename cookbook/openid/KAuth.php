<?php if (!defined('PmWiki')) exit();
$RecipeInfo['KAuth']['Version'] = '20111118';

if ($EnableAuthUser == 1){
    throw new Exception("");
    exit;
}
require_once 'openid.php';

Markup("google_loginbox", "directives", '/\\(:google_loginbox:\\)/ei', "GoogleLoginBox()");
function GoogleLoginBox(){
    if ( !empty($_REQUEST['action'])) $action='&action='.$_REQUEST['action'];
    
    $output = '<form action="?google_login'.$action.'" method="post"><button>使用Google账户登录(OpenID)</button></form>';
    return $output;
}

if (isset($_REQUEST['openid_mode']) || isset($_REQUEST['openid.mode'])) {
    if ($_REQUEST['openid_mode'] == 'id_res' || $_REQUEST['openid.mode'] == 'id_res') {
        $openid = new LightOpenID($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
        $attr = $openid->getAttributes();
        if (!empty($attr['contact/email'])) {
            $_REQUEST['authid'] = $_POST['authid'] = $attr['contact/email'];
        } else {
            $_REQUEST['authid'] = $_POST['authid'] = getIdentityAsAuthID();
        }
        $AuthUserFunctions['google'] = 'AuthUserOpenID';
        $AuthUser['google'] = true;
        
        if ($_REQUEST['action'] == 'login') {
            unset($_REQUEST['action']);
            unset($_GET['action']);
            $action = 'browse';
        }
        
    } else if ($_REQUEST['openid_mode'] == 'cancel' || $_REQUEST['openid.mode'] == 'cancel') {
        $GLOBALS['MessagesFmt'] = '用户取消了验证';
    }
    
} else {
    if (isset($_REQUEST['google_login'])) {
        $openid = new LightOpenID($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
        $openid->required = array('contact/email');
        $openid->identity = 'https://www.google.com/accounts/o8/id';
        header('Location: ' . $openid->authUrl());
    }
}


function AuthUserOpenID($pagename, $id, $pw, $pwlist) {
  try{
    $openid = new LightOpenID($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    if($openid->validate()){
      return true;
    }
  } catch(ErrorException $e) {
    var_dump($e);exit;
  }
  return false;
}

function getIdentityAsAuthID(){
  $original=$_REQUEST['openid.identity'];
  if (empty($original)) $original=$_REQUEST['openid_identity'];

  $fixed=str_replace("~", "-", $original);
  $fixed=str_replace("https://", "",$fixed);
  $fixed=str_replace("http://", "",$fixed);
  $fixed=str_replace("/", "-",$fixed);

  return $fixed;
}