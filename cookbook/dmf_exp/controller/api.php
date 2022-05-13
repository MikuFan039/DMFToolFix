<?php if (!defined('PmWiki')) exit();
//Acfun (老) 播放器接口
class Api extends K_Controller {
    public function filtrate()
    {
        $this->DisplayStatic('acfun_filter_10.xml');
    }
    
    public function filtrate2()
    {
        $this->DisplayStatic('acfun_filter2_10 .xml');
    }    

    public function ujson()
    {
        die('[]');
    }
    
    public function badwords()
    {
        die('[]');
    }
}