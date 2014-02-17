<article>	
	<form method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<legend>Formulaire d'inscription :</legend>
				<fieldset>
					<legend>Informations Générales :</legend>
					
					<label for="username">Nom d'utilisateur</label>
					<input type="text" name="username" id="username" class="<?php echo isset($registration_error['username']) ? '.incorrect' : '.correct'; ?>" required autofocus />
					<?php echo isset($registration_error['username']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['username'].'</span>' : NULL; ?>
					<br />
								
					<label for="password">Mot de passe :</label>
					<input type="password" name="password" id="password" class="<?php echo isset($registration_error['password']) ? '.incorrect' : '.correct'; ?>" required />
					<?php echo isset($registration_error['password']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['password'].'</span>' : NULL; ?>
					<br />
					
					<label for="password_confirmation">Confirmez votre mot de passe :</label>
					<input type="password" name="password_confirmation" id="password_confirmation" class="<?php echo isset($registration_error['password_confirmation']) ? '.incorrect' : '.correct'; ?>" required />
					<?php echo isset($registration_error['password_confirmation']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['password_confirmation'].'</span>' : NULL; ?>
					<br /><br />
					
					<label for="email">Adresse  E-Mail :</label>
					<input type="email" name="email" id="email" class="<?php echo isset($registration_error['email']) ? '.incorrect' : '.correct'; ?>" required />
					<?php echo isset($registration_error['email']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['email'].'</span>' : NULL; ?>
					<br />
				</fieldset>
				
				<fieldset>
					<legend>Informations Complémentaires :</legend>
					
					<label for="last_name">Nom :</label>
					<input type="text" name="last_name" id="last_name" class="<?php echo isset($registration_error['last_name']) ? '.incorrect' : '.correct'; ?>" />
					<?php echo isset($registration_error['last_name']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['last_name'].'</span>' : NULL; ?>
					<br />
								
					<label for="first_name">Prénom :</label>
					<input type="text" name="first_name" id="first_name" class="<?php echo isset($registration_error['first_name']) ? '.incorrect' : '.correct'; ?>" />
					<?php echo isset($registration_error['first_name']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['first_name'].'</span>' : NULL; ?>
					<br />
					
					<label for="birth_date">Date de naissance :</label>
					<input type="date" name="birth_date" id="birth_date" class="<?php echo isset($registration_error['password_confirmation']) ? '.incorrect' : '.correct'; ?>" />
					<?php echo isset($registration_error['birth_date']) ? '<span class="tooltip"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/alert.png" class="icon" />'.$registration_error['birth_date'].'</span>' : NULL; ?>
					<br />
				</fieldset>
		</fieldset>
			   
		<center><input type="submit" value="Inscription" /></center>
	</form>
</article>