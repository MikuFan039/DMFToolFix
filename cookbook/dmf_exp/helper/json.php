<?php
/*
    json readable encode
    basically, encode an array (or object) as a json string, but with indentation
    so that i can be easily edited and read by a human

    THIS REQUIRES PHP 5.3+

    Copyleft (C) 2008-2011 BohwaZ <http://bohwaz.net/>

    Licensed under the GNU AGPLv3

    This software is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This software is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this software. If not, see <http://www.gnu.org/licenses/>.
*/

function json_readable_encode($in, $indent = 0, Closure $_escape = null)
{
    if (__CLASS__ && isset($this))
    {
        $_myself = array($this, __FUNCTION__);
    }
    elseif (__CLASS__)
    {
        $_myself = array('self', __FUNCTION__);
    }
    else
    {
        $_myself = __FUNCTION__;
    }

    if (is_null($_escape))
    {
        $_escape = function ($str)
        {
            return str_replace(
                array('\\', '"', "\n", "\r", "\b", "\f", "\t", '/', '\\\\u'),
                array('\\\\', '\\"', "\\n", "\\r", "\\b", "\\f", "\\t", '\\/', '\\u'),
                $str);
        };
    }

    $out = '';

    foreach ($in as $key=>$value)
    {
        $out .= str_repeat("\t", $indent + 1);
        $out .= "\"".$_escape((string)$key)."\": ";

        if (is_object($value) || is_array($value))
        {
            $out .= "\n";
            $out .= call_user_func($_myself, $value, $indent + 1, $_escape);
        }
        elseif (is_bool($value))
        {
            $out .= $value ? 'true' : 'false';
        }
        elseif (is_null($value))
        {
            $out .= 'null';
        }
        elseif (is_string($value))
        {
            $out .= "\"" . $_escape($value) ."\"";
        }
        else
        {
            $out .= $value;
        }

        $out .= ",\n";
    }

    if (!empty($out))
    {
        $out = substr($out, 0, -2);
    }

    $out = str_repeat("\t", $indent) . "{\n" . $out;
    $out .= "\n" . str_repeat("\t", $indent) . "}";

    return $out;
}
