<?php

namespace System\Library\Models\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class ChatBox_message extends \System\Library\Entity
{
	protected $username;
	protected $time;
	protected $content;
	
	// SETTERS
	
	public function setUsername($username)
	{		
		if (!empty($username) && is_string($username))
		{
			$this->username = $username;
		}
	}
	
	public function setTime($time)
	{
		if (!empty($time))
		{
			$date = new \DateTime();
			$this->time = $date->setTimestamp($time);
		}
	}
	
	public function setContent($content)
	{
		if (!empty($content) && is_string($content))
		{
			$this->content = $content;
		}
	}
	
	// GETTERS
	
	public function user()
	{
		return $this->user;
	}
	
	public function time()
	{
		return $this->time;
	}
	
	public function content()
	{
		return $this->content;
	}
}

?>