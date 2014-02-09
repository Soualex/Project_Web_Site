<?php

namespace System\Library\Database\Site\Files;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Files extends \System\Library\Entity
{
	protected $uploader;
	protected $filename;
	protected $file_size;
	protected $upload_date;
	
	
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
		if (!empty($upload_date) && is_int($upload_date))
		{
			$date = new \DateTime();
			$this->upload_date = $date->setTimestamp($upload_date);
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
}

?>