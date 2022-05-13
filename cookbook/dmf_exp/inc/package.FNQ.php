<?php if (!defined('PmWiki')) exit();
function GetFNQClass($url)
{
    $class = Utils::GetGroup($url)."FNQClass";
    return new $class($url);
}

abstract class FNQClass
{
    protected $html;
    protected $xml;
    protected $cookieFile;
    protected $username;
    protected $password;
    protected $gc;
    protected $url;
    
    public function Init($url)
    {
        $this->url = $url;
        $this->Login();
        $this->html = $this->DownloadWebPage($url);
        $this->gc = Utils::GetGroupConfig($url);
        $this->xml = $this->gc->UploadFilePreProcess($this->GetXMLdata());
    }
    
    abstract protected function Login();
    abstract protected function DownloadWebPage($url);
    abstract protected function GetXMLData();
    abstract protected function GetDanmakuId();
    abstract protected function GetTitle();
    abstract protected function GetDesc();
    
    public function __toString()
    {
        $str = $this->url."\r\n";
        $str .= $this->GetTitle();
        $str .= "\r\n".$this->GetDesc();
        $id = $this->GetDanmakuId();
        if (is_array($id))
            {$str .= "\r\n{$id[1]} :: {$id[2]}";} else {$str .= "\r\n{$id}";}
        $str .= "\r\n".$this->GetXMLData();
        return $str;
    }
}

class Bilibili2FNQClass extends FNQClass
{
    public function __construct($url)
    {
        $this->cookieFile = './uploads/temp/bilibili.txt';
        $this->Init($url);
    }
    
    protected function GetDesc()
    {
        return $this->html->description;
    }
    
    protected function GetTitle()
    {
        return $this->html->title;
    }
    
    protected function GetDanmakuId()
    {
        return $this->html->vid;
    }
    
    protected function GetXMLData()
    {
        $id = $this->GetDanmakuId();
        return @gzinflate(file_get_contents("http://comment.bilibili.tv/dm,{$id}"));
    }
    
    protected function DownloadWebPage($url)
    {
        preg_match('/bilibili\.tv\/video\/av([0-9]+)(?:\/index_([0-9]+)\.html)?/', $url, $m);
        $vid = $m[1]; $page = $m[2];
        $str = "http://api.bilibili.tv/view?type=json&appkey=fc9f37b4c428e5be&id={$vid}&page={$page}";
        
        return json_decode(file_get_contents($str));
    }
    
    protected function Login()
    {
        return;
    }
}

class AcfunN1FNQClass extends FNQClass
{
    private $jsonObj = null;
    
    public function __construct($url)
    {
        $this->cookieFile = './uploads/temp/Acfun.txt';
        $this->Init($url);
        
    }
    
    protected function GetDesc()
    {
        preg_match('/\<meta.*description.*\"(.*)\".*>/',$this->html,$matches);
        $des = $matches[1];
    }
    
    protected function GetTitle()
    {
        preg_match('/\<title>(.*)\<\/title>/',$this->html,$matches);
        return $matches[1];
    }
    
    protected function GetDanmakuId()
    {
        if (is_null($this->jsonObj)) {
            preg_match('/\'id\':\'([0-9]*)\'/',$this->html,$matches2);
            $videoid = $matches2[1];
            $jsonStr = file_get_contents("http://www.acfun.tv/api/getVideoByID.aspx?vid={$videoid}");
            $this->jsonObj = json_decode($jsonStr);
        }
        return $this->jsonObj->cid;
    }
    
    protected function GetXMLData()
    {
        $id = $this->GetDanmakuId();
        $str = @file_get_contents("http://comment.acfun.tv/{$id}.json");
        $str .= @file_get_contents("http://comment.acfun.tv/{$id}_lock.json");
        return $str;
    }
    
    protected function DownloadWebPage($url)
    {
        global $FarmD;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);
        $str = curl_exec($ch);
        curl_close($ch);
        return $str;
    }
    
    protected function Login()
    {
        return;
    }
}

class Twodland1FNQClass extends FNQClass
{
    public function __construct($url)
    {
        $this->cookieFile = './uploads/temp/2dland.txt';
        $this->Init($url);
    }
    
    protected function GetDesc()
    {
        if (preg_match('/\<meta.*description.*\"(.*)\".*>/',$this->html,$matches))
            return $matches[1];
    }
    
    protected function GetTitle()
    {
        if (preg_match('/\<title>(.*)\<\/title>/',$this->html,$matches))
            return $matches[1];
    }
    
    protected function GetDanmakuId()
    {
        preg_match('/{dir:\'([^\']*)\', vid:\'([^\']*)\'}/',$this->html , $matches);
        return $matches;
    }
    
    protected function GetXMLData()
    {
        $id = $this->GetDanmakuId();
        $str = @file_get_contents("http://www.2dland.cn/watch/api.php?mod=comment&act=load&static=0&dir={$id[1]}&vid={$id[2]}");
        return $str;
    }
    
    protected function DownloadWebPage($url)
    {
        global $FarmD;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);
        $str = curl_exec($ch);
        curl_close($ch);
        return $str;
    }
    
    protected function Login()
    {
        return;
    }
}