</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Espace Personnel</p>

<article>
	<p>Nom d'utilisateur : <?php echo $user_account->offsetGet('username'); ?></p>
	<p>E-mail : <?php echo $user_account->offsetGet('email'); ?></p>
	<p>Rang : <?php echo $user_account->offsetGet('rank'); ?></p>
	<p>Date d'inscription : <?php echo $user_account->offsetGet('joindate')->format('d/m/Y à H:i'); ?></p>
	<p>IP d'enregistrement : <?php echo $user_account->offsetGet('joinip'); ?></p>
	<p>Dernière Connexion : <?php echo $user_account->offsetGet('last_login')->format('d/m/Y à H:i'); ?></p>
	<p>Dernière IP utilisé : <?php echo $user_account->offsetGet('last_ip'); ?></p>
</article>