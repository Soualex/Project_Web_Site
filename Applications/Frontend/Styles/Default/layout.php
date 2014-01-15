<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<html>
        <head>
			<title><?php echo isset($page_name) ? $config->getItem(CFG_GENERAL, 'site_name').' :: '.$page_name : $config->getItem(CFG_GENERAL, 'site_name'); ?></title>
			<meta charset="<?php echo $config->getItem(CFG_GENERAL, 'charset'); ?>" http-equiv="Content-Type" content="text/html" />
        </head>
         
        <body>
			<?php echo $main_module; ?>
        </body>
</html>