<?php if (!defined('PmWiki')) exit();
class VideoSourceSet extends Set
{
    protected function get($name)
    {
        if (array_key_exists($name, $this->Set)) {
            return $this->Set[$name];
        } else {
            global $pagename;
            Utils::WriteLog('VideoSourceSet::Get()', "Unknown Video Source {$pagename} :: >>{$name}<<");
        }
    }

	protected function isVaildType($Obj)
	{
		return $Obj instanceof VideoSourceBase;
	}
}