</p class="location">Navigation : <a href="<?php echo $config->getItem(CFG_GENERAL, 'base_url'); ?>" >Accueil</a> -> Fichiers</p>

<article>	
	<table>
	   <caption>Liste des téléchargements disponibles :</caption>

	   <thead>
		   <tr>
			   <th>Nom du fichier</th>
			   <th>Description</th>
			   <th>Date d'upload</th>
			   <th>Par</th>
			   <th>Télécharger</th>
		   </tr>
	   </thead>

	   <tfoot>
		   <tr>
			   <th>Nom du fichier</th>
			   <th>Description</th>
			   <th>Date d'upload</th>
			   <th>Par</th>
			   <th>Télécharger</th>
		   </tr>
	   </tfoot>

	   <tbody>
	   <?php 
	   foreach ($listFiles as $files)
	   {
		   echo '<tr>
				<td>'.$files->offsetGet('title').'</td>
				<td>'.$files->offsetGet('upload_date')->format('d/m/Y à H:i').'</td> 
				<td>'.$files->offsetGet('uploader')->offsetGet('username').'</td>
				<td>'.nl2br($files->offsetGet('description')).'</td>
				<td><a href="" >Télécharger</a></td>
		   </tr>';
		}
		?>
	   </tbody>
	</table>
</article>