<?php
include "dbConnection.php";
    
$conn = getDatabaseConnection("ottermart");

    function getCategories(){
        global $conn;
        
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record){
            echo "<option value='".$record["catId"]."'>".$record['catName'] ." </option>";
        }
    }
    
    if(isset($_GET['submitProduct'])){
        $productName = $_GET['productName'];
        $productDescription = $_GET['description'];
        $productImage = $_GET['productImage'];
        $productPrice = $_GET['price'];
        $catId = $_GET['catId'];
        
        $sql = "INSERT INTO om_product (
                    productName, productDescription, productImage, price, catId)
                    VALUES (:productName, :productDescription, :productImage, :price, :catId)";
        
        $namedParameters = array();
        $namedParameters[':productName'] = $productName;
        $namedParameters[':productDescription'] = $productDescription;
        $namedParameters[':productImage'] = $productImage;
        $namedParameters[':price'] = $productPrice;
        $namedParameters[':catId'] = $catId;

        $statement = $conn->prepare($sql);
        $statement->execute($namedParameters);
    }
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
	    <meta charset="utf-8">
	    <title>Add A Product</title>
    </head>

    <body>
        <form>
        <strong>Product Name</strong><input type="text" class="form-control" name="productName"><br>
        <strong>Description</strong><textarea name="description" class="form-control" cols = 50 rows = 4></textarea><br>
        <strong>Price</strong><input type="text" class="form-control" name="price"><br>
        <strong>Category</strong><select name="catId" class="form-control">
            <option value="">Select One</option>
            <?php getCategories(); ?>
        </select><br>
        <strong>Set Image URL</strong> <input type="text" name="productImage" class="form-control"><br />
        <input type="submit" name="submitProduct" class='btn btn-primary' value="Add Product">
        </form>
    </body>
</html>
    

