<?php

    session_start();
    
    include "dbConnection.php";
    
    $conn = getDatabaseConnection("catalan");
    
    if(!isset($_SESSION['userId']))
    {
        header('Location:index.php');
    }
    
    function displayCourses(){
        global $conn;
        $sql = "Select courseName, courseId FROM cat_menuCourse order by courseId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $courses = $statement->fetchAll(PDO::FETCH_ASSOC);

        //echo "<option>Select a Course, Good Sir</option>";
        foreach ($courses as $foodCategory){
            echo "<option value='".$foodCategory["courseId"]."'>" . $foodCategory["courseName"] . "</option>";
        }
    }
    
    function displaySearchResults(){
        global $conn;
        if (isset($_GET['searchForm'])){
        echo "<h3>Here is Your Food! </h3>";
        
        //Query below prevents SQL injection
        
        $namedParameters = array();
        
        $sql = "SELECT * FROM cat_menuItems WHERE 1";
        
        if(!empty($_GET['foodsearch'])){
            $sql .= " AND itemName LIKE :itemName";
            $namedParameters[":itemName"] = "%" . $_GET['foodsearch'] . "%";
        }
        
        if(!empty($_GET['courseId'])){
            $sql .= " AND courseId = :courseId";
            $namedParameters[":courseId"] = $_GET['courseId'];
        }
        
        if(!empty($_GET['priceFrom'])){
            $sql .= " AND price >= :priceFrom";
            $namedParameters[":priceFrom"] = $_GET['priceFrom'];
        }
        
        if(!empty($_GET['priceTo'])){
            $sql .= " AND price <= :priceTo";
            $namedParameters[":priceTo"] = $_GET['priceTo'];
        }
        
        if(!empty($_GET['orderBy'])){
            if($_GET['orderBy'] == "price"){
                $sql .= " ORDER BY price";
            }
            else{
                $sql .= " ORDER BY itemName";
            }
        }

        //fetch the data
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $foodquery = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
         echo "<table>";
        foreach($foodquery as $foodItem)
        {
                $itemName = $foodItem['itemName'];
                $itemPrice = $foodItem['price'];
                $itemImage = $foodItem['productImage'];
                $itemId = $foodItem['itemId'];
				$itemDescription = $foodItem['itemDescription'];
                
                //Display item as table row
                echo '<tr>';
                echo "<td><img src='$itemImage'></td>";
                echo "<td><h4>$itemName</h4></td>";
				echo "<td><h4>$itemDescription</h4></td>";
                echo "<td><h4>$$itemPrice</h4></td>";
                
                // Hidden input element containing the item name
                //a button for each item to add it to the shopping cart.   
                //Each item will need to contain its own form so that when one 
                //of the buttons is pressed, the information sent to  the program is specific to that item.
                echo "<form class='form-item'>";
                
                echo "<input type='hidden' name='itemName' value='$itemName'>";
				echo "<input type='hidden' name='itemDescription' value='$itemDescription'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<input type='hidden' name='itemImage' value='$itemImage'>";
                echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
                
                // Check to see if the most recent POST request has the same itemId
                // If so, this item was just added to the cart. Display different button.
                if($_GET['itemId'] == $itemId){
                    echo "<td><input type='text' size='2' maxlength='2' name='itemQty' value='1'/>";
                    echo "<input name='itemId' type='hidden' value=" .$foodItem['itemId'] .">";
                    echo "<button type='submit' id='addToCart' value='Add to Cart' class='btn btn-success'>Added</button></td>";
                }else{
                    echo "<td><input type='text' size='2' maxlength='2' name='itemQty' value='1'/>";
                    echo "<input name='itemId' type='hidden' value=" .$foodItem['itemId'] .">";
                    echo "<button type='submit' id='addToCart' value='Add to Cart' class='btn btn-warning'>Add</button></td>";
                }
                echo "</tr>";
                echo"</form>";
        }
        echo "</table>";
        
    }
    
}

function displayCartCount(){
        echo count($_SESSION['cartProducts']);
    }
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Menu Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
	<style>@import url("css/styles.css");</style>
	<!--<link rel="stylesheet" type="text/css" href="./css/styles.css">-->
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
      
	<script type="text/javascript" src="cart.js"></script>
</head>

<body id="menuBody">
    <div id="menu">
    <!-- Bootstrap Navagation Bar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewCart.php">Cart</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="menu.php">Menu</a>
          </li>
        </ul>
      </div>
    </nav>
                
    
        <div class="jumbotron text-center">
    <h1>Welcome <?=$_SESSION['userName']?>!</h1><br/>
    <h3>Please select the items you'd like to order.</h3>
    </div>
	
    <br />
				
    <form>
        Search Menu: Product: <input type="text" name="foodsearch" value=""/><br />
        Select a course: 
        <select name="courseId">
            <option value = ""></value>
            <?php displayCourses() ?>
        </select>
        <br>
        Price From <input type="text" name="priceFrom" size="7"/>
              To   <input type="text" name="priceTo" size="7"/>
        <br>      
        Order result by:
        <br>
        <input type="radio" name="orderBy" value="price"> Price <br>
        <input type="radio" name="orderBy" value="name"> Name    
        <br><br>
        <div class="submitwrapper">
        <input type="submit" value="Search" name="searchForm" />
        </div>
    </form>
    </div>
    
    <div id="results">
    <?php displaySearchResults() ?>
    </div>
    
    <a href="#" class="cart-box" id="cart-info" title="View Cart">
    <?php 
    if(isset($_SESSION["cartProducts"]))
    {
        echo count($_SESSION["cartProducts"]); 
    }
    else
    {
        echo 0; 
    }
    ?>
    </a>
    <div class="shopping-cart-box">
        <a href="#" class="close-shopping-cart-box" >Close</a>
        <h3>Your Shopping Cart</h3>
        <div id="shopping-cart-results"></div>
    </div>
</body>
</html>
