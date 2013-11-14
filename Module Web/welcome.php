<?php
session_start();
	if(!isset($_SESSION['id']))
	{
		header("Location : ./index.php");
	}
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
				<a href="add-db.php">Ajouter une base</a>
				<a href="edit-db.php">Editer une base</a>
				<a href="insert-table.php">Insérer des valeurs</a>
			</div>
			<div id="content">
				titi tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti toto
				<br />
				titi tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti toto
				<br />
				titi tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti toto
				<br />
				titi tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti tototiti toto
			</div>
		</div>
	</body>
	
</html>