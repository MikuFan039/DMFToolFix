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

/*
 * LANGUAGE: English (US)
 * Translated by: Klemen Stirn
 *
 * !!! This file must be saved in UTF-8 encoding without byte order mark (BOM) !!!
 * Test chars: àáâãäåæ
 */

// Encoding for HTML pages and emails
$lang['enc']='utf-8'; // DO NOT CHANGE, must be utf-8!
$lang['lng']='English';

// Error messages
$lang['e02']='Invalid ID';
$lang['e03']='Please enter your name';
$lang['e04']='Enter a valid e-mail address or leave it empty';
$lang['e05']='Enter a valid website address or leave it empty';
$lang['e06']='Please enter your comments';
$lang['e07']='Please enter the security number';
$lang['e08']='Wrong security number';
$lang['e09']='Please enter your password';
$lang['e10']='Please enter your reply message';
$lang['e11']='This is not a valid action!';
$lang['e12']='Wrong password!';
$lang['e13']='Can\'t open entries file for writing. Please CHMOD entries file to 666 (rw-rw-rw-)!';
$lang['e14']='The bad words file can\'t be found! Please check the name of the file. On most servers names are CaSe SeNsiTiVe!';
$lang['e15']='Wrong password! Only the guestbook owner may read this post!';
$lang['e16']='Wrong password! The selected entry wasn\'t deleted.';
$lang['e17']='You may only submit this guestbook once per session!';
$lang['e18']='Can\'t open entries file for reading! CHMOD this file to 666 (rw-rw-rw) and make sure your host allows PHP scripts to read from local files!';
$lang['e19']='Error';
$lang['e20']='ERROR: Invalid IP address, access blocked!';

// Text used
$lang['t07']='This post has been submitted from:';
$lang['t08']='Click here to continue';
$lang['t09']='View IP address';
$lang['t10']='Only guestbook owner may view IP addresses of people who posted into this guestbook. To view IP for the selected post please enter your administration password and click the &quot;View IP&quot; button.';
$lang['t12']='Your reply has been posted successfully!';
$lang['t13']='Reply to guestbook post';
$lang['t14']='Guestbook owner may use this form to reply to a post. To reply to the selected post please enter your administration password, your message and click the &quot;Post reply&quot; button.';
$lang['t15']='发送人';
$lang['t16']='留言：';
$lang['t17']='昵称：';
$lang['t18']='来自：';
$lang['t19']='网站：';
$lang['t20']='邮箱：';
$lang['t21']='管理员密码:';
$lang['t22']='附加选项：';
$lang['t23']='屏蔽此IP';
$lang['t24']='查看IP';
$lang['t25']='回复：';
$lang['t26']='更多';
$lang['t27']='联系';
$lang['t28']='不显示表情';
$lang['t29']='发表回复';
$lang['t30']='管理员回复：';
$lang['t31']='Added:';
$lang['t32']='删除';
$lang['t33']='回复';
$lang['t34']='返回';
$lang['t35']='查看匿名留言';
$lang['t36']='This is a private post and may only be read by the owner of this questbook. To view selected private post please enter your administration password and click the &quot;Read private post&quot; button.';
$lang['t37']='Selected entry was successfully removed!';
$lang['t38']='Delete guestbook post';
$lang['t39']='Only guestbook owner may delete posts. To delete selected post please enter your administration password and click the &quot;Delete this entry&quot; button to confirm your decision.';
$lang['t40']='Delete this entry';
$lang['t41']='Someone has just signed your guestbook'; // <-- This is e-mail subject
$lang['t42']='Hello!';
$lang['t43']='Someone has just signed your guestbook!'; // <-- This is text inside e-mail
$lang['t44']='Message (without smileys):';
$lang['t45']='Visit the below URL to view your guestbook:';
$lang['t46']='已经到结尾啦~';
$lang['t48']='点我留言';
$lang['t49']='必填字段以<b>粗体</b>展示';
$lang['t50']='昵称：';
$lang['t51']='来自：';
$lang['t52']='邮箱：';
$lang['t54']='请不要输入网址';
$lang['t55']='发送匿名留言';
$lang['t56']='请输入验证码：';
$lang['t57']='输入评论';
$lang['t58']='点击查看匿名留言';
$lang['t59']='返回上一页';
$lang['t60']='查看所有留言';
$lang['t61']='返回';
$lang['t62']='Security image';
$lang['t63']='View e-mail address';
$lang['t64']='Only guestbook owner may view e-mail addresses. To view contact e-mail please enter your administration password and click the &quot;View Email address&quot; button.';
$lang['t66']='邮箱默认隐藏';

// Added or modified in version 1.7
$lang['t01']='留言条数： %d';
$lang['t75']='留言页数： %d';
$lang['e01']='You cannot sign this guestbook at this time!';
$lang['t53']='Your Web site:';
$lang['t02']='&laquo; First';
$lang['t03']='&lsaquo; Prev';
$lang['t04']='Next &rsaquo;';
$lang['t05']='Last &raquo;';
$lang['t11']='&laquo; Guestbook main page';
$lang['t06']='目前还没有人嗦话，我来抢沙发！';
$lang['t47']='Your message was added successfully!';
$lang['t67']='Please answer the anti-SPAM question';
$lang['t68']='Wrong answer to the anti-SPAM question';
$lang['t69']='Selected post was submitted from:';
$lang['t65']='Contact email for selected post:';
$lang['e21']='ERROR: We don\'t like spammers. You have been permanently banned from this guestbook!';
$lang['t70']='Emoticos';
$lang['t71']='Click on an icon to insert it into your message.';
$lang['t72']='Close Window';
$lang['t73']='Please limit comments to %d chars (now %d)';
$lang['t74']='Please keep number of emoticons below %d (now %d)';
$lang['m01']='一月';
$lang['m02']='二月';
$lang['m03']='三月';
$lang['m04']='四月';
$lang['m05']='五月';
$lang['m06']='六月';
$lang['m07']='七月';
$lang['m08']='八月';
$lang['m09']='九月';
$lang['m10']='十月';
$lang['m11']='十一月';
$lang['m12']='十二月';
$lang['e22']='Could not lock the entries file. Please try again later.';
$lang['t76']='Hello %s!';
$lang['t77']='The owner of %s has just replied to your entry.';
$lang['t78']='To read the reply please visit:';
$lang['t79']='Best regards,';
$lang['t80']='Reply to your Guestbook entry'; // E-mail subject
$lang['t81']='You already have a message waiting approval!';
$lang['e23']='Couldn\'t open temporary file for writing! Please CHMOD the apptmp folder to 777 (rwxrwxrwx)!';
$lang['t82']='A new guestbook entry is waiting approval.';
$lang['t83']='To APPROVE the entry visit this URL:';
$lang['t84']='To REJECT the entry visit this URL:';
$lang['t85']='Thank you. Your entry has been submitted for approval.';
$lang['e24']='Missing ID hash. Please make sure you copy the full approval/rejection URL!';
$lang['e25']='Wrong entry ID hash. Possible problems:<br><br>- the entry has already been approved or rejected<br>- you didn\'t copy the full approval/rejection URL';
$lang['t86']='The entry has been approved and submitted to the guestbook.';
$lang['t87']='The entry has been rejected and deleted.';

// Added 25th November 2009
$lang['t88']='发布留言';
