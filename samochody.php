<?php
include 'connect.php';
	session_start();
	if(!isset($_SESSION['logged']))
	{
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Cars</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 50px;}
	
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Obecne samochody w ofercie</h1>
    <a href="koszyk.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i></a>
    <div id="products" class="row list-group">
        <?php
        $query = $db->query("SELECT * FROM samochody ORDER BY id_samochodu	DESC LIMIT 10");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>
        <div class="item col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <p class="text-info"><big><?php echo $row["Marka"]." ".$row["Model"] ; ?></big></p>
					 <p class="list-group-item-text"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['zdjecie'] ).'" class="img-responsive" /><br />';?></p>
                    <p class="list-group-item-text"><?php echo "Rocznik : ".$row["Rocznik"]; ?></p>
					<p class="list-group-item-text"><?php echo "Kolor : ".$row["Kolor"]; ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?php echo $row["Cena"].' zł/dzień'; ?></p>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="koszyk_inicjalizacja.php?action=addToCart&id_samochodu=<?php echo $row["id_samochodu"]; ?>">Dodaj do koszyka</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else{ ?>
        <p>Nie znaleziono produktu</p>
        <?php } ?>
    </div>
	<form action="pozalogowaniu.php">
    <input type="submit" value="Powrót do strony głównej" />
</form>
</div>
</body>
</html>