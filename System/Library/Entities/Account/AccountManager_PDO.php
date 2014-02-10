<?php

namespace System\Library\Database\Site\Account;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Database\Site\Account\Account;
 
class AccountManager_PDO extends AccountManager
{
	public function getList($debut = -1, $limite = -1) 
	{
		$sql = "SELECT id, author_id, title, content, add_date, update_date FROM news ORDER BY id DESC";

		if ($debut != -1 || $limite != -1) {
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$query = $this->dao->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Account\Account');

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
		$query = $this->dao->prepare('SELECT * FROM account WHERE id = :id');
		$query->bindValue(':id', $id, \PDO::PARAM_INT);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Account\Account');
		$account = $query->fetch();
		$query->closeCursor();

		return $account;
	}
	
	public function getUsername($username) 
	{
		$query = $this->dao->prepare('SELECT * FROM account WHERE username = :username');
		$query->bindValue(':username', $username, \PDO::PARAM_STR);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Account\Account');
		$account = $query->fetch();
		$query->closeCursor();

		return $account;
	}
	
	public function getEmail($email) 
	{
		$query = $this->dao->prepare('SELECT * FROM account WHERE email = :email');
		$query->bindValue(':email', $email, \PDO::PARAM_STR);
		$query->execute();

		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Account\Account');
		$account = $query->fetch();
		$query->closeCursor();

		return $account;
	}
	
	public function add(\System\Library\Database\Site\Account\Account $account) 
	{
		global $HTTPRQST;
		
		$query = $this->dao->prepare('INSERT INTO account(username, email, password, joinip) 
												  VALUES(:username, :email, :password, :joinip)');
												  
		$query->bindValue(':username', $account->offsetGet('username'), \PDO::PARAM_STR);
		$query->bindValue(':email', $account->offsetGet('email'), \PDO::PARAM_STR);
		$query->bindValue(':password', $account->offsetGet('password'), \PDO::PARAM_STR);
		$query->bindValue(':joinip', $HTTPRQST->getUserIP(), \PDO::PARAM_STR);
		
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
}

?>
