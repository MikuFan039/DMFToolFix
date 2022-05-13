<?php if (!defined('PmWiki')) exit();
class K_Controller {
    protected $Input;
    protected $Router;
    
    public function K_Controller() {
        global $MVC_Input, $MVC_Router;
        $this->Input  = $MVC_Input;
        $this->Router = $MVC_Router;
    }
    
    private function _loadFile($folder, $file, $vars = array()) {
        //localize vars
        foreach ($vars as $k => $v) {
            $$k = $v;
        }
        
        $p = MVC_PATH."/$folder/{$file}.php";
        if (file_exists($p)) {
            include($p);
        } else {
            die("view not found {$p}.");
        }
    }
    
    protected function Helper($name) {
        $this->_loadFile('helper', $name);
    }
    
    protected function DisplayView($viewName, $vars = array()) {
        $this->_loadFile('view', $viewName, $vars);
    }
    
    protected function DisplayStatic($name) {
        $p = MVC_PATH."/static/{$name}";
        if (file_exists($p)) {
            include($p);
        } else {
            die("static file not found {$p}.");
        }
    }
    
    protected function GetView($viewName, $vars = array()) {
        ob_flush();
        $this->DisplayView($viewName, $vars);
        return ob_get_clean();
    }
    
    protected function requireVars($arr, $varNames)
    {
        foreach ($varNames as $name) {
            if (!isset($arr->$name)) {
                return false;
            }
        }
        return true;
    }
    
}