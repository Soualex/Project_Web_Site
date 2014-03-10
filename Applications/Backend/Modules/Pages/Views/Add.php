<article>	
	<form method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<legend>Formulaire d'inscription :</legend>
					
			<label for="page_name">Nom de la page :</label>
			<input type="text" name="page_name" id="page_name" class="<?php echo isset($registration_error['page_name']) ? '.incorrect' : '.correct'; ?>" required autofocus />
			<?php echo isset($registration_error['page_name']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['username'].'</span>' : NULL; ?>
			<br />
								
			<label for="page_url">URL d'accès :</label>
			<input type="text" name="page_url" id="page_url" class="<?php echo isset($registration_error['page_url']) ? '.incorrect' : '.correct'; ?>" required />
			<?php echo isset($registration_error['page_url']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['password'].'</span>' : NULL; ?>
			<br />
					
			<label for="page_content">Contenu :</label>
			<textarea name="page_content" id="page_content" rows="10" cols="50" required></textarea>
			<?php echo isset($registration_error['page_content']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['password_confirmation'].'</span>' : NULL; ?>
			<br />
					
			<label for="page_security">Securité :</label>
			<select name="page_security" id="page_security">
					<option value="0">Visiteur</option>
					<option value="1">Membre</option>
					<option value="2">Modérateur</option>
					<option value="3">Administrateur</option>
			</select>
			<?php echo isset($registration_error['page_security']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['email'].'</span>' : NULL; ?>
			<br />
		</fieldset>
			   
		<center><input type="submit" value="Ajouter" /></center>
	</form>
</article>