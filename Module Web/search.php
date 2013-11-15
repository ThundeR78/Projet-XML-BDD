<?php
session_start();
	if(!isset($_SESSION['id']))	{
		header("Location : ./index.php");
	}

	$file_xml = 'example3';
	$path_xml = 'xml/'.$file_xml.'.xml';

	if (file_exists($path_xml)) {
		//Load file
		$xml = simplexml_load_file($path_xml);

		//List author DB
		$usersDB = $xml->xpath("/sgbd/database/author");

		if (isset($_POST["userDB"]))
			$userDB = $_POST["userDB"];

		$searchEngine = "";

		//Action Result
		if ($_POST["action"] == "result") {	
			var_dump($userDB);
			$dbs = $xml->xpath("/sgbd/database");
			$database= NULL;
			// var_dump($dbs[0]->author);
			foreach ($dbs as $db) {
				// var_dump($db->author);
				if ($db->author == $userDB)
					$database = $db;
			}
			// var_dump($database);

			if ($database == NULL) {
				$searchEngine = '<h4 class="label_result label_error">La recherche n\'a pas été fructueuse !</h4>';
			} else {
				//TODO display result DB
				$searchEngine = $database->name;
			}
		} 
		if ($_POST["action"] == "search" || !isset($db)) {
			//Search Form
			$searchEngine .= '<form action="search.php" method="post">';
			$searchEngine .= '<input type="hidden" name="action" value="result">';
			$searchEngine .= 'Base de données de : <select name="userDB">';
			foreach($usersDB as $u) {
				if (isset($userDB) && $userDB == $u)
					$searchEngine .= '<option value="'.$u.'" selected>'.$u.'</option>';
				else 
					$searchEngine .= '<option value="'.$u.'">'.$u.'</option>';
			}
			$searchEngine .= "</select><br /><br />";
			$searchEngine .= '<input type="submit" value="Rechercher" onclick="return checkForm();">';
			$searchEngine .= '</form>';
		}

		if (isset($alertAction))
			$searchEngine .= $alertAction;
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
		<link rel="stylesheet" type="text/css" href="css/search.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript">
			function checkForm() {
				// var u = document.getElementById("editUsername").value;
				// var p = document.getElementById("editPassword").value;

				// if (u.length >3 && p.length >3)
				// 	return true;
				// else {
				// 	alert("Tous les champs ne sont pas valides !");
				// 	return false;
				// }
				return true;
			}

			function launchSearch() {

			}
		</script>
	</head>  
	
	<body>
		<?php include("header.php"); ?>

			<div id="search">
				<div id="content">
					<h2>Moteur de Recherche</h2>

					<?php echo $searchEngine; ?>
				</div>
			</div>
		
		<?php include("footer.php"); ?>
	</body>
	
</html>