<?php if (!defined('PmWiki')) exit();
abstract class DanmakuPoolAccessor
{
    protected $group;
    protected $dmid;
    
    public $hasError = false;
    public $errorString = "";
    
	protected static $XMLHeader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<comments>";
	protected static $XMLFooter = "\r\n</comments>";
	
	public function __construct($group, $dmid)
	{
        $this->group = $group;
        $this->dmid = $dmid;
	}
    
    //return : SimpleXMLElement []
	public function Load() {
        if ( !XMLAuth::IsRead($this->group, $this->dmid) ) {
            $class = get_class($this);
            Utils::WriteLog("{$class}::Load()", "{$this->group} :: {$this->dmid}  :: 请求read权限失败");
            return simplexml_load_string(self::GetEmptyXML())->xpath("/comments/comment");
        }
        $xmlstr = $this->_load();
        $xmlobj = simplexml_load_string($xmlstr, "SimpleXMLElement", LIBXML_COMPACT);
        if ($xmlobj === false) {
            $this->hasError = true;
            $this->errorString = Utils::get_xml_error(libxml_get_errors(), $xmlstr);
            $xml = simplexml_load_string(self::GetErrorXML(get_class($this)."::XML文件损坏"));
            return $xml->xpath("/comments/comment");
        } else {
            return $xmlobj->xpath("/comments/comment");
        }
        
	}
	
	abstract protected function _load();
    
    //return : boolean
	public function Save($arr) {
        if ( !XMLAuth::IsEdit($this->group, $this->dmid) ) {
            $class = get_class($this);
            Utils::WriteLog("{$class}::Save()", "{$this->group} :: {$this->dmid}  :: 请求write权限失败");
            return false;
        }
        
        $xmlstr = "";
        foreach ($arr as $node) {
            $xmlstr .= "\r\n".$node->asXML();
        }
        
        return $this->_save($xmlstr);
	}
	
	abstract protected function _save($str);
	
	public static function GetAccessor($group, $dmid, $poolType) {
        switch ($poolType) {
            case PoolMode::S:
                return new StaticPoolAccessor($group, $dmid);
            case PoolMode::D:
                return new DynamicPoolAccessor($group, $dmid);
            default         :
                Utils::WriteLog(get_class($this).'::GetAccessor()', "找不到指定弹幕池{$poolType}");
                throw new Exception("找不到指定弹幕池{$poolType}");
        }
	}
	
	public static function GetErrorXML($msg) {
        return <<<EOF
<comments>
<comment id="0" poolid="1" userhash="b82a51a3" sendtime="0">
	<text>$msg</text>
	<attr id="0" playtime="0.0" mode="1" fontsize="64" color="316711680"/>
</comment>
</comments>
EOF;
    }
    
	public static function GetEmptyXML() {
        return "<comments />";
    }
}

class StaticPoolAccessor extends DanmakuPoolAccessor
{
    private $file;
	public function __construct($group, $dmid)
	{
		parent::__construct($group, $dmid);
		$this->file = Utils::GetXMLFilePath($group, $dmid);
	}
	
    protected function _load() {
		if (!file_exists($this->file))
		{
			return self::GetEmptyXML();
		} else {
            return file_get_contents($this->file);
        }
    }
    
	protected function _save($xmlstr) {
		if (file_exists($this->file))
		{
			rename($this->file, $this->file.",del-".time());
		}
		
		$folder = pathinfo($this->file, PATHINFO_DIRNAME);
		if (!file_exists($folder))
		{
            mkdir($folder, 0777, true);
		}
		
		$result = file_put_contents($this->file, self::$XMLHeader.$xmlstr.self::$XMLFooter, LOCK_EX);
		
		if ($result === FALSE)
		{
            Utils::WriteLog(get_class($this).'::Save()', "{$this->group} :: {$this->dmid}  :: 文件写入失败");
            return false;
		} else {
            Utils::WriteLog(get_class($this).'::Save()', "{$this->group} :: {$this->dmid}  :: 文件写入成功");
            return true;
        }
	}
}


class DynamicPoolAccessor extends DanmakuPoolAccessor
{
    private $pagename;
    private $loadauth = 'read';
    private $saveauth = 'edit';
    
	public function __construct($group, $dmid)
	{
		parent::__construct($group, $dmid);
		$this->pagename = Utils::GetDMRPageName($group, $dmid);
	}
	
    protected function _load() {
        $page = RetrieveAuthPage($this->pagename, $this->loadauth, FALSE, READPAGE_CURRENT);
        return self::$XMLHeader.$page['text'].self::$XMLFooter;
    }
    
	protected function _save($xmlstr) {
        $new = $old = RetrieveAuthPage($this->pagename, $this->saveauth, FALSE, READPAGE_CURRENT);
        $new['text'] = $xmlstr;
		if (UpdatePage($this->pagename, $old, $new)) {
            Utils::WriteLog(get_class($this).'::Save()', "{$this->group} :: {$this->dmid}  :: PmWiki页面更新成功");
            return true;
        } else {
            Utils::WriteLog(get_class($this).'::Save()', "{$this->group} :: {$this->dmid}  :: PmWiki页面更新失败");
            return false;
        }
	}
}