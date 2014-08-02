<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<html>
        <head>
			<title><?php echo isset($page_name) ? $config->getItem(CFG_GENERAL, 'site_name').' :: '.$page_name : $config->getItem(CFG_GENERAL, 'site_name'); ?></title>
			
			<!-- Balises META -->
			<meta charset="<?php echo $config->getItem(CFG_GENERAL, 'charset'); ?>" http-equiv="Content-Type" content="text/html" />
			
			<!-- Feuilles de style -->
			<link rel="stylesheet" href="/Project_Web_Site/Applications/Frontend/Styles/Default/CSS/global.css" />
			<?php echo implode('', $css_files); ?>
			
			<!-- Scripts -->
			<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
			<?php echo implode('', $js_files); ?>
        </head>
         
        <body>
			<nav>
				<ul style="float: left;">
					<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>">Accueil</a></li>
					<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'pages'; ?>">Pages</a></li>
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
				<!-- Module principal -->
				<?php echo array_key_exists('main_view', $views) ? require($views['main_view']) : show_error(ERROR_LEVEL_FATAL, 'Vue requise', 'La vue "main_view" est requise dans ce template'); ?>
			</section>
			
			<footer>
				<p><a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'page/conditions'; ?>">Conditions Générales d'Utilisation</a> | <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'page/sitemap'; ?>">Plan du site</a></p>
			</footer>
        </body>
</html>