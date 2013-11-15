<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Projet XML</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/welcome.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript" src="./js/bdd.js"></script>
		<script type="text/javascript">
			function setContent(toShow, toHide) 
			{ 
				$("#"+toHide).hide();
				$("#"+toShow).show();

				if (toShow == "users")
					location.href='users.php';
			}
		</script>
	</head>  
	
	<body>
		<div id="global">
			<h1 id="title">Projet XML - Partie WEB</h1>
			<div id="tabBar">
				<a onclick="setContent('bdd', 'users')">BDD</a>
				<a onclick="setContent('users', 'bdd')">Users</a>
			</div>
			
			<?php include('bdd.php'); ?>
			
			<!-- <?php //include('users2.php'); ?> -->

			<footer>
				<h4>Made in ESGI - Julien Wetstein, Julien Zerbit, Kevin Grosgojat</h4>
			</footer>
		</div>
	</body>
</html>