</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Pages Personnalisées</p>

<article>
<?php

foreach ($custom_pages as $page)
{
	echo '<p><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/page_icon.png" /><a href="'.$config->getItem(CFG_GENERAL, 'base_url').'page/'.$page->offsetGet('url').'">'.string_format($page->offsetGet('name')).'</a></p>';
}

?>
</article>