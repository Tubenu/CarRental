<?php

include 'koszyk_funkcje.php';
$cart = new Cart;

include 'connect.php';

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id_samochodu'])){
        $productID = $_REQUEST['id_samochodu'];
        $query = $db->query("SELECT * FROM samochody WHERE id_samochodu = ".$productID);
        $_SESSION['row'] = $query->fetch_assoc();
        $itemData = array(
            'id' => $_SESSION['row']['id_samochodu'],
            'name' => $_SESSION['row']['Marka'],
			'brand' => $_SESSION['row']['Model'],
            'price' => $_SESSION['row']['Cena'],
            'qty' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'koszyk.php':'samochody.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id_samochodu'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id_samochodu'])){
        $deleteItem = $cart->remove($_REQUEST['id_samochodu']);
        header("Location: koszyk.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
		$gowno = "INSERT INTO zamowienie (id_klienta, id_samochodu, suma) VALUES ('".$_SESSION['sessCustomerID']."', '".$_SESSION['row']['id_samochodu']."', '".$cart->total()."')";
        $insertOrder = $db->query($gowno)or die($db -> error." ".$gowno);
		
	
		
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO przedmioty_zamowione (id_zamowienia, id_samochodu, ilosc) VALUES ('".$orderID."', '".$item['id']."' ,'".$item['qty']."');";
            
			}
            $insertOrderItems = $db->multi_query($sql)or die($db -> error." ".$sql);
          
            if($insertOrderItems){
                $cart->destroy();
                header("Location: udany_zakup.php?id_gotowego_zamowienia=$orderID");
            }else{
                header("Location: podsumowanie.php");
            }
        }else{
            header("Location: podsumowanie.php");
        }
    }else{
        header("Location: samochody.php");
    }
}else{
    header("Location: samochody.php");
}