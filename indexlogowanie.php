<?php

	session_start();
	
	if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
	{
		header('Loacation: pozalogowaniu.php');
	}
	
?>

<!DOCTYPE HTML>
<html lang ="pl">
<head>
<title>Samochody24.pl</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content ="IE=edge,chrome=1" />
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	
</head>



<body>
	
	
	<div id="nav_rejestracja">
	<form action ="logowanie.php" method="post">
	
	Login:<br /> <input type="text" name="login"/><br/>
	Hasło:<br /> <input type="password" name="haslo"/><br/><br/>

	<br/><input type="submit" value="Zaloguj sie"/><br/>
	</form>
	<form action="index.php">
    <input type="submit" value="Powrót do strony głównej" />
</form>
<?php

	if(isset($_SESSION['fail']))
		echo $_SESSION['fail'];
	


?>

</body>

</html>