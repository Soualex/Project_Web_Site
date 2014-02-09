<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class EntitiesHandler
{
	protected $_entity;
	protected $_entity_manager;


	public function load_entity($entity, $class)
	{
		if (!is_string($entity) || empty($entity) || !is_string($class) || empty($class))
		{
			show_error(ERROR_LEVEL_FATAL, 'Erreur Arguments', 'Les arguments spécifiés dans la fonction "EntitiesHandler::load_entity()" sont invalides.');
		}
		else
		{
			if (!isset($this->_entity[$entity.'_'.$class]))
			{
				require_once(HOMEPATH.'/System/Library/Entities/'.$entity.'.php');		
				$this->_entity[$entity.'_'.$class] = new $class();
			}

			return $this->_entity[$entity.'_'.$class];
		}
	}
	
	public function load_entity_manager($entity)
	{
		if (!is_string($entity) || empty($entity))
		{
			show_error(ERROR_LEVEL_FATAL, 'Erreur Arguments', 'Les arguments spécifiés dans la fonction "EntitiesHandler::load_entity_manager()" sont invalides.');
		}
		else
		{
			if (!isset($this->_entity_manager[$entity]))
			{			
				$class = '\System\Library\Entities\\'.$entity.'\\'.$entity.'Manager_PDO';			
				$this->_entity_manager[$entity] = new $class();
			}

			return $this->_entity_manager[$entity];
		}
	}
}

?>