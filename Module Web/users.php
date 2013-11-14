<?php
session_start();
	if(!isset($_SESSION['id']))	{
		header("Location : ./index.php");
	}

	$file_xml = 'user';
	$path_xml = 'xml/'.$file_xml.'.xml';

	if (file_exists($path_xml)) {
		$xml = simplexml_load_file($path_xml);

		if (isset($_GET["id"]))
			$id = $_GET["id"];
		else if (isset($_POST["id"]))
			$id = $_POST["id"];

		//List User
		$listUser = "<ul>";
		foreach($xml->user as $u) {
			$listUser .= '<li><a href="users.php?id='.$u->id.'">'.$u->id.' - '.$u->username.'</a></li>';

			if (isset($id) && $u->id == $id)
				$user = $u;
		}
		$listUser .= "</ul>";

		//Action User
		if (isset($_POST["action"])) {
			$username = $_POST["username"];
			$password = $_POST["password"];
			$grant = $_POST["grant"];

			if ($_POST["action"] == "edit") 

				$labelAction = '<h4></h4>';
			else if ($_POST["action"] == "insert") 
				$labelAction = '<h4></h4>';
		}

		$detailUser = "";

		//Display Form
		if (isset($id)) {
			//Edit Form
			$detailUser .= "<h2>Edition d'un User</h2>";
			$detailUser .= '<form action="users.php" method="post">';
			$detailUser .= '<input type="hidden" name="action" value="edit">';
			$detailUser .= '<input type="hidden" name="id" value="'.$user->id.'">';
			$detailUser .= 'Username : <input type="text" name="username" value="'.$user->username.'" /><br />';
			$detailUser .= 'Password : <input type="password" name="password" value="'.$user->password.'" /><br />';
			$detailUser .= 'Droit : <select name="grant">';
			$arrayGrant = array(1,3,5,7);
			foreach ($arrayGrant as $value) {
				if($value == $user->droits)
					$detailUser .= '<option value="'.$value.'" selected>'.$value.'</option>';
				else
					$detailUser .= '<option value="'.$value.'">'.$value.'</option>';
			}
			$detailUser .= '</select><br />';
			$detailUser .= '<input type="submit" value="Mettre à jour">';
			$detailUser .= '</form>';
		} else {
			//Insert Form
			$detailUser .= "<h2>Ajout d'un User</h2>";
			$detailUser .= '<form action="users.php" method="post">';
			$detailUser .= '<input type="hidden" name="action" value="insert">';
			$detailUser .= 'Username : <input type="text" name="username" /><br />';
			$detailUser .= 'Password : <input type="password" name="password" /><br />';
			$detailUser .= 'Droit : <select name="grant">';
			$detailUser .= '<option value="1">1</option>';
			$detailUser .= '<option value="3">3</option>';
			$detailUser .= '<option value="5">5</option>';
			$detailUser .= '<option value="7">7</option>';
			$detailUser .= '</select><br />';
			$detailUser .= '<input type="submit" value="Ajouter">';
			$detailUser .= '</form>';
		}

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
		<link rel="stylesheet" type="text/css" href="css/welcome.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript">
			function setContent(toShow, toHide) 
			{ 
				$("#"+toHide).hide();
				$("#"+toShow).show();
			}
		</script>
	</head>  
	
	<body onload="setContent('users', 'bdd')">
		<div id="global">
			<h1 id="title">Projet XML - Partie WEB</h1>
			<div id="tabBar">
				<a onclick="setContent('bdd', 'users')">BDD</a>
				<a onclick="setContent('users', 'bdd')">Users</a>
			</div>
			<div id="bdd">
				<div id="menu">
				</div>
				<div id="content">
					totoBdd
				</div>
			</div>
			
			<div id="users">
				<div id="menu">
				<button onclick="location.href='users.php'">Ajouter un User</button>
				<?php echo $listUser; ?>
			</div>
			<div id="content">
				<?php echo $detailUser; ?>
			</div>
			</div>
		</div>
	</body>
	
</html>