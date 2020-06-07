<?php
/*if(!isset($_REQUEST['id_samochodu'])){
    header("Location: samochody.php");
}*/
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
    <title>Zamówienie przebiegło pomyślnie</title>
    <meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content ="IE=edge,chrome=1" />
    <style>
    .container{width: 100%;padding: 50px;}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Status zamówienia</h1>
    <p>Udało ci się zakończyć zamówienie :)  Numer zamówienia to :  <?php echo $_GET['id_gotowego_zamowienia']; ?></p>
	<?php 
	
	 $query = $db->query("SELECT * FROM kierowcy ORDER BY RAND() LIMIT 1");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
			if($row['czy_dostepny'] == 1){
				
				$id = $row['id_kierowcy'];
				$numer  = $row['numer_telefonu'];
				$imie   = $row['imie'];
				?><p>Twój wymarzony samochód przywiezie ci kierowca :  <?php echo $imie; ?>. W razie jakichkolwiek pytań możesz się z nim skontaktować pod numerem : <?php echo $numer;?></p>
				
				<?php
				$sql = $db->query("UPDATE kierowcy SET czy_dostepny='0' WHERE id_kierowcy=".$id);
			}
			else{
				echo "Nie mamy obecnie wolnych kierowców";
				$sql1 = $db->query("UPDATE kierowcy SET czy_dostepny='1'");
			}
				
			
				
		}}
	
	?>
	<form action="pozalogowaniu.php">
    <input type="submit" value="Powrót do strony głównej" />
</form>
</div>
</body>
</html>