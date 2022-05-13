<?php if (!defined('PmWiki')) exit();
//PoolOp / command / group / dmid / params
//post move clear valid download

//弹幕操作接口
//返回HTML
class PoolOp extends K_Controller {
    const GoBack = "<script language='javascript'> setTimeout('history.go(-1)', 2000);</script>两秒后传送回家";
        
    public function PoolOp() {
        parent::__construct();
    }
    
	public function clear($group, $dmid, $pool)
	{
		if (!XmlAuth::IsAdmin($group, $dmid)) {
            Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: 权限不足");
            $this->display("越权访问。");
            return;
        }
        
        $staPool = PoolUtils::GetPool($group, $dmid, PoolMode::S);
		$dynPool = PoolUtils::GetPool($group, $dmid, PoolMode::D);
        
		switch (strtolower($pool))
		{
			case "static":
				$staPool->Clear();
				$staPool->Save();
				unset($staPool);
				Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: {$pool} :: Done!");
				break;
			case "dynamic":
				$dynPool->Clear();
				$dynPool->Save();
				unset($dynPool);
				Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: {$pool} :: Done!");
				break;
			case "all":
				$staPool->Clear();
                $dynPool->Clear();
                $staPool->Save();
				$dynPool->Save();
				unset($staPool);
				unset($dynPool);
				Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: {$pool} ::Done!");
				break;
		}
        
		$this->display("和谐弹幕池 $pool 完毕。".self::GoBack);
	}
	
	
	public function loadxml($group, $dmid) // GET : format attach split
	{
        
        $gc = Utils::GetGroupConfig($group);

		$format = is_null($_GET['format']) ? $gc->AllowedXMLFormat[0] : $_GET['format'];
		$format = strtolower($format);
		$chunksize = intval($_GET['split']);
		$attach = ($_GET['attach'] == 'true');
		$fileExt = ($format == 'json') ? "json" : "xml";
		
		$staPool = PoolUtils::GetPool($group, $dmid, PoolMode::S);
		$dynPool = PoolUtils::GetPool($group, $dmid, PoolMode::D);
		
		$XMLArr = $staPool->Get() + $dynPool->Get();
        unset($staPool);
		unset($dynPool);
		

		
		$GetString = function (array $XML) use ($format) {
            if ($format == 'json') {
                return XMLConverter::ToJsonFormat($XML);
            } else {
                return XMLConverter::FromUniXML($format, $XML);
            }
        };
		
        if ($chunksize == 0) {
            header("Content-type: text/plain");
            if ($attach) {
                header("Content-disposition: attachment; filename=\"{$group}_{$dmid}_{$format}.{$fileExt}\"");
            }
            echo $GetString($XMLArr);
        } else {
            $tempfile = tempnam(sys_get_temp_dir(), 'DMF');
            $zip = new ZipArchive();
            if ($zip->open($tempfile, ZipArchive::CREATE)!==TRUE) {
                exit("cannot open zip file <$filename>\n");
            }
            $chunks = array_chunk($XMLArr, $chunksize);
            unset($XMLArr);
            foreach ( $chunks as $idx => $chunk ) {
                $zip->addFromString("{$group}_{$dmid}_{$idx}.{$fileExt}", $GetString($chunk));
            }
            $zip->Close();
            
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment; filename=\"{$group}_{$dmid}_{$format}_{$chunksize}.zip\"");
            readfile($tempfile);
            
            unlink($tempfile);
        }
		
	}
	
	public function post($group, $dmid) // GET : pool append
	{
        
        if (!XmlAuth::IsEdit($group, $dmid)) {
            Utils::WriteLog('PoolOp::post()', "{$group} :: {$dmid} :: 权限不足");
            return;
        }
        
		//加载文件
		if ($this->Input->File->uploadfile['error'] != UPLOAD_ERR_OK)
		{
            Utils::WriteLog('PoolOp::post()', "{$group} :: {$dmid} :: 文件上传失败");
			$this->display("文件上传失败");
			return;
		}
	
		if ($xmldata === FALSE) 
		{
            Utils::WriteLog('PoolOp::post()', "{$group} :: {$dmid} :: XML非法");
            $this->display("XML文件非法，拒绝上传请求");
			return;
		}
		
        $pool = PoolUtils::GetPool($group, $dmid, PoolUtils::StrToPool($this->Input->Post->Pool));
		$gc = Utils::GetGroupConfig($group);
		$xmldata = $gc->UploadFilePreProcess(file_get_contents($this->Input->File->uploadfile['tmp_name']));
		$XMLObj = XMLConverter::ToUniXML($xmldata);
		unset($xmldata);
		
		$append = strtolower($this->Input->Post->Append) == 'true' ;
		if ($append) {
			$pool->Append($XMLObj);
		} else {
			$pool->Set($XMLObj);
		}
        
        $pool->Save();
        Utils::WriteLog('PoolOp::post()', "{$group} :: {$dmid} :: Success!");
		$this->display("非常抱歉，上传成功。".self::GoBack);
	}
	
	public function merge($group, $dmid, $from, $to)
	{
        if (!XmlAuth::IsAdmin($group, $dmid)) {
            Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: Unauthorized access!");
            $this->display("越权访问。");
            return;
        }
        
		$fromPool =  PoolUtils::GetPool($group, $dmid, PoolUtils::StrToPool($from));
		$toPool   =  PoolUtils::GetPool($group, $dmid, PoolUtils::StrToPool($to  ));
		
		$toPool->MergeFrom($fromPool);
		$fromPool->Clear();
		
		$fromPool->Save();
		$toPool->Save();
		Utils::WriteLog('PoolOp::move()', "{$group} :: {$dmid} :: 从 {$from} 移动到 {$to} 成功");
		$this->display("弹幕池合并： $from -> $to 完毕。".self::GoBack);
	}
	
	public function validate($group, $dmid, $pool = 'dynamic')
	{
		$acc = DanmakuPoolAccessor::GetAccessor($group, $dmid, PoolUtils::StrToPool($pool));
        $acc->Load();
        if ($acc->hasError) {
            $msg = nl2br(htmlspecialchars($acc->errorString), true);
            $this->display($msg);
        } else {
            $this->display("弹幕池{$pool}校验正常".self::GoBack);
        }
	}
	
	public function randomize($group, $dmid, $pool = 'dynamic')
	{
		if (!XmlAuth::IsAdmin($group, $dmid)) {
            Utils::WriteLog('PoolOp::Randomize()', "{$group} :: {$dmid} :: 权限不足");
            $this->display("越权访问。");
            return;
        }


		switch (strtolower($pool))
		{
			case "static":
                $staPool = PoolUtils::GetPool($group, $dmid, PoolMode::S);
				$staPool->RandomizeID();
				$staPool->Save();
				unset($staPool);
				Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: {$pool} :: Done!");
				break;
			case "dynamic":
                $dynPool = PoolUtils::GetPool($group, $dmid, PoolMode::D);
				$dynPool->RandomizeID();
				$dynPool->Save();
				unset($dynPool);
				Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: {$pool} :: Done!");
				break;
			case "all":
                $staPool = PoolUtils::GetPool($group, $dmid, PoolMode::S);
				$staPool->RandomizeID();
				$staPool->Save();
				unset($staPool);
				
                $dynPool = PoolUtils::GetPool($group, $dmid, PoolMode::D);
				$dynPool->RandomizeID();
				$dynPool->Save();
				unset($dynPool);
				Utils::WriteLog('PoolOp::clear()', "{$group} :: {$dmid} :: {$pool} ::Done!");
				break;
		}
        
		$this->display("初始化弹幕id $pool 完毕。".self::GoBack);
	}

	
	private function display($msg)
	{
        $GLOBALS['MessagesFmt'] = $msg;
        $this->DisplayView('pmwiki_view', array('name' => 'API.XMLTool'));
	}
	
}
