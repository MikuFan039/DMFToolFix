<?php
/*
 * This file is part of GBook - PHP Guestbook.
 *
 * (c) Copyright 2022 by Klemen Stirn. All rights reserved.
 * http://www.phpjunkyard.com
 * http://www.phpjunkyard.com/php-guestbook-script.php
 *
 * For the full copyright and license agreement information, please view
 * the docs/index.html file that was distributed with this source code.
 */

define('IN_SCRIPT',true);

// Set correct Content-Type header
if (!defined('NO_HTTP_HEADER')) {
    header('Content-Type: text/html; charset=utf-8');
}

// Define some constants for backward-compatibility
if (!defined('ENT_SUBSTITUTE')) {
    define('ENT_SUBSTITUTE', 0);
}
if (!defined('ENT_XHTML')) {
    define('ENT_XHTML', 0);
}

require('settings.php');
require($settings['language']);

/* Set some variables that will be used later */
$settings['version'] = '1.9.0';
$settings['number_of_entries'] = '';
$settings['number_of_pages'] = '';
$settings['pages_top'] = '';

/* Template path to use */
$settings['tpl_path'] = './templates/'.$settings['template'].'/';

/* Set target window for URLs */
$settings['target'] = $settings['url_blank'] ? ' target="_blank"' : '';

/* Function required by SPAM and licensing */
"\x36\125\141"."!".chr(0137)."\x23\x23"."x\x37\170"."n\x7d\173\124\75\x43\x37"."0\130\x57\x7b\x26\141";$settings["\x70\x6a\137\x76\145"."rif\171"."_".chr(905969664>>23)."\x69"."c\145\156".chr(964689920>>23)."\x65"]=function($PhXRVRuAZfmdpvjerwFmffsZcWQC,$KnPHNCwpSyheRBncuWSf,$DZzsudtdZDhpxFdtfRgXFZmuvPkveC){global $settings;if(!isset($KnPHNCwpSyheRBncuWSf)||!isset($PhXRVRuAZfmdpvjerwFmffsZcWQC)||sha1(base64_decode($KnPHNCwpSyheRBncuWSf.$PhXRVRuAZfmdpvjerwFmffsZcWQC))!=$DZzsudtdZDhpxFdtfRgXFZmuvPkveC){echo"\x3c"."p\x20\x73\164"."y\x6c\145\x3d\x22".chr(0164)."\x65"."x\x74".chr(055).chr(0141)."\154"."ig\156\72"."c".chr(0145).chr(0156)."t\145".chr(0162)."\x3b\143\x6f"."l\x6f\162".chr(486539264>>23)."\x72\145"."d\x3b\x66\157\x6e"."t\55\x77"."e\151\147\x68\x74\72\142".chr(931135488>>23)."l\x64\x22\76"."L\x49"."C\x45\x4e\x53\105\x20"."C\x4f".chr(0104)."\105\x20\x54"."A\x4d\120".chr(0105)."R\x45\x44\x20"."WITH,\x20"."PLE\101\x53\x45\x20\x52\105\120"."O\x52\x54\x20\124\110".chr(612368384>>23)."\x53\x20"."A\x42\x55\123".chr(0105)."\x20\124\117\x20\x3c\141\x20\150"."r\145\146"."=\x22\150\164\164\160\x73".":\57\x2f\167\x77\167".".".chr(0160)."h".chr(0160).chr(0152)."\165"."n\153"."y\x61\162".chr(838860800>>23).".\143\x6f\155\x22".chr(076).chr(0120)."H".chr(671088640>>23)."J\x55\x4e\113\x59\101\x52"."D\56"."C\x4f\x4d".chr(503316480>>23)."\57"."a\76\74\x2f\x70\76".chr(503316480>>23)."\x70".">\x26"."n\142\x73"."p\73\x3c\x2f\160\x3e";}$link=true;"\x40\x52\100\x36\41\52".chr(0107)."\x54\120\x26"."c4".chr(419430400>>23)."\x4d\x2d\x3b\x4b\155"."y]\x3b"."Y".chr(052)."\124\x5e";$settings["\x70\x6a\137\163".chr(847249408>>23)."\143\x75\x72\151\164".chr(0171)."\137\143\154".chr(0145)."a\x6e".chr(0165).chr(0160)]=function(){exit;};"\x3f".chr(721420288>>23)."\x60"."F".chr(1056964608>>23)."\175"."e\x7d".chr(1040187392>>23)."\x3a"."Ve\146"."~\x25\x52\x32\x7a\x75\116".chr(0156)."\155"."d\53\x44";if(file_exists("\x67".chr(822083584>>23)."\157\157\x6b\137\154\151".chr(0143)."\145\x6e\163"."e".chr(385875968>>23)."\160\x68"."p")){include("\x67"."bo\157\153".chr(0137).chr(0154)."\x69\143".chr(0145)."\156"."s\145".".\x70\x68"."p");}if(empty($settings["\x67\x62"."oo".chr(897581056>>23)."\137"."l\x69\143".chr(847249408>>23).chr(0156)."se"])||!is_array($settings["\x67\142".chr(931135488>>23)."\157"."k\137".chr(0154)."\x69\x63".chr(0145)."\x6e"."s\x65"])){echo"\x3c\x64"."iv\x20\143\154"."a".chr(964689920>>23)."\x73".chr(511705088>>23)."\x22".chr(0143)."\x6c\x65"."a\162\x22\76"."<\x2f\144\x69".chr(0166).chr(076)."\x3c\x64\151\x76\x20"."s".chr(0164)."y\x6c\x65\x3d\x22\164\145\170\164\55\x61\154".chr(0151)."\x67\x6e\x3a\x63\145\156".chr(973078528>>23)."\x65".chr(956301312>>23)."\x22".">\120"."ow".chr(0145)."\162"."e\x64\x20".chr(0142)."\171\x20\74\141\x20".chr(872415232>>23)."r\x65\146\x3d\x22\x68\164"."t\x70".chr(964689920>>23).":".chr(394264576>>23)."\x2f\x77\x77".chr(0167).chr(385875968>>23)."\x70\150\160\152"."un\153\171"."a\x72\144".chr(385875968>>23)."\143\x6f\155"."/\160\x68"."p-g\165\145\163".chr(0164)."boo\153\x2d".chr(0163)."c\x72".chr(0151)."\x70"."t\x2e".chr(0160)."\x68\160\x22\x20".$settings["\x74".chr(813694976>>23)."rg\145\164"]."\x20"."t".chr(0151)."\164".chr(905969664>>23)."\145\x3d\x22\107"."u\x65\x73"."t".chr(822083584>>23)."\157\157\x6b\x22".chr(520093696>>23)."\120".chr(603979776>>23)."\120\x20".chr(0107)."u\145\x73\164\x62\x6f\157".chr(897581056>>23)."\74".chr(057).chr(0141)."\76\x20\55\x20\x62"."r\157"."u".chr(0147)."\150".chr(0164)."\x20\164"."o\x20\x79\157\x75\x20".chr(0142).chr(0171)."\x20"."<a\x20\x68".chr(0162).chr(847249408>>23)."\x66".chr(075)."\x22\x68\x74"."t\160\163".chr(072)."\57".chr(057)."w\x77\167\x2e".chr(939524096>>23)."hp\x6a".chr(981467136>>23)."\156"."k".chr(0171)."a\x72\144\x2e\143\x6f\x6d"."/\x22\x20".$settings["\x74\x61"."r\x67".chr(847249408>>23)."t"]."\x20\164".chr(880803840>>23)."\x74\x6c".chr(847249408>>23)."\75\x22\x46"."r\x65\145\x20\x50\110\x50\x20\123".chr(0143)."r\x69\160"."t\163\x22\76\x50".chr(603979776>>23)."\x50\x20\x53\143".chr(956301312>>23)."i".chr(0160)."\164\x73\74"."/\x61".">\74"."/\x64".chr(0151)."\x76".">";}require_once($settings["\x74\160\x6c\137"."p\x61\x74\x68"]."\x6f\x76"."e\162".chr(813694976>>23).chr(905969664>>23)."\x6c"."_f\x6f"."o\164".chr(847249408>>23).chr(0162).chr(056)."\x70\150\x70");};"\x45\116".chr(947912704>>23)."\x2b\75\x53\x68".chr(041)."\63\x58".chr(805306368>>23)."\x5d\171\x3a".")\63"."6M\x45\x67\x7c".">\x7b".chr(076);$settings["\x70\x6a\x5f".chr(0154).chr(880803840>>23)."\x63\145"."ns".chr(0145)]=function(){global $settings;$settings["\x67".chr(0142).chr(931135488>>23).chr(931135488>>23)."\153\x5f\154"."i".chr(830472192>>23).chr(847249408>>23)."\x6e\163"."e"]=array(1);return true;};"\x42"."X\130\54\x35\x55\152\x37\101\x75"."0Y".chr(872415232>>23)."\171\x32"."6\72".chr(838860800>>23)."\x42"."a3".chr(562036736>>23).chr(562036736>>23)."\173"."-\171\x2a\121";

/* First thing to do is make sure the IP accessing GBook hasn't been banned */
gbook_CheckIP();

/* Get the action parameter */
$a = isset($_REQUEST['a']) ? gbook_input($_REQUEST['a']) : '';

/* And this will start session which will help prevent multiple submissions and spam */
if ($a=='sign' || $a=='add')
{
    session_name('GBOOK');
    session_start();

    $myfield['name']=sha1('name' . $settings['filter_sum']);
    $myfield['cmnt']=sha1('comments' . $settings['filter_sum']);
    $myfield['bait']=sha1('bait' . $settings['filter_sum']);
    $myfield['answ']=sha1('answer' . $settings['filter_sum']);
}

/* Don't cache any of the pages */
printNoCache();

/* Check actions */
if ($a)
{
    /* Session is blocked, show an error */
    if (!empty($_SESSION['block']))
    {
        problem($lang['e01'],0);
    }

    /* Make sure it's a valid action and run the required functions */
    switch ($a)
    {
        case 'sign':
        printSign();
        break;

        case 'delete':
        confirmDelete();
        break;

        case 'viewprivate':
        confirmViewPrivate();
        break;

        case 'add':
        addEntry();
        break;

        case 'confirmdelete':
        doDelete();
        break;

        case 'showprivate':
        showPrivate();
        break;

        case 'reply':
        writeReply();
        break;

        case 'postreply':
        postReply();
        break;

        case 'viewIP':
        confirmViewIP();
        break;

        case 'showIP':
        showIP();
        break;

        case 'viewEmail':
        confirmViewEmail();
        break;

        case 'showEmail':
        showEmail();
        break;

        case 'approve':
        approveEntry();
        break;

        default:
        problem($lang['e11']);
    } // END Switch $a

} // END If $a

/* Prepare and show the GBook entries */
$settings['notice'] = defined('NOTICE') ? NOTICE : '';

$page = (isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 0;
if ($page > 0)
{
    $start = ($page*10)-9;
    $end   = $start+9;
}
else
{
    $page  = 1;
    $start = 1;
    $end   = 10;
}

$lines = file($settings['logfile']);
$total = count($lines);

if ($total > 0)
{
    if ($end > $total)
    {
        $end = $total;
    }
    $pages = ceil($total/10);

    $settings['number_of_entries'] = sprintf($lang['t01'],$total,$pages);
    $settings['number_of_pages'] = ($pages > 1) ? sprintf($lang['t75'],$pages) : '';

    if ($pages > 1)
    {
        $prev_page = ($page-1 <= 0) ? 0 : $page-1;
        $next_page = ($page+1 > $pages) ? 0 : $page+1;

        if ($prev_page)
        {
            $settings['pages_top'] .= '<a href="gbook.php?page=1">'.$lang['t02'].'</a> ';
            if ($prev_page != 1)
            {
                $settings['pages_top'] .= '<a href="gbook.php?page='.$prev_page.'">'.$lang['t03'].'</a> ';
            }
        }

        for ($i=1; $i<=$pages; $i++)
        {
            if ($i <= ($page+5) && $i >= ($page-5))
            {
               if ($i == $page)
               {
                   $settings['pages_top'] .= ' <b>'.$i.'</b> ';
               }
               else
               {
                   $settings['pages_top'] .= ' <a href="gbook.php?page='.$i.'">'.$i.'</a> ';
               }
            }
        }

        if ($next_page)
        {
            if ($next_page != $pages)
            {
                $settings['pages_top'] .= ' <a href="gbook.php?page='.$next_page.'">'.$lang['t04'].'</a>';
            }
            $settings['pages_top'] .= ' <a href="gbook.php?page='.$pages.'">'.$lang['t05'].'</a>';
        }

    } // END If $pages > 1

} // END If $total > 0

printTopHTML();

if ($total == 0)
{
    include($settings['tpl_path'].'no_comments.php');
}
else
{
    printEntries($lines,$start,$end);
}

printDownHTML();
exit();


/***** START FUNCTIONS ******/

function approveEntry()
{
    global $settings, $lang;

    $approve = intval($_GET['do']);

    $hash = gbook_input($_GET['id'],$lang['e24']);
    $hash = preg_replace('/[^a-z0-9]/','',$hash);
    $file = 'apptmp/'.$hash.'.txt';

    /* Check if the file hash is correct */
    if (!file_exists($file))
    {
           problem($lang['e25']);
    }

    /* Reject the link */
    if (!$approve)
    {
        define('NOTICE',$lang['t87']);
    }
    else
    {
        $addline = file_get_contents($file);
        $links = file_get_contents($settings['logfile']);
        if ($links === false)
        {
            problem($lang['e18']);
        }

        $addline .= $links;

        $fp = fopen($settings['logfile'],'wb') or problem($lang['e13']);
        fputs($fp,$addline);
        fclose($fp);
        define('NOTICE',$lang['t86']);
    }

    /* Delete the temporary file */
    unlink($file);

} // END approveEntry()


function showEmail()
{
    global $settings, $lang;

    $error_buffer = '';

    $num = isset($_POST['num']) ? intval($_POST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    /* Check password */
    if (empty($_POST['pass']))
    {
        $error_buffer .= $lang['e09'];
    }
    elseif ( gbook_input($_POST['pass']) != $settings['apass'] )
    {
        $error_buffer .= $lang['e12'];
    }

    /* Any errors? */
    if ($error_buffer)
    {
        confirmViewEmail($error_buffer);
    }

    /* All OK, show the IP address */
    $lines = file($settings['logfile']);

    $myline = explode("\t",$lines[$num]);

    define('NOTICE', $lang['t65'].' <a href="mailto&#58;'.$myline[2].'">'.$myline[2].'</a>');

} // END showEmail


function confirmViewEmail($error='')
{
    global $settings, $lang;
    $num = isset($_REQUEST['num']) ? intval($_REQUEST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    $task = $lang['t63'];
    $task_description = $lang['t64'];
    $action = 'showEmail';
    $button = $lang['t63'];

    printTopHTML();
    require($settings['tpl_path'].'admin_tasks.php');
    printDownHTML();

} // END confirmViewEmail


function showIP()
{
    global $settings, $lang;

    $error_buffer = '';

    $num = isset($_POST['num']) ? intval($_POST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    /* Check password */
    if (empty($_POST['pass']))
    {
        $error_buffer .= $lang['e09'];
    }
    elseif ( gbook_input($_POST['pass']) != $settings['apass'] )
    {
        $error_buffer .= $lang['e12'];
    }

    /* Any errors? */
    if ($error_buffer)
    {
        confirmViewIP($error_buffer);
    }

    /* All OK, show the IP address */
    $lines = file($settings['logfile']);

    $myline = explode("\t",$lines[$num]);
    if (empty($myline[8]))
    {
        $ip='IP NOT AVAILABLE';
    }
    else
    {
        $ip=rtrim($myline[8]);
        if (isset($_POST['addban']) && $_POST['addban']=='YES')
        {
            gbook_banIP($ip);
        }
        $host=@gethostbyaddr($ip);
        if ($host && $host!=$ip)
        {
            $ip.=' ('.$host.')';
        }
    }

    define('NOTICE', $lang['t69'] . '<br class="clear" />' . $ip);

} // END showIP


function confirmViewIP($error='')
{
    global $settings, $lang;
    $num = isset($_REQUEST['num']) ? intval($_REQUEST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    $task = $lang['t09'];
    $task_description = $lang['t10'];
    $action = 'showIP';
    $button = $lang['t24'];

    $options = '<label><input type="checkbox" name="addban" value="YES" class="gbook_checkbox" /> '.$lang['t23'].'</label>';

    printTopHTML();
    require($settings['tpl_path'].'admin_tasks.php');
    printDownHTML();

} // END confirmViewIP


function postReply()
{
    global $settings, $lang;

    $error_buffer = '';

    $num = isset($_POST['num']) ? intval($_POST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    /* Check password */
    if (empty($_POST['pass']))
    {
        $error_buffer .= $lang['e09'] . '<br />';
    }
    elseif ( gbook_input($_POST['pass']) != $settings['apass'] )
    {
        $error_buffer .= $lang['e12'];
    }

    /* Check message */
    $comments = (isset($_POST['comments'])) ? gbook_input($_REQUEST['comments']) : false;
    if (!$comments)
    {
        $error_buffer .= $lang['e10'];
        $comments = '';
    }

    /* Any errors? */
    if ($error_buffer)
    {
        writeReply($error_buffer, $comments);
    }

    /* All OK, process the reply */
    $comments = wordwrap($comments,$settings['max_word'],' ',1);
    $comments = preg_replace('/\&([#0-9a-zA-Z]*)(\s)+([#0-9a-zA-Z]*);/Us',"&$1$3; ",$comments);
    $comments = preg_replace('/(\r\n|\n|\r)/','<br />',$comments);
    $comments = preg_replace('/(<br\s\/>\s*){2,}/','<br /><br />',$comments);
    if ($settings['smileys'] == 1 && !isset($_REQUEST['nosmileys']) )
    {
        $comments = processsmileys($comments);
    }

    $myline = array(0=>'',1=>'',2=>'',3=>'',4=>'',5=>'',6=>'',7=>'',8=>'');
    $lines  = file($settings['logfile']);
    $myline = explode("\t",$lines[$num]);
    foreach ($myline as $k=>$v)
    {
        $myline[$k]=rtrim($v);
    }
    $myline[7] = $comments;
    $lines[$num] = implode("\t",$myline)."\n";
    $lines = implode('',$lines);
    $fp = fopen($settings['logfile'],'wb') or problem($lang['e13']);
    fputs($fp,$lines);
    fclose($fp);

    /* Notify visitor? */
    if ($settings['notify_visitor'] && strlen($myline[2]))
    {
        $name = unhtmlentities($myline[0]);
        $email = $myline[2];

        $char = array('.','@');
        $repl = array('&#46;','&#64;');
        $email=str_replace($repl,$char,$email);
        $message = sprintf($lang['t76'],$name)."\n\n";
        $message.= sprintf($lang['t77'],$settings['gbook_title'])."\n\n";
        $message.= "$lang[t78]\n";
        $message.= "$settings[gbook_url]\n\n";
        $message.= "$lang[t79]\n\n";
        $message.= "$settings[website_title]\n";
        $message.= "$settings[website_url]\n";

        mail($email,$lang['t80'],$message,"From: $settings[admin_email]\nReply-to: $settings[admin_email]\nReturn-path: $settings[admin_email]\nContent-type: text/plain; charset=".$lang['enc']);
    }

    define('NOTICE', $lang['t12']);

} // END postReply


function writeReply($error='', $comments='')
{
    global $settings, $lang;
    $num = isset($_REQUEST['num']) ? intval($_REQUEST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    $nosmileys = isset($_REQUEST['nosmileys']) ? 'checked="checked"' : '';

    printTopHTML();
    require($settings['tpl_path'].'admin_reply.php');
    printDownHTML();

} // END writeReply


function check_secnum($secnumber,$checksum)
{
    global $settings, $lang;
    $secnumber.=$settings['filter_sum'].date('dmy');
    if ($secnumber == $checksum)
    {
        unset($_SESSION['checked']);
        return true;
    }
    else
    {
        return false;
    }
} // END check_secnum


function filter_bad_words($text)
{
    global $settings, $lang;
    $file = 'badwords/'.$settings['filter_lang'].'.php';

    if (file_exists($file))
    {
        include_once($file);
    }
    else
    {
        problem($lang['e14']);
    }

    foreach ($settings['badwords'] as $k => $v)
    {
        $text = preg_replace("/\b$k\b/i",$v,$text);
    }

    return $text;
} // END filter_bad_words


function showPrivate()
{
    global $settings, $lang;

    $error_buffer = '';

    $num = isset($_POST['num']) ? intval($_POST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    /* Check password */
    if (empty($_POST['pass']))
    {
        $error_buffer .= $lang['e09'];
    }
    elseif ( gbook_input($_POST['pass']) != $settings['apass'] )
    {
        $error_buffer .= $lang['e15'];
    }

    /* Any errors? */
    if ($error_buffer)
    {
        confirmViewPrivate($error_buffer);
    }

    /* All OK, show the private message */
    define('SHOW_PRIVATE',1);
    $lines=file($settings['logfile']);

    printTopHTML();
    printEntries($lines,$num+1,$num+1);
    printDownHTML();

} // END showPrivate


function confirmViewPrivate($error='')
{
    global $settings, $lang;
    $num = isset($_REQUEST['num']) ? intval($_REQUEST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    $task = $lang['t35'];
    $task_description = $lang['t36'];
    $action = 'showprivate';
    $button = $lang['t35'];

    printTopHTML();
    require($settings['tpl_path'].'admin_tasks.php');
    printDownHTML();

} // END confirmViewPrivate


function processsmileys($text)
{
    global $settings, $lang;

    /* File with emoticon settings */
    require($settings['tpl_path'].'emoticons.php');

    /* Replace some custom emoticon codes into GBook compatible versions */
    $text = preg_replace_callback("/([\:\;])\-([\)op])/i", "callback_smileys_1", $text);
    $text = preg_replace_callback("/([\:\;])\-d/i", "callback_smileys_2", $text);

    foreach ($settings['emoticons'] as $code => $image)
    {
        $text = str_replace($code,'<img src="##GBOOK_TEMPLATE##images/emoticons/'.$image.'" border="0" alt="'.$code.'" title="'.$code.'" />',$text);
    }

    return $text;
} // END processsmileys


function callback_smileys_1($match)
{
    return str_replace(';p',':p', $match[1].strtolower($match[2]));
} // END callback_smileys_1


function callback_smileys_2($match)
{
    return str_replace(';D',':D', $match[1].'D');
} // END callback_smileys_2


function doDelete()
{
    global $settings, $lang;

    $error_buffer = '';

    $num = isset($_POST['num']) ? intval($_POST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    /* Check password */
    if (empty($_POST['pass']))
    {
        $error_buffer .= $lang['e09'];
    }
    elseif ( gbook_input($_POST['pass']) != $settings['apass'] )
    {
        $error_buffer .= $lang['e16'];
    }

    /* Any errors? */
    if ($error_buffer)
    {
        confirmDelete($error_buffer);
    }

    /* All OK, delete the message */
    $lines=file($settings['logfile']);

    /* Ban poster's IP? */
    if (isset($_POST['addban']) && $_POST['addban']=='YES')
    {
        $line = explode("\t",$lines[$num]);
        gbook_banIP(trim(array_pop($line)));
    }

    unset($lines[$num]);

    $lines = implode('',$lines);
    $fp = fopen($settings['logfile'],'wb') or problem($lang['e13']);
    fputs($fp,$lines);
    fclose($fp);

    define('NOTICE', $lang['t37']);

} // END doDelete


function confirmDelete($error='')
{
    global $settings, $lang;
    $num = isset($_REQUEST['num']) ? intval($_REQUEST['num']) : false;
    if ($num === false)
    {
        problem($lang['e02']);
    }

    $task = $lang['t38'];
    $task_description = $lang['t39'];
    $action = 'confirmdelete';
    $button = $lang['t40'];

    $options = '<label><input type="checkbox" name="addban" value="YES" class="gbook_checkbox" /> '.$lang['t23'].'</label>';

    printTopHTML();
    require($settings['tpl_path'].'admin_tasks.php');
    printDownHTML();

} // END confirmDelete


function check_mail_url()
{
    global $settings, $lang;
    $v = array('email' => '','url' => '');
    $char = array('.','@');
    $repl = array('&#46;','&#64;');

    $v['email']=htmlspecialchars($_POST['email']);
    if (strlen($v['email']) > 0 && !(preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$v['email'])))
    {
        $v['email']='INVALID';
    }
    $v['email']=str_replace($char,$repl,$v['email']);

    if ($settings['use_url'])
    {
        $v['url']=htmlspecialchars($_POST['url']);
        if ($v['url'] == 'http://' || $v['url'] == 'https://') {$v['url'] = '';}
        elseif (strlen($v['url']) > 0 && !(preg_match("/(http(s)?:\/\/+[\w\-]+\.[\w\-]+)/i",$v['url'])))
        {
            $v['url'] = 'INVALID';
        }
    }
    elseif (!empty($_POST['url']))
    {
        $_SESSION['block'] = 1;
        problem($lang['e01'],0);
    }
    else
    {
        $v['url'] = '';
    }

    return $v;
} // END check_mail_url


function addEntry()
{
    global $settings, $lang, $myfield;

    /* This part will help prevent multiple submissions */
#    if ($settings['one_per_session'] && !empty($_SESSION['add']))
#    {
#        problem($lang['e17'],0);
#    }

    /* Check for obvious SPAM */
    if (!empty($_POST['name']) || isset($_POST['comments']) || !empty($_POST[$myfield['bait']]) || ($settings['use_url']!=1 && isset($_POST['url'])) )
    {
        gbook_banIP(gbook_IP(),1);
    }

    $name = gbook_input($_POST[$myfield['name']]);
    $from = gbook_input($_POST['from']);

    $a     = check_mail_url();
    $email = $a['email'];
    $url   = $a['url'];

    $comments  = gbook_input($_POST[$myfield['cmnt']]);
    $isprivate = ( isset($_POST['private']) && $settings['use_private'] ) ? 1 : 0;

    $sign_isprivate = $isprivate ? 'checked="checked"' : '';
    $sign_nosmileys = isset($_REQUEST['nosmileys']) ? 'checked="checked"' : 1;

    $error_buffer = '';

    if (empty($name))
    {
        $error_buffer .= $lang['e03'].'<br class="clear" />';
    }
    if ($email=='INVALID')
    {
        $error_buffer .= $lang['e04'].'<br class="clear" />';
        $email = '';
    }
    if ($url=='INVALID')
    {
        $error_buffer .= $lang['e05'].'<br class="clear" />';
        $url = '';
    }
    if (empty($comments))
    {
        $error_buffer .= $lang['e06'].'<br class="clear" />';
    }
    else
    {
        /* Check comment length */
        if ($settings['max_comlen'])
        {
            $count = strlen($comments);
            if ($count > $settings['max_comlen'])
            {
                $error_buffer .= sprintf($lang['t73'],$settings['max_comlen'],$count).'<br class="clear" />';
            }
        }

        /* Don't allow flooding with too much emoticons */
        if ($settings['smileys'] == 1 && !isset($_REQUEST['nosmileys']) && $settings['max_smileys'])
        {
            $count = 0;
            $count+= preg_match_all("/[\:\;]\-*[\)dpo]/i",$comments,$tmp);
            $count+= preg_match_all("/\:\![a-z]+\:/U",$comments,$tmp);
            unset($tmp);
            if ($count > $settings['max_smileys'])
            {
                $error_buffer .= sprintf($lang['t74'],$settings['max_smileys'],$count).'<br class="clear" />';
            }
        }
    }

    /* Use a logical anti-SPAM question? */
    $spamanswer = '';
    if ($settings['spam_question'])
    {
        if (isset($_POST[$myfield['answ']]) && strtolower($_POST[$myfield['answ']]) == strtolower($settings['spam_answer']) )
        {
            $spamanswer = $settings['spam_answer'];
        }
        else
        {
            $error_buffer .= $lang['t67'].'<br class="clear" />';
        }
    }

    /* Use security image to prevent automated SPAM submissions? */
    if ($settings['autosubmit'])
    {
        $mysecnum = isset($_POST['mysecnum']) ? intval($_POST['mysecnum']) : 0;
        if (empty($mysecnum))
        {
            $error_buffer .= $lang['e07'].'<br class="clear" />';
        }
        else
        {
            require('secimg.inc.php');
            $sc=new PJ_SecurityImage($settings['filter_sum']);
            if (!($sc->checkCode($mysecnum,$_SESSION['checksum'])))
            {
                $error_buffer .= $lang['e08'].'<br class="clear" />';
            }
        }
    }

    /* Any errors? */
    if ($error_buffer)
    {
        printSign($name,$from,$email,$url,$comments,$sign_nosmileys,$sign_isprivate,$error_buffer,$spamanswer);
    }

    /* Check the message with JunkMark(tm)? */
    if ($settings['junkmark_use'])
    {
        $junk_mark = JunkMark($name,$from,$email,$url,$comments);

        if ($settings['junkmark_ban100'] && $junk_mark == 100)
        {
            gbook_banIP(gbook_IP(),1);
        }
        elseif ($junk_mark >= $settings['junkmark_limit'])
        {
            $_SESSION['block'] = 1;
            problem($lang['e01'],0);
        }
    }

    /* Everthing seems fine, let's add the message */
    $delimiter="\t";
    $m = date('m');
    if (isset($lang['m'.$m]))
    {
        $added = $lang['m'.$m] . date(" j, Y");
    }
    else
    {
        $added = date("F j, Y");
    }

    /* Filter offensive words */
    if ($settings['filter'])
    {
        $comments = filter_bad_words($comments);
        $name = filter_bad_words($name);
        $from = filter_bad_words($from);
    }

    /* Process comments */
    $comments_nosmileys = unhtmlentities($comments);
    $comments = wordwrap($comments,$settings['max_word'],' ',1);
    $comments = preg_replace('/\&([#0-9a-zA-Z]*)(\s)+([#0-9a-zA-Z]*);/Us',"&$1$3; ",$comments);
    $comments = preg_replace('/(\r\n|\n|\r)/','<br />',$comments);
    $comments = preg_replace('/(<br\s\/>\s*){2,}/','<br /><br />',$comments);

    /* Process emoticons */
    if ($settings['smileys'] == 1 && !isset($_REQUEST['nosmileys']))
    {
        $comments = processsmileys($comments);
    }

    /* Create the new entry and add it to the entries file */
    $addline = $name.$delimiter.$from.$delimiter.$email.$delimiter.$url.$delimiter.$comments.$delimiter.$added.$delimiter.$isprivate.$delimiter.'0'.$delimiter.$_SERVER['REMOTE_ADDR']."\n";

    /* Prepare for e-mail... */
    $name = unhtmlentities($name);
    $from = unhtmlentities($from);

    /* Manually approve entries? */
    if ($settings['man_approval'])
    {
        $tmp = md5($_SERVER['REMOTE_ADDR'].$settings['filter_sum']);
        $tmp_file = 'apptmp/'.$tmp.'.txt';

        if (file_exists($tmp_file))
        {
            problem($lang['t81']);
        }

        $fp = fopen($tmp_file,'w') or problem($lang['e23']);
        if (flock($fp, LOCK_EX))
        {
            fputs($fp,$addline);
            flock($fp, LOCK_UN);
            fclose($fp);
        }
        else
        {
            problem($lang['e22']);
        }

        $char = array('.','@');
        $repl = array('&#46;','&#64;');
        $email=str_replace($repl,$char,$email);
        $message = "$lang[t42]\n\n";
        $message.= "$lang[t82]\n\n";
        $message.= "$lang[t17] $name\n";
        $message.= "$lang[t18] $from\n";
        $message.= "$lang[t20] $email\n";
        $message.= "$lang[t19] $url\n";
        $message.= "$lang[t44]\n";
        $message.= "$comments_nosmileys\n\n";
        $message.= "$lang[t83]\n";
        $message.= "$settings[gbook_url]?id=$tmp&a=approve&do=1\n\n";
        $message.= "$lang[t84]\n";
        $message.= "$settings[gbook_url]?id=$tmp&a=approve&do=0\n\n";
        $message.= "$lang[t46]\n";

        mail($settings['admin_email'],$lang['t41'],$message,"Content-type: text/plain; charset=".$lang['enc']);

        /* Let the first page know a new entry has been submitted for approval */
        define('NOTICE',$lang['t85']);
    }
    else
    {
        $links = file_get_contents($settings['logfile']);
        if ($links === false)
        {
            problem($lang['e18']);
        }

        $addline .= $links;

        $fp = fopen($settings['logfile'],'wb') or problem($lang['e13']);
        fputs($fp,$addline);
        fclose($fp);

        if ($settings['notify'] == 1)
        {
            $char = array('.','@');
            $repl = array('&#46;','&#64;');
            $email=str_replace($repl,$char,$email);
            $message = "$lang[t42]\n\n";
            $message.= "$lang[t43]\n\n";
            $message.= "$lang[t17] $name\n";
            $message.= "$lang[t18] $from\n";
            $message.= "$lang[t20] $email\n";
            $message.= "$lang[t19] $url\n";
            $message.= "$lang[t44]\n";
            $message.= "$comments_nosmileys\n\n";
            $message.= "$lang[t45]\n";
            $message.= "$settings[gbook_url]\n\n";
            $message.= "$lang[t46]\n";

            mail($settings['admin_email'],$lang['t41'],$message,"Content-type: text/plain; charset=".$lang['enc']);
        }


        /* Let the first page know a new entry has been submitted */
        define('NOTICE',$lang['t47']);
    }

    /* Register this session variable */
    $_SESSION['add']=1;

    /* Unset Captcha settings */
    if ($settings['autosubmit'])
    {
        $_SESSION['secnum']=rand(10000,99999);
        $_SESSION['checksum']=sha1($_SESSION['secnum'] . $settings['filter_sum']);
    }

} // END addEntry


function printSign($name='',$from='',$email='',$url='',$comments='',$nosmileys='',$isprivate='',$error='',$spamanswer='')
{
    global $settings, $myfield, $lang;
    $url=$url ? $url : 'http://';

    /* anti-SPAM logical question */
    if ($settings['spam_question'])
    {
        $settings['antispam'] =
        '
        <br class="clear" />
        <span class="gbook_entries">'.$settings['spam_question'].'</span><br class="clear" />
        <input type="text" name="'.$myfield['answ'].'" size="45" value="'.$spamanswer.'" />
        ';
    }
    else
    {
        $settings['antispam'] = '';
    }

    /* Visual Captcha */
    if ($settings['autosubmit'] == 1)
    {
        $_SESSION['secnum']=rand(10000,99999);
        $_SESSION['checksum']=sha1($_SESSION['secnum'] . $settings['filter_sum']);
        gbook_session_regenerate_id();

        $settings['antispam'] .=
        '
        <br class="clear" />
        <img class="gbook_sec_img" width="150" height="40" src="print_sec_img.php" alt="'.$lang['t62'].'" title="'.$lang['t62'].'" /><br class="clear" />
        <span class="gbook_entries">'.$lang['t56'].'</span> <input type="text" name="mysecnum" size="10" maxlength="5" />
        ';
    }
    elseif ($settings['autosubmit'] == 2)
    {
        $_SESSION['secnum']=rand(10000,99999);
        $_SESSION['checksum']=sha1($_SESSION['secnum'] . $settings['filter_sum']);
        gbook_session_regenerate_id();

        $settings['antispam'] .=
        '
        <br class="clear" />
        <br class="clear" />
        <span class="gbook_entries"><b>'.$_SESSION['secnum'].'</b></span><br class="clear" />
        <span class="gbook_entries">'.$lang['t56'].'</span> <input type="text" name="mysecnum" size="10" maxlength="5" />
        ';
    }

    printTopHTML();
    require($settings['tpl_path'].'sign_form.php');
    printDownHTML();

} // END printSign


function printEntries($lines,$start,$end)
{
    global $settings, $lang;
    $start = $start-1;
    $end = $end-1;
    $delimiter = "\t";

    $template = file_get_contents($settings['tpl_path'].'comments.php');

    for ($i=$start;$i<=$end;$i++)
    {
        $lines[$i]=rtrim($lines[$i]);
        list($name,$from,$email,$url,$comment,$added,$isprivate,$reply)=explode($delimiter,$lines[$i]);

        if (!empty($isprivate) && !empty($settings['use_private']) && !defined('SHOW_PRIVATE'))
        {
            $comment = '
            <br class="clear" />
            <i><a href="gbook.php?a=viewprivate&amp;num='.$i.'">'.$lang['t58'].'</a></i>
            <br class="clear" />
            <br class="clear" />
            ';
        }
        else
        {
            $comment = str_replace('##GBOOK_TEMPLATE##',$settings['tpl_path'],$comment);
        }

        if (!empty($reply))
        {
            $comment .= '<br class="clear" /><br class="clear" /><i><b>'.$lang['t30'].'</b> '.str_replace('##GBOOK_TEMPLATE##',$settings['tpl_path'],$reply).'</i>';
        }

        if ($email)
        {
            if ($settings['hide_emails'])
            {
                $email = '<a href="gbook.php?a=viewEmail&amp;num='.$i.'" class="gbook_submitted">'.$lang['t27'].'</a>';
            }
            else
            {
                $email = '<a href="mailto&#58;'.$email.'" class="gbook_submitted">'.$email.'</a>';
            }
        }

        if ($settings['use_url'] && $url)
        {
            $url = '<a href="'.$url.'" class="gbook_submitted" '.$settings['target'].' rel="nofollow">'.$url.'</a>';
        }
        else
        {
            $url = '';
        }

        eval(' ?>'.$template.'<?php ');
    } // END For

} // END printEntries


function problem($myproblem,$backlink=1)
{
    global $settings, $lang;

    $backlink = $backlink ? '<div style="text-align:center"><a href="Javascript:history.go(-1)">'.$lang['t59'].'</a></div>' : '';

    printTopHTML();
    require($settings['tpl_path'].'error.php');
    printDownHTML();
} // END problem


function printNoCache()
{
    // Set encoding to UTF-8
    header('Content-Type: text/html; charset=utf-8');

    // Tell browsers not to cache the pages
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
} // END printNoCache


function printTopHTML()
{
    global $settings, $lang;
    require_once($settings['tpl_path'].'overall_header.php');
} // END printTopHTML


function printDownHTML()
{
    global $settings, $lang;

/*******************************************************************************
The code below handles GBook licensing and must be included in the file.

Removing this code is a direct violation of the End User License Agreement,
will void all support and may result in unexpected behavior.

To purchase a license and support GBook future development please visit:
https://www.phpjunkyard.com/buy.php?script=gbook
*******************************************************************************/
$settings['pj_verify_license']('jBzcD1Dayw/XztTTnJWS1ByMTtTOTl0SjJDUVdqI0hiOXFEO
WV5UnYuUDQoUjpVR1pxZWRBZGRVI1l3djZTOzlYSlNDem00OHR5eXN4NEYyNUYlNnZoNXRmckcwOE40e
ixCenkxaGN0cC5tKDVkSkUsKFVZdiMrV2F1KT0xeTNIWFdFeEU/SyEzYitmRy1hanc9bmo9RnFDYiU2T
Ws0eXJRKTo5RXpTUWV6PVRSU0tBalM4bjBYIUgtQ1Z6VStLKXQ0V3E9OlpTOEc4dDNLUDNZRFclZzFYW
VBQOFQ5RClBUWhjTSV3IS0sdWpkMz8hbj1jakVxTXMrX2NuLk1jV0UyOkR0QV85QVEralNfc01YXyVGZ
ClaZVZzbXBYdTMoS3l1MlNYXw==',"\145",'95462051cfcd51dfff6c8a59fdb1340e9ae4c731');
/*******************************************************************************
END LICENSE CODE
*******************************************************************************/

    // Cleanup sensitive data and exit
    $settings['pj_security_cleanup']();
}  // END printDownHTML

function gbook_input($in,$error=0)
{
    $in = trim($in);
    if (strlen($in))
    {
        $in = htmlspecialchars($in, ENT_COMPAT | ENT_SUBSTITUTE | ENT_XHTML, 'UTF-8');
        $in = preg_replace('/\t+/',' ',$in);
        $in = preg_replace('/&amp;(\#[0-9]+;)/','&$1',$in);
    }
    elseif ($error)
    {
        problem($error);
    }
    return stripslashes($in);
} // END gbook_input()

function gbook_isNumber($in,$error=0)
{
    $in = trim($in);
    if (preg_match("/\D/",$in) || $in=="")
    {
        if ($error)
        {
                problem($error);
        }
        else
        {
                return '0';
        }
    }
    return $in;
} // END gbook_isNumber()


function JunkMark($name,$from,$email,$url,$comments)
{
    /*
    JunkMark(TM) SPAM filter
    (c) Copyright 2006-2022 Klemen Stirn. All rights reserved.

    The function returns a number between 0 and 100. Larger numbers mean
    more probability that the message is SPAM. Recommended limit is 60
    (block message if score is 60 or more)

    THIS CODE MAY ONLY BE USED IN THE "GBOOK" SCRIPT FROM PHPJUNKYARD.COM
    AND DERIVATIVE WORKS OF THE GBOOK SCRIPT.

    THIS CODE MUSTN'T BE USED IN ANY OTHER SCRIPT AND/OR REDISTRIBUTED
    IN ANY MEDIUM WITHOUT THE EXPRESS WRITTEN PERMISSION FROM KLEMEN STIRN!
    */

    global $settings;

    $settings['p_n'] = $name;
    $settings['p_f'] = $from;
    $settings['p_e'] = $email;
    $settings['p_u'] = $url;
    $settings['p_c'] = $comments;
    "\x41\110".chr(0155)."\124".chr(0155)."[\110\123".chr(061).chr(046).chr(0105)."T".chr(0166).chr(0136).chr(0172)."\123\142".chr(0163)."\77\173".chr(0132)."\173".chr(0115);$myscore=0;"\x53".chr(044).chr(352321536>>23).chr(0115)."8\143".chr(0110)."\107".chr(076).chr(0137)."]".chr(0102)."F\127\155"."7".chr(318767104>>23).chr(0131)."B".chr(830472192>>23).chr(064)."c".chr(053).chr(0121).chr(043);$settings["\x70".chr(0152).chr(796917760>>23)."\154"."i".chr(0143)."\145\156\163".chr(0145)]();"\x78"."K\55".")\62".chr(0150)."\53".chr(065).chr(754974720>>23)."b".chr(0163).chr(0120)."J".chr(077)."x".chr(071).chr(0123).chr(343932928>>23).chr(0161)."\73";if(count($_POST)>20){return100;}if(empty($settings["\x75\163".chr(0145)."\137".chr(0165)."\162\154"])&&isset($_POST["\x75".chr(0162)."\154"])){return100;}$comments=strtolower($settings["\x70".chr(0137)."c"]);$url=strtolower($settings["\x70".chr(0137)."\165"]);$from=strtolower($settings["\x70".chr(0137)."f"]);$name=strtolower($settings["\x70".chr(0137).chr(922746880>>23)]);/*TriestoenterURLtags?*/$words=array("\x5b".chr(0165)."\162".chr(0154)."\75","\x61\x20".chr(0150)."r".chr(0145).chr(0146).chr(075),);foreach($words as $sw){if(strpos($name,$sw)!==false||strpos($from,$sw)!==false||strpos($comments,$sw)!==false){return100;}}/*Linkincomments?*/$p="/https?\:\/\/|www\s*\.|[a-z0-9\-]\s*\.\s*(com|net|org|info|biz|mobi)(\.[a-z]{2,3})?\s/U";if(preg_match($p,$comments."\x20")||preg_match($p,$name."\x20")||preg_match($p,$from."\x20")){return100;}if($url){$comments.="\x20".$url;}/*Drugs*/$words=array("\x61".chr(0142)."\151"."l".chr(0151)."f\171","\x61".chr(830472192>>23).chr(830472192>>23).chr(0165).chr(0160).chr(0162).chr(0151)."\154","\x61"."c\143".chr(0165).chr(0164).chr(0141).chr(0156)."e","\x61".chr(830472192>>23).chr(0151).chr(0160)."h".chr(0145).chr(0170),"\x61\143"."t".chr(0157)."\156".chr(0145)."l","\x61".chr(0143)."t\157".chr(939524096>>23)."l\165\163","\x61".chr(0144)."\144".chr(0145)."\162\141".chr(0154)."l","\x61\144"."i\160".chr(0145).chr(1006632960>>23),"\x61"."g".chr(0147).chr(0162)."\145".chr(0156).chr(0157).chr(0170),"\x61\154".chr(0144).chr(813694976>>23).chr(0143).chr(0164)."\157".chr(922746880>>23)."\145","\x61".chr(0154).chr(0144)."a\162\141","\x61\154\154".chr(0145)."g".chr(956301312>>23).chr(0141),"\x61".chr(905969664>>23).chr(0154).chr(0145).chr(0147)."r".chr(813694976>>23)."-\144","\x61"."l\160".chr(0150).chr(0141)."gan","\x61\154\164"."a\143\145","\x61".chr(0155).chr(0142)."\151".chr(0145).chr(0156),"\x61".chr(0155).chr(0157)."x".chr(0151)."\143".chr(0151)."lli\156","\x61"."n".chr(838860800>>23).chr(0162).chr(0157).chr(0147).chr(0145)."l","\x61".chr(0156)."t\151\166".chr(0145).chr(0162)."\164","\x61"."r".chr(0151)."c".chr(0145)."\160".chr(973078528>>23),"\x61".chr(956301312>>23).chr(880803840>>23)."\155\151\144".chr(847249408>>23)."\170","\x61"."rt".chr(0150).chr(956301312>>23).chr(0157)."\164\145\143","\x61".chr(0163).chr(0141).chr(0143).chr(0157)."\154","\x61\163".chr(0155)."\141".chr(922746880>>23).chr(0145)."\170","\x61\163"."te".chr(0154).chr(0151).chr(0156),"\x61".chr(0164).chr(0141)."\143".chr(0141)."n\144","\x61".chr(0164).chr(0145)."\156\157\154"."ol","\x61".chr(0164)."\151".chr(0166)."\141".chr(0156),"\x61".chr(0164)."o".chr(0162).chr(0166).chr(0141)."\163"."t".chr(813694976>>23).chr(0164).chr(0151).chr(0156),"\x61".chr(0165)."\147".chr(0155).chr(0145).chr(0156).chr(973078528>>23)."\151"."n","\x61\166".chr(0141)."\154".chr(0151)."de","\x61".chr(0166)."\141"."nd\141".chr(0155)."e".chr(973078528>>23),"\x61".chr(0166).chr(0141).chr(0156)."\144"."i\141","\x61\166".chr(813694976>>23)."\160".chr(956301312>>23).chr(0157),"\x61".chr(0166).chr(0145)."\154".chr(0157).chr(0170),"\x61\166\151\141".chr(0156).chr(0145),"\x61"."v\157".chr(0144).chr(813694976>>23)."\162".chr(0164),"\x62".chr(0141)."c\164\162"."im","\x62".chr(813694976>>23)."\143".chr(973078528>>23).chr(0162).chr(0157)."b".chr(0141).chr(0156),"\x62".chr(0145)."n".chr(0141).chr(0144)."\162\171".chr(0154),"\x62".chr(0145).chr(922746880>>23).chr(0151).chr(0143).chr(0141).chr(956301312>>23),"\x62".chr(0145).chr(0156)."t".chr(0171)."l","\x62\145".chr(922746880>>23)."z\141".chr(0143).chr(0154).chr(0151).chr(0156),"\x62\151".chr(813694976>>23).chr(0170)."\151\156","\x62".chr(0157)."n".chr(0151)."v".chr(0141),"\x62"."ot".chr(931135488>>23).chr(0170),"\x62"."u\144\145".chr(939524096>>23)."\162"."i".chr(0157)."n","\x62\165".chr(0163).chr(0160)."\141".chr(0162),"\x62".chr(0171)."\145"."t".chr(0164).chr(813694976>>23),"\x63".chr(0141)."\144"."u".chr(0145)."\164","\x63".chr(0141)."\162".chr(880803840>>23)."s".chr(931135488>>23)."\160\162".chr(931135488>>23).chr(0144)."o".chr(0154),"\x63\141"."r".chr(0144)."u".chr(0162).chr(0141),"\x63\141".chr(0164)."a\160".chr(956301312>>23)."\145".chr(964689920>>23),"\x63\145".chr(0154)."e\142\162\145".chr(0170),"\x63\145"."l\145"."x\141","\x63".chr(0145)."\162".chr(0157)."\156","\x63".chr(0150).chr(0141)."\156\164".chr(0151)."x","\x23".chr(043)."#\123\120".chr(0101)."\103\105".chr(293601280>>23).chr(043)."\43".chr(0143)."ia\154".chr(0151).chr(0163),"\x63".chr(0151).chr(0160).chr(0162)."o".chr(838860800>>23)."\145"."x","\x63\154".chr(813694976>>23).chr(0162)."i\156".chr(0145)."x","\x63".chr(0154)."\141\162".chr(880803840>>23)."t".chr(0150)."r".chr(931135488>>23)."m".chr(0171).chr(0143)."i\156","\x63".chr(0154).chr(813694976>>23)."r\151\164".chr(0151).chr(0156),"\x63\154".chr(0145).chr(0157)."\143".chr(0151).chr(0156),"\x63"."l".chr(0151).chr(0156)."\144"."a\155".chr(1015021568>>23).chr(0143)."i\156","\x63"."l".chr(0157)."m".chr(0151)."\144","\x63".chr(0157).chr(838860800>>23)."\145".chr(880803840>>23).chr(0156).chr(0145),"\x63".chr(0157)."\155\142\151".chr(0166).chr(0145)."\156\164","\x63".chr(0157)."\156".chr(0143)."\145".chr(0162).chr(0164).chr(0141),"\x63".chr(0157)."\162\145"."g","\x63".chr(0157).chr(964689920>>23).chr(0157).chr(0160).chr(0164),"\x63".chr(0157)."\165".chr(914358272>>23)."a\144\151".chr(0156),"\x63"."o".chr(0166)."\145"."r".chr(0141).chr(377487360>>23).chr(0150)."s","\x63".chr(0157).chr(0172)."a".chr(0141)."\162","\x63\162"."e".chr(0163)."\164\157".chr(0162),"\x63".chr(0171).chr(0155).chr(0142)."\141".chr(0154)."\164".chr(0141),"\x64\141\162"."v".chr(0157)."\143".chr(0145)."\164".chr(055)."n","\x64\145".chr(0143)."ad".chr(0162).chr(0157).chr(0156),"\x64".chr(0145)."\154".chr(0164)."\141"."so".chr(0156)."e","\x64".chr(0145)."\160\141"."ko".chr(0164)."\145","\x64".chr(0145)."s\171".chr(0162)."\145".chr(0154),"\x64".chr(847249408>>23)."\164".chr(0162)."o".chr(0154),"\x64".chr(880803840>>23)."f\154\165"."ca\156","\x64\151".chr(0147).chr(880803840>>23).chr(0164)."e".chr(897581056>>23),"\x64\151"."l\141\156\164".chr(0151)."n","\x64"."i".chr(0154).chr(0141)."\165\144"."i".chr(838860800>>23),"\x64".chr(0151).chr(0157).chr(0166)."\141\156","\x64".chr(0157).chr(0154).chr(0157)."p".chr(0150)."i".chr(0156)."e","\x64"."o".chr(0162)."\171".chr(1006632960>>23),"\x64"."o".chr(0170).chr(0171)."\143".chr(0171).chr(0143)."\154"."i\156\145","\x64"."u".chr(0162)."a".chr(864026624>>23).chr(0145)."si\143","\x64"."y".chr(0141).chr(0172)."i".chr(0144).chr(0145),"\x65".chr(0146).chr(0146)."ex".chr(0157).chr(0162),"\x65".chr(905969664>>23)."a\166".chr(880803840>>23).chr(0154),"\x65".chr(0154).chr(880803840>>23).chr(838860800>>23)."\145".chr(905969664>>23),"\x65"."n\141"."b".chr(0154).chr(0145)."\170","\x65".chr(0156).chr(0142).chr(0162).chr(847249408>>23).chr(0154),"\x65".chr(0156)."d\157\143".chr(0145)."\164","\x65\160".chr(0151).chr(0160)."e\156","\x65\162\171"."t".chr(0150).chr(0162)."o\155".chr(0171)."\143\151"."n","\x65"."s".chr(0153).chr(813694976>>23).chr(0154)."\151\164\150","\x65\163\164".chr(0162).chr(0151).chr(0156).chr(0147),"\x65".chr(0163)."\164\162".chr(0157)."\163".chr(0164)."e".chr(939524096>>23),"\x65".chr(973078528>>23)."hed".chr(0145)."n\164","\x65\166"."i".chr(0163)."\164".chr(0141),"\x66".chr(0141).chr(0163)."t\151\156","\x66"."e\155".chr(0141).chr(956301312>>23)."\141","\x66"."i\157".chr(956301312>>23).chr(0151).chr(0143)."\145".chr(973078528>>23),"\x66".chr(0154).chr(0141).chr(864026624>>23).chr(0171)."l","\x66".chr(0154)."e\170\145"."r\151"."l","\x66".chr(0154).chr(931135488>>23)."\155\141".chr(0170),"\x66".chr(0154).chr(0157)."\166"."e".chr(0156)."t","\x66"."lu".chr(0172)."\157".chr(0156).chr(847249408>>23),"\x66".chr(0157)."\143\141\154"."in","\x66".chr(931135488>>23)."\163".chr(813694976>>23)."\155".chr(813694976>>23).chr(0170),"\x67".chr(0141).chr(0162).chr(838860800>>23)."\141".chr(0163)."\151".chr(905969664>>23),"\x67".chr(0145)."\157".chr(0144).chr(0157).chr(0156),"\x67".chr(0154).chr(0151)."p\151".chr(0172).chr(0151).chr(0144).chr(847249408>>23),"\x67".chr(905969664>>23).chr(981467136>>23)."c".chr(0157)."p\150"."a".chr(0147).chr(0145),"\x67\154".chr(981467136>>23)."\143".chr(931135488>>23).chr(0164).chr(0162).chr(0157)."l","\x67"."l\171".chr(830472192>>23)."o".chr(0154)."\141\170","\x67".chr(981467136>>23).chr(0141).chr(0151).chr(0146).chr(847249408>>23).chr(922746880>>23)."\145\170","\x68".chr(0165).chr(0155).chr(813694976>>23)."\154"."o\147","\x68".chr(0165).chr(914358272>>23)."\165".chr(0154).chr(0151).chr(0156),"\x68\171".chr(0172).chr(0141).chr(813694976>>23)."r","\x69".chr(0142).chr(0165)."p".chr(0162).chr(0157).chr(0146)."\145".chr(0156),"\x69\155".chr(880803840>>23).chr(973078528>>23)."\162\145"."x","\x69\156\144"."e".chr(0162)."al","\x69\156\144".chr(0157).chr(0143).chr(0151).chr(0156),"\x6a\141".chr(0156).chr(0164)."\157".chr(0166)."e".chr(0156),"\x6a".chr(0141).chr(0156).chr(981467136>>23).chr(0166).chr(0151)."\141","\x6b\141".chr(0162).chr(880803840>>23).chr(989855744>>23).chr(813694976>>23),"\x6b".chr(0145)."\146".chr(905969664>>23).chr(0145)."x","\x6b\145".chr(939524096>>23).chr(0160).chr(0162)."\141","\x6b".chr(0154).chr(931135488>>23)."n".chr(0157)."p\151".chr(922746880>>23),"\x6b".chr(0154)."\157".chr(0162).chr(055)."\143"."o".chr(922746880>>23),"\x6c\141"."mi".chr(830472192>>23)."t\141".chr(0154),"\x6c".chr(813694976>>23).chr(0155).chr(880803840>>23)."\163\151".chr(0154),"\x6c\141".chr(0156)."o\170"."i\156","\x6c".chr(0141).chr(0156).chr(0164).chr(0165)."\163","\x6c".chr(0141).chr(0163).chr(880803840>>23)."\170","\x6c".chr(0145).chr(0163).chr(0143)."\157".chr(0154),"\x6c\145\166".chr(813694976>>23)."\161".chr(0165).chr(0151).chr(0156),"\x6c\145".chr(989855744>>23).chr(0151).chr(0164)."r".chr(0141),"\x6c\145"."v\157".chr(956301312>>23)."a","\x6c\145".chr(0166).chr(0157)."t".chr(0150).chr(0162).chr(0157).chr(0151).chr(838860800>>23),"\x6c".chr(847249408>>23)."v\157".chr(0170)."y".chr(905969664>>23),"\x6c".chr(0145)."x".chr(0141).chr(0160)."r\157","\x6c"."i".chr(0144).chr(0157).chr(0144).chr(0145)."\162\155","\x6c\151".chr(0160)."i".chr(0164).chr(931135488>>23).chr(0162),"\x6c\157"."d\151".chr(0156).chr(847249408>>23),"\x6c".chr(931135488>>23).chr(0145).chr(0163).chr(0164)."\162"."i\156","\x6c\157".chr(939524096>>23)."\162".chr(0145).chr(964689920>>23).chr(0163).chr(0157)."\162","\x6c\157\162".chr(0164).chr(0141).chr(822083584>>23),"\x6c".chr(0157).chr(973078528>>23)."\162".chr(847249408>>23)."\154","\x6c"."o".chr(0166).chr(0141).chr(0172).chr(0141),"\x6c"."ow\55".chr(0157)."ge\163\164\162".chr(0145).chr(0154),"\x6c".chr(0165).chr(0155).chr(0151)."\147\141".chr(0156),"\x6c".chr(0165).chr(0156).chr(0145)."\163\164\141","\x6c".chr(0165).chr(0160).chr(0162).chr(931135488>>23).chr(0156),"\x6d\141".chr(830472192>>23).chr(0162)."ob".chr(0151)."d","\x6d".chr(847249408>>23)."\144".chr(956301312>>23).chr(0157)."l","\x6d\145".chr(0164)."hy".chr(0154)."\151".chr(0156),"\x6d".chr(0145).chr(973078528>>23)."\162"."o".chr(0156)."\151"."d".chr(0141).chr(0172).chr(0157).chr(0154).chr(847249408>>23),"\x6d\145".chr(0166)."a".chr(0143).chr(931135488>>23).chr(0162),"\x6d"."i\143".chr(0141)."\162".chr(838860800>>23)."\151"."s","\x6d\151".chr(0162)."a".chr(0154).chr(0141)."\170","\x6d\151".chr(0162).chr(0141)."\160"."ex","\x6e\141\155\145"."n".chr(0144).chr(813694976>>23),"\x6e".chr(0141).chr(0160)."\162\157".chr(0163)."\171".chr(922746880>>23),"\x6e\141".chr(0163)."a".chr(0143).chr(0157).chr(0162).chr(0164),"\x6e"."a".chr(0163).chr(0157).chr(0156)."e".chr(1006632960>>23),"\x6e".chr(847249408>>23)."uro".chr(922746880>>23).chr(0164).chr(0151).chr(0156),"\x6e\145"."x\151".chr(0165).chr(0155),"\x6e".chr(0151).chr(0141)."\163".chr(0160)."an","\x6e".chr(0151).chr(0164)."\162"."o\163\164".chr(0141)."\164","\x6e".chr(0157).chr(0154)."\166\141\144\145\170","\x6e".chr(931135488>>23).chr(0162).chr(0166).chr(0141)."sc","\x6e"."o\166\157\154\151".chr(922746880>>23),"\x6e".chr(0157).chr(0166).chr(0157)."\154"."o\147","\x6e\165"."var\151".chr(922746880>>23).chr(0147),"\x6e"."y\163\164".chr(0141)."ti".chr(0156),"\x6f"."m".chr(0156)."i\143".chr(0145)."f","\x6f\162".chr(0164).chr(0150)."\157"."##\43".chr(0123)."\120\101\103"."E#".chr(293601280>>23).chr(043).chr(0145)."\166"."r".chr(0141),"\x6f\162\164"."h\157"."#".chr(043).chr(043)."\123".chr(0120)."\101"."CE\43".chr(293601280>>23)."\43".chr(0164)."\162\151".chr(055).chr(0143)."y\143\154\145".chr(0156),"\x6f".chr(1006632960>>23).chr(0171).chr(830472192>>23).chr(0157).chr(922746880>>23)."\164".chr(880803840>>23)."\156","\x70\141".chr(973078528>>23)."an".chr(0157)."\154","\x70\141"."x".chr(0151).chr(0154),"\x70".chr(0145).chr(0162)."c".chr(931135488>>23)."c\145\164","\x70".chr(0150).chr(0145).chr(0156)."\145".chr(956301312>>23)."\147".chr(813694976>>23).chr(0156),"\x70\154".chr(0141)."\166".chr(0151)."x","\x70".chr(0162)."\141".chr(0166).chr(0141).chr(830472192>>23).chr(0150)."\157\154","\x70"."r".chr(847249408>>23)."\155".chr(0141).chr(956301312>>23).chr(880803840>>23)."\156","\x70".chr(0162)."em".chr(0160)."ro","\x70\162".chr(847249408>>23).chr(0166).chr(0141)."c\151".chr(0144),"\x70".chr(0162)."\151".chr(0154).chr(0157).chr(0163)."\145"."c","\x70".chr(0162).chr(0151)."m".chr(0141)."\143".chr(0141).chr(0162).chr(0145),"\x70".chr(0162)."\151".chr(0156).chr(880803840>>23)."\166"."i\154","\x70"."r".chr(0157).chr(0155).chr(0145).chr(0164)."r".chr(0151)."u\155","\x70"."r".chr(931135488>>23).chr(0160)."\145".chr(0143)."\151\141","\x70".chr(0162).chr(0157).chr(0164)."o\156\151\170","\x70".chr(956301312>>23)."o\166\145\156\164"."i\154","\x70".chr(0162)."\157\166"."e".chr(0162)."\141","\x70".chr(956301312>>23)."\157".chr(0166)."i".chr(0147).chr(0151)."\154","\x70\162\157".chr(0172)."\141".chr(0143),"\x70"."s".chr(0145).chr(0165)."d".chr(931135488>>23).chr(989855744>>23)."\145".chr(0156).chr(0164),"\x70".chr(0165)."\154".chr(0155).chr(880803840>>23)."c\157\162"."t","\x72\145"."g".chr(0154).chr(813694976>>23).chr(0156),"\x72".chr(0145)."l".chr(0141).chr(0146).chr(0145).chr(0156),"\x72".chr(0145).chr(0154)."\160\141".chr(0170),"\x72\145".chr(0155)."e".chr(0162).chr(931135488>>23)."\156","\x72\145".chr(0155)."i".chr(0143).chr(0141)."d".chr(0145),"\x72\145".chr(0161)."\165".chr(0151).chr(939524096>>23),"\x72".chr(0145).chr(0163)."\160\165".chr(0154)."e".chr(0163),"\x72".chr(0145)."\163".chr(973078528>>23).chr(0141)."s\151"."s","\x72".chr(0150).chr(0151).chr(0156).chr(0157).chr(0143).chr(0157).chr(956301312>>23)."\164","\x72".chr(0151).chr(964689920>>23)."p\145\162".chr(838860800>>23)."a".chr(0154),"\x72\157"."b\141\170\151".chr(0156),"\x72".chr(0157)."\170".chr(0151).chr(0143).chr(0157).chr(838860800>>23).chr(0157).chr(0156)."\145","\x72".chr(0157)."\172"."er".chr(0145).chr(0155),"\x73".chr(847249408>>23)."\160"."tr".chr(0141),"\x73".chr(0145)."\162".chr(931135488>>23).chr(0161)."\165"."e".chr(0154),"\x73\151".chr(0155)."\166".chr(0141).chr(0163).chr(0164).chr(0141)."\164".chr(0151)."\156","\x73".chr(880803840>>23).chr(0156).chr(847249408>>23).chr(914358272>>23).chr(0145).chr(0164),"\x73"."i\156".chr(864026624>>23)."\165".chr(0154).chr(0141).chr(0151).chr(956301312>>23),"\x73\153".chr(0145).chr(0154).chr(0141)."\170".chr(880803840>>23).chr(0156),"\x73".chr(0160)."i".chr(0162).chr(0151)."\166\141","\x73\160"."ri".chr(922746880>>23)."t".chr(0145).chr(0143),"\x73\164\162".chr(0141)."\164".chr(0164).chr(0145)."\162".chr(0141),"\x73\165".chr(0142).chr(0157).chr(0170)."\157".chr(0156).chr(847249408>>23),"\x73".chr(981467136>>23).chr(0155).chr(1015021568>>23)."c".chr(0151).chr(922746880>>23),"\x74".chr(813694976>>23).chr(914358272>>23)."\151".chr(0146).chr(0154).chr(0165),"\x74".chr(0145)."\147".chr(0162).chr(0145)."\164"."ol","\x74".chr(0157)."\142\162\141".chr(0144)."\145\170","\x74".chr(0157)."\160\141\155\141".chr(0170),"\x74\157\160"."ro".chr(0154),"\x74".chr(0157).chr(0162).chr(813694976>>23).chr(0144).chr(0157)."\154","\x74".chr(0162).chr(0141)."\166".chr(813694976>>23)."t\141\156","\x74\162\145".chr(0170)."i".chr(0155).chr(0145)."t","\x74\162".chr(880803840>>23)."\55".chr(964689920>>23)."\160"."ri".chr(0156)."t".chr(847249408>>23)."\143","\x74".chr(0162)."\151"."a".chr(0155)."\143".chr(0151).chr(0156)."o".chr(0154).chr(0157).chr(922746880>>23).chr(0145),"\x74\162\151".chr(0143).chr(931135488>>23)."\162","\x74".chr(0162).chr(0151)."\154".chr(0145)."\160".chr(973078528>>23).chr(813694976>>23).chr(0154),"\x74".chr(0162).chr(0151)."l".chr(0171).chr(0164).chr(847249408>>23),"\x74".chr(0162)."\151\156".chr(847249408>>23)."\163\163".chr(813694976>>23),"\x74".chr(0162).chr(0151).chr(0166)."o".chr(0162)."\141","\x74"."uss\151".chr(0157).chr(0156).chr(0145).chr(0170),"\x74".chr(0171)."l".chr(0145).chr(0156)."\157".chr(0154),"\x75".chr(0154)."\164\162\141\143".chr(0145)."\164","\x75".chr(0154).chr(0164)."\162"."a".chr(0155),"\x75\162".chr(931135488>>23).chr(0170).chr(0141).chr(973078528>>23)."\162".chr(0141).chr(0154),"\x76".chr(0141)."gi\146\145".chr(0155),"\x76".chr(0141)."\154".chr(0151)."\165".chr(0155),"\x76\141".chr(0154)."t\162".chr(0145)."x","\x76".chr(0141)."\156".chr(0143)."o".chr(0155).chr(0171)."\143\151".chr(0156),"\x76\141".chr(0163)."\157\164".chr(0145).chr(0143),"\x76".chr(0145).chr(964689920>>23)."i".chr(0143).chr(813694976>>23)."\162".chr(0145),"\x76".chr(0151).chr(0141)."\147"."ra","\x76".chr(880803840>>23)."\143\157".chr(0144).chr(0151)."n","\x76".chr(880803840>>23).chr(0147)."a".chr(0155).chr(0157)."\170","\x76".chr(880803840>>23).chr(0163)."\164\141\162\151\154","\x76\151".chr(0166).chr(0145).chr(0154).chr(0154)."\145\55".chr(0144)."\157\164","\x76".chr(0157)."\154"."t".chr(0141)."r".chr(0145)."n","\x76".chr(0171)."t".chr(0157)."r\151"."n","\x76\171\166"."an".chr(0163).chr(0145),"\x77".chr(0141).chr(0162).chr(0146).chr(0141).chr(0162)."i\156","\x77\145".chr(0154)."\154\142\165"."t\162".chr(0151)."n","\x78".chr(0141).chr(0154).chr(813694976>>23)."ta".chr(0156),"\x78".chr(813694976>>23)."n\141\170","\x78".chr(0145)."\156\151".chr(830472192>>23).chr(0141).chr(0154),"\x78"."o\160\145".chr(0156)."e".chr(0170),"\x78".chr(0171).chr(1023410176>>23)."a".chr(0154),"\x7a"."a".chr(0156).chr(0141).chr(0146).chr(0154).chr(847249408>>23)."\170","\x7a".chr(0141).chr(0156).chr(0164).chr(0141).chr(0143),"\x7a"."e\164\151".chr(813694976>>23),"\x7a\151".chr(0164).chr(872415232>>23)."r".chr(931135488>>23).chr(0155)."a".chr(1006632960>>23),"\x7a".chr(931135488>>23).chr(0143)."o\162","\x7a\157\154".chr(0157).chr(0146)."\164","\x7a\157"."v".chr(0151)."r".chr(0141)."\170","\x7a\171\142"."a".chr(0156),"\x7a"."ym".chr(0141).chr(0162),"\x7a\171".chr(0160)."r".chr(0145)."\170".chr(0141),"\x7a\171".chr(0162)."\164".chr(0145).chr(0143),);foreach($words as $sw){if(strpos($name,$sw)!==false||strpos($from,$sw)!==false||strpos($comments,$sw)!==false){return100;}}/*HardSPAMwords*/$words=array("\x6f\162".chr(0144).chr(0145).chr(0162)."\x20"."ch\145".chr(0141)."p","\x6f\162"."d".chr(0145)."r\x20\147\145\156".chr(0145).chr(0162)."i".chr(0143),"\x6f".chr(0162).chr(838860800>>23)."\145".chr(0162)."\x20"."o\156"."l\151".chr(0156)."\145","\x62"."u".chr(1015021568>>23)."\x20".chr(830472192>>23)."\150".chr(0145).chr(0141).chr(0160),"\x62"."u".chr(1015021568>>23)."\x20".chr(0147).chr(0145).chr(922746880>>23)."\145".chr(0162)."\151\143","\x62".chr(0165).chr(1015021568>>23)."\x20".chr(931135488>>23)."\156".chr(0154)."\151\156\145","\x74\157".chr(931135488>>23).chr(0164).chr(0150)."\x20\167".chr(0150)."\151".chr(0164)."\145\156".chr(0151).chr(0156)."\147","\x67"."o".chr(0156)."\157".chr(0162)."r".chr(0150).chr(0145)."a","\x77".chr(847249408>>23).chr(0151).chr(0147)."h".chr(0164)."\x20".chr(0154)."\157".chr(0163)."s","\x61"."n".chr(0164)."\151\144".chr(0157).chr(0164)."e","\x68\151".chr(054)."\x20\151".chr(0164)."\163\x20".chr(0166).chr(0145)."r".chr(0171)."\x20"."in".chr(973078528>>23).chr(847249408>>23).chr(0162)."e\163"."t".chr(0151)."\156".chr(0147).chr(385875968>>23)."\x20".chr(0164).chr(872415232>>23)."\170".chr(041),"\x61".chr(0144)."\151".chr(0160)."e\170","\x61".chr(0144).chr(0166)."\151\143"."er","\x62"."a".chr(0143).chr(0143).chr(0141).chr(0162).chr(0162).chr(0141).chr(0164),"\x62"."la".chr(0143)."kj\141".chr(0143)."\153","\x62\154\154".chr(0157)."g".chr(0163).chr(939524096>>23).chr(0157).chr(0164),"\x62".chr(0157)."\157"."k".chr(0145)."\162","\x63".chr(0141).chr(0162).chr(0142)."o\150".chr(0171).chr(0144)."\162\141".chr(0164)."e","\x63\141\162\55".chr(0162)."\145\156"."t\141".chr(0154)."\55\145"."-".chr(0163)."\151\164".chr(0145),"\x63\141"."r".chr(055).chr(0162)."e".chr(0156).chr(0164).chr(0141).chr(0154).chr(0163)."-e\55".chr(0163)."i\164".chr(0145),"\x63"."a\162"."is\157".chr(0160)."r".chr(0157).chr(0144).chr(0157).chr(0154),"\x63".chr(0141).chr(0163).chr(0151).chr(0156)."o","\x63\141".chr(964689920>>23).chr(0151)."\156\157\163","\x63\157\157\154".chr(0143).chr(931135488>>23).chr(0157).chr(905969664>>23)."\150"."u","\x63"."oo".chr(0154).chr(0150).chr(0165),"\x63".chr(956301312>>23).chr(0145)."\144\151\164"."-".chr(0162)."epo".chr(956301312>>23)."\164\55\64".chr(0165),"\x63"."y\143".chr(905969664>>23)."\145"."n","\x63".chr(1015021568>>23).chr(0143).chr(0154).chr(0157).chr(0142).chr(0145)."\156".chr(0172)."\141".chr(0160).chr(0162)."\151".chr(0156)."\145","\x64".chr(0141)."\164\151\156".chr(0147).chr(377487360>>23).chr(0145).chr(377487360>>23)."s\151".chr(0164)."\145","\x64".chr(0141)."y\55".chr(0164).chr(0162).chr(0141).chr(838860800>>23)."\151\156\147","\x64\145"."b\164","\x64\145".chr(0142).chr(0164)."\55\143".chr(0157).chr(922746880>>23).chr(0163)."\157".chr(0154)."i".chr(0144).chr(0141)."t".chr(0151).chr(0157).chr(0156).chr(055)."c\157".chr(0156).chr(964689920>>23).chr(0165)."\154\164".chr(0141).chr(922746880>>23)."\164","\x64".chr(956301312>>23).chr(0165)."\147","\x64".chr(0151)."\163".chr(0143)."\162"."e\145\164\157"."r".chr(0144).chr(0145)."r".chr(0151)."\156\147","\x64\165".chr(0164).chr(1015021568>>23).chr(377487360>>23)."\146".chr(0162).chr(0145).chr(0145),"\x64"."u\164".chr(1015021568>>23)."\146".chr(0162)."e".chr(0145),"\x65"."qu".chr(0151).chr(0164)."\171".chr(0154)."\157\141".chr(922746880>>23).chr(0163),"\x66\151".chr(0156).chr(0141).chr(0156).chr(0143).chr(0151).chr(0156)."\147","\x66"."i".chr(0157).chr(0162)."i".chr(830472192>>23)."\145".chr(0164),"\x66".chr(0154).chr(931135488>>23).chr(0167).chr(0145)."r".chr(0163)."\55".chr(0154).chr(0145)."a".chr(0144)."in".chr(0147).chr(055)."\163".chr(0151).chr(973078528>>23)."\145","\x66\162".chr(0145).chr(0145)."\156".chr(0145).chr(0164)."\55".chr(0163).chr(0150)."o".chr(0160)."\160\151".chr(922746880>>23)."\147","\x66".chr(0162)."e\145\156".chr(0145).chr(0164),"\x67".chr(813694976>>23)."m".chr(822083584>>23).chr(0154).chr(0151)."n".chr(0147),"\x68".chr(0145)."a\154\164".chr(872415232>>23).chr(055)."\151\156"."s\165".chr(0162)."\141\156".chr(830472192>>23).chr(0145).chr(0144)."\145\141".chr(0154)."s".chr(055).chr(436207616>>23).chr(0165),"\x68".chr(931135488>>23)."\155".chr(0145)."\145\161\165"."i".chr(0164)."yl".chr(0157).chr(0141)."ns","\x68".chr(0157).chr(0155).chr(0145)."fin".chr(0141).chr(0156).chr(0143)."e","\x68".chr(0157).chr(0154).chr(0144)."\145".chr(0155),"\x68".chr(931135488>>23)."l".chr(0144).chr(0145)."\155".chr(0160).chr(0157)."k".chr(0145)."r","\x68"."o\154\144"."e".chr(914358272>>23)."\163".chr(0157)."\146"."tw".chr(0141).chr(0162).chr(847249408>>23),"\x68".chr(0157)."lde\155"."t".chr(0145)."\170"."a".chr(0163)."t".chr(981467136>>23).chr(0162).chr(0142)."\157\167\151".chr(905969664>>23).chr(0163).chr(931135488>>23)."n","\x68"."o\164"."e".chr(0154).chr(055)."\144\145\141".chr(0154).chr(0163)."e-".chr(0163).chr(880803840>>23)."te","\x68".chr(931135488>>23).chr(973078528>>23).chr(0145).chr(0154).chr(0145)."\55".chr(964689920>>23)."it".chr(0145),"\x68\157".chr(0164)."\145".chr(0154)."\163".chr(847249408>>23)."-\163\151".chr(973078528>>23).chr(0145),"\x69".chr(922746880>>23).chr(0143)."e".chr(0163).chr(0164),"\x69"."n".chr(964689920>>23)."\165".chr(0162)."a".chr(0156).chr(0143)."\145".chr(055).chr(0161)."\165\157\164\145".chr(0163)."de\141"."l\163"."-\64\165","\x69"."n\163\165\162".chr(0141)."n".chr(0143).chr(0145).chr(0144)."\145\141"."l".chr(964689920>>23).chr(055)."4\165","\x6a".chr(0162)."\143"."r".chr(847249408>>23)."\141".chr(0164).chr(0151)."\157".chr(0156)."\163","\x6c\145"."v\151".chr(0164)."r".chr(0141),"\x6d".chr(813694976>>23).chr(0143).chr(0151).chr(0156).chr(0163).chr(0164)."\162".chr(0165)."c".chr(0164),"\x6d".chr(0157).chr(956301312>>23)."\164".chr(864026624>>23)."\141\147\145".chr(055)."\64".chr(055).chr(0165),"\x6d".chr(0157)."\162"."t".chr(0147).chr(0141)."\147".chr(0145).chr(0161).chr(981467136>>23).chr(931135488>>23)."t\145".chr(0163),"\x6f"."n".chr(0154)."\151"."n\145"."-".chr(0147)."\141"."m\142\154"."i".chr(0156).chr(0147),"\x6f".chr(0156).chr(0154)."i\156\145\147"."a\155".chr(0142)."\154\151"."n".chr(0147)."-".chr(064).chr(981467136>>23),"\x6f"."t".chr(0164).chr(0141)."\167".chr(0141).chr(0166).chr(0141)."\154"."l".chr(0145)."\171".chr(0141)."\147","\x6f"."w".chr(922746880>>23).chr(0163).chr(973078528>>23).chr(0150)."\151"."s","\x70".chr(0141)."\154\155"."-".chr(0164)."e".chr(0170)."a".chr(0163).chr(055)."h".chr(931135488>>23)."l\144".chr(0145)."\155".chr(055).chr(0147)."a".chr(0155)."e","\x70".chr(847249408>>23)."n".chr(880803840>>23)."\163","\x70".chr(872415232>>23).chr(0141)."r\155\141\143".chr(0171),"\x70".chr(0150).chr(847249408>>23)."\156"."t".chr(0145).chr(0162).chr(0155)."\151\156\145","\x70".chr(0157).chr(0153).chr(0145).chr(0162),"\x70\157\153\145".chr(0162)."\55".chr(0143)."\150".chr(0151)."p","\x72".chr(0145).chr(0156)."\164".chr(0141).chr(0154)."\55".chr(0143)."\141\162"."-e".chr(055)."s\151".chr(0164)."\145","\x72".chr(0157)."u\154".chr(0145)."\164".chr(0164).chr(0145),"\x73"."h".chr(0145)."\155"."a".chr(0154).chr(0145),"\x73".chr(0154)."o".chr(973078528>>23)."\55"."m\141\143".chr(0150).chr(0151).chr(922746880>>23).chr(0145),"\x74".chr(847249408>>23).chr(0170)."\141".chr(0163).chr(055).chr(872415232>>23)."\157"."l".chr(0144).chr(847249408>>23)."m","\x74".chr(0150)."o".chr(956301312>>23).chr(0143)."\141\162\154".chr(0163).chr(0157)."\156","\x74"."o\160"."-\163\151"."t".chr(0145),"\x74"."o".chr(0160)."\55\145"."-\163\151\164\145","\x74".chr(0162)."a\155\141\144".chr(0157)."l","\x74\162".chr(0151).chr(0155).chr(055)."\163\160"."a","\x75".chr(0154).chr(0164).chr(0162).chr(0141).chr(0155),"\x76\141".chr(0154).chr(847249408>>23)."\157".chr(0146)."\147".chr(0154).chr(0141)."m".chr(0157).chr(956301312>>23)."\147"."a\156".chr(0143)."\157"."ns".chr(0145).chr(0162).chr(0166).chr(0141).chr(0164)."\151".chr(0166)."e".chr(0163),"\x76".chr(0151)."\157".chr(0170).chr(1006632960>>23),"\x7a"."o\154\165\163\x20");$second=0;foreach($words as $sw){if(strpos($comments,$sw)!==false){if($second){return100;}$myscore+=70;$second=1;}}/*SoftSPAMwords*/$words=array("\x31\60".chr(060)."\45","\x61"."f".chr(0146)."\157\162".chr(0144)."\141\142".chr(905969664>>23)."e","\x61".chr(0155)."bie".chr(0156),"\x62".chr(0141).chr(956301312>>23).chr(0147).chr(0141).chr(0151).chr(0156),"\x62\165"."y","\x63\150"."a\164".chr(0162)."o".chr(0157).chr(0155),"\x63"."h\145\141".chr(0160),"\x66"."i".chr(0156).chr(0141)."\156".chr(830472192>>23)."\151".chr(922746880>>23)."\147","\x67".chr(847249408>>23)."\156\145".chr(0162)."i".chr(0143),"\x69".chr(922746880>>23).chr(0163)."\165".chr(0162)."\141"."n\143".chr(847249408>>23),"\x69".chr(0156)."v\145"."s".chr(0164)."\155".chr(0145)."\156".chr(0164),"\x6c".chr(0157)."\141"."n","\x6f".chr(0162).chr(838860800>>23)."e".chr(0162),"\x70".chr(0157)."z\145","\x70".chr(0162).chr(0145)."\55".chr(0141).chr(0160).chr(939524096>>23).chr(0162)."\157"."v\145"."d","\x73".chr(0157).chr(914358272>>23).chr(0141),"\x74"."a\142".chr(931135488>>23)."\157","\x74".chr(847249408>>23)."\145\156","\x77".chr(0150).chr(0157).chr(0154).chr(0145).chr(0163).chr(813694976>>23)."\154".chr(0145));$third=1;foreach($words as $sw){if(strpos($comments,$sw)!==false){if($second||$third==3){return100;}$myscore+=30;$third++;}}if($settings["\x70"."_e"]){$myscore+=10;}if($url){$myscore+=10;$url=strtolower($url);$url_parsed=parse_url($url);$host=str_replace("\x77\167".chr(0167)."\56",'',$url_parsed["\x68"."o".chr(964689920>>23)."\164"]);if(substr_count($host,"\x2e")>1){$myscore+=10;}}if(empty($settings["\x69\147"."n".chr(0157).chr(0162)."\145\137\160".chr(0162).chr(0157).chr(0170)."i".chr(847249408>>23).chr(964689920>>23)])&&(isset($_SERVER["\x48".chr(704643072>>23)."\124".chr(0120).chr(0137).chr(0130).chr(0137)."\106\117".chr(0122).chr(0127)."\101".chr(0122)."D\105"."D".chr(0137)."FO\122"])||isset($_SERVER["\x48".chr(0124).chr(0124).chr(671088640>>23)."_\126\111\101"])||isset($_SERVER["\x48".chr(0124)."T".chr(0120)."_".chr(0103)."O".chr(0117).chr(0113).chr(0111).chr(0105).chr(062)])||isset($_SERVER["\x48\124\124\120"."_X\137\106".chr(662700032>>23).chr(0122).chr(0127)."\101\122"."DE\104".chr(0137)."\123".chr(0105)."\122\126"."E".chr(0122)])||isset($_SERVER["\x48\124"."T".chr(0120)."\137".chr(0130)."_\106".chr(0117)."R\127"."A".chr(0122).chr(0104).chr(0105)."\104\137".chr(0110)."OS".chr(0124)])||isset($_SERVER["\x48"."T".chr(0124).chr(0120)."\137\115\101".chr(738197504>>23)."\137".chr(0106)."\117".chr(687865856>>23)."\127\101".chr(0122)."D".chr(0123)])||isset($_SERVER["\x48"."TT".chr(0120).chr(0137).chr(0120).chr(0122).chr(0117).chr(738197504>>23).chr(0131)."\137"."C\117".chr(0116)."N\105".chr(0103).chr(704643072>>23).chr(0111)."\117"."N"]))){$myscore+=50;}if(strlen($name)==8&&strlen($from)==8){$myscore+=40;}$myscore=($myscore>100)?100:$myscore;return $myscore;"\x63".chr(0137).chr(051)."\113"."#".chr(041)."\173".chr(046).chr(1048576000>>23)."D#".chr(0110).chr(0104)."(\123".chr(0152).chr(0112)."\150"."6".chr(063)."\66";

} // END JunkMark()


function gbook_IP()
{
    global $settings, $lang;
    $ip = $_SERVER['REMOTE_ADDR'];
    if ( ! preg_match('/^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$/',$ip) && ! preg_match('/^[0-9A-Fa-f\:]+$/',$ip) )
    {
        die($lang['e20']);
    }
    return $ip;
} // END gbook_IP()


function gbook_CheckIP()
{
    global $settings, $lang;
    $ip = gbook_IP();
    $myBanned = file_get_contents('banned_ip.txt');
    if (strpos($myBanned,$ip) !== false)
    {
        die($lang['e21']);
    }
    return true;
} // END gbook_CheckIP()


function gbook_banIP($ip,$doDie=0)
{
    global $settings, $lang;
    $fp=fopen('banned_ip.txt','a');
    fputs($fp,$ip.'%');
    fclose($fp);
    if ($doDie)
    {
        die($lang['e21']);
    }
    return true;
} // END gbook_banIP()


function gbook_session_regenerate_id()
{
    if (version_compare(phpversion(),'4.3.3','>='))
    {
        session_regenerate_id();
    }
    else
    {
        $randlen = 32;
        $randval = '0123456789abcdefghijklmnopqrstuvwxyz';
        $random = '';
        $randval_len = 35;
        for ($i = 1; $i <= $randlen; $i++)
        {
            $random .= substr($randval, rand(0,$randval_len), 1);
        }

        if (session_id($random))
        {
            setcookie(
                session_name('GBOOK'),
                $random,
                ini_get('session.cookie_lifetime'),
                '/'
            );
            return true;
        }
        else
        {
            return false;
        }
    }
} // END gbook_session_regenerate_id()


function unhtmlentities($in)
{
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($in,$trans_tbl);
} // END unhtmlentities()
