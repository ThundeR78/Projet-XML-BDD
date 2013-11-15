<?php
session_start();
	if(!isset($_SESSION['id']))	{
		header("Location : ./index.php");
	}

	$file_xml = 'user';
	$path_xml = 'xml/'.$file_xml.'.xml';

	if (file_exists($path_xml)) {
		//Store id
		if (isset($_GET["id"]))
			$id = $_GET["id"];
		else if (isset($_POST["id"]))
			$id = $_POST["id"];

		//Action User
		if (isset($_POST["action"])) {
			//Load file
			$xml = simplexml_load_file($path_xml);

			$username = $_POST["username"];
			$password = $_POST["password"];
			$grant = $_POST["grant"];

			if ($_POST["action"] == "edit") {		//Action Edit	
				//Update user nodes
				foreach($xml->user as $u) {
					if (isset($id) && $u->id == $id) {
						$u->username = $username;
						$u->password = $password;
						$u->droits = $grant;
					}
				}

				//Save file
				$ok = $xml->asXML($path_xml);

				if ($ok)
					$labelAction = '<h4 class="label_result label_success">Enregistrement bien effectué !</h4>';
				else 
					$labelAction = '<h4 class="label_result label_error">Erreur durant l\'enregistrement !</h4>';
			} else if ($_POST["action"] == "insert") {	//Action Insert
				$lastId = intval($xml->user[count($xml->user) -1]->id);
				
				//Add user nodes
				$newUser = $xml->addChild('user');
				$newUser->addChild('id', $lastId +1);
				$newUser->addChild('username', $username);
				$newUser->addChild('password', $password);
				$newUser->addChild('droits', $grant);

				//Save file
				$ok = $xml->asXML($path_xml);

				if ($ok)
					$labelAction = '<h4 class="label_result label_success">Insertion bien effectué !</h4>';
				else 
					$labelAction = '<h4 class="label_result label_error">Erreur durant l\'insertion !</h4>';
			}	
		}

		//Load file
		$xml = simplexml_load_file($path_xml);

		//List User
		$listUser = "<ul>";
		foreach($xml->user as $u) {
			$listUser .= '<li><a href="users.php?id='.$u->id.'">'.$u->username.'</a></li>';

			if (isset($id) && $u->id == $id)
				$user = $u;
		}
		$listUser .= "</ul>";

		//Display Form
		$detailUser = "";
		if (isset($labelAction))
			$detailUser .= $labelAction;

		if (isset($id)) {
			//Edit Form
			$detailUser .= "<h2>Edition d'un User</h2>";
			$detailUser .= '<form action="users.php" method="post">';
			$detailUser .= '<input type="hidden" name="action" value="edit">';
			$detailUser .= '<input type="hidden" name="id" value="'.$user->id.'">';
			$detailUser .= 'Username : <input id="editUsername" type="text" name="username" value="'.$user->username.'" /><br />';
			$detailUser .= 'Password : <input id="editPassword" type="password" name="password" value="'.$user->password.'" /><br />';
			$detailUser .= 'Droit : <select name="grant">';
			$arrayGrant = array(1,3,5,7);
			foreach ($arrayGrant as $value) {
				if($value == $user->droits)
					$detailUser .= '<option value="'.$value.'" selected>'.$value.'</option>';
				else
					$detailUser .= '<option value="'.$value.'">'.$value.'</option>';
			}
			$detailUser .= '</select><br /><br />';
			$detailUser .= '<input type="submit" value="Mettre à jour" onclick="return checkForm();">';
			$detailUser .= '</form>';
		} else {
			//Insert Form
			$detailUser .= "<h2>Ajout d'un User</h2>";
			$detailUser .= '<form action="users.php" method="post">';
			$detailUser .= '<input type="hidden" name="action" value="insert">';
			$detailUser .= 'Username : <input id="editUsername" type="text" name="username" /><br />';
			$detailUser .= 'Password : <input id="editPassword" type="password" name="password" /><br />';
			$detailUser .= 'Droit : <select name="grant">';
			$detailUser .= '<option value="1">1</option>';
			$detailUser .= '<option value="3">3</option>';
			$detailUser .= '<option value="5">5</option>';
			$detailUser .= '<option value="7">7</option>';
			$detailUser .= '</select><br /><br />';
			$detailUser .= '<input type="submit" value="Ajouter" onclick="return checkForm();">';
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
		<link rel="stylesheet" type="text/css" href="css/users.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript">
			function setContent(toShow, toHide) 
			{ 
				$("#"+toHide).hide();
				$("#"+toShow).show();
			}

			function checkForm() {
				var u = document.getElementById("editUsername").value;
				var p = document.getElementById("editPassword").value;

				if (u.length >3 && p.length >3)
					return true;
				else {
					alert("Tous les champs ne sont pas valides !");
					return false;
				}
			}
		</script>
	</head>  
	
	<body onload="setContent('users', 'bdd')">
		<div id="global">
			<h1 id="title">Projet XML - Partie WEB</h1>
			<div id="tabBar">
				<a href="welcome.php">BDD</a>
				<a href="users.php">Users</a>
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