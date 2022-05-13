<?php if (!defined('PmWiki')) exit();
class Utils
{
    public static function get_xml_error($errors, $xml)
    {
        $xml = explode("\n", $xml);
        foreach ($errors as $error) {
            $return .= $xml[$error->line - 1] . "\n";
            $return .= str_repeat('-', $error->column) . "^\n";

            switch ($error->level) {
                case LIBXML_ERR_WARNING:
                    $return .= "Warning $error->code: ";
                    break;
                 case LIBXML_ERR_ERROR:
                    $return .= "Error $error->code: ";
                    break;
                case LIBXML_ERR_FATAL:
                    $return .= "Fatal Error $error->code: ";
                    break;
            }

            $return .= trim($error->message) .
                       "\n  Line: $error->line" .
                       "\n  Column: $error->column";

            if ($error->file) {
                $return .= "\n  File: $error->file";
            }

            $return.= "$return\n\n--------------------------------------------\n\n";
        }
        return $return;
    }
    
	public static function display_xml_error($error, $xmlstr = NULL)
	{
        return nl2br(self::get_xml_error($error, $xmlstr), true);
	}

	public static function GetXMLFilePath($group, $dmid)
	{
		$gc = self::GetGroupConfig($group);
		return $gc->XMLFolderPath."/$dmid.xml";
	}
	
	public static function GetDMRPageName($group, $dmid = "*")
	{
        $gc = self::GetGroupConfig($group);
        if ($dmid == "*") {
            return "DMR.Default";
        } else {
            return "DMR.{$gc->SUID}{$dmid}";
        }
	}
	
	//FIXME
	public static function GetGroup($str)
	{
        static $Mapping = array(
            array("bilibili3", "Bilibili3"),
            array("bilibili2", "bilibili2"),
            array("acfun4p",   "Acfun4p"),
            array("acfun2",    "Acfun2"),
            array("twodland1", "Twodland1"),
            array("acfun1n",   "AcfunN1"),
            array("acfunn1",   "AcfunN1"),
            array("acfun",     "Acfun2"), // 标准化后删除
        );
        reset($Mapping);
        while( list(, list($from, $to)) = each($Mapping) ) {
            if (stripos($str,$from) !== false ) return $to;
        }
        
        throw new Exception("Unknown group : {$str}");
	}
    
	public static function GetGroupConfig($str)
    {
        $str = self::GetGroup($str);
        $class = "{$str}GroupConfig";
        if (!class_exists($class)) {
            throw new Exception("Group Config Not Found : {$class}");
        }
        return call_user_func("{$str}GroupConfig::GetInstance");
    }
    
	public static function WriteLog($action, $message)
	{
        if (!$GLOBALS['EnableSysLog']) return;
        
		$str = sprintf("\r\n%s  ... %s ... %s", strftime($GLOBALS['TimeFmt']), $action, $message);
		$pagename = "Main/SysLog";
		$page = ReadPage($pagename);
		$page['text'] .= $str;
		
		WritePage($pagename, $page);
	}
}
