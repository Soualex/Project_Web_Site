</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Actualités</p>

<?php
foreach ($listNews as $news)
{
?>

	<article>
		<h2><?php echo $news->offsetGet('title'); ?></h2>
		<em>Le <?php echo $news->offsetGet('add_date'); ?> par <?php echo $news->offsetGet('author')->offsetGet('username'); ?>.</em>
		<p><?php echo nl2br($news->offsetGet('content')); ?></p>
	</article>

<?php
}
?>