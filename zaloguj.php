<?php
	session_start();

	if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

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

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

		//--- LogIn test with Database ---//
		//echo "It works!";

		/*$sql = "SELECT*FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";*/
		//modified for user security

		if ($result = @$first_connect->query(
			sprintf("SELECT*FROM uzytkownicy WHERE user='%s' AND pass='%s'",
			mysqli_real_escape_string($first_connect,$login),
			mysqli_real_escape_string($first_connect,$haslo))))
		{
			$how_many_user = $result->num_rows;
			if ($how_many_user>0) 
			{
				$_SESSION['online'] = true;
				$record = $result->fetch_assoc();
				//$user = $record['user'];

				$_SESSION['id'] = $record['id'];
				$_SESSION['user'] = $record['user'];
				$_SESSION['drewno'] = $record['drewno'];
				$_SESSION['kamien'] = $record['kamien'];
				$_SESSION['zboze'] = $record['zboze'];
				$_SESSION['email'] = $record['email'];
				$_SESSION['dnipremium'] = $record['dnipremium'];

				//--- Test to get record from table "uzytkownicy" (Is only one table in this DB) ---//
				//echo $user;

				unset($_SESSION['error_login']);
				$result->free_result(); // ->close(); || ->free();
				header('location: game.php');
				
			} else {

				$_SESSION['error_login'] = '<span style="color:red; margin-left:auto; margin-right:auto;">Nieprawidłowy login lub hasło!</span>';
				header('location: index.php');

			}
		}

		$first_connect->close();
	}
	
	//--- Test with variable reading ---//
	//echo $login."<br>";
	//echo $haslo;
?>