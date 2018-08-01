<?php
    session_start();
    include 'dbConnection.php';
    
    $currency = '&#36;';
    $shipping_cost      = 1.50; //shipping cost
    $taxes              = array( //List your Taxes percent here.
                            'Tax' => 5
                            );
    
    $conn = getDatabaseConnection("catalan");
    
    ############# add products to session #########################
    if(isset($_POST["itemId"]))
    {
        foreach($_POST as $key => $value)
        {
            $newItem[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
        }
        
        //we need to get product name and price from database.
        $sql = "SELECT itemName, price, itemId 
                FROM cat_menuItems
                WHERE itemId = :itemId";
        
        $namedParameters = array();
        $namedParameters[":itemId"] = $newItem['itemId'];
        $statement = $conn->prepare($sql);
        $statement->execute($namedParameters);
        $record=$statement->fetch(PDO::FETCH_ASSOC);
        
    
        if(isset($_SESSION["cartProducts"]))
        {  //if session var already exist
            if(isset($_SESSION["cartProducts"][$record['itemId']])) //check item exist in products array
            {
                unset($_SESSION["cartProducts"][$record['itemId']]); //unset old array item
            }           
        }
        $_SESSION["cartProducts"][$record['itemId']] = $record; //update or create product session with new item
        $_SESSION["cartProducts"][$record['itemId']]['itemQty'] = $_POST['itemQty'];
        
        $total_items = count($_SESSION["products"]); //count total items
        die(json_encode(array('items'=>$totalItems))); //output json 
    
    }
    
    ################## list products in cart ###################
    if(isset($_POST["loadCart"]) && $_POST["loadCart"]==1)
    {
    
        if(isset($_SESSION["cartProducts"]) && count($_SESSION["cartProducts"])>0){ //if we have session variable
            $cart_box = '<ul class="cart-products-loaded">';
            $total = 0;
            foreach($_SESSION["cartProducts"] as $product){ //loop though items and prepare html content
                
                //set variables to use them in HTML content below
                $itemName = $product["itemName"]; 
                $price = $product["price"];
                $itemId = $product["itemId"];
                $itemQty = $product["itemQty"];
                
                $cart_box .=  "<li> $itemName (Qty : $itemQty) &mdash; $currency ".sprintf("%01.2f", ($price * $itemQty)). " <a href='#' class='remove-item' data-code=".$itemId.">&times;</a></li>";
                $subtotal = ($price * $itemQty);
                $total = ($total + $subtotal);
            }
            $cart_box .= "</ul>";
            $cart_box .= '<div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="viewCart.php" title="Review Cart and Check-Out">Check-out</a></u></div>';
            die($cart_box); //exit and output content
        }else{
            die("Your Cart is empty"); //we have empty cart
        }
    }
    
    ################# remove item from shopping cart ################
    if(isset($_GET["removeCode"]) && isset($_SESSION["cartProducts"]))
    {
        $itemId   = filter_var($_GET["removeCode"], FILTER_SANITIZE_STRING); //get the product code to remove
    
        if(isset($_SESSION["cartProducts"][$itemId]))
        {
            unset($_SESSION["cartProducts"][$itemId]);
        }
        
        $total_items = count($_SESSION["cartProducts"]);
        die(json_encode(array('items'=>$total_items)));
    }
?>