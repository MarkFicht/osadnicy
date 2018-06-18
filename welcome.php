<?php
	session_start();
	
	if(!isset($_SESSION['registration_done']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['registration_done']);
	}

	//--- Delete variables, which remember datas in <form> ---//
	if (isset($_SESSION['formR_nick'])) unset($_SESSION['formR_nick']);
	if (isset($_SESSION['formR_email'])) unset($_SESSION['formR_email']);
	if (isset($_SESSION['formR_haslo1'])) unset($_SESSION['formR_haslo1']);
	if (isset($_SESSION['formR_haslo2'])) unset($_SESSION['formR_haslo2']);
	if (isset($_SESSION['formR_regulamin'])) unset($_SESSION['formR_regulamin']);

	//--- Delete variables, with errors registration ---//
	if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	if (isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
	if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf=8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Osadnicy - gra przeglądarkowa</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
	<div id="container">
		<span id="title1">Dziękujemy za rejestrację!</span>
		<span id="title2">PLATON</span>

		<a href="index.php"><input type="submit" value="Zaloguj się"></a>
	</div>	
</body>
</html>