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

session_name('GBOOK');
session_start();
define('IN_SCRIPT',true);

if (empty($_SESSION['secnum']) || strlen($_SESSION['secnum']) != 5) {
    die('Invalid or missing security number');
}

require('settings.php');
require('secimg.inc.php');
$sc=new PJ_SecurityImage($settings['filter_sum']);
$sc->printImage(intval($_SESSION['secnum']));

exit;
