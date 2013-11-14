<?php
session_start();
if(isset($_POST['connect']))
{
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		if (file_exists('./xml/user.xml')) 
		{
			$find = false;
			$users = simplexml_load_file('./xml/user.xml');
			foreach($users as $user)
			{
				if(($user->username == $_POST['username']) && ($user->password == $_POST['password']))
				{
					$_SESSION['id'] = (string)$user->id;
					$_SESSION['username'] = (string)$user->username;
					$find = true;
					break;
				}
			}
			if($find)
			{
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'welcome.php';
				header("Location: http://$host$uri/$extra");
				exit;
			}
			else
				$error = "Utilisateur inconnu !";
		}
		else
			$error = "Erreur ouverture fichier user";
	}
	else
		$error = "Tous les champs sont obligatoires";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Projet XML</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/index.css" />
	</head>  
	
	<body>
		<div id="global">
			<h1 id="title">Projet XML - Partie WEB</h1>
			<div id="loginDiv">
				<form action="" method="post">
					<input type="text" name="username" placeholder="Login" required /><br /><br />
					<input type="password" name="password"  placeholder="Password" required /><br /><br />
					<input type="submit" value="Connexion" name="connect" />
				</form>
			</div>
			<div id="loginError">
				<?php if(isset($error)) { echo "<p>".$error."</p>"; } ?>
			</div>
		</div>
	</body>
	
</html>