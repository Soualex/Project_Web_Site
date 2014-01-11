<div id="newscontainer">
	<div class="news_row">
		<div class="news_head"><p>Inscription</p></div>
        
		<div class="news_cont">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="username">Nom d'utilisateur :</label> 
                <input name="username" type="text" autofocus required />
                <?php if (isset($errors['username'])) echo '<img src="/site-v2/Applications/Frontend/Styles/defaults/images/others/alert.png" class="icon" title="'.$errors['username'].'" />'; ?>
                <br /><br />
                
                <label for="password">Mot de passe :</label> 
                <input name="password" type="password" required />
                <?php if (isset($errors['password'])) echo '<img src="/site-v2/Applications/Frontend/Styles/defaults/images/others/alert.png" class="icon" title="'.$errors['password'].'" />'; ?>
                <br /><br />
                
                <label for="password_repeat">Vérification du mot de passe :</label> 
                <input name="password_repeat" type="password" required />
                <?php if (isset($errors['password_repeat'])) echo '<img src="/site-v2/Applications/Frontend/Styles/defaults/images/others/alert.png" class="icon" title="'.$errors['password_repeat'].'" />'; ?>
                <br /><br />
                
                <label for="email">Adresse e-mail :</label> 
                <input name="email" type="email" required />
                <?php if (isset($errors['email'])) echo '<img src="/site-v2/Applications/Frontend/Styles/defaults/images/others/alert.png" class="icon" title="'.$errors['email'].'" />'; ?>
                <br /><br />
                
                <input name="register" type="submit" value="Inscription" />
            </form>
		</div>
        
		<div class="news_foot"></div>
	</div>
    
	<div class="news_pagination">
		<ul></ul>
    </div>
</div>

<div class="pagestablecontainer"><div class="pagestablebox" id="newspagestable"></div></div>