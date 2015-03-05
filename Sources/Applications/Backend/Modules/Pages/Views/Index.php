<article>
	<table>
		<thead>
			<tr>
				<th>Nom</th>
				<th>Actions</th>
			<tr>
		</thead>
		
		<tbody>
			<?php
			foreach ($custom_pages as $page)
			{
				echo '
				<tr>
					<td>'.$page->offsetGet('name').'</td>
					<td>
						<a href="'.$config->getItem(CFG_GENERAL, 'base_url').'admin/pages/delete/'.$page->offsetGet('url').'"><img src="/Project_Web_Site/Applications/Backend/Styles/Default/Images/delete.png" title="Supprimer" alt="Supprimer" /></a>
						<a href="'.$config->getItem(CFG_GENERAL, 'base_url').'admin/pages/edit/'.$page->offsetGet('url').'"><img src="/Project_Web_Site/Applications/Backend/Styles/Default/Images/edit.png" title="Modifier" alt="Modifier" /></a>
						<a href="'.$config->getItem(CFG_GENERAL, 'base_url').'page/'.$page->offsetGet('url').'"><img src="/Project_Web_Site/Applications/Backend/Styles/Default/Images/reach.png" title="Accéder" alt="Accéder" /></a>
					</td>
				</tr>';
			}
			?>
		</tbody>
		
		<tfoot>
			<tr>
				<th>Nom</th>
				<th>Actions</th>
			<tr>
		</tfoot>
	</table>
	
	<p><a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url').'admin/pages/add'; ?>">Ajouter une page</a></p>
</article>