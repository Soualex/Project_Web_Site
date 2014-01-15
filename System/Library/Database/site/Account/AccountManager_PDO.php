<?php

namespace System\Library\Models;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Entities\Account;
 
class AccountManager_PDO extends AccountManager
{
	public function getList($debut = -1, $limite = -1) 
	{
		$sql = "SELECT id, author_id, title, content, add_date, update_date FROM news ORDER BY id DESC";

		if ($debut != -1 || $limite != -1) {
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$query = $this->dao->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Account');

		$listeNews = $query->fetchAll();

		foreach ($listeNews as $news) 
		{
			$news->setAdd_date(new \DateTime($news->add_date()));
			$news->setUpdate_date(new \DateTime($news->update_date()));
		}
 
		$query->closeCursor();

		return $listeNews;
	}
	
	public function getId($id) 
	{
		$query = $this->dao->prepare('SELECT id, username, sha_pass_hash, email, joindate, last_login, last_ip, locked FROM account WHERE id = :id');
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Account');
		
		if ($account = $query->fetch())
		{
			$account->setJoindate(new \DateTime($account['joindate']));
			$account->setLast_login(new \DateTime($account['last_login']));
			
			return $account;
		}

		return NULL;
	}
	
	public function getUsername($username) 
	{
		$query = $this->dao->prepare('SELECT id, username, sha_pass_hash, email, joindate, last_login, last_ip, locked FROM account WHERE username = :username');
		$query->bindValue(':username', $username, \PDO::PARAM_STR);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Account');

		return $query->fetch();
	}
	
	public function getEmail($email) 
	{
		$query = $this->dao->prepare('SELECT * FROM account WHERE email = :email');
		$query->bindValue(':email', $email, \PDO::PARAM_STR);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Entities\Account');

		return $query->fetch();
	}
	
	public function add(\System\Library\Entities\Account $account) 
	{
		global $HTTPRQST;
		
		$query = $this->dao->prepare('INSERT INTO account(username, sha_pass_hash, email, joindate, last_login, last_ip) 
												  VALUES(:username, :sha_pass_hash, :email, NOW(), NOW(), :last_ip)');
												  
		$query->bindValue(':username', $account->offsetGet('username'), \PDO::PARAM_STR);
		$query->bindValue(':sha_pass_hash', $account->offsetGet('sha_pass_hash'), \PDO::PARAM_STR);
		$query->bindValue(':email', $account->offsetGet('email'), \PDO::PARAM_STR);
		$query->bindValue(':last_ip', $HTTPRQST->getUserIP(), \PDO::PARAM_STR);
		
		$query->execute();
		
		$query->closeCursor();
	}
	
	public function updateLogin($id)
	{
		global $HTTPRQST;
	
		$query = $this->dao->prepare('UPDATE account SET last_login = NOW(), last_ip = :last_ip WHERE id = :id');

		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->bindValue(':last_ip', $HTTPRQST->getUserIP(), \PDO::PARAM_STR);
		
		$query->execute();
		
		$query->closeCursor();
	}
	
	public function countOnlinePlayers() 
	{
		$query = $this->dao->query('SELECT logged FROM account WHERE logged = 1');
		$data = $query->fetchAll();
		
		return count($data);
	}
}

?>