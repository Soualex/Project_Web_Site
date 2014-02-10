<?php

namespace System\Library\Database\Site\Files;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class FilesManager extends \System\Library\Manager
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
	 * Méthode ajoutant un utilisateur à la base de données
	 * @param $account \Library\Entities\Account
	 */
	abstract public function add(\System\Library\Database\Site\Files\Files $file);
}

?>
