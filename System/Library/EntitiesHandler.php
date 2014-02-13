<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class EntitiesHandler
{
	protected $_entity;
	protected $_entity_manager;
	protected $_DB_HANDLER;


	public function __construct(\System\Library\DatabaseHandler $_DB_HANDLER)
	{
		$this->_DB_HANDLER = $_DB_HANDLER;
	}
	
	public function load_entity($entity, $class, array $args = NULL)
	{
		if (!is_string($entity) || empty($entity) || !is_string($class) || empty($class))
		{
			show_error(ERROR_LEVEL_FATAL, 'Erreur Arguments', 'Les arguments spécifiés dans la fonction "EntitiesHandler::load_entity()" sont invalides.');
		}
		else
		{
			if (!isset($this->_entity[$class]))
			{
				$class_file = '\System\Library\Entities\\'.$entity.'\\'.$class;		
				$this->_entity[$class] = new $class_file($args);
			}
			
			return $this->_entity[$class];
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
				$this->_entity_manager[$entity] = new $class($this->_DB_HANDLER);
			}

			return $this->_entity_manager[$entity];
		}
	}
}

?>