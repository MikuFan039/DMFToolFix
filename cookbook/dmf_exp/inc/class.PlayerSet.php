<?php if (!defined('PmWiki')) exit();
class PlayerSet extends Set
{
    public function __construct()
    {
    }
    
    protected function get($name)
    {
        if (array_key_exists($name, $this->Set)) {
            return $this->Set[$name];
        } else {
            return false;
        }
    }
    
    public function Load(/* groupstring*/ $gs)
    {
        $dir = self::GetPlayerDir($gs);
        $pattern = "{$dir}/*.json";
        foreach (glob($pattern) as $file) {
            $j = json_decode(file_get_contents($file));
            //是不是default.json
            if (strtolower(basename($file)) == "default.json") {
                $defaultId = $j->playerid;
            } else {
                $playerPath = "{$gs}/{$j->filename}";
                $player = new Player($playerPath, $j->name, $j->width, $j->height);
                $this->add($j->playerid, $player);
            }
        }
        
        if (empty($defaultId)) {
            Utils::WriteLog('PlayerSet::Load()', "找不到默认播放器，为空或文件不存在");
            $this->addDefault($j->playerid);
        } else {
            $this->addDefault($defaultId);
        }
    }
    
	public function addDefault($id)
	{
		$this->add('Default', $this->Set[strtolower($id)]);
	}
	
	protected function isVaildType($Obj)
	{
		return $Obj instanceof Player;
	}
	
	public static function GetPlayerDir($gs)
	{
        global $FarmD;
        return "{$FarmD}/static/players/$gs";
	}
}

