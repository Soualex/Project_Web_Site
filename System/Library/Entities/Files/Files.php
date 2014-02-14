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
	
	public function setUploader($uploader)
	{
		if (!empty($uploader) && is_string($uploader))
		{
			$this->uploader = $uploader;
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
		if (!empty($upload_date) && is_numeric($upload_date))
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
