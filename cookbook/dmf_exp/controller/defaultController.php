<?php if (!defined('PmWiki')) exit();
class DefaultController extends K_Controller {

    private function _urlReplace($pattern, $to, &$subject) {
        $subject = preg_replace($pattern, $to, $subject);
    }
    
    public function try_getFile() {
        $p = $this->Router->toPath();
        Utils::WriteLog("DefaultController::try_getFile()", "Tried to redirect {$this->Input->Server->REQUEST_URI} to {$p}");
        if (file_exists($p)) {
            Header("Url_Router_Stats : {$this->Input->Server->REQUEST_URI} => {$p}");
            Header("Content-Type: application/octet-stream");
            include($p);
            exit;
        } else {
            $this->page_missing();
        }
        
    }
    
	public function page_missing()
	{
		echo $this->view('Site/PageNotFound');
	}
	
	public function view($name = 'Main/HomePage')
	{
        $data = array('name' => $name);
        $this->DisplayView('pmwiki_view', $data);
	}
}
