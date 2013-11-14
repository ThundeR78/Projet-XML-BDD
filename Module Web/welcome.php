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
		<script type="text/javascript">
			function setContent(toShow, toHide) 
			{ 
				$("#"+toHide).hide();
				$("#"+toShow).show();
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
			<div id="bdd">
				<div id="menu">
				</div>
				<div id="content">
					totoBdd
				</div>
			</div>
			
			<div id="users">
				<div id="menu">
				</div>
				<div id="content">
					totoUser
				</div>
			</div>
		</div>
	</body>
	
</html>