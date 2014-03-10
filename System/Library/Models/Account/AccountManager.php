<?php

namespace System\Library\Models\Account;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class AccountManager extends \System\Library\Manager
{
	/**
	 * Méthode retournant une liste d'utilisateurs demandée
	 * @param $debut int La première news à sélectionner
	 * @param $limite int Le nombre de news à sélectionner
	 * @return array La liste des news. Chaque entrée est une instance de News.
	 */
	abstract public function getList($debut = -1, $limite = -1);
	
	/**
	 * Méthode retournant un utilisateur précis.
	 * @param $id int L'identifiant du compte à récupérer
	 * @return Account Le compte demandé
	 */
	abstract public function getId($id);
	
	/**
	 * Méthode retournant un utilisateur précis.
	 * @param $username string Le nom d'utilisateur du compte demandé
	 * @return Account Le compte demandé
	 */
	abstract public function getUsername($username);
	
	/**
	 * Méthode retournant un utilisateur précis.
	 * @param $id string L'adresse email du compte demandé
	 * @return Account Le compte demandé
	 */
	abstract public function getEmail($email);
	
	/**
	 * Méthode ajoutant un utilisateur à la base de données
	 * @param $account \Library\Models\Account
	 */
	abstract public function add(\System\Library\Models\Account\Account $account);
	
	/**
	 * Méthode mettant à jour les informations de la dernière connxeion
	 * @param $id int L'identifiant du compte à mettre à jour
	 */
	abstract public function updateLogin($id);
}

?>
