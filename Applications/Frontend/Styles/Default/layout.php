<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<html>
        <head>
			<title><?php echo isset($page_name) ? $config->getItem(CFG_GENERAL, 'site_name').' :: '.$page_name : $config->getItem(CFG_GENERAL, 'site_name'); ?></title>
			<meta charset="<?php echo $config->getItem(CFG_GENERAL, 'charset'); ?>" http-equiv="Content-Type" content="text/html" />
			
			<link rel="stylesheet" href="/Project_Web_Site/Applications/Frontend/Styles/Default/CSS/global.css" />
        </head>
         
        <body>
			<nav>
				<ul style="float: left;">
					<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>">Accueil</a></li>
					<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'conatct'; ?>">Contact</a></li>
				</ul>
				
				<ul style="float: right; border-left: 1px black solid;">
					<?php
					switch ($session->getAttribute('rank'))
					{
						case USER_VISITOR:
							echo '<li><a href="'.$config->getItem(CFG_GENERAL, 'base_url').'account/login">Connexion</a></li>';
							echo '<li><a href="'.$config->getItem(CFG_GENERAL, 'base_url').'account/register">Inscription</a></li>';
							break;
						
						case USER_MEMBER:
							echo '<li>Bonjour , '.$session->getAttribute('username').'</li>';
							echo '<li><a href="'.$config->getItem(CFG_GENERAL, 'base_url').'account/logout">Déconnexion</a></li>';
							break;
						
						case USER_MODERATOR:
							echo '<li>Bonjour , '.$session->getAttribute('username').'</li>';
							echo '<li><a href="'.$config->getItem(CFG_GENERAL, 'base_url').'account/logout">Déconnexion</a></li>';
							break;
						
						case USER_ADMINISTRATOR:
							echo '<li>Bonjour , '.$session->getAttribute('username').'</li>';
							echo '<li><a href="'.$config->getItem(CFG_GENERAL, 'base_url').'admin">Administration</a></li>';
							echo '<li><a href="'.$config->getItem(CFG_GENERAL, 'base_url').'account/logout">Déconnexion</a></li>';
							break;
					}
					?>
				</ul>
			</nav>
			
			<section>
				<?php echo $main_module; ?>
			</section>
			
			<footer>
				Copyright 2014 © Alexis Godin. Tous droits réservés.
			</footer>
        </body>
</html>