<?php if (!defined('PmWiki')) exit();
class XMLAuth
{
    const read = 'XMLAuth;read';
    const edit = 'XMLAuth;edit';
    const admin = 'XMLAuth;admin';
    
    
    public static function IsRead($group, $dmid)
    {
        $pn = Utils::GetDMRPageName($group, $dmid);
        return CondAuth($pn, 'xmlread');
    }
    
    public static function IsEdit($group, $dmid)
    {
        $pn = Utils::GetDMRPageName($group, $dmid);
        return CondAuth($pn, 'xmledit');
    }
    
    public static function IsAdmin($group, $dmid)
    {
        $pn = Utils::GetDMRPageName($group, $dmid);
        return CondAuth($pn, 'xmladmin');
    }
    
}