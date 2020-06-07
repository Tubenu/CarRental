<?php
include 'connect.php';

include 'koszyk_funkcje.php';
$cart = new Cart;


if($cart->total_items() <= 0){
    header("Location: samochody.php");
}


$_SESSION['sessCustomerID'] = $_SESSION['id'];

$query = $db->query("SELECT * FROM klient WHERE id_klienta = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Podsumowanie zakupów</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
</head>
<body>
<div class="container">
    <h1>Twoje zamówienie</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Samochód</th>
            <th>Cena za dzień</th>
            <th>Ilość dni</th>
            <th>Suma</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]." ".$item['brand']; ?></td>
            <td><?php echo $item["price"].' zł'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo $item["subtotal"].' zł'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>Koszyk jest pusty! Dodaj coś :)</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Suma <?php echo $cart->total().' zł'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Dane do zamówienia : </h4>
		
        <p><?php echo "Login : ".$custRow["login"]; ?></p>
        <p><?php echo "Email : ".$custRow["email"]; ?></p>
        <p><?php echo "Numer telefonu : ".$custRow["Numer_telefonu"]; ?></p>
        <p><?php echo "Adres dostarczenia zamówienia : ".$custRow["Ulica"]." ".$custRow["Numer_mieszkania"]." m".$custRow["Numer_domu"]; ?></p>
    </div>
    <div class="footBtn">
        <a href="samochody.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Kontynuuj zakupy</a>
        <a href="koszyk_inicjalizacja.php?action=placeOrder" class="btn btn-success orderBtn">Zamów <i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
</div>
</body>
</html>