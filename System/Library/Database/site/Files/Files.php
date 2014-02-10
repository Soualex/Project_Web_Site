<?php

namespace System\Library\Database\Site\Files;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Files extends \System\Library\Entity
{
	protected $uploader;
	protected $filename;
	protected $file_size;
	protected $upload_date;
	protected $title;
	protected $description;
	
	
	// SETTERS
	
	public function setUploader($uploader_id)
	{
		global $DB;
		
		if (!empty($uploader_id) && is_numeric($uploader_id))
		{
			$this->uploader = $DB->getManager('Account', 'Site')->getId($uploader_id);
		}
	}
	
	public function setFilename($filename)
	{
		if (!empty($filename) && is_string($filename))
		{
			$this->filename = $filename;
		}
	}
	
	public function setFile_size($file_size)
	{
		if (!empty($file_size) && is_numeric($file_size))
		{
			$this->file_size = $file_size;
		}
	}
	
	public function setUpload_date($upload_date)
	{
		if (!empty($upload_date))
		{
			$this->upload_date = new \DateTime($upload_date);
		}
	}
	
	public function setTitle($title)
	{
		if (!empty($title) && is_string($title))
		{
			$this->title = $title;
		}
	}
	
	public function setDescription($description)
	{
		if (!empty($description) && is_string($description))
		{
			$this->description = $description;
		}
	}
	
	// GETTERS
	
	public function uploader()
	{
		return $this->uploader;
	}
	
	public function filename()
	{
		return $this->filename;
	}
	
	public function file_size()
	{
		return $this->file_size;
	}
	
	public function upload_date()
	{
		return $this->upload_date;
	}
	
	public function title()
	{
		return $this->title;
	}
	
	public function description()
	{
		return $this->description;
	}
}

?>