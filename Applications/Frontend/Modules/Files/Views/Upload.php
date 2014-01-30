</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Fichiers -> Upload</p>

<article>
	<p><?php if(!empty($upload_message)) echo $upload_message; ?></p>
	
	<form method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<legend>Formulaire d'upload :</legend>

			<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
			<input type="file" name="upl_file" id="upl_file" />
			
			<select name="upl_security">
				<option value="">Sécurité du fichier</option>
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
		</fieldset>
		 
		<center><input type="submit" name="submit" value="Envoyer" /></center>
	</form>
</article>