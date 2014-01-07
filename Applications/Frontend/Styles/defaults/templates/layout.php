<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title><?php echo isset($title) ? $config->getItem(CFG_GENERAL, 'site_name').' :: '.$title : $config->getItem(CFG_GENERAL, 'site_name'); ?></title>
		 
		<meta charset="<?php echo $config->getItem(CFG_GENERAL, 'charset'); ?>" http-equiv="Content-Type" content="text/html" />

		<script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/javascripts/Core.js"></script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/javascripts/Ajax.core.js"></script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/javascripts/Mask.core.js"></script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/javascripts/Tooltip.core.js"></script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/javascripts/PageSort.core.js"></script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/templates/basic/nivo.js"></script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/templates/basic/misc.js"></script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/templates/basic/tab_js.js"></script>
        <script type="text/javascript">
            document.write(<style type="text/css">.tabber{display:none;}</style>)
        </script>
        <script type="text/javascript" src="/site-v2/Applications/Frontend/Styles/defaults/javascripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
            tinyMCE.init({
                    mode : "textareas"
            });
        </script>

		<link rel="icon" href="favicon.ico" />
		<link rel="stylesheet" href="/site-v2/Applications/Frontend/Styles/defaults/css/main.css" type="text/css" />
		<link rel="stylesheet" href="/site-v2/Applications/Frontend/Styles/defaults/css/share.css" type="text/css" />
		<link rel="stylesheet" href="/site-v2/Applications/Frontend/Styles/defaults/css/tab_css.css" type="text/css" />
		
	</head>
    
	<body><center>
	
	 <!-- DEBUT HEADER -->
	 
    <div class="header" align="center">
		<div id="top_bar">
			<div id="top_bar_cont_holder">
				<div id="logo" align="center"><a href="<?php echo $config->getItem(CFG_GENERAL, 'url_suffix'); ?>"></a></div>
				
				<div id="top_nav">
					<ul>
						<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'url_suffix'); ?>"><span></span>Accueil</a></li>
						<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'url_suffix').'page/joinus'; ?>"><span></span>Nous rejoindre</a></li>
						<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'url_suffix').'page/ladder'; ?>"><span></span>Classement</a></li>
						<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'url_suffix').'page/staff'; ?>"><span></span>L'équipe</a></li>
						<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'url_suffix').'page/story'; ?>"><span></span>Histoire</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="login_container" align="left">
			<div id="log_in"><a></a></div>
			
			<div id="login_form" align="left">
				<div id="cont">
					<form method="post" action="">
						<label>
							<p>Nom de compte</p>
							<input type="text" name="login" maxlength="10">
						</label>
						
						<label>
							<p>Mot de passe</p>
							<input type="password" name="passlog" maxlength="10">
						</label>
						
						<div style="height:10px"></div>
						
						<center><input type="submit" name="logon" value="Connexion"></center>
					</form>
					
					<ul id="login_form_links">
						<li><a href="<?php echo $config->getItem(CFG_GENERAL, 'url_suffix').'account/register'; ?>">Pas encore inscrit ?</a></li>
					</ul>
				</div>
			</div>
		</div>
    </div>
	
    <br /><br /><br /><br />
	
	<!-- FIN HEADER -->

	<!-- DEBUT SLIDESHOW -->

	<div class="body">
		<div class="top_line"></div>
		
		<table cellpadding="0" cellspacing="0"><tr>
			<td valign="top" class="main_side">
				<div id="main_side">

				<script type="text/javascript">
					$(window).load(function(){
						$('#slider').nivoSlider({
						effect:'random', //Specify sets like: 'fold,fade,sliceDown'
						slices:15,
						animSpeed:900, //Slide transition speed
						pauseTime:9000,
						directionNav:false, //Next & Prev
						directionNavHide:false, //Only show on hover
						controlNav:false, //1,2,3...
						controlNavThumbs:false, //Use thumbnails for Control Nav
						pauseOnHover:true, //Stop animation while hovering
						captionOpacity:0.8 //Universal caption opacity
						});
					});
				</script>


					<div class="news" align="left">
						<div class="slider_container" id="slider">
							<img src="/site-v2/Applications/Frontend/Styles/defaults/images/slideshow/20.jpg" width="718" height="266" title="#caption1" alt="" />
							<img src="/site-v2/Applications/Frontend/Styles/defaults/images/slideshow/21.jpg" width="718" height="266" title="#caption2" style="display:none;" />
							<a href="points.html"><img src="/site-v2/Applications/Frontend/Styles/defaults/images/slideshow/22.jpg" width="718" height="266" title="#caption3" style="display:none;" /></a>
							<a href="vote.html"><img src="/site-v2/Applications/Frontend/Styles/defaults/images/slideshow/23.jpg" width="718" height="266" title="#caption4" style="display:none;" /></a>
						</div>
						
						<div id="caption1" style="display:none;" class="nivo-html-caption"><center>Bienvenue sur le serveur !</center></div>
						<div id="caption2" style="display:none;" class="nivo-html-caption"><center>Rejoignez dès à présent le serveur !</center></div>
						<div id="caption3" style="display:none;" class="nivo-html-caption"><center>Pleins de PNJ que vous n\'avez jamais vu !</center></div>
						<div id="caption4" style="display:none;" class="nivo-html-caption"><center>Un chacha so seks</center></div>
						
	<!-- FIN SLIDESHOW -->

	<!-- DEBUT MILLIEU -->

						<?php echo $main_module; ?>
						
					</div>
				</div>
			</td>
			
	<!-- DEBUT MENU DROITE -->
	
			<td valign="top" class="right_side">
				<div id="right_side">
					<?php echo $Server_Statue; ?>
					
					<div class="subbox">
						<div id="sb_head"><p>Top 3 des joueurs</p></div>
						
						<div class="tabber">

							<div class="tabbertab">
								<h2>Expérience</h2>
								<p><center>
									<table class="table">
										<tr>
											<th>Pseudo</th>
											<th>Level</th>
											<th>Expérience</th>
											<th>Classe</th>
										</tr>
										<tr class="online_player_bit">
											<td>
												?	
											</td>
							
											<td>
												?	
											</td>
								
											<td>
												?	
											</td>
							
											<td>
												<img src="/site-v2/Applications/Frontend/Styles/defaults/images/icons/class/?-?"/>
											</td>
										</tr>
										
									</table>
								</center></p>
							</div>

							<div class="tabbertab">
								<h2>Kamas</h2>
								
								<p><center>
									<table class="table">
										<tr>
											<th>Pseudo</th>
											<th>Kamas</th>
											<th>Classe</th>
										</tr>
										
										<tr class="online_player_bit">

											<td>
												?	</td>
									
											<td>
												?	</td>
											<td>
												<img src="/site-v2/Applications/Frontend/Styles/defaults/images/icons/class/?-?"/>
											</td>
										</tr>	
									</table>
								</center></p>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr></table>
	</div>

	<br /><br /><br />
	
	<!-- FIN MENU DROITE -->

	<!-- DEBUT  FOOTER  -->

	<div class="footer">
		<a id="evil_logo" href=""></a>
		
		<div id="l_side" align="right">
			Sky-Dream n\'est en aucun cas lié à Ankama Games<br />
			Design par <b>Evil!</b> & codé par <b>Megadux & Kryptonix</b>
		</div>
		
		<div id="r_side" align="left">
			Copyright Sky-Dream 2012 - 2013<br />
			<i>Merci de respecter le travail du développeur</i>
		</div>
	</div>
	
	</center></body>
</html>
<? /* -- FIN FOOTER */ ?>