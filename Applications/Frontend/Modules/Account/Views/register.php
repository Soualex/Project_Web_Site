<article>
	<?php 
	if (isset($registration_errors))
	{
		echo '<div class="error-block">';
		foreach ($registration_errors as $registration_error)
		{
			echo '<p>'.$registration_error.'</p>';
		}
		echo '</div>';
	}
	?>
	
	<form method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<legend>Formulaire d'inscription :</legend>
				<fieldset>
					<legend>Informations Générales :</legend>
					
					<label for="username">Nom d'utilisateur</label>
					<input type="text" name="username" id="username" required autofocus />
					<br />
								
					<label for="password">Mot de passe :</label>
					<input type="password" name="password" id="password" required />
					<br />
					
					<label for="password_confirmation">Confirmez votre mot de passe :</label>
					<input type="password" name="password_confirmation" id="password_confirmation" required />
					<br /><br />
					
					<label for="email">Adresse  E-Mail :</label>
					<input type="email" name="email" id="email" required />
					<br />
				</fieldset>
				
				<fieldset>
					<legend>Informations Complémentaires :</legend>
					
					<label for="lastname">Nom :</label>
					<input type="text" name="lastname" id="lastname"  />
					<br />
								
					<label for="firstname">Prénom :</label>
					<input type="text" name="firstname" id="firstname" />
					<br />
					
					<label for="born_date">Date de naissance :</label>
					<input type="text" name="born_date" id="born_date" />
					<br />
				</fieldset>
		</fieldset>
			   
		<center><input type="submit" value="Inscription" /></center>
	</form>
</article>