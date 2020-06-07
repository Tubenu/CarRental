<?php

	session_start();
	
	if(!isset($_SESSION['success']))
	{
		header('Location: index.php');
	}
	else
	{
		
		unset($_SESSION['success']);
		
		
	}
	
?>

<!DOCTYPE HTML>
<html lang ="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content ="IE=edge,chrome=1" />
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Witamy na pokładzie Samochody24 :)</title>
</head>



<body>
	
	<center>Dziękujemy za rejestrację w serwisie ! </center>
	
	<br/><br/>
	<form action="indexlogowanie.php">
	<center>
    <input type="submit" value="Możesz teraz zalogować się na swoje konto klikając tutaj" />
	</center>
	</form>


</body>

</html>