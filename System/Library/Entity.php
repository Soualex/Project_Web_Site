<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class Entity
{
	protected $errors = array();
	protected $id;
	   
	public function __construct($data = array())
	{
		if (!empty($data))
		  $this->hydrate($data);
	}
	   
	public function isNew()
	{
		return empty($this->id);
	}
	
	public function hasError()
	{
		return !empty($this->errors);
	}
	   
	public function error($attr = NULL)
	{
		if (!empty($attr))	
			return $this->errors[$attr];
			
		return $this->errors;
	}
	
	public function setError($attr, $value)
	{
		$this->errors[$attr] = $value;
	}
	   
	public function id()
	{
		return $this->id;
	}
	   
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	   
	public function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			   
			if (is_callable(array($this, $method)))
				$this->$method($value);
		}
	}
	   
	public function offsetGet($var)
	{
		if (isset($this->$var) && is_callable(array($this, $var)))
		 	return $this->$var();
	}
	   
	public function offsetSet($var, $value)
	{
		$method = 'set'.ucfirst($var);
		 
		if (isset($this->$var) && is_callable(array($this, $method)))
			$this->$method($value);
	}
	   
	public function offsetExists($var)
	{
		return isset($this->$var) && is_callable(array($this, $var));
	}
	   
	public function offsetUnset($var)
	{
		throw new \Exception('Impossible de supprimer une quelconque valeur');
	}
}