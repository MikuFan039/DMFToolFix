<?php if (!defined('PmWiki')) exit();
class Acfun2GroupConfig extends GroupConfig
{

    protected function __construct()
    {
        parent::__construct();
        $this->GroupString = 'Acfun2';
        $this->AllowedXMLFormat = array('data', 'raw');
        $this->SUID = 'A';
        $this->XMLFolderPath = './uploads/Acfun2';
        $this->PlayersSet->Load($this->GroupString);
    }
    
    public function UploadFilePreProcess($str) {
        return simplexml_load_string($str);
    }
    
	public function GenerateFlashVarArr(VideoPageData $source)
	{
        $p = $source->Player;
        $playerParams = new FlashParams($p->playerUrl, $p->width, $p->height);
	    switch (strtoupper($source->VideoType->getType()))
	    {
	        case "NOR":
                $playerParams->addVar('id', $source->DanmakuId);
	        break;
	        
			case "QQ":
			case "TD":
			case "6CN":
			case "URL":
			case "BURL":
			case "LINK":
			case "BLINK":
			case "LOCAL":
                $playerParams->addVar('id'  , $source->DanmakuId);
                $playerParams->addVar('file', $source->VideoStr);
	        break;
	        
			case "YK":
                $playerParams->addVar('ykid', $source->DanmakuId);
	        break;
	        
			default:
				echo "$source->VideoType->getType(): $source->DanmakuId : $source->VideoStr";
				assert(false);
	        break;
	    }
		return $playerParams;
	}
    
    public function __get($name) {
        return $this->$name;
    }
    
    
}