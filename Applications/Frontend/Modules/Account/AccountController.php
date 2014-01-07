<?php

namespace Applications\Frontend\Modules\Account;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AccountController extends \System\Library\BackController
{
	public function executeLogin(\System\Core\HTTPRequest $request)
	{
	
	}
	
	public function executeRegister(\System\Core\HTTPRequest $request)
	{
		$this->page()->addVar('title', 'Inscription');
		
		if (!$this->app()->session()->isAuthenticated())
		{		
			if ($request->postExists('username') && $request->postExists('password') && $request->postExists('password_repeat') && $request->postExists('email'))
			{	
				$account = new \System\Library\Entities\Account(array('username' => $request->postData('username'), 
															   		  'sha_pass_hash' => hash("sha512", $request->postData('password')),
															   		  'email' => $request->postData('email')));
					
				if (!empty($this->db_handler()->getManagerOf('Account', 'site')->getUsername($request->postData('username'))))
				{
					$account->setError('username', 'Le nom d\'utilisateur est déjà utilisé');
				}
					
				if (!empty($this->db_handler()->getManagerOf('Account', 'site')->getEmail($request->postData('email'))))
				{
					$account->setError('email', 'L\'adresse email est déjà utilisée');
				}									   
													   
				if (!$account->hasError())
				{
					$this->db_handler()->getManagerOf('Account', 'site')->add($account);
					// $this->executeLogin($request);
				}
				else
				{
					$this->page()->addVar('errors', $account->error());
				}
			}
		}
		else
		{
			show_error(403, 'Already Connected', 'You are already connected.');
		}
	}
}

?>