<?php if (!defined('PmWiki')) exit();
/*  LimitDiffsPerPage for PmWiki version 2.2.12 or newer.
    Copyright 2010 Petko Yotov

    This file is written for PmWiki; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published
    by the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.  See pmwiki.php for full details.
*/

$RecipeInfo['LimitDiffsPerPage']['Version'] = '20100217';

$DiffHTMLFunction = 'LimitDiffsPerPage';
SDV($LimitDiffsNewer, "[[%s?action=diff&source=%s&minor=%s&diffstart=%d |&larr;$[Newer changes] ]] ");
SDV($LimitDiffsOlder, "[[%s?action=diff&source=%s&minor=%s&diffstart=%d |$[Older changes]&rarr; ]] ");
SDV($LimitDiffsAll,   "[[%s?action=diff&source=%s&minor=%s&diffstart=-1 |$[Show all] ]] ");
$LimitDiffsMore = 0;

function LimitDiffsPerPage($pagename, $diff) {
  global $DiffCountPerPage, $PageEndFmt, $LimitDiffsMore;
  static $lines = -1;
  static $navsent = 0;
  if($lines<0) { $PageEndFmt = (array)$PageEndFmt; array_unshift( $PageEndFmt, 'function:LimitDiffsNavLinks');}
  SDV($DiffCountPerPage, 10); # 0 means unlimited
  $start = intval(@$_REQUEST['diffstart']);
  $lines++;

  if($lines<$start) return false;
  if($start>=0 && $DiffCountPerPage>0 && $lines>$start+$DiffCountPerPage){
    $LimitDiffsMore = 1; return false;
  }
  return DiffHTML($pagename, $diff);
}

function LimitDiffsNavLinks($pagename) {
  global $DiffCountPerPage, $DiffShow, $LimitDiffsMore, 
    $LimitDiffsNewer, $LimitDiffsOlder, $LimitDiffsAll;
  $start = intval(@$_REQUEST['diffstart']);
  $nav = ""; 
  if($start>0) $nav .= sprintf($LimitDiffsNewer,
    $pagename, $DiffShow['source'], $DiffShow['minor'], max(0, $start-$DiffCountPerPage));
  if($start>0 || $LimitDiffsMore>0) $nav .= sprintf($LimitDiffsAll,
    $pagename, $DiffShow['source'], $DiffShow['minor']);
  if($LimitDiffsMore>0) $nav .= sprintf($LimitDiffsOlder,
    $pagename, $DiffShow['source'], $DiffShow['minor'], $start+$DiffCountPerPage);
  if($nav) echo MarkupToHTML($pagename, $nav);
}
