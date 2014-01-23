<?php

namespace Applications\Frontend\Modules\Files;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class FilesController extends \System\Library\BackController
{
	public function executeUpload(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Upload');
		
		if ($request->postExists('upl_title') && $request->postExists('upl_description') && $request->filesExists('upl_file') && $request->postExists('upl_security'))
		{
			if ($request->filesData('upl_file', 'error') !== NULL)
			{
				switch ($request->filesData('upl_file', 'error'))
				{
					case UPLOAD_ERR_NO_FILE:
						$this->app()->page()->addVar('upload_message', 'Fichier manquant');
						break;
						
					case UPLOAD_ERR_INI_SIZE:
						$this->app()->page()->addVar('upload_message', 'Le fichier dépasse la taille maximale autorisée par PHP');
						break;

					case UPLOAD_ERR_FORM_SIZE:
						$this->app()->page()->addVar('upload_message', 'Le fichier dépasse la taille maximale autorisée par le formulaire');
						break;

					case UPLOAD_ERR_PARTIAL:
						$this->app()->page()->addVar('upload_message', 'Fichier transféré partiellement');
						break;
				}
			}
			else
			{
				$uniqid = md5(uniqid(rand(), TRUE));
				$file_extension = strtolower(substr(strrchr($_FILES['icone']['name'], '.'), 1));
				$filename = "Uploads/".$uniqid.$file_extension;
				
				if (move_uploaded_file($request->filesData('upl_file', 'tmp_name'), $filename))
				{
					$this->app()->page()->addVar('upload_message', 'Upload réussi');
				}
			}
		}
	}
	
	public function executeDownload(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Téléchargement');
	}
}

?>