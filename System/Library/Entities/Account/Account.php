<?php

namespace System\Library\Database\Site\Account;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Account extends \System\Library\Entity
{
	protected $username;
	protected $password;
	protected $rank;
	protected $email;
	protected $joindate;
	protected $joinip;
	protected $last_login;
	protected $last_ip;
	protected $locked;
	
	// SETTERS
	
	public function setUsername($username)
	{
		if (!empty($username) && is_string($username))
		{
			$this->username = $username;
		}
	}
	
	public function setPassword($password)
	{
		if (!empty($password) && is_string($password))
		{
			$this->password = $password;
		}
	}
	
	public function setRank($rank)
	{
		if (is_int($rank) && !empty($rank) && $rank >= 0)
		{
			$this->rank = $rank;
		}
	}
	
	public function setEmail($email)
	{
		if (!empty($email) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
		{
			$this->email = $email;
		}
	}
	
	public function setJoindate($joindate)
	{
		if (!empty($joindate) && is_int($joindate))
		{
			$date = new \DateTime();
			$this->upload_date = $date->setTimestamp($joindate);
		}
	}
	
	public function setJoinip($ip)
	{
		if (!empty($ip) && is_string($ip))
		{
			$this->ip = $ip;
		}
	}
	
	public function setLast_login($last_login)
	{
		if (!empty($last_login) && is_int($last_login))
		{
			$date = new \DateTime();
			$this->upload_date = $date->setTimestamp($last_login);
		}
	}
	
	public function setLast_ip($last_ip)
	{
		$this->last_ip = $last_ip;
	}
	
	public function setLocked($locked)
	{
		if (is_int($locked) && !empty($locked))
		{
			$this->locked = $locked;
		}
	}
	
	
	// GETTERS
	
	public function username()
	{
		return $this->username;
	}
	
	public function password()
	{
		return $this->password;
	}
	
	public function rank()
	{
		return $this->rank;
	}
	
	public function email()
	{
		return $this->email;
	}
	
	public function joindate()
	{
		return $this->joindate;
	}
	
	public function joinip()
	{
		return $this->joinip;
	}
	
	public function last_login()
	{
		return $this->last_login;
	}
	
	public function last_ip()
	{
		return $this->last_ip;
	}
	
	public function locked()
	{
		return $this->locked;
	}
}

?>