<?php
function GetAllGroupConfig() {
    $TargetGroupsConfigs = array();
    foreach (listpages('/.*\.GroupFooter/') as $pagename) {
            try {
                $group = substr($pagename, 0, -12);
                $TargetGroupsConfigs[strtolower($group)] = Utils::GetGroupConfig($group);
            }
            catch (Exception $e) {}
    }
    return $TargetGroupsConfigs;
}
function ConfigureDefaultPlayer() {
    $groups = GetAllGroupConfig();
    $text   = "";
    foreach ($groups as $groupname => $gc) {
        $text .= "{$gc->GroupString} <br />\r\n";
        $default = $gc->PlayersSet->Default;
        foreach ($gc->PlayersSet as $id => $player) {
            if ($id == "default") break;
            if ($player == $default) {
                $def = "selected=selected";
            } else {
                $def = "";
            }
            $text .= "(:input select name=\"{$gc->GroupString}\" value=\"{$id}\" label=\"{$player->desc}\" {$def} :)\r\n";
        }
        $text .= "<br />";
    }
    return $text;
}
Markup("ConfigureDefaultPlayer", '<directives', "/\\(:ConfigureDefaultPlayer:\\)/e", 'ConfigureDefaultPlayer()');

$HandleActions['UpdateConfig'] = 'HandleConfigUpdate';
$HandleAuth['UpdateConfig'] = 'admin';
function HandleConfigUpdate($pagename, $auth) {
    $groups = GetAllGroupConfig();
    foreach ($_POST as $group => $playerid) {
        $group    = basename($group);
        $playerid = basename($playerid);
        
        $group    = @$groups[strtolower($group)];
        if (is_null($group)) break;
        if ($group->$playerid === false) break;
        $jsonfile = PlayerSet::GetPlayerDir($group->GroupString)."/default.json";
        file_put_contents($jsonfile, json_encode(array("playerid" => $playerid)));
    }
    $GLOBALS['MessagesFmt'] = '配置已保存';
    HandleBrowse($pagename);
}