<?php if (!defined('PmWiki')) exit();
class K_Array {
    private $arr;
    
    public function K_Array ($vars) {
        $this->arr = array();
        @$this->copyVars($this->arr, $vars);
    }
    
    private function copyVars(&$arr, $vars)
    {
        foreach ($vars as $k => $v) {
            $arr[$k] = stripmagic($v);
        }
    }
    
    public function __get($name) {
        return @$this->arr[$name];
    }
}


class K_Input {
    private $get;
    private $file;
    private $post;
    private $server;
    private $request;
    
    public function K_Input () {
        $this->server  = new K_Array($_SERVER);
        $this->get     = new K_Array($_GET);
        $this->post    = new K_Array($_POST);
        $this->file    = new K_Array($_FILES);
        $this->request = new K_Array($_REQUEST);
    }
    
    public function __get($name) {
        $name = strtolower($name);
        return $this->$name;
    }
    
}