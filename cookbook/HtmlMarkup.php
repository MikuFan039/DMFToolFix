<?php if (!defined('PmWiki')) exit();
Markup(
  'html',
  'fulltext',
  '/\\(:html:\\)(.*?)\\(:htmlend:\\)/mesi',
  "Keep(str_replace(array('&lt;', '&gt;', '&amp;'), array('<', '>', '&'),
  PSS('$1')))"
);