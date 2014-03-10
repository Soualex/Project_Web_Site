<?php

namespace Applications\Frontend\Modules\Account;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AccountController extends \System\Library\BackController
{
	public function executeLogin(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Connexion');
		
		if (!$this->app()->session()->isAuthenticated() || $this->app()->session()->getAttribute('login_attempts') > 3)
		{		
			if ($request->postExists('username') && $request->postExists('password'))
			{
				$account = $this->app()->entities_handler()->load_model_manager('Account')->getUsername($request->postData('username'));
				
				if (!empty($account))
				{
					if ($account->offsetGet('password') == hash_password($request->postData('password')))
					{
						$this->app()->session()->setAttribute('id', $account->offsetGet('id'));
						$this->app()->session()->setAttribute('username', $account->offsetGet('username'));
						$this->app()->session()->setAttribute('email', $account->offsetGet('email'));
						$this->app()->session()->setAttribute('rank', $account->offsetGet('rank'));
						$this->app()->session()->setAuthenticated(TRUE);
						$this->app()->entities_handler()->load_model_manager('Account')->updateLogin($account->offsetGet('id'));
					}
					else
					{
						$this->app()->page()->addVar('login_error_password', 'Mot de passe incorrecte.');
						$this->app()->session()->setAttribute('login_attempts', $this->app()->session()->getAttribute('login_attempts')+1);
					}
				}
				else
				{
					$this->app()->page()->addVar('login_error_username', 'Nom d\'utilisateur incorrecte.');
					$this->app()->session()->setAttribute('login_attempts', $this->app()->session()->getAttribute('login_attempts')+1);
				}
			}
		}
		else
		{
			show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous êtes déjà connecté; Veulliez vous déconnecter d\'abord pour vous connectez à un autre compte.');
		}
	}
	
	public function executeRegister(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Inscription');
		
		if (!$this->app()->session()->isAuthenticated())
		{		
			if ($request->postExists('username') && $request->postExists('password') && $request->postExists('password_confirmation') && $request->postExists('email'))
			{
				$account = $this->app()->entities_handler()->load_model('Account', 'Account', array('username' => $request->postData('username'), 
																									 'password' => hash_password($request->postData('password')),
																									 'email' => $request->postData('email'),
																									 'first_name' => $request->postData('first_name'),
																									 'last_name' => $request->postData('last_name'),
																									 'birth_date' => $request->postData('birth_date')));
					
				if ($request->postData('password') != $request->postData('password_confirmation'))
				{
					$registration_error['password'] = 'Les mots de passe sont différents';
				}
				
				if (!empty($this->app()->entities_handler()->load_model_manager('Account')->getUsername($request->postData('username'))))
				{
					$registration_error['username'] = 'Le nom d\'utilisateur est déjà utilisé';
				}
					
				if (!empty($this->app()->entities_handler()->load_model_manager('Account')->getEmail($request->postData('email'))))
				{
					$registration_error['email'] = 'L\'adresse email est déjà utilisée';
				}
				
				if ($account->hasErrors())
				{
					$registration_error['email'] = $account->errors();
				}
				
				if (empty($registration_error))
				{
					$this->app()->entities_handler()->load_model_manager('Account')->add($account);
					$this->executeLogin($request);
				}
				else
				{
					$this->app()->page()->addVar('registration_error', $registration_error);
				}
			}
		}
		else
		{
			show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous êtes déjà connecté; Veulliez vous déconnecter d\'abord pour vous connectez à un autre compte.');
		}
	}
	
	public function executeLogout(\System\Core\HTTPRequest $request)
	{
		if ($this->app()->session()->isAuthenticated())
		{
			$this->app()->session()->setAttribute('id', 0);
			$this->app()->session()->setAttribute('username', NULL);
			$this->app()->session()->setAttribute('email', NULL);
			$this->app()->session()->setAttribute('rank', NULL);
			$this->app()->session()->setAuthenticated(FALSE);
		}
		else
		{
			show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous êtes déjà déconnecté.');
		}
	}
}

?>