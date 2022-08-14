<?php
/*
 * This file is part of GBook - PHP Guestbook.
 *
 * (c) Copyright 2016 by Klemen Stirn. All rights reserved.
 * http://www.phpjunkyard.com
 * http://www.phpjunkyard.com/php-guestbook-script.php
 *
 * For the full copyright and license agreement information, please view
 * the docs/index.html file that was distributed with this source code.
 */

define('IN_SCRIPT',true);

require('settings.php');
require($settings['language']);

/* Template path to use */
$settings['tpl_path'] = './templates/'.$settings['template'].'/';

/* Get file with emoticons settings */
require($settings['tpl_path'].'emoticons.php');

$list_emoticons = '';
foreach ($settings['emoticons'] as $code => $image)
{
	$list_emoticons .= '<a href="javascript:void(0)" onclick="Javascript:insertSmiley(\''.$code.'\');return false;"><img src="'.$settings['tpl_path'].'images/emoticons/'.$image.'" alt="'.$code.'" title="'.$code.'" class="gbook_emoticon" /></a> ';
}

require($settings['tpl_path'].'emoticons_popup.php');
exit();
