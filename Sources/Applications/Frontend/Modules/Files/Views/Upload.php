</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Fichiers -> Upload</p>

<article>
	<p><?php if(!empty($upload_message)) echo $upload_message; ?></p>
	
	<form method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<legend>Formulaire d'upload :</legend>

			<label for="title">Titre :</label>
			<input type="text" name="title" id="title" required />
			<br />
			
			<label for="file">Fichier :</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
			<input type="file" name="upl_file" id="upl_file" required />
			<br />
				
			<label for="upl_security">Sécruité du fichier :</label>
			<select name="upl_security" required>
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
				
			<label for="description">Description :</label>
			<textarea name="description" id="description" rows="5" cols="50" required></textarea>
		</fieldset>
		 
		<center><input type="submit" name="submit" value="Envoyer" /></center>
	</form>
</article>