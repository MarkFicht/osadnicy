<?php

	require_once "connect.php";

	$first_connect = @new mysqli($host, $db_user, $db_password, $db_name);

	if($first_connect->connect_errno!=0)
	{
		echo "Error: ".$first_connect->connect_errno;/*." Opis: ".$first_connect->connect_error;//This is error log for me*/
	}
	else //--- Correct connect with DB ---//
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		//--- Connetion test with Database ---//
		//echo "It works!";

		$sql = "SELECT*FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";

		if ($result = @$first_connect->query($sql))
		{
			$how_many_user = $result->num_rows;
			if ($how_many_user>0) 
			{
				$record = $result->fetch_assoc();
				$user = $record['user'];

				//--- Test to get record from table "uzytkownicy" (Is only one table in this DB) ---//
				echo $user;

				$result->free_result(); // ->close(); || ->free();
			} else {

			}
		}

		$first_connect->close();
	}
	
	//--- Test with variable reading ---//
	//echo $login."<br>";
	//echo $haslo;

?>