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

/* Check if this is a valid include */
if (!defined('IN_SCRIPT')) {
    die('Invalid attempt');
}

class PJ_SecurityImage
{

    function __construct($key)
    {
        $this->code = '';
        $this->key = $key;
    }

    function encrypt($plain_text)
    {
        $this->code = trim(sha1($plain_text . $this->key));
    } // End encrypt

    function checkCode($mystring, $checksum)
    {
        $this->encrypt($mystring);
        if ($this->code == $checksum)
            return true;
        else
            return false;
    } // End checkCode

    function printImage($random_number)
    {
        $im = @imagecreate(150, 40) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));

        for ($i = 0; $i < strlen($random_number); $i++) {
            $text_color = imagecolorallocate($im, mt_rand(180, 255), mt_rand(180, 255), mt_rand(100, 255));
            $display = substr($random_number, $i, 1);
            $x = ($i * 30) + mt_rand(3, 16);
            $y = mt_rand(3, 26);
            imagestring($im, 5, $x, $y, $display, $text_color);
        }

        if (function_exists('imagejpeg')) {
            header("Content-type: image/jpeg");
            imagejpeg($im);
        } elseif (function_exists('imagepng')) {
            header("Content-type: image/png");
            imagepng($im);
        } elseif (function_exists('imagegif')) {
            header("Content-type: image/gif");
            imagegif($im);
        } else {
            die("GD was not compiled with JPEG or PNG support");
        }

        imagedestroy($im);
    } // End printImage

    function get()
    {
        return $this->code;
    } // End get

} // End class PJ_SecurityImage
