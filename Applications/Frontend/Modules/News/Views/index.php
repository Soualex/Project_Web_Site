</p class="location"><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/location.png" alt="" />Vous êtes ici : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> :: Actualités</p>

<?php
foreach ($listNews as $news)
{
?>

	<article>
		<h2><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/news.png" alt="" /><?php echo html_escape($news->offsetGet('title')); ?></h2>
		<em>Le <?php echo $news->offsetGet('add_date')->format('d/m/Y à H:i'); ?> par <?php echo $news->offsetGet('author')->offsetGet('username'); ?>.</em>
		<p><?php echo string_format($news->offsetGet('content')); ?></p>
	</article>
	
	<br />
<?php
}
?>

<br />

<p align="center">Page :

<?php

for($i = 1; $i <= $nombreDePages; $i++)
{
     if($i == $pageActuelle)
     {
         echo $i; 
     }	
     else
     {
          echo ' <a href="'.$i.'">'.$i.'</a> ';
     }
}

?>

</p>