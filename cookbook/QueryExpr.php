<?php if (!defined('PmWiki')) exit();
$MarkupExpr['queryexpr'] = 'queryexpr($args[0], $args[1],$args[2],$args[3])';

function queryexpr($qtype, $dtype, $name, $def)
{
    switch (strtolower($qtype))
    {
        case "post":
            $arr = $_POST;
            break;
        case "get":
            $arr = $_GET;
            break;
        default:
            $arr = $_REQUEST;
            break;
    }
    $data =$arr[$name];
    $d = validetype($dtype, $data);
    if (!validetype($dtype, $data)) $data = $def;
    return $data;
}

function validetype($type, $data)
{
    if (is_null($data)) return false;
    switch (strtolower($type))
    {
        case "int":
        return is_int($data);
        case "double":
        return is_double($data);
        case "number":
        case "numeric":
        return is_numeric($data);
        case "string":
        return is_string($data);
        case "anything":
        return true;
        default:
        return false;
    }
}
