<?php

namespace Applications\Frontend\Modules\Files;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class FilesController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Fichiers');
		
		$this->app()->page()->addVar('listFiles', $GLOBALS['$_MODELS_HANDLER']->load_model_manager('Files')->getList());
	}
	
	public function executeUpload(\System\Core\HTTPRequest $request)
	{
			$this->app()->page()->addVar('page_name', 'Upload');
			
			if ($request->filesExists('upl_file') && $request->postExists('upl_security') && $request->postExists('title') && $request->postExists('description'))
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
					$file = $GLOBALS['$_MODELS_HANDLER']->load_model_entity('Files', 'Files', array('uploader' => $GLOBALS['$_SESSION']->getAttribute('id'), 
																								 'filename' => $filename, 
																								 'file_size' => $request->filesData('upl_file', 'size'), 
																								 'upload_date' => time(),
																								 'title' => $request->postData('title'),
																								 'description' => $request->postData('description')));
					
					if (move_uploaded_file($request->filesData('upl_file', 'tmp_name'), UPLPATH.$filename))
					{
						$GLOBALS['$_MODELS_HANDLER']->load_model_manager('Files')->add($file);
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
		
		$file = $GLOBALS['$_MODELS_HANDLER']->load_model_manager('Files')->getId($request->getData('id'));
	}
}

?>