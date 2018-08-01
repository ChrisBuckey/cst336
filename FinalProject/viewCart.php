<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cart Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
	<style>@import url("css/styles.css");</style>
	<!--<link rel="stylesheet" type="text/css" href="./css/styles.css">-->
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
      
	<script type="text/javascript" src="cart.js"></script>
</head>

<body id="menuBody">
    <br/>
    <!-- Bootstrap Navagation Bar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Cart</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="viewCart.php">Cart</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="menu.php">Menu</a>
          </li>
        </ul>
      </div>
    </nav>
                
    
        <div class="jumbotron text-center">
    <h1>Your Cart</h1><br/>
    </div>
	
    
    
</body>
</html>

<?php
    session_start();
    
    $currency = '&#36;';
    $shipping_cost      = 1.50; //shipping cost
    $taxes              = array( //List your Taxes percent here.
                            'Tax' => 5
                            );
    
    if(isset($_SESSION["cartProducts"]) && count($_SESSION["cartProducts"])>0){
    $total          = 0;
    $list_tax       = '';
    $cart_box       = '<ul class="view-cart">';

    foreach($_SESSION["cartProducts"] as $product){ //Print each item, quantity and price.
        $itemName = $product["itemName"];
        $itemQty = $product["itemQty"];
        $price = $product["price"];
        $itemId = $product["itemId"];
        
        $item_price     = sprintf("%01.2f",($price * $itemQty));  // price x qty = total item price
        
        $cart_box       .=  "<li>$itemName (Qty : $itemQty ) <span> $currency $item_price </span></li>";
	
        $subtotal       = ($price * $itemQty); //Multiply item quantity * price
        $total          = ($total + $subtotal); //Add up to total price
        //$_SESSION["cartProducts"][$record['itemId']]['orderTotal'] = $total;
    }
    $grand_total = $total + $shipping_cost; //grand total
    
    foreach($taxes as $key => $value){ //list and calculate all taxes in array
            $tax_amount     = round($total * ($value / 100));
            $tax_item[$key] = $tax_amount;
            $grand_total    = $grand_total + $tax_amount; 
    }
    
    
    foreach($tax_item as $key => $value){ //taxes List
        $list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
    }
    
    $shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
    
    //Print Shipping, VAT and Total
    $cart_box .= "<li class='view-cart-total'>$shipping_cost  $list_tax <hr>Payable Amount : $currency ".sprintf("%01.2f", $grand_total)."</li>";
    $cart_box .= "</ul>";
    
    echo $cart_box;
    echo "<form action='checkout.php'>";
    echo "<input type='hidden' name='orderTotal' value='$grand_total'>";
    echo '<button type="submit" class="check-out">Place Order</button>';
    echo "</form>";
    }
    else
    {
    echo "Your Cart is empty";
    }

?>