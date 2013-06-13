<?php

class Validator {

	private $data=array();
	private $rules=array();

	public function setData($params)
	{
		$this->data = $params;
	}

	public function setRules($field, $type, $param)
	{
		$this->rules[$field][]=array('type'=>$type, 'param'=>$param);
		return $this;
	}

	public function validate()
	{
		foreach ($this->rules as $k => $v) 
		{
			foreach ($v as $vv) 
			{
				$this->$vv['type']($k, $vv['param']);
			}
		}
	}

	private function min_length($field, $param)
	{
		if(mb_strlen($this->data[$field])>$param) 
		{
			echo "$field min_length is OK<br />";
		}
		else
		{
			echo "$field min_length is not OK <br />";	
		}
	}

	private function max_length($field, $param)
	{
		if(mb_strlen($this->data[$field])<$param) 
		{
			echo "$field max_length is OK<br />";
		}
		else
		{
			echo "$field max_length is not OK<br />";
		}
	}
}