</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Pages Personnalisées</p>

<article>
<?php

foreach ($custom_pages as $pages)
{
	echo '<p>'.html_escape($custom_page->offsetGet('title')).'</p>';
}

?>
</article>