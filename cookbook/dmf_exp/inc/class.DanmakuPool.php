<?php if (!defined('PmWiki')) exit();
class DanmakuPool implements Iterator, ArrayAccess
{
    private $group;
    private $dmid;
    private $pool;
	
	private $container = array();
    private $loader;
    private $loaded = false;
    
    public function DanmakuPool($group, $dmid, $pool) {
        $this->group = $group;
        $this->dmid  = $dmid;
        $this->pool  = $pool;
        
        
        $this->loader = DanmakuPoolAccessor::GetAccessor($group, $dmid, $pool);
        foreach ($this->loader->Load() as $danmaku) {
            $this->container[strval($danmaku['id'])] = $danmaku;
        }
    }
    
    public function Save() {
        $this->loader->Save($this->container);
    }
    
    public function Find($callback) {
        if (!is_callable($callback)) return false;
        return array_filter($this->container, $callback);
    }
    
    public function Exists($id) {
        return $this->offsetExists($id);
    }
    
    public function Update(SimpleXMLElement $new, $id = null) {
        if ( !self::IsValidNode($new) ) return false;
        $id = ($id == null) ? intval($new->attr[0]["playtime"]) : intval($id);
        $this->container[$id] = $new;
        return true;
    }
    
    public function Delete($id) {
        if ($this->Exists($id)) {
            unset($this->container[$id]);
            return true;
        } else {
            return false;
        }
    }
    
    public function DeleteByContent($id) {
        
    }
    
    public function Clear() {
        $this->container = array();
    }
    
    public function MoveFrom(DanmakuPool $pool) {
        $this->Set($pool->Get());
        $pool->Clear();
    }
    
    public function MergeFrom(DanmakuPool $pool) {
        $this->container = array_merge($this->container, $pool->Get());
    }
    
    public function RandomizeID() {
        $newarr = array();
        $getUniqueId = function () use ($newarr) {
            do {
                $id = mt_rand();
            } while (isset($newarr[$id]));
            return $id;
        };
            
        foreach ($this->container as $id => $cmt) {
            $id = $getUniqueId();
            $cmt[0]["id"] = $id;
            $newarr[$id] = $cmt;
        }
        $this->container = $newarr;
    }
    
    public function Append(array $arr) {
        foreach ($arr as $node) {
            if (!self::IsValidNode($node)) {
                return false;
            }
        }
        
        $this->container = array_merge($this->container, $arr);
    }
    
    public function Get() {
        return $this->container;
    }
    
    public function Set(array $arr) {
        foreach ($arr as $node) {
            if (!self::IsValidNode($node)) {
                return false;
            }
        }
        $this->container = $arr;
        return true;
    }
    
    private static function IsValidNode($node) {
        if (!$node instanceof SimpleXMLElement) return false;
        if ($node->GetName() != "comment") return false;
        return true;
    }
    
    /***** Iterator *****/
    public function current() {
        current($this->container);
    }
    public function key() {
        key($this->current());
    }
    public function next() {
        next($this->container);
    }
    public function rewind() {
        reset($this->container);
    }
    public function valid() {
        return self::IsValidNode($this->current());
    }
    
    
    /***** ArrayAccess *****/
    public function offsetSet($offset, $value) {
        if ( !self::IsValidNode($value) ) return;
        
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}