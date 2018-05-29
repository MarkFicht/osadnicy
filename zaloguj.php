<?php

	require_once "connect.php";

	$first_connect = @new mysqli($host, $db_user, $db_password, $db_name);

	if($first_connect->connect_errno!=0)
	{
		echo "Error: ".$first_connect->connect_errno." Opic: ".$first_connect->connect_error;
	}
	else 
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		//--- Connetion test with Database ---//
		echo "It works!";

		$first_connect->close();
	}
	
	//--- Test with variable reading ---//
	//echo $login."<br>";
	//echo $haslo;

?>