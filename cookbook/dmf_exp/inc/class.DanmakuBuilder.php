<?php if (!defined('PmWiki')) exit();
class DanmakuBuilder {
    
    public $text;
    public $pool;
    public $userhash;
    public $dmid;
    public $time;
    
    public $attrs = array();
    private $attrIdx = 0;
    
    public function __construct($text, $pool, $userhash = 'deadbeef', $time = null) {
        $this->time = ($time === null) ? time() : $time;
        $this->text = htmlspecialchars($text, ENT_NOQUOTES);
        $this->dmid = mt_rand(0,2147483647);
        $this->pool= $pool;
        $this->userhash = $userhash;
    }
    
    public function AddAttr(array $fields) {
        foreach ($fields as $key => $value) {
            $this->attrs[$this->attrIdx][$key] = $value;
        }
    }
    
    public function NextAttr() {
        $this->attrIdx += 1;
    }
    
    public function __toString() {
        $text = <<<CMT

<comment id="{$this->dmid}" poolid="{$this->pool}" userhash="{$this->userhash}" sendtime="{$this->time}">
	<text>{$this->text}</text>

CMT;
        foreach ($this->attrs as $idx => $fields) {
            $text .= "\t<attr id=\"{$idx}\"";
            foreach ($fields as $key => $value) {
                $text .= " {$key}=\"{$value}\"";
            }
            $text .= " />\r\n";
        }
        $text .= "</comment>";
        return $text;
    }
    
}