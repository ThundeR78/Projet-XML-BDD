<?php

function ListBddDir($Directory)
{
  	$MyDirectory = opendir($Directory) or die('Erreur');
	while($Entry = @readdir($MyDirectory)) 
	{
		if($Entry != '.' && $Entry != '..')
			echo '<a onclick="showDB(\''.$Entry.'\')">'.$Entry.'</a><br />';
	}
	closedir($MyDirectory);
}

?>


<div id="bdd">
	<input id="createDbButton" type="button" value="Créer une base" /><br /><br />
	<div id="menu">
	<?php
			ListBddDir('./xml/bdd');
	?>
	</div>
	<div id="content">
		
	</div>
</div>
