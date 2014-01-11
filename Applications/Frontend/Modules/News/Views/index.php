<?php
foreach ($listNews as $news)
{
?>

<div id="newscontainer">
	<div class="news_row">
		<div class="news_head"><p><?php echo html_escape($news->offsetGet('title')); ?></p></div>
        
		<div class="news_cont"><?php echo nl2br(html_escape($news->offsetGet('content'))); ?></div>
        
		<div class="news_foot"><p>Le <?php echo $news->offsetGet('add_date')->format('d/m/Y à H\Hi'); ?>, par <?php // echo $news->offsetGet('author')->offsetGet('username'); ?></p></div>
	</div>
    
	<div class="news_pagination">
		<ul></ul>
    </div>
</div>

<div class="pagestablecontainer"><div class="pagestablebox" id="newspagestable"></div></div>

<?php
}
?>