<?php

namespace System\Library\Entities\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class ChatBox extends \System\Library\Entity
{
	protected $user;
	protected $time;
	protected $content;
	
	// SETTERS
	
	public function setUser($user_id)
	{
		global $DB;
		
		if (!empty($user_id) && is_numeric($user_id))
		{
			$this->user = $DB->getManager('Account', 'Site')->getId($user_id);
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