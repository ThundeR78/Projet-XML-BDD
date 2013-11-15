<?
	if(isset($_POST['action']))
	{
		if($_POST['action'] == 'list')
		{
			if(isset($_POST['bddName']))
			{
				$xmlFile = $_POST['bddName'];
				if (file_exists('./xml/bdd/'.$xmlFile)) 
				{
					$tables = simplexml_load_file('./xml/bdd/'.$xmlFile);
					$tablesNames;
							
					foreach($tables->database->tables->table as $table)
					{
						$tablesNames[] = (string)$table->name;
					}
					echo json_encode($tablesNames);
				}
			}
			
		}
	}

?>