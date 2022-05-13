<?php if (!defined('PmWiki')) exit();
class Bpi extends K_Controller {
    private $GroupConfig;
    
    public function __construct() {
        $this->GroupConfig = Utils::GetGroupConfig("Bilibili2");
        parent::__construct();
    }
    
	public function index()
	{
        die("unknown action");
	}
	
	public function nullResp()
	{
        die('');
	}
	
	public function msg()
	{
        die('<msg/>');
	}
	
	public function cloudfilter()
	{
        die('{"user":[],"keyword":[]}');
    }
    public function bpad()
    {
        $this->DisplayStatic('bilibili_pad.xml');
    }
    
    public function error()
	{
        $GLOBALS['MessagesFmt'] = '你知道的太多了，小心大表哥。';
        $this->DisplayView('pmwiki_view', array('name' => 'API.XMLTool'));
	}
	
	public function dad()
	{
        global $BilibiliAuthLevel;
        
        $data = array();
        
        if (empty($this->Input->Request->id)) {
            $data['ChatId'] = $this->Input->Request->id;
        } else {
            $data['ChatId'] = 0;
        }
        
        if (XmlAuth::IsEdit('Bilibili2', $this->Input->Request->id)) {
            $data['AuthLevelString'] = $BilibiliAuthLevel->Danmakuer;
        } else {
            $data['AuthLevelString'] = $BilibiliAuthLevel->DefaultLevel;
        }
        
        $this->DisplayView('bilibili_dad_xml', $data);
	}
	
	public function advanceComment()
	{
        $gc = Utils::GetGroupConfig('Bilibili2');
        if ($gc->BiliEnableSA)
        {
            die("<confirm>1</confirm><hasBuy>true</hasBuy>");
        } else {
            die("<confirm>0</confirm><hasBuy>false</hasBuy><accept>false</accept>");
        }
	}
	
	public function dmduration()
	{
        exit;
	}
	
	public function rec()
	{
        exit;
	}
	//关联视频
	public function playtag()
	{
        exit;
	}
	//弹幕举报
	public function dmreport()
	{
        exit;
	}
    //播放器接口 。弹幕错误汇报
	public function dmerror()
	{
        if ( empty($this->Input->Request->id) || empty($this->Input->Request->error) )
            exit;
        $str = "播放器汇报错误{$this->Input->Request->error}, 返回视频vid : {$this->Input->Request->id}";
        Utils::WriteLog('bpi::dmerror()', $str);
	}
	
	public function dmpost()
	{
        if ($this->requireVars(
                $this->Input->Post,
                array("date", "playTime", "mode", "fontsize", "color", "pool", "message"))) {
            Abort("不允许直接访问");
        }
        
		$pool = ($this->Input->Post->mode == '8') ? 2 : 1; //mode = 8 时 pool 必须 = 2
        $builder = new DanmakuBuilder($this->Input->Post->message, $pool, 'deadbeef');
        $attrs = array(
                'playtime'  => $this->Input->Post->playTime,
                'mode'      => $this->Input->Post->mode,
                'fontsize'  => $this->Input->Post->fontsize,
                'color'     => $this->Input->Post->color);
		$builder->AddAttr($attrs);
		
        if (PoolUtils::AppendToDynamicPool($this->GroupConfig, $this->Input->Post->cid, $builder)) {
            echo mt_rand();
        } else {
            die("-55");
        }
	}

    
    // ************************* dmm ********************//
    
    
	public function update_comment_time()
	{
        $targetTime = intval($this->Input->Request->time);
        $dmid = intval($this->Input->Request->dmid);
        $poolId = intval($this->Input->Request->dm_inid);
        if (is_null($poolId)) die("2");
        
        $dynPool = PoolUtils::GetPool('Bilibili2', $poolId, PoolMode::D);
        if (!$dynPool->Exists($dmid)) die("3");
        
        $cmt = $dynPool[$dmid];
        $cmt->attr[0]["playtime"] = $targetTime;
        
        $res = $dynPool->Update($cmt);
        
        if ($res == true) {
            $dynPool->Save();
            Utils::WriteLog('Dmm::update_comment_time()', "{$poolId} :: Pool->Save() :: Done!");
            die("0");
        } else {
            Utils::WriteLog('Dmm::update_comment_time()', "{$poolId} :: Pool->Save() :: Fail!");
            die("-1");
        }
	}
	
	public function del()
	{
        
        if ($this->requireVars(
                $this->Input->Post,
                array("playerdel", "dm_inid"))) {
            Abort("不允许直接访问");
        }
        
        $poolId = $this->Input->Request->dm_inid;
        $dynPool =PoolUtils::GetPool('Bilibili2', $poolId, PoolMode::D);
        $idsToDelete = explode(",", $this->Input->Request->playerdel);
        
        $msg = "";
        foreach ($idsToDelete as $id)
        {
            if ($dynPool->Delete($id)) {
                $msg .= "$id deleted;    ";
            } else {
                $msg .= "can't found id {$id};    ";
            }
        }
        
        $dynPool->Save();
        
        Utils::WriteLog('Dmm::del()', "Bilibili2 :: {$poolId} :: Done!  \r\n{$msg}");
        die("0");
	}

	public function move()
	{
        die("0");
	}
	
	public function credit()
	{
        die("0");
	}
	
	public function skip()
	{
        die("0");
	}
}