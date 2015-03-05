<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<html>
        <head>
        	<title>Error :: <?php echo htmlspecialchars($heading); ?></title>
          	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <style>
				#main {
				   font-family: 'Trebuchet Ms', Serif;
				   font-size: 13px;
				   position: absolute;
				   top: 50%;
				   margin-top: -150px;
				   height: 150px;
				   left: 50%;
				   margin-left: -300px;
				   width: 600px;
				}
				.message {
				   border: 1px solid #c1c1c1;
				   padding: 10px;
				   margin-bottom: 10px;
				   height: 150px;
				}
				h1 {
				   font-family: Arial, Serif;
				   font-size: 30px;
				   text-align: center;
				}
			</style>
        </head>
         
        <body>
            <div id="main">              
                 <div class="message">
                     <h1><?php echo $heading; ?></h1>
                     <p><?php echo $message; ?></p>
           		 </div>
         	</div>
        </body>
</html>