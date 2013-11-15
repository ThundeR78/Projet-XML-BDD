<?
	if(isset($_POST['action']))
	{
		if($_POST['action'] == 'detail')
		{
			if(isset($_POST['userId']))
			{
				$userId = $_POST['userId'];
				if (file_exists('xml/user.xml')) 
				{
					$users = simplexml_load_file('xml/user.xml');
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