<?php
	session_start();

	if (isset($_POST['email']))
	{
		//Successful validation? Let's check!
		$validation_OK = true;

		//--- Check nick ---//
		$nick = $_POST['nick'];

		if ((strlen($nick)<3) || (strlen($nick)>20))	{
			$validation_OK = false;
			$_SESSION['e_nick'] = 'Nick musi posiadać od 3 do 20 znaków!';
		}

		if (ctype_alnum($nick)==false)	{
			$validation_OK = false;
			$_SESSION['e_nick'] = 'Nick musi posiadać tylko litery i cyfry (bez polskich znaków)!';
		}

		//--- Check e-mail ---//
		$email = $_POST['email'];
		$emailSafe = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailSafe, FILTER_VALIDATE_EMAIL) == false) || ($emailSafe!=$email)) {
			$validation_OK = false;
			$_SESSION['e_email'] = 'Podaj poprawny adres e-mail';
		}

		//--- Check password ---//
		$pass1 = $_POST['haslo1'];
		$pass2 = $_POST['haslo2'];

		if ((strlen($pass1)<8) || (strlen($pass1)>20)) {
			$validation_OK = false;
			$_SESSION['e_haslo'] = 'Hasło musi posiadać od 8 do 20 znaków!';
		}

		if ($pass1 != $pass2) {
			$validation_OK = false;
			$_SESSION['e_haslo'] = 'Podane hasła nie są identyczne!';
		}

		$pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
		echo $pass_hash; exit();




		//--- Check all tests of validation ---//
		if ($validation_OK == true)
		{
			//All tests of validation correct. Added player to DB
			echo "Correct validation!"; 	exit(); // Its test

		}
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf=8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Osadnicy - załóż darmowe konto</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<form method="post">	

		Nickname: <br> <input type="text" name="nick"> <br>
		<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?>

		E-mail: <br> <input type="text" name="email"> <br>
		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>

		Twoje hasło: <br> <input type="password" name="haslo1"> <br>
		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>

		Powtórz hasło: <br> <input type="password" name="haslo2"> <br>

		<label>
			<input type="checkbox" name="regulamin"> Akceptuje regulamin
		</label>

		<div class="g-recaptcha" data-sitekey="6LeKZV4UAAAAADCeNnCH7u_eYvIiUw16-R9H_tx4"></div>
		<br> <input type="submit" value="Zarejestruj się">

	</form>
</body>
</html>