<?php
//Load file
$file_xml = 'user';
$path_xml = 'xml/'.$file_xml.'.xml';
$xml = simplexml_load_file($path_xml);

function ListUser() {
	//List User
	echo "<ul>";
	foreach($xml->user as $u) {
		echo '<li><a class="menuLink" onclick="showUser(\''.$u->id.'\')">'.$u->username.'</a></li>';

		// if (isset($id) && $u->id == $id)
		// 	$user = $u;
	}
	echo "</ul>";
}

function DetailUser() {
	
}

?>

	<!-- <input id="createDbButton" type="button" value="Créer une base" /><br /><br /> -->

<div id="users">
	<button id="createUserButton" onclick="location.href='users.php'">Ajouter un User</button>
	<div id="menu">
		<?php
			ListUser();
		?>
	</div>
	<div id="content">
		
	</div>
</div>



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
			$detailUser .= '</select><br /><br />';
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
			$detailUser .= '</select><br /><br />';
			$detailUser .= '<input type="submit" value="Ajouter">';
			$detailUser .= '</form>';
		}
	}
	else
		$error = "Erreur ouverture fichier ".$file_xml;
?>

			
		