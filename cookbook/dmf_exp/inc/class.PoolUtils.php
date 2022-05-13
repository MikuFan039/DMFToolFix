<?php if (!defined('PmWiki')) exit();
class PoolUtils
{
    public static function HashByAttrs() {
        $res = "";
        foreach (func_get_args() as $arg) {
            $res = md5("{$res}{$arg}");
        }
        return $res;
    }
    
    public static function GetPool($group, $dmid, $pool) {
        $group = Utils::GetGroup($group);
        $dmid  = basename($dmid);
        $pool  = self::StrToPool($pool);
        
        if ($group === FALSE) {
            Utils::WriteLog('danmakuPool#GetPool()', "{$group} :: {$dmid} ::{$pool}:: 找不到指定组");
            return false;
        }
        return new DanmakuPool($group, $dmid, $pool);
    }
    
    public static function StrToPool($str) {
        if (substr($str, 0, 8) === 'PoolMode') return $str;
        
        switch (strtolower($str)) {
            case "static"  :
                return PoolMode::S;
            case "dynamic" :
                return PoolMode::D;
            case "all"     :
                return PoolMode::A;
            default        :
                Utils::WriteLog('danmakuPool#StrToPool()', "找不到指定弹幕池{$str}");
                die($str);
        }
    }
    
    public static function XmlAuth($group, $dmid, $auth) {
        $pn = Utils::GetDMRPageName($dmid, Utils::GetGroup($group));
        switch ($auth) {
            case XmlAuth::read:
                return CondAuth($pn, 'xmlread');
                break;
            case XmlAuth::edit:
                return CondAuth($pn, 'xmledit');
                break;
            case XmlAuth::admin:
                return CondAuth($pn, 'xmladmin');
                break;
        }
    }
    
    public static function AppendToDynamicPool($gc, $id, DanmakuBuilder $builder) {
        $id = basename($id);
        $_pagename = "DMR.{$gc->SUID}{$id}";
        $auth = 'edit';
        $page = @RetrieveAuthPage($_pagename, $auth, false, 0);
        if (!$page) {
            return false;
        }
        self::DanmakuTimeShift($page, $id, $builder);
        $page['text'] .= (string) $builder;
        WritePage($_pagename, $page);
        return true;
    }
    
    public static function DanmakuTimeShift(&$page, $dmid, DanmakuBuilder $builder) {
        global $TimeShiftDelta;
        if (empty($GLOBALS['EnableAutoTimeShift'])) return;
        
        $lastcommit = json_decode($page['LastCommit']);
        
        $isNull = ($lastcommit === NULL);
        if ($isNull) {
            $lastcommit = (object) array(
                'sendtime' => time(),
                'playtime' => $builder->attrs[0]['playtime'],
                'count'    => 1);
        }
        
        $isTimeMatched = ($builder->attrs[0]['playtime'] == $lastcommit->playtime);
        
        if ($isTimeMatched) {
            $timeoffset = $TimeShiftDelta * $lastcommit->count;
            $builder->attrs[0]['playtime'] += $timeoffset;
            $lastcommit->count += 1;
        } else {
            $lastcommit->playtime = $builder->attrs[0]['playtime'];
            $lastcommit->count    = 0;
        }
        
        $lastcommit->sendtime = time();
        $page['LastCommit'] = json_encode($lastcommit);
    }
}