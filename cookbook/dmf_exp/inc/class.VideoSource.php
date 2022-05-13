<?php if (!defined('PmWiki')) exit();

abstract class VideoSourceBase
{

	protected $PageNameAsDanmakuId;
	protected $MutiAble;
	protected $UrlConvert;
	
	abstract public function getType();
	
	public function convertVideoUrl($str)
	{
		
	}
	
	public function __get($name)
	{
		return $this->$name;
	}
	
}

class XinaSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = true;
		$this->PageNameAsDanmakuId = false;
		$this->UrlConvert = false;
	}
	
	public function getType()
	{
		return "nor";
	}
}

class TuDouSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = false;
		$this->PageNameAsDanmakuId = false;
		$this->UrlConvert = false;
	}
	public function getType()
	{
		return "td";
	}	
}

class QQSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = true;
		$this->PageNameAsDanmakuId = false;
		$this->UrlConvert = true;
	}
	public function getType()
	{
		return "qq";
	}
	
	public function convertVideoUrl($str)
	{
		return rawurlencode(
			'https://2dland.sinaapp.com/video.php?action=video&type=qq&vid='.
			$str);
	}
}

class sixRoomSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = true;
		$this->PageNameAsDanmakuId = false;
		$this->UrlConvert = true;
	}
	public function getType()
	{
		return "6cn";
	}
}

class URLSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = true;
		$this->PageNameAsDanmakuId = true;
		$this->UrlConvert = true;
	}
	public function getType()
	{
		return "url";
	}
	
	public function convertVideoUrl($str)
	{
		return rawurlencode($str);
	}
}

class BURLSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = true;
		$this->PageNameAsDanmakuId = false;
		$this->UrlConvert = true;
	}
	public function getType()
	{
		return "burl";
	}
	
	public function convertVideoUrl($str)
	{
		return rawurlencode('http://pl.bilibili.us/'.
			str_replace(array("levelup"),"/",$str).
			'.flv');
	}
}

class LocalSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = true;
		$this->PageNameAsDanmakuId = true;
		$this->UrlConvert = true;
	}
	public function getType()
	{
		return "local";
	}
	
	public function convertVideoUrl($str)
	{
		return rawurlencode($str);
	}
}

class YouKuSource extends VideoSourceBase
{
	public function __construct()
	{
		$this->MutiAble = true;
		$this->PageNameAsDanmakuId = false;
		$this->UrlConvert = false;
	}
	public function getType()
	{
		return "yk";
	}
}

