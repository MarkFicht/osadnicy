<?php
	session_start();

	if((isset($_SESSION['online'])) && ($_SESSION['online']==true))
	{
		header('Location: game.php');
		exit();
	}

	if (isset($_POST['email'])) // 1 variable is enought - i send all datas from <form>
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
		/*echo $pass_hash; exit(); // test for hashing password*/
		/*echo $_POST['regulamin']; exit(); // test for checkbox on/off*/

		//--- Rules accepted? ---//
		if (!isset($_POST['regulamin'])) {
			$validation_OK = false;
			$_SESSION['e_regulamin'] = 'Potwierdź akceptację regulaminu!';
		}

		//--- Bot or not? reCAPTCHA ---//
		$secretK = "6LeKZV4UAAAAANM_wPOoi1sjsDfEN1Reb2wB5Mpo";
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretK.'&response='.$_POST['g-recaptcha-response']);

		$answer = json_decode($check);

		if (!($answer->success)) {
			$validation_OK = false;
			$_SESSION['e_bot'] = 'Potwierdź, że nie jesteś BOTem!';
		}

		//--- Remember the entered data to <form> ---//
		$_SESSION['formR_nick'] = $nick;
		$_SESSION['formR_email'] = $email;
		$_SESSION['formR_haslo1'] = $pass1;
		$_SESSION['formR_haslo2'] = $pass2;
		if (isset($_POST['regulamin'])) $_SESSION['formR_regulamin'] = true;

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try {
			$first_connect = new mysqli($host, $db_user, $db_password, $db_name);
			if($first_connect->connect_errno!=0)	{
				throw new Exception(mysqli_connect_errno());
			}
			else {
				//--- E-mail address already exists? ---//
				$result = $first_connect->query("SELECT id FROM uzytkownicy WHERE email='$email'");

				if (!$result) throw new Exception($first_connect->error);

				$how_many_mails = $result->num_rows;
				if ($how_many_mails>0) {
					$validation_OK = false;
					$_SESSION['e_email'] = 'Istnieje już konto z takim adresem e-mail!';
				}

				//--- Login already exists? ---//
				$result = $first_connect->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

				if (!$result) throw new Exception($first_connect->error);

				$how_many_nick = $result->num_rows;
				if ($how_many_nick>0) {
					$validation_OK = false;
					$_SESSION['e_nick'] = 'Istnieje już konto z takim loginem!';
				}

				//--- Check all tests of validation ---//
				if ($validation_OK == true)
				{
					//All tests of validation correct. Added player to DB
					//echo "Correct validation!"; 	exit(); // Its test

					if ($first_connect->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$pass_hash', '$email', 100, 100, 100, 14)")) {
						$_SESSION['registration_done'] = true;
						header('Location: welcome.php');
					}
					else {
						throw new Exception($first_connect->error);
					}

				}

				$first_connect->close();
			}
		}
		catch(Exception $e) {
			echo '<div class="error">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie.</div>';
			//--- Error info for developer ---//
			//echo '<br>Informacja developerska: '.$e;
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
	<div id="container">
	<form method="post">	
		Nickname: <input type="text" value="<?php
			if (isset($_SESSION['formR_nick']))
			{
				echo $_SESSION['formR_nick'];
				unset($_SESSION['formR_nick']);
			}
		?>" name="nick">
		<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?>

		E-mail: <input type="text" value="<?php
			if (isset($_SESSION['formR_email']))
			{
				echo $_SESSION['formR_email'];
				unset($_SESSION['formR_email']);
			}
		?>" name="email">
		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>

		Twoje hasło: <input type="password" value="<?php
			if (isset($_SESSION['formR_haslo1']))
			{
				echo $_SESSION['formR_haslo1'];
				unset($_SESSION['formR_haslo1']);
			}
		?>" name="haslo1"> 
		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>

		Powtórz hasło: <input type="password" value="<?php
			if (isset($_SESSION['formR_haslo2']))
			{
				echo $_SESSION['formR_haslo2'];
				unset($_SESSION['formR_haslo2']);
			}
		?>" name="haslo2"> 
			
		<label>
			<input type="checkbox" name="regulamin" <?php
				if (isset($_SESSION['formR_regulamin']))
				{
					echo "checked";
					unset($_SESSION['formR_regulamin']);
				}
			?> > Akceptuje regulamin
		</label>
		<span class="breakl"></span>
		<?php
			if (isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
		?>
		<span class="breakl"></span>
		<div class="g-recaptcha" data-sitekey="6LeKZV4UAAAAADCeNnCH7u_eYvIiUw16-R9H_tx4"></div>
		<?php
			if (isset($_SESSION['e_bot']))
			{
				echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
				unset($_SESSION['e_bot']);
			}
		?>
		<input type="submit" value="Zarejestruj się">
	</form>
		<a href="index.php"><input type="submit" value="Powrót"></a>
	</div>
</body>
</html>