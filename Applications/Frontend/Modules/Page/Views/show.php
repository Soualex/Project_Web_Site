<div id="newscontainer">
	<div class="news_row">
		<div class="news_head"><p><?php echo html_escape($page->offsetGet('title')); ?></p></div>
        
		<div class="news_cont"><?php echo nl2br(html_escape($page->offsetGet('content'))); ?></div>
        
		<div class="news_foot"></div>
	</div>
    
	<div class="news_pagination">
		<ul></ul>
    </div>
</div>

<div class="pagestablecontainer"><div class="pagestablebox" id="newspagestable"></div></div>