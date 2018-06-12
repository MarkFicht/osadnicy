<?php
	session_start();
	if((isset($_SESSION['online'])) && ($_SESSION['online']==true))
	{
		header('Location: game.php');
		exit();
	}
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
		<span id="title1">Tylko martwi ujrzeli koniec wojny</span>
		<span id="title2">PLATON</span>
		
		<form action="zaloguj.php" method="post">
			<input type="text" name="login" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'">

			<input type="password" name="haslo" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'">

			<input type="submit" value="Zaloguj się">
			<?php
				if(isset($_SESSION['error_login']))	
				{
					echo $_SESSION['error_login'];
					unset($_SESSION['error_login']);
				}
			?>
		</form>

		<a href="register.php"><input type="submit" value="Rejestracja"></a>
	</div>	
</body>
</html>