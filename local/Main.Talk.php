<?php if (!defined('PmWiki')) exit();
/** \file Main.ContactUs.php
 *  \brief customization for the Contact Us form
 *
 *  AWColley 2006-08-28    -- created
 *  AWColley Version 0.2.1 -- fixed REMOTE_ADDR problem caused by new PHP default
 *                            settings
 *  
 *  Copyright 2006-2007 A. W. Colley
 *  You may use this file however you see fit. I don't care.
 *
 *  THIS SOFTWARE IS PROVIDED AS IS WITHOUT ANY GUARANTEES FOR SUITABLILITY FOR
 *  ANY PURPOSE. THE COPYRIGHT HOLDERS ARE NOT RESPONSIBLE FOR ANY DAMAGES, WHETHER
 *  DIRECT, INDIRECT, OR TOTALLY UNRELATED THAT MAY ACCOMPANY, RESULT FROM, OR FOR
 *  ANY REASON OCCUR AFTER THE USE OF, PERUSAL OF, OR THINKING ABOUT THIS SOFTWARE.
 *
 */
define( CONTACTUS_VERSION, '0.2.1' );
$REMOTE_ADDR = $_SERVER["REMOTE_ADDR"];

function is_blocked( $ipaddr )
{
    $BlackListIP = array( "0.0.0.0","127.0.0.1" );
    foreach ($BlackListIP as $blocked) {
        // Look for blocked IP *in* the function argument, since the blocked IP
        // may be truncated to specify an entire Class C/B/A subnet
        $pos = strpos( $ipaddr, $blocked );
        if ($pos !== false && $pos == 0) return true;
    }
    return false;
}


if ($_POST) {
    $lvisitor = "no_visitor";
    if (!empty( $_POST["visitor"])) {
        $FmtPV['$PVisitor'] = '$_POST["visitor"]';
        $lvisitor = $_POST["visitor"];
    }

    $lreplyto = "no_name@no_domain";
    if (!empty( $_POST["replyto"])) {
        $FmtPV['$PReplyTo'] = '$_POST["replyto"]';
        $lreplyto = $_POST["replyto"];
        $lastpos = strlen( $lreplyto ) - 1;
        if ((strpos( $lreplyto, "@" ) === false) ||
            (strpos( $lreplyto, "@" ) == $lastpos)) {
            $lreplyto .= "@no_domain";
        }
    }

    $lsubject = "";
    if (!empty( $_POST["subjects"])) {
        foreach ($_POST["subjects"] as $subj) {
            $lsubject .= $subj." ";
        }
    }
    
    if (empty( $_POST["message"])) {
        $msg = "You did not provide a message to send. ";
        $snt = "false";
        $frm = "true";
    }
    else if (strpos( $lreplyto, "@no_domain" ) !== false) {
        $msg = "You did not provide a valid email address.";
        $snt = "false";
        $frm = "true";
    }
    else {
        $lmessage = $_POST["message"];

        if (! is_blocked( $REMOTE_ADDR )) {
            $to = "DMF<2016572973@qq.com>";

            $re = "ContactMe message from ".$lvisitor;

            $hd = "From: <".$lreplyto.">\n";
            $hd.= "X-Sender: <".$lreplyto.">\n";
            $hd.= "X-Mailer: PHP\n"; //mailer
            $hd.= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
            $hd.= "Return-Path: <".$lreplyto.">\n";
            $hd.= "MIME-Version: 1.0\n";
            $hd.= "Content-Type: text/html; charset=utf-8\n";

            // Convert newlines to <br>
            $bd = ereg_replace( "\n|\r|\n\r|\n", "<br>", $lmessage );
            // Convert two <br>s to a <p>
            $bd = eregi_replace( "<br><br>", "<p>", $bd );

            // Disable certain HTML tags
            $bd = eregi_replace( "<img", "[blk_img", $bd );
            $bd = eregi_replace( "<script", "[blk_script", $bd );
            $bd = eregi_replace( "<embed", "[blk_embed", $bd );
            $bd = eregi_replace( "<applet", "[blk_applet", $bd );
            $bd = eregi_replace( "<param", "[blk_param", $bd );
            $bd = eregi_replace( "<object", "[blk_object", $bd );
            $bd = eregi_replace( "<bgsound", "[blk_bgsound", $bd );
            $bd = eregi_replace( "<sound", "[blk_sound", $bd );
        
            // Make sure there is a line break at least every 1024 characters
            $tmp = "";
            $since = 0;
            for ($i=0; $i<strlen($bd); $i++) {
                $tmp .= $bd[$i];
                if ("$bd[$i]" == "\n") {
                    $since = 0;
                }
                else {
                    $since++;
                    if ($since > 1000) {
                        $tmp .= "\n";
                        $since = 0;
                    }
                }
            }
            $bd = $tmp;
  
            $bd .= "\n<hr>Sender's IP address: ".$REMOTE_ADDR;
            $bd .= "\n<br>Subject(s): ".$lsubject;
            
            if (mail( $to, $re, $bd, $hd )) {
                $msg = "Your message has been sent to the WebMaster.";
                $snt = "true";
                $frm = "false";
            }
            else {
                $msg = "I@'m sorry, your messages could not be sent. ";
                $msg.= "It@'s not your fault, something isn@'t working right. ";
                $msg.= "Please try again later.";
                $snt = "false";
                $frm = "false";
            }
        }
        else {
            $msg = "Messages from your current IP address are blocked because ";
            $msg.= "someone has sent me spam or an otherwise unacceptable email ";
            $msg.= "from it. If this wasn@'t you, I@'m sorry for the inconvenience.";
            $snt = "false";
            $frm = "false";
        }
    }
    $pst = "true";
}
else {
    $snt = "false";
    $frm = "true";
    $pst = "false";
    $msg = "none";
}

$FmtPV['$CUFSent'] = "'".$snt."'";
$FmtPV['$CUFForm'] = "'".$frm."'";
$FmtPV['$CUFPost'] = "'".$pst."'";
$FmtPV['$CUFMess'] = '"'.$msg.'"'; // Must use ' outside because msg may contain '
