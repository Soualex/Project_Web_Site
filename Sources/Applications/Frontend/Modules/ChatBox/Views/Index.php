</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> ChatBox</p>

<article>
	<div id="chat-container">
		<table class="status"><tr>
			<td>
				<span id="statusResponse"></span>
				<select name="status" id="status" style="width:200px;" onchange="setStatus(this)">
					<option value="0">Absent</option>
					<option value="1">Occupé</option>
					<option value="2" selected>En ligne</option>
				</select>
			</td>
		</tr></table>
			
		<table class="chat"><tr>		
			<td valign="top" id="text-td">
						<div id="annonce"></div>
				<div id="text">
					<div id="loading">
						<center>
						<span class="info" id="info">Chargement du chat en cours...</span><br />
						<img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/ajax-loader.gif" alt="patientez...">
						</center>
					</div>
				</div>
			</td>

			<td valign="top" id="users-td"><div id="users">Chargement</div></td>
		</tr></table>
		
		<a name="post"></a>
				
		<table class="post_message"><tr>
			<td>
			<form action="" method="" onsubmit="envoyer(); return false;">
				<input type="text" id="message" maxlength="255" />
				<input type="button" onclick="envoyer()" value="Envoyer" id="post" />
			</form>
					<div id="responsePost" style="display:none"></div>
			</td>
		</tr></table>
	</div>
</article>