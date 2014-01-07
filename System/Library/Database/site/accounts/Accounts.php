<?php

namespace System\Library\Entities;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Accounts extends \System\Library\Entity
{
	protected $username;
	protected $sha_pass_hash;
	protected $email;
	protected $joindate;
	protected $last_login;
	protected $last_ip;
	protected $locked;
	
	// SETTERS
	
	public function setId($id)
	{
		if (is_int($id) && !empty($id) && $id > 0)
			$this->id = $id;
		else
			$this->errors['id'] = "L'ID de l'utilisateur doit être un nombre entier positif.";
	}
	
	public function setUsername($username)
	{
		if (!empty($username) && is_string($username))
			$this->username = $username;
		else
			$this->errors['username'] = "Le nom d'utilisateur doit être une chaîne de caractères.";
	}
	
	public function setEmail($email)
	{
		if (!empty($email) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
			$this->email = $email;
		else
			$this->errors['email'] = "Votre adresse email doit être de la forme \"exemple@exemple.net\".";
	}
	
	public function setSha_pass_hash($sha_pass_hash)
	{
		if (!empty($sha_pass_hash) && is_string($sha_pass_hash))
			$this->sha_pass_hash = $sha_pass_hash;
		else
			$this->errors['sha_pass_hash'] = "Mot de passe incorrecte.";
	}
	
	public function setJoindate(\DateTime $joindate)
	{
		$this->joindate = $joindate;
	}
	
	public function setLast_login(\DateTime $last_login)
	{
		$this->last_login = $last_login;
	}
	
	public function setLast_ip($last_ip)
	{
		$this->last_ip = $last_ip;
	}
	
	public function setLocked($locked)
	{
		if (is_int($locked) && !empty($locked))
			$this->locked = $locked;
		else
			$this->errors['locked'] = "La valeur de \"locked\" doit être 0 ou 1.";
	}
	
	
	// GETTERS
	
	public function username()
	{
		return $this->username;
	}
	
	public function sha_pass_hash()
	{
		return $this->sha_pass_hash;
	}
	
	public function email()
	{
		return $this->email;
	}
	
	public function joindate()
	{
		return $this->joindate;
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