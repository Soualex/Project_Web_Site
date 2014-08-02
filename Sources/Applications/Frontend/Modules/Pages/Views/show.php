</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'page'; ?>" >Pages Personnalisées</a> -> <?php echo string_format($custom_page->offsetGet('name')); ?></p>

<article>
	<?php echo '<h2><img src="/Project_Web_Site/Applications/Frontend/Styles/Default/Images/page.png" />'.string_format($custom_page->offsetGet('name')).'</h2>'; ?>
	
	<?php echo '<p>'.string_format($custom_page->offsetGet('content')).'</p>'; ?>
</article>