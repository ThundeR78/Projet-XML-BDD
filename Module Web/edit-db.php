<?php
session_start();
	if(!isset($_SESSION['id']))	{
		header("Location : ./index.php");
	}

	$file_xml = 'example3';
	$path_xml = 'xml/'.$file_xml.'.xml';

	if (file_exists($path_xml)) {
		$xml = simplexml_load_file($path_xml);
		// var_dump($xml);

		$listDB = "<ul>";
		foreach($xml->database as $db)	{
			$listDB .= '<li>'. $db->name .'</li>';
		}
		$listDB .= "</ul>";

	}
	else
		$error = "Erreur ouverture fichier ".$file_xml;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Projet XML</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>  
	
	<body>
		<div id="global">
			<h1 id="title">Projet XML - Partie WEB</h1>
			<div id="menu">
				<a href="">Ajouter une base</a>
				<a href="">Editer une base</a>
				<a href="">Insérer des valeurs</a>
			</div>
			<div id="content">
				<?php echo $listDB; ?>
			</div>
		</div>
	</body>
	
</html>