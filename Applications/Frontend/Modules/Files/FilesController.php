<?php

namespace Applications\Frontend\Modules\Files;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class FilesController extends \System\Library\BackController
{
	public function executeUpload(\System\Core\HTTPRequest $request)
	{
			$this->app()->page()->addVar('page_name', 'Upload');
			
			if ($request->filesExists('upl_file') && $request->postExists('upl_security'))
			{
				if ($request->filesData('upl_file', 'error') > 0)
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
					$file_extension = strtolower(substr(strrchr($request->filesData('upl_file', 'name'), '.'), 1));
					$filename = $request->filesData('upl_file', 'name').'_'.md5(uniqid(rand(), TRUE)).'.'.$file_extension;
					$file = new \System\Library\Database\Site\Files\Files(array('uploader' => $this->app()->session()->getAttribute('id'), 'filename' => $filename, 'file_size' => $request->filesData('upl_file', 'size'), 'upload_date' => time()));
					
					if (move_uploaded_file($request->filesData('upl_file', 'tmp_name'), UPLPATH.$filename))
					{
						$this->app()->db_handler()->getManager('Files', 'Site')->add($file);
						$this->app()->page()->addVar('upload_message', 'Upload réussi');
					}
					else
					{
						$this->app()->page()->addVar('upload_message', 'Transfère en échec');
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