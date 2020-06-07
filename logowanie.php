<?php
	session_start();
	
	if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}	
	
	require_once "connect.php"; 
	
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	
	$login = htmlentities($login,ENT_QUOTES,"UTF-8");
	
	
	$connection = new mysqli($host,$db_user,$db_password,$db_name);
	
	
	if($connection->connect_errno!=0)
	{
		
		echo "Error: ".$connection->connect_errno ."opis: " .$connection->connect_error;	
	
	}
	
	else
	{
		$sql="SELECT * FROM klient WHERE login='$login'";
		if($result = $connection->query($sql))
		{
			$usercount = $result->num_rows;
			if($usercount>0)
			{	
				$row = $result->fetch_assoc();
				if(password_verify($haslo,$row['haslo']))
				{
							
						
						$_SESSION['logged'] = true;
						
						$_SESSION['login'] = $row['login'];
						$_SESSION['id'] = $row['id_klienta'];
						
						$result->free_result();
						
						unset($_SESSION['fail']);
						header('Location: pozalogowaniu.php');
				}
				else
				{
						$_SESSION['fail'] = '<span style ="color:red">Nieprawidłowy login lub hasło!</span>';
						header('Location: indexlogowanie.php');
					
				}
			}
			else
			{
				$_SESSION['fail'] = '<span style ="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: indexlogowanie.php');
			}
			
		}
		
		$connection->close();
	
	}

	
	
?>