</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'page'; ?>" >Pages Personnalisées</a> -> <?php echo html_escape($custom_page->offsetGet('title')); ?></p>

<article>
	<?php echo '<p>'.string_format($custom_page->offsetGet('content')).'</p>'; ?>
</article>