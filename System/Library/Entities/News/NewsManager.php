<?php

namespace System\Library\Database\Site\News;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class NewsManager extends \System\Library\Manager
{
	/**
	 * Méthode retournant une liste de news demandée
	 * @param $debut int La première news à sélectionner
	 * @param $limite int Le nombre de news à sélectionner
	 * @return array La liste des news. Chaque entrée est une instance de News.
	 */
	abstract public function getList($debut = -1, $limite = -1);
	
	/**
	 * Méthode retournant une news précise.
	 * @param $id int L'identifiant de la news à récupérer
	 * @return News La news demandée
	 */
	abstract public function get($id);
}

?>