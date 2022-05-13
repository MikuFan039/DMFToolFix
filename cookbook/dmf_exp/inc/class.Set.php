<?php if (!defined('PmWiki')) exit();
abstract class Set implements Iterator
{
	protected $Set = array();
	
	public function add($id, $Obj)
	{
		if (!$this->isVaildType($Obj))
			return;
		$this->Set[strtolower($id)] = $Obj;
		return $this;
	}
	
	abstract protected function get($name);
	
	public function __get($name)
	{
		return $this->get(strtolower($name));
	}

	public function current()
	{
		return current($this->Set);
	}
	
	public function key()
	{
		return key($this->Set);
	}
	
	public function next()
	{
		next($this->Set);
	}
	
	public function rewind()
	{
		reset($this->Set);
	}
	
	public function valid()
	{
		return $this->isVaildType($this->current());
	}

	abstract protected function isVaildType($Obj);
}