<?php

namespace System\Library\Database\Site\Ip_banned;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Route Class
 *
 * @subpackage	Library
 * @category	Route
 */
class Ip_banned extends \System\Library\Entity
{
	protected $ip;
	protected $ban_date;
	protected $unban_date;
	protected $ban_reason;
	protected $bannedby;
	
	// SETTERS
	
	public function setIp($ip)
	{
		if (is_string($ip))
		{
			$this->ip = $ip;
		}
	}
	
	public function setBan_date($ban_date)
	{
		$this->ban_date = new \DateTime($ban_date);
	}
	
	public function setUnban_date($unban_date)
	{
		$this->unban_date = new \DateTime($unban_date);
	}
	
	public function setBan_reason($ban_reason)
	{
		if (is_string($ban_reason))
		{
			$this->ban_reason = $ban_reason;
		}
	}
	
	public function setBannedby($bannedby)
	{
		global $DB;
		
		$this->bannedby = $DB->getManager('Account', 'Site')->get($bannedby);
		
	}
	
	
	// GETTERS
	
	public function ip()
	{
		return $this->ip;
	}
	
	public function ban_date()
	{
		return $this->ban_date;
	}
	
	public function unban_date()
	{
		return $this->unban_date;
	}
	
	public function ban_reason()
	{
		return $this->ban_reason;
	}
	
	public function bannedby()
	{
		return $this->bannedby;
	}
}

?>