<?php echo html_escape($custom_page->offsetGet('title')); ?>
        
<?php echo nl2br(html_escape($custom_page->offsetGet('content'))); ?>

</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'page'; ?>" >Pages Personnalisées</a> -> <?php echo html_escape($custom_page->offsetGet('title')); ?></p>

<article>
	<?php echo '<p>'.nl2br(html_escape($custom_page->offsetGet('content'))).'</p>'; ?>
</article>