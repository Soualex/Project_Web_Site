</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Fichiers -> Upload</p>

<article>
	<p style="text-align: center;"><?php if(!empty($upload_message)) echo $upload_message; ?></p>
	
	<form method="post" action="" enctype="multipart/form-data">
		<label for="upl_title">Titre du fichier (max. 50 caractères) :</label><br />
		<input type="text" name="upl_title" id="upl_title" /><br />
		 
		<label for="upl_description">Description de votre fichier (max. 255 caractères) :</label><br />
		<textarea name="upl_description" id="upl_description"></textarea><br />
		 
		<label for="upl_file">Fichier (tous formats | max. 1 Mo) :</label><br />
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
		<input type="file" name="upl_file" id="upl_file" /><br />
		
		<label for="upl_security">Sécurité du fichier :</label><br />
		<select name="upl_security">
			<?php 
			if ($session->getAttribute('rank') >= 1) 
			{ ?>
			<option value="0">Visiteurs</option>
			<option value="1">Membres</option>
			<?php 
			} 
			?>
			<?php if ($session->getAttribute('rank') >= 2) { echo '<option value="2">Modérateurs</option>'; } ?>
			<?php if ($session->getAttribute('rank') >= 3) { echo '<option value="3">Administrateurs</option>'; } ?>
		</select>
		<br />
		 
		<input type="submit" name="submit" value="Envoyer" />
	</form>
</article>