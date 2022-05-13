<?php if (!defined('PmWiki')) exit();
class Router {
    protected static $instance;
    public $controller;
    public $action;
    public $params;
    public static $rules = array();
    public $matched = false;
  
    public static function getInstance() {
        if (isset(self::$instance) and (self::$instance instanceof self)) {
            return self::$instance;
        } else {
            self::$instance = new self();
            return self::$instance;
        }
    }
    
    private static function deleteEmpty($array) {
        return array_filter($array, function ($item) { return !empty($item);});
    }
    
    private function matchRules($uri) {
       foreach (self::$rules as $cond => $resu) {
            if ( preg_match($cond, $uri) ) {
                if  ((strpos($cond, '(') !== FALSE) && (strpos($resu, '$') !== FALSE)) {
                    $resu = preg_replace($cond, $resu, $uri);
                }
                $this->matched = true;
                return $this->setRequest($resu);
            }
        }
        return $this->setRequest($uri);
    }
    
    private function setRequest($uri) {
        $uriSegments = explode('/', $uri);
        $this->controller = empty($uriSegments[0]) ? "" : $uriSegments[0];
        $this->action     = empty($uriSegments[1]) ? "" : $uriSegments[1];
        $this->params     = count($uriSegments) < 2? array() : array_slice($uriSegments, 2);
    }
    
    public function init(K_Input $input) {
        //$_SERVER["REQUEST_URI"],'?');
        $uri = substr(strtok($input->Server->REQUEST_URI, '?'), 1);
        $this->matchRules($uri);
    }
    
    public function toPath() {
        $p = implode("/", $this->params);
        return implode("/", self::deleteEmpty(array($this->controller, $this->action, $p)));
    }
    
    public static function addRule($cond, $resu) {self::$rules[$cond] = $resu;}
}