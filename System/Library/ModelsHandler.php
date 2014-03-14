<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelsHandler
{
	protected $_model_entity;
	protected $_model_manager;

	
	public function load_model_entity($model, $entity, array $args = NULL)
	{
		if (!is_string($model) || empty($model) || !is_string($entity) || empty($entity))
		{
			show_error(ERROR_LEVEL_FATAL, 'Erreur Arguments', 'Les arguments spécifiés dans la fonction "EntitiesHandler::load_entity()" sont invalides.');
		}
		else
		{
			if (!isset($this->_model_entity[$entity]))
			{
				$entity_file = '\System\Library\Models\\'.$model.'\\'.$entity;		
				$this->_model_entity[$entity] = new $entity_file($args);
			}
			
			return $this->_model_entity[$entity];
		}
	}
	
	public function load_model_manager($model)
	{
		if (!is_string($model) || empty($model))
		{
			show_error(ERROR_LEVEL_FATAL, 'Erreur Arguments', 'Les arguments spécifiés dans la fonction "EntitiesHandler::load_entity_manager()" sont invalides.');
		}
		else
		{
			if (!isset($this->_model_manager[$model]))
			{			
				$class = '\System\Library\Models\\'.$model.'\\'.$model.'Manager_PDO';			
				$this->_model_manager[$model] = new $class($GLOBALS['$_DB_HANDLER']);
			}

			return $this->_model_manager[$model];
		}
	}
}

?>