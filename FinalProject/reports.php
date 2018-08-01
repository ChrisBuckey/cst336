<?php
    session_start();
    
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    if(!isset($_SESSION['adminName']))
    {
        header("Location:login.php");
    }
    
    function displayAverageCostofOrders()
    {
        global $conn;
        $sql="SELECT ROUND(AVG(orderTotal), 2) AS SQLAVG FROM `cat_orders`";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    function displayMostExpensiveOrder()
    {
        global $conn;
        $sql="SELECT orderTotal, orderId, quantity FROM `cat_orders` JOIN cat_menuItems WHERE cat_orders.itemId = cat_menuItems.itemId ORDER BY orderTotal DESC";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    function displayMostPopularItem()
    {
        global $conn;
        $sql="SELECT COUNT(cat_orders.itemId) AS total, itemName FROM cat_orders JOIN cat_menuItems where cat_orders.itemId = cat_menuItems.itemId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    function displayAveragePriceofAllItems()
    {
        global $conn;
        $sql="SELECT ROUND(AVG(price), 2) AS SQLAVG FROM `cat_menuItems`";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    function displayMostFrequentUser()
    {
        global $conn;
        $sql="SELECT COUNT(cat_orders.user_id) AS totalOrders, firstName, lastName FROM cat_orders JOIN cat_user where cat_orders.user_id = cat_user.userId GROUP BY user_id";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reports Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">-->
    </head>
    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Admin Access</a> 
            </div>
            <ul class="nav navbar-nav">
              <li><a href="admin.php">Admin Home</a></li>
              <li><a href="addProduct.php">Add Product</a></li>
              <li class="active"><a href="reports.php">Reports</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </nav>
        
        <?php
            echo "<table class='table table-hover'>";
            echo "<tbody>";
            
            //Average cost of all orders
            $averageOrders = displayAverageCostofOrders();
            echo "<tr>";
            echo "<td>Average Cost of all Orders</td>";
            echo "<td></td>";
            echo "<td>$". $averageOrders["SQLAVG"] . "</td>";
            echo "</tr>";
            
            //Most expensive order
            $mostExpensive = displayMostExpensiveOrder();
            echo "<tr>";
            echo "<td>Most Expensive Order</td>";
            echo "<td>Order Id: " . $mostExpensive['orderId'] ."</td>";
            echo "<td>$" . $mostExpensive['orderTotal'] . "</td>";
            echo "</tr>";
            
            //Most popular item
            $mostPopular = displayMostPopularItem();
            echo "<tr>";
            echo "<td>Most Popular Item</td>";
            echo "<td>" . $mostPopular['itemName'] . "</td>";
            echo "<td>" . $mostPopular['total'] . " orders</td>";
            echo "</tr>";
            
            //Average cost of all Items
            $averageItems = displayAveragePriceofAllItems();
            echo "<tr>";
            echo "<td>Average Cost of all Menu Items</td>";
            echo "<td></td>";
            echo "<td>$". $averageItems["SQLAVG"] . "</td>";
            echo "</tr>";
            
            //Most Frequent USer
            $frequentUser = displayMostFrequentUser();
            echo "<tr>";
            echo "<td>Most Frequent Customer</td>";
            echo "<td>" . $frequentUser['firstName'] . " " . $frequentUser['lastName'] . "</td>";
            echo "<td>Total Orders: ". $frequentUser['totalOrders'] . "</td>";
            echo "</tr>";
            
            echo "</tbody>";
            echo "</table>";
        ?>
    </body>
</html>
