<?php if (!defined('PmWiki')) exit();
class VideoPageData
{
    public $VideoStr;
    public $SourceLink;
    public $VideoType;
    
	public $DanmakuId;
    public $Player;
    public $PartNo;
    public $IsMuti;
	
    public $Pagename;
    public $Group;
    public $GroupConfig;
    
    public function VideoPageData($pn)
    {
        $this->Pagename = $pn;
        $this->readVars($this->Group, '$Group');
        $this->GroupConfig = Utils::GetGroupConfig($this->Group);
        $this->readVars($this->VideoStr, '$:VideoStr');
        $this->readVars($this->SourceLink, '$:sourcelink');
        $this->readVars($this->VideoType, '$:VideoType');
		$vt = $this->VideoType;
        $this->VideoType = $this->GroupConfig->VideoSourceSet->$vt;
		$this->IsMuti = $this->VideoType->MutiAble && (PageVar($this->Pagename, '$:IsMuti') == 'true');
		$PartPreferPlayer = $page["PartPlayer_P".$this->partIndex];
		$UserPreferPlayer = $_REQUEST['Player'];
		$this->Player = $this->GroupConfig->PlayersSet->Default;
		if ($this->isValidPlayer($PartPreferPlayer)) 
			$this->Player = $this->GroupConfig->PlayersSet->$PartPreferPlayer;
		if ($this->isValidPlayer($UserPreferPlayer)) 
			$this->Player = $this->GroupConfig->PlayersSet->$UserPreferPlayer;
		
		$this->PartNo = intval($_REQUEST['Part']) > 1 ?  intval($_REQUEST['Part']) : 1;
		
		if ($this->VideoType->PageNameAsDanmakuId)
		{
			$this->DanmakuId = PageVar($this->Pagename, '$Name');
		} else {
			$this->DanmakuId = $this->VideoStr;
		}
		
		if ($this->VideoType->MutiAble && ($this->PartNo > 1))
		{
			$this->DanmakuId .= "P".$this->PartNo; 
		}
		
		if ($this->VideoType->UrlConvert)
		{
			$this->VideoStr = $this->VideoType->ConvertVideoUrl($this->VideoStr);
		}
		
    }
    
	private function isValidPlayer($p)
	{
		return ($this->GroupConfig->PlayersSet->$p) !== FALSE;
	}
	
    private function readVars(&$var, $name)
    {
        $var = PageVar($this->Pagename,$name);
    }
}
