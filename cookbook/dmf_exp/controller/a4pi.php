<?php if (!defined('PmWiki')) exit();

class a4pi extends K_Controller {
    private $GroupConfig;
    
    public function __construct() {
        $this->GroupConfig = Utils::GetGroupConfig("acfun4p");
        parent::__construct();
    }
    
    public function getlogo()
    {
        die(base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAAXNSR0IArs4c6QAA'.
            'AARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAMSURBVBhXY/j/'.
            '/z8ABf4C/qc1gYQAAAAASUVORK5CYII='));
    }
    
    public function dmpost()
    {
        $this->Helper("json");
        
        if ($this->requireVars(
                $this->Input->Post,
                array("islock", "color", "text", "size", "mode", "stime", "timestamp", "poolid"))) {
            Abort("不允许直接访问");
        }
        
        if ($this->Input->Post->mode == 7) {
            $text = json_readable_encode(json_decode($this->Input->Post->text), 1);
            $builder = new DanmakuBuilder($text, 0, 'deadbeef');
        } else {
            $builder = new DanmakuBuilder($this->Input->Post->text, 0, 'deadbeef');
        }
        
        $attrs = array(
                'playtime'  => $this->Input->Post->stime,
                'mode'      => $this->Input->Post->mode,
                'fontsize'  => $this->Input->Post->size,
                'color'     => $this->Input->Post->color);
		$builder->AddAttr($attrs);

        if (PoolUtils::AppendToDynamicPool($this->GroupConfig, $this->Input->Post->poolid, $builder)) {
            die('DMF_Local :: a4pi :: dmpost() :: success!');
        } else {
            die('DMF_Local :: a4pi :: dmpost() :: page fail!');
        }
    }
    
    public function dmdelete()
    {
    
    }
    
    public function getvideobyid($pageid)
    {
        $pid = basename($pageid);
        $source = new VideoPageData("Acfun4p.{$pid}");
        
        $arr["aid"] = $pid;
        $arr["uid"] = 1;
        $arr["vinfo"] = array("checked" => 2);
        $arr["cid"] = "";
        $arr["vid"] = "";
        $arr["vtype"] = "";
        
        switch (strtoupper($source->VideoType->getType()))
	    {
	        case "NOR":
	            $arr['vid'] = $source->DanmakuId;
	            $arr['cid'] = $source->DanmakuId;
	            $arr['vtype'] = "sina";
	        break;
	        
			case "QQ":
                $arr["vid"]   = $source->DanmakuId;
				$arr["cid"]   = $source->DanmakuId;
				$arr["vtype"] = "qq";
	        break;
	        
			case "TD":
                $arr["vid"]   = $source->DanmakuId;
				$arr["cid"]   = $source->DanmakuId;
				$arr["vtype"] = "tudou";
	        break;

			case "YK":
                $arr["vid"]   = $source->DanmakuId;
				$arr["cid"]   = $source->DanmakuId;
				$arr["vtype"] = "youku";
	        break;
	        
			case "URL":
			case "BURL":
			case "LINK":
			case "BLINK":
			case "LOCAL":
				$arr["vid"]   = rawurldecode($source->VideoStr);
				$arr["file"]   = rawurldecode($source->VideoStr);
				$arr["cid"]   = $source->DanmakuId;
				$arr["vtype"] = "url";
	        break;

			default:
				echo "$source->VideoType->getType(): $source->DanmakuId : $source->VideoStr";
				assert(false);
	        break;
	    }
	    echo json_encode($arr);
	    exit;
    }

	
    public function ujson()
    {
        die('[]');
    }
    
    public function badwords()
    {
        die('[]');
    }
    
    public function adsjson()
    {
        die('');
    }
}