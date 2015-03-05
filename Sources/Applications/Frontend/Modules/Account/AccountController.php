<?php

namespace Applications\Frontend\Modules\Account;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AccountController extends \System\Library\BackController
{
	public function executeLogin(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'Connexion');
		
		if (!$GLOBALS['$_SESSION']->isAuthenticated() || $GLOBALS['$_SESSION']->getAttribute('login_attempts') > 3)
		{		
			if ($request->postExists('username') && $request->postExists('password'))
			{
				$account = $GLOBALS['$_MODELS_HANDLER']->load_model_manager('Account')->getUsername($request->postData('username'));
				
				if (!empty($account))
				{
					if ($account->offsetGet('password') == hash_password($request->postData('password')))
					{
						$GLOBALS['$_SESSION']->setAttribute('id', $account->offsetGet('id'));
						$GLOBALS['$_SESSION']->setAttribute('username', $account->offsetGet('username'));
						$GLOBALS['$_SESSION']->setAttribute('email', $account->offsetGet('email'));
						$GLOBALS['$_SESSION']->setAttribute('rank', $account->offsetGet('rank'));
						$GLOBALS['$_SESSION']->setAuthenticated(TRUE);
						$GLOBALS['$_MODELS_HANDLER']->load_model_manager('Account')->updateLogin($account->offsetGet('id'));
					}
					else
					{
						$this->app()->page()->addVar('login_error_password', 'Mot de passe incorrecte.');
						$GLOBALS['$_SESSION']->setAttribute('login_attempts', $GLOBALS['$_SESSION']->getAttribute('login_attempts')+1);
					}
				}
				else
				{
					$this->app()->page()->addVar('login_error_username', 'Nom d\'utilisateur incorrecte.');
					$GLOBALS['$_SESSION']->setAttribute('login_attempts', $GLOBALS['$_SESSION']->getAttribute('login_attempts')+1);
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
		
		if (!$GLOBALS['$_SESSION']->isAuthenticated())
		{		
			if ($request->postExists('username') && $request->postExists('password') && $request->postExists('password_confirmation') && $request->postExists('email'))
			{
				$account = $GLOBALS['$_MODELS_HANDLER']->load_model_entity('Account', 'Account', array('username' => $request->postData('username'), 
																									 'password' => hash_password($request->postData('password')),
																									 'email' => $request->postData('email'),
																									 'first_name' => $request->postData('first_name'),
																									 'last_name' => $request->postData('last_name'),
																									 'birth_date' => $request->postData('birth_date')));
					
				if ($request->postData('password') != $request->postData('password_confirmation'))
				{
					$registration_error['password'] = 'Les mots de passe sont différents';
				}
				
				if (!empty($GLOBALS['$_MODELS_HANDLER']->load_model_manager('Account')->getUsername($request->postData('username'))))
				{
					$registration_error['username'] = 'Le nom d\'utilisateur est déjà utilisé';
				}
					
				if (!empty($GLOBALS['$_MODELS_HANDLER']->load_model_manager('Account')->getEmail($request->postData('email'))))
				{
					$registration_error['email'] = 'L\'adresse email est déjà utilisée';
				}
				
				if ($account->hasErrors())
				{
					$registration_error['email'] = $account->errors();
				}
				
				if (empty($registration_error))
				{
					$GLOBALS['$_MODELS_HANDLER']->load_model_manager('Account')->add($account);
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
		if ($GLOBALS['$_SESSION']->isAuthenticated())
		{
			$GLOBALS['$_SESSION']->setAttribute('id', 0);
			$GLOBALS['$_SESSION']->setAttribute('username', NULL);
			$GLOBALS['$_SESSION']->setAttribute('email', NULL);
			$GLOBALS['$_SESSION']->setAttribute('rank', NULL);
			$GLOBALS['$_SESSION']->setAuthenticated(FALSE);
		}
		else
		{
			show_error(ERROR_LEVEL_ERROR, 'Accès Refusé', 'Vous êtes déjà déconnecté.');
		}
	}
}

?>