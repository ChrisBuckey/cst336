<?php
include 'dbConnection.php';

$conn = getDatabaseConnection("ottermart");

function displayCategories(){
    global $conn;
    
    $sql = "SELECT catID, catName from om_category ORDER BY catName";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($records as $record){
        echo "<option value='".$record["catId"]."'>" . $record["catName"] . "</option>";
    }
}

function displaySearchResults(){
    global $conn;
    
    if (isset($_GET['searchForm'])){
        echo "<h3>Products Found: </h3>";
        //Query below prevents SQL injection
        
        $namedParameters = array();
        
        $sql = "Select * FROM om-product WHERE 1";
        
        if(!empty($_GET['product'])){
            $sql .= " AND productName LIKE :productName";
            $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
        }
        
        if(!empty($_GET['category'])){
            $sql .= " AND catId LIKE :categoryId";
            $namedParameters[":categoryId"] = $_GET['category'];
        }
        
        if(!empty($_GET['priceFrom'])){
            $sql .= " AND price >= :priceFrom";
            $namedParameters[":priceFrom"] = $_GET['priceFrom'];
        }
        
        if(!empty($_GET['priceTo'])){
            $sql .= " AND price <= :priceTo";
            $namedParameters[":priceTo"] = $_GET['priceTo'];
        }
        
        if(isset($_GET['orderBy'])){
            if($_GET['orderBy'] == "price"){
                $sql .= " ORDER BY price";
            }
            else{
                $sql .= " ORDER BY productName";
            }
        }        
        //fetch the data
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
            
            echo "<a href=\"purchaseHistory.php?productId=".$record["productId"] . "\"> History </a>";
            
            echo $record["productName"] . " " . $record["product Description"] . " $" . $record["price"] . "<br /><br />";
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
	    <meta charset="utf-8">
	    <title>Ottermart Product Search</title>
	    <link href="css/styles.css" rel="stylesheet" type="text/css" />
	
	</head>

    <body>
        <div>
            <h1> OtterMart Product Search </h1>
        
            <form>
                Product: <input type="text" name="product" />
                <br>
                Category:
                    <select name="category">
                        <option value="">Select One</option>
                        <?=displayCategories()?>
                    </select>
                <br>
                Price From <input type="text" name="priceFrom" size="7"/>
                      To   <input type="text" name="priceTo" size="7"/>
                <br>      
                Order result by:
                <br>
                
                <input type="radio" name="OrderBy" value="price"> Price <br>
                <input type="radio" name="OrderBy" value="name"> Name    

                <br><br>
                <input type="submit" value="search" name="searchform" />
            </form>
    
            <br />
    
        </div>
    
        <hr>
    <?= displaySearchResults() ?>
    </body>
</html>
