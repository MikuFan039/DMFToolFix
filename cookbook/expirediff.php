<?php if (!defined('PmWiki')) exit();

# add "?action=expirediff"
SDV($HandleActions['expirediff'],'HandleExpireDiff');
SDV($HandleAuth['expirediff'], 'edit');

function HandleExpireDiff($pagename, $auth) {
  global $WikiDir, $Now;
  Lock(2);
  $page = RetrieveAuthPage($pagename, $auth);
  if (!$page) { Abort("?cannot get $pagename"); }
  $keepdays = @$_REQUEST['keepdays'];
  $keepgmt = $Now - $keepdays * 86400;
  $keys = array_keys($page);
  foreach($keys as $k) 
    if (preg_match("/^\\w+:(\\d+)/", $k, $match)) 
      if ($match[1] < $keepgmt) unset($page[$k]);
  $WikiDir->delete($pagename);
  WritePage($pagename, $page);
  Redirect($pagename);
  exit;
}


## -- For expiring all pages at once; first parameter is the desired group,
##                                    second parameter tells whether a backup should be done,
##                                    third parameter tells which DIFFs should be kept.
function ExpireDiffAll($group='',$backup=1,$keepdays=0) {
  global $WikiDir,$Now;
  $pagelist = $WikiDir->ls();
  $pagelist = array_unique($pagelist);
  sort($pagelist);
  foreach($pagelist as $k=>$p)
      if (!(($group==substr($p,0,strpos($p,"."))) or ($group==''))) {
	  unset($pagelist[$k]);
      } 
  $pagecount = count($pagelist);

  echo "
    <html>
    <head>
    <title>Expire pages (remove DIFFs)</title>
    </head>
    <body>
    <h2>Expire existing pages (remove DIFFs)</h2>
    <p>I'm now removing the DIFFs from the files (pages) you have stored in your wiki.
    When this is finished you can get rid of the <tt>ExpireDiff(...);</tt> line in your 
    local/config.php</p>";

  if ($pagelist) {
    foreach($pagelist as $p) {
      echo "<li>Expiring $p</li>\n";
      $page = ReadPage($p);
      $keepgmt = $Now - $keepdays * 86400;
      $keys = array_keys($page);
      foreach($keys as $k) 
        if (preg_match("/^\\w+:(\\d+)/", $k, $match)) 
          if ($match[1] < $keepgmt) unset($page[$k]);
      if ($backup==1) {
        $WikiDir->delete($p);
      };
      WritePage($p,$page);
    }
  }
  echo "<p>Removed DIFFs from ", $pagecount, " pages.</p>\n";
  echo "<p>Now you can get rid of the <tt>ExpireDiff(...);</tt> line in your 
    local/config.php</p>
    </body></html>\n";
  exit(0);
}


