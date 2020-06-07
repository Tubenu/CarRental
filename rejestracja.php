<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		
		$test_pass=true;
		
		
		$nick = $_POST['nick'];
		
		
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$test_pass=false;
			$_SESSION['e_nick']="Nick musi posiadać od 4 do 15 znaków!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$test_pass=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$test_pass=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		
		if ((strlen($pass1)<8) || (strlen($pass1)>15))
		{
			$test_pass=false;
			$_SESSION['e_pass']="Hasło musi posiadać od 8 do 15 znaków!";
		}
		
		if ($pass1!=$pass2)
		{
			$test_pass=false;
			$_SESSION['e_pass']="Podane hasła nie są identyczne!";
		}	

		$pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
				
		
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$phone = $_POST['phone'];
		$flat_number = $_POST['flat_number'];
		$room_number = $_POST['room_number'];
		$street = $_POST['street'];
		
		
		if(!is_numeric($phone))
		{
			$test_pass=false;
			$_SESSION['e_phone']="Numer telefonu może składać się tylko z cyfr!";
		}
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				$result = $connection->query("SELECT * FROM klient WHERE email='$email'");
				
				if (!$result) throw new Exception($connection->error);
				
				$mail_count = $result->num_rows;
				if($mail_count>0)
				{
					$test_pass=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				
				$result = $connection->query("SELECT * FROM klient WHERE login='$nick'");
				
				if (!$result) throw new Exception($connection->error);
				
				$ile_takich_nickow = $result->num_rows;
				if($ile_takich_nickow>0)
				{
					$test_pass=false;
					$_SESSION['e_nick']="Istnieje już osoba o takim nicku! Wybierz inny.";
				}
				
				if ($test_pass==true)
				{
					echo "dzialam";
					
					$connection->query("INSERT INTO klient VALUES (NULL, '$nick', '$pass_hash', '$name', '$surname', '$email', '$phone', '$street', '$flat_number', '$room_number')");
					
						echo "a tu nie dzialam";
						$_SESSION['success']=true;
						header('Location: po_rejestracji.php');
				
					
					
				}
				
				$connection->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Cieszymy się że wybrałeś właśnie nas :)</title>
	
	
	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	<div id="nav_rejestracja">
	<form method="post">
	
		Login: <br /> <input type="text" name="nick"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_nick']))
			{
				echo'<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?> <br />
		
		
		Hasło: <br /> <input type="password" name="pass1"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_pass']))
			{
				echo'<div class="error">'.$_SESSION['e_pass'].'</div>';
				unset($_SESSION['e_pass']);
			}
		?> <br />
		
		
		Powtórz hasło: <br /> <input type="password" name="pass2"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_pass']))
			{
				echo'<div class="error">'.$_SESSION['e_pass'].'</div>';
				unset($_SESSION['e_pass']);
			}
		?> <br />
		
		Imię: <br /> <input type="text" name="name"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_name']))
			{
				echo'<div class="error">'.$_SESSION['e_name'].'</div>';
				unset($_SESSION['e_name']);
			}
		?> <br />
		
		Nazwisko: <br /> <input type="text" name="surname"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_surname']))
			{
				echo'<div class="error">'.$_SESSION['e_surname'].'</div>';
				unset($_SESSION['e_surname']);
			}
		?> <br />
		
		Email: <br /> <input type="text" name="email"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_email']))
			{
				echo'<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?> <br />
		
		Numer telefonu: <br /> <input type="number" name="phone"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_phone']))
			{
				echo'<div class="error">'.$_SESSION['e_phone'].'</div>';
				unset($_SESSION['e_phone']);
			}
		?> <br />
		
		Ulica: <br /> <input type="text" name="street"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_street']))
			{
				echo'<div class="error">'.$_SESSION['e_street'].'</div>';
				unset($_SESSION['e_street']);
			}
		?> <br />
		
		Numer domu: <br /> <input type="number" name="flat_number"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_flat_number']))
			{
				echo'<div class="error">'.$_SESSION['e_flat_number'].'</div>';
				unset($_SESSION['e_flat_number']);
			}
		?> <br />
		
		Numer mieszkania: <br /> <input type="number" name="room_number"/><br/>
		
		<?php
			
			if (isset($_SESSION['e_room_number']))
			{
				echo'<div class="error">'.$_SESSION['e_room_number'].'</div>';
				unset($_SESSION['e_room_number']);
			}
		?> <br />
	
		
	
		
	
		
		<br />
		
		<input type="submit" value="Zarejestruj się" />
		
	</form>
	<form action="pozalogowaniu.php">
    <input type="submit" value="Powrót do strony głównej" />
</form>
</div>
</body>
</html>