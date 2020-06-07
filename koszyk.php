<?php
include 'koszyk_funkcje.php';
$cart = new Cart;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Witaj w swoim koszyku</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
    <style>
    .container{padding: 50px;}
    input[type="number"]{width: 20%;}
    </style>
    <script>
    function updateCartItem(obj,id){
		
        $.get("koszyk_inicjalizacja.php", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
				
               location.reload();
            }else{
                alert('Nie udało się zaaktualizować koszyka. Spróbuj ponownie później');
				
            }
        });
    }
    </script>
</head>
</head>
<body>
<div class="container">
    <h1>Twój koszyk</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Samochód</th>
            <th>Cena za dzień</th>
            <th>ilość dni</th>
            <th>Suma</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]." ". $item["brand"]; ?></td>
            <td><?php echo $item["price"].' zł'; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo $item["subtotal"].' zł'; ?></td>
            <td>
                <a href="koszyk_inicjalizacja.php?action=removeCartItem&id_samochodu=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Jesteś pewny?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Twój koszyk jest pusty. Dodaj coś :)</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="samochody.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Kontynuuj zakupy</a></td>
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Suma <?php echo $cart->total().' zł'; ?></strong></td>
            <td><a href="podsumowanie.php" class="btn btn-success btn-block">Przejdz do podsumowania <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
</div>
</body>
</html>