<?php

namespace System\Library;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model
{
	private $name;
	private $db;
	private $entities[];
	private $manager;

	/**
	 * Construct.
	 *
	 * @access	public
	 * @param	string	the entity's name
	 * @param	string	the entity's database
	 */
	public function __construct($name, $db)
	{
		$name = ucfirst($name);
		$db = ucfirst($db);

		$model_path = BASEPATH.'\System\Libray\\'.$this->db.'\\'.$this->name;

		if (is_dir($model_path))
		{
			if (file_exists($model_path.'\\'.$this->db.'\\'.$this->name'.php') || file_exists($model_path.'\\'.$this->db.'\\'.$this->name'Manager.php'))
			{
				show_error(ERROR_LEVEL_FATAL, 'Invalid Configuration', 'Your model\'s files '.$this->db.'\\'.$this->name.' are badly configured.');
			}
			else
			{
				$this->manager = new \
			}
		}
		else
		{
			show_error(ERROR_LEVEL_FATAL, 'Invalid Configuration', 'The <i>'.$this->db.'\\'.$this->name.'</i> model\'s directory does not exist.');
		}
	}

	/**
	 * Return a list of entities generated.
	 *
	 * @access	public
	 * @return	Entity
	 */
	public function getEntities()
	{
		return $this->entities;
	}

	/**
	 * Return a specificate entity.
	 *
	 * @access	public
	 * @param	int	the entity's index
	 * @return	string
	 */
	public function getEntity($index)
	{
		if (array_key_exists($index, $this->entities))
			return $this->entities[$index];
		else
			show_error(ERROR_LEVEL_FATAL, 'Entity Not Found', 'The entity you try to serch does not exist. May be you have entried an invalid index.');
	}

	/**
	 * Return the model's manager
	 *
	 * @access	public
	 * @return	Manager
	 */
	public function getManager()
	{
		if (!empty($this->manager))
			return $this->manager;
		else
			show_error(ERROR_LEVEL_FATAL, 'Manager Not Found', 'The entity\'s manager '.$this->name.' of the database '.$this->database.' have been badly instanciated.');
	}
}

?>