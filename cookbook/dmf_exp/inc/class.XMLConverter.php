<?php if (!defined('PmWiki')) exit();

class XMLConverter
{

    /*****  以下格式用于XML输出时转换 *****/
    //in format : string
    //in xml    : SimpleXMLElement []
    
    public static function FromUniXML($format, array $xml) {
        switch (strtolower($format)) {
            case "raw":
                return self::ToRawFormat($xml);
            case "comments":
                //此处为2dland用的comments格式
                return self::ToCommentsFormat($xml);
            case "data":
                return self::ToDataFormat($xml);
            //case "c":
            //    return self::ToCLFormat($xml);
            case "d":
                return self::ToIDFormat($xml);
            case "json":
                //为了方便，直接返回Uni格式。转换到json的步骤由独立代码进行
                return $xml;
			default:
				throw new UnexpectedValueException("Can't find corresponding format coverter.");
        }
    }
    
    public static function ToRawFormat(array $xml) {
        $XMLString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<comments>\r\n";
        foreach ($xml as $node) {
            $XMLString .= self::ToRawNode($node)."\r\n";
        }
        $XMLString .= "</comments>";
        return $XMLString;
    }
    
    public static function ToRawNode($node) {
        return $node->asXML();
    }
    
    public static function ToCommentsFormat(array $xml) {
        $XMLString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<comments>";
        foreach ($xml as $node) {
            $XMLString .= self::ToCommentsNode($node);
        }
        $XMLString .= "\r\n</comments>";
        return $XMLString;
    }
    
    public static function ToCommentsNode(SimpleXMLElement $node) {
        $attr = $node->attr[0]->attributes();
        $nodeA = $node->attributes();
        
        $attrs = array();
        $pt = $attr['playtime'];
        $mode = $attr['mode'];
        $fontsize = $attr['fontsize'];
        $color = $attr['color'];
        $SE = $attr['showeffect'];
        $HE = $attr['hideeffect'];
        $FE = $attr['fonteffect'];
        $sendtime = $nodeA['sendtime'];
        
        $usText = $node->text;
        $text = htmlspecialchars((string)$usText, ENT_NOQUOTES, "UTF-8");
        return <<<CMT

<comment mode="$mode" showEffect="$SE" hideEffect="$HE" fontEffect="$FE" isLocked="-1" fontSize="$fontsize" color="$color">
    <playTime>$pt</playTime>
    <message>$text</message>
    <sendTime>$sendtime</sendTime>
</comment>
CMT;
    }
    
    public static function ToDataFormat(array $xml) {
        $XMLString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<information>";
        foreach ($xml as $node) {
            $XMLString .= self::ToDataNode($node);
        }
        $XMLString .= "\r\n</information>";
        return $XMLString;
    }
    
    public static function ToDataNode(SimpleXMLElement $node) {
        $attr = $node->attr[0]->attributes();
        $nodeA = $node->attributes();
        
        $attrs = array();
        $pt = $attr['playtime'];
        $mode = $attr['mode'];
        $fontsize = $attr['fontsize'];
        $color = $attr['color'];
        $sendtime = $nodeA['sendtime'];
        
        $usText = $node->text;
        $pString = implode(",", $attrs);
        $text .= htmlspecialchars((string)$usText, ENT_NOQUOTES, "UTF-8");
        return <<<CMT

<data>
    <playTime>$pt</playTime>
    <message fontsize="$fontsize" color="$color" mode="$mode">$text</message>
    <times>$sendtime</times>
</data>
CMT;
    }
    
    //unused
    public static function ToCLFormat(array $xml) {
        
    }
    
    public static function ToJsonFormat(array $xml) {
        $json = array();
        foreach ($xml as $node) {
            $attr = $node->attr[0]->attributes();
            $nodeA = $node->attributes();
            $attrs = array();
            $attrs[] = $attr['playtime'];
            $attrs[] = $attr['color'];
            $attrs[] = $attr['mode'];
            $attrs[] = $attr['fontsize'];
            $attrs[] = $nodeA['userhash'];
            $attrs[] = $nodeA['sendtime'];
            
            $usText = $node->text;
            $pString = implode(",", $attrs);
            $text = htmlspecialchars($usText, ENT_NOQUOTES, "UTF-8");
            $text = strtr($text , "\n", "\r");
            $json[] = (object)array('c' => $pString, 'm' => $text);
        }
        if (!empty($json)) {
            return json_encode($json);
        } else {
            return '[]';
        }
    }
    
    public static function ToJsonNode(SimpleXMLElement $node) {
    
    }
    
    public static function ToIDFormat(array $xml) {
        $XMLString = '<?xml version="1.0" encoding="UTF-8"?><i>';
        foreach ($xml as $node) {
            $attr = $node->attr[0]->attributes();
            $nodeA = $node->attributes();
            
            $attrs = array();
            $attrs[] = $attr['playtime'];
            $attrs[] = $attr['mode'];
            $attrs[] = $attr['fontsize'];
            $attrs[] = $attr['color'];
            $attrs[] = $nodeA['sendtime'];
            $attrs[] = $nodeA['poolid'];
            $attrs[] = $nodeA['userhash'];
            $attrs[] = $nodeA['id'];
            
            $usText = $node->text;
            $pString = implode(",", $attrs);
            $text = htmlspecialchars($usText, ENT_NOQUOTES, "UTF-8");
            $XMLString .= "\r\n<d p=\"$pString\">$text</d>";
        }
        $XMLString .= "\r\n</i>";
        return $XMLString;
    }
    

    /*****  以下格式用于XML输入时转换 *****/
    //in format : SimpleXMLElement
    //in xml    : SimpleXMLElement [] (comments子节点)
    
    
    // SimpleXMLElement -> SimpleXMLElement
    public static function ToUniXML(SimpleXMLElement $xml) {
        switch (strtolower($xml->getName())) {
            case "comments":
                //因为2dland根节点和目前DMF一样
                if (empty($xml->comment[0]->playTime)) {
                    return $xml->xpath("/comments/comment");
                } else {
                    return self::FromCommentsFormat($xml)->xpath("/comments/comment");
                }
            case "information":
                return self::FromDataFormat($xml)->xpath("/comments/comment");
            case "c":
                return self::FromCLFormat($xml)->xpath("/comments/comment");
            case "i":
                return self::FromIDFormat($xml)->xpath("/comments/comment");
			default:
				throw new UnexpectedValueException("Can't find corresponding format coverter.");
        }
    }
    
    
    //2dland
    private static function FromCommentsFormat(SimpleXMLElement $Obj) {
		$XMLString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<comments>";
		foreach ($Obj->comment as $comment) {
            $pool = 0;
            $time = (string)strtotime((string)$comment->sendTime);
			$danmaku = new DanmakuBuilder((string)$comment->message, $pool, 'deadbeef', $time);
            //var_dump($attrs);
            foreach ($comment->attributes() as $k =>$v) {
                $attrs[strtolower($k)] = $v;
            }
            
            $attrs['playtime'] = (string)$comment->playTime;
            unset($attrs['islocked']);
            $danmaku->AddAttr($attrs);
			$XMLString .= (string)$danmaku;
		}
		$XMLString .= "\r\n</comments>";
		return simplexml_load_string($XMLString);
	}
    
    //老Ac格式，Bilibili上传格式
    private static function FromDataFormat(SimpleXMLElement $Obj)
	{
		$XMLString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<comments>";
		foreach ($Obj->data as $comment) {
            $pool = 1;
            if ($comment->message['mode'] == '8') $pool = 2;
			$danmaku = new DanmakuBuilder((string)$comment->message, $pool, 'deadbeef');
            $attrs = array(
                    'playtime'  => $comment->playTime,
                    'mode'      => $comment->message['mode'],
                    'fontsize'  => $comment->message['fontsize'],
                    'color'     => $comment->message['color']);
            $danmaku->AddAttr($attrs);
			$XMLString .= (string)$danmaku;
		}
		$XMLString .= "\r\n</comments>";
        
		return simplexml_load_string($XMLString);
	}
    
	public static function FromIDFormat(SimpleXMLElement $Obj)
	{
		$XMLString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<comments>";
		foreach ($Obj->d as $comment) {
			$arr = explode(",", $comment['p']);
			
            $attrs = array(
                    'playtime'  => $arr[0],
                    'mode'      => $arr[1],
                    'fontsize'  => $arr[2],
                    'color'     => $arr[3],);
            $danmaku = new DanmakuBuilder((string)$comment, $arr[5], $arr[6]);
            $danmaku->AddAttr($attrs);
			$XMLString .= (string)$danmaku;
		}
		$XMLString .= "\r\n</comments>";
        
		return simplexml_load_string($XMLString);
	}
	
	
	//新ac
	public function FromCLFormat(SimpleXMLElement $Obj)
	{
		$XMLString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<comments>";
		foreach ($Obj->l as $comment) {
            $pool = 0;
			$arrs = explode(",", $comment['i']);
            $attrs = array(
                'playtime'  => $arrs[0],
                'mode'      => $arrs[3],
                'fontsize'  => $arrs[1],
                'color'     => $arrs[2]);
            $text = (string)$comment;
            if ($arrs[3] == "7")
            { 
                $text = stripslashes($text);
            }
            $danmaku = new DanmakuBuilder($text, $pool, 'deadbeef');
            $danmaku->AddAttr($attrs);
			$XMLString .= (string)$danmaku;
		}
		$XMLString .= "\r\n</comments>";
		return simplexml_load_string($XMLString);
	}
}