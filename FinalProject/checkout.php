<?php
    session_start();
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("catalan");
    
    if(isset($_SESSION["cartProducts"]))
    {
        //Get highest order ID in db
        $sql = "SELECT orderId FROM cat_orders ORDER BY orderId DESC LIMIT 1";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        $lastOrderId = $record['orderId'] + 1;
        $date = date('Y-m-d H:i:s');
        
        $orderTotal = $_GET['orderTotal'];
        
        foreach($_SESSION["cartProducts"] as $item)
        {
            $userId = $_SESSION['userId'];
            $itemId = $item['itemId'];
            $itemQty = $item['itemQty'];
            
            $sql = "INSERT INTO cat_orders (orderId, user_id, itemId, quantity, orderTotal, orderDate)
                    VALUES($lastOrderId, $userId, $itemId, $itemQty, $orderTotal, '$date')";
            
            print $sql;
            echo "<br>";
            
            $statement = $conn->prepare($sql);
            $statement->execute();
        }
        /*
        echo "<h4>Order Placed Succesfully!</h4>";
        echo "<form>";
        echo "<input type='hidden' name='done'>";
        echo '<button type="submit">Ok</button>';
        echo "</form>";
        
        if(isset($_GET['done']))
        {
            session_destroy();
            header('Location:index.php');
        }
        */
        session_destroy();
        header('Location:index.php');
    }
?>