<?php
/*
 * GUESTBOOK SETTINGS
 *
 * See docs/settings.html for detailed options available
 */

// Password for admin area
$settings['apass'] = '1006093326';

// Website title
$settings['website_title'] = "DMF主页";

// Website URL
$settings['website_url'] = 'http://danmaku.site:90';

// Guestbook title
$settings['gbook_title'] = "留言板";

// Your e-mail address.
$settings['admin_email'] = '2016572973@qq.com';

// URL of the gbook.php file.
$settings['gbook_url'] = 'http://danmaku.site:90/gbook/gbook.php';

// If you want to use a logical anti-SPAM question type it here
$settings['spam_question'] = '0';

// Correct answer to the anti-SPAM logical question
$settings['spam_answer'] = '';

// Send you an e-mail when a new entry is added? 1 = YES, 0 = NO
$settings['notify'] = 0;

// Notify visitor when you reply to his/her guestbook entry? 1 = YES, 0 = NO
$settings['notify_visitor'] = 0;

// Manually approve new guestbook entris? 1 = YES, 0 = NO
$settings['man_approval'] = 0;

// Template to use. On many servers template names are CaSe SeNSiTiVe!
$settings['template'] = 'default';

// Name of the file where guestbook entries will be stored
$settings['logfile'] = 'entries.txt';

// Use "Your website" field? 1 = YES, 0 = NO
$settings['use_url'] = 0;

// Open URLs in a new window? 1 = YES, 0 = NO
$settings['url_blank'] = 1;

// Allow private posts (readable only by admin)? 1 = YES, 0 = NO
$settings['use_private'] = 1;

// Hide e-mail addresses? 1 = YES, 0 = NO
$settings['hide_emails'] = 1;

// Allow smileys? 1 = YES, 0 = NO
$settings['smileys'] = 1;

// Maximum number of smileys per post. Set to 0 for unlimited.
$settings['max_smileys'] = 20;

// Filter bad words? 1 = YES, 0 = NO
$settings['filter'] = 1;

// Filter language. Please refer to readme for info on how to add more bad words to the list!
$settings['filter_lang'] = 'en';

// Prevent automated submissions (recommended YES)? 0 = NO, 1 = YES, GRAPHICAL, 2 = YES, TEXT
$settings['autosubmit'] = 1;

// Checksum - just type some digits or chars. Used to help prevent SPAM
$settings['filter_sum'] = '2kc7DPFf464HG7JCb5CK';

// Use JunkMark(tm) SPAM filter (recommended YES)? 1 = YES, 0 = NO
$settings['junkmark_use'] = 1;

// JunkMark(tm) score limit after which messages are marked as SPAM
$settings['junkmark_limit'] = 61;

// Ban IP address if JunkMark(tm) score is 100 (100% SPAM)? 1 = YES, 0 = NO
$settings['junkmark_ban100'] = 1;

// Ignore proxy servers from JunkMark check? 1 = YES, 0 = NO
$settings['ignore_proxies'] = 0;

// Show "NO GUESTBOOK SPAM" banner? 1 = YES, 0 = NO
$settings['show_nospam'] = 1;

// Prevent multiple submissions in the same session? 1 = YES, 0 = NO
$settings['one_per_session'] = 1;

// Maximum length of the comment (chars). Set to 0 for unlimited length
$settings['max_comlen'] = 1000;

// Maximum chars word length
$settings['max_word'] = 75;

// Language file
$settings['language'] = 'language.inc.php';

// Allow IPv6 format? 1 = YES, 0 = NO
$settings['allow_IPv6'] = 0;

// Debug mode? 1 = ON, 0 = OFF
$settings['debug'] = 0;


//============================================================================//
// DO NOT EDIT BELOW
//============================================================================//

if (!defined('IN_SCRIPT')) {
    die('Invalid attempt!');
}

if ($settings['debug']) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}
