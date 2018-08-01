<?php
    session_start();
    
    include 'dbConnection.php';

    $conn = getDatabaseConnection();
    
    if(!isset($_SESSION['adminName']))
    {
        header("Location:login.php");
    }
    
    if(isset($_GET['itemId']))
    {
        $product = getProductInfo();
    }
    
    function getProductInfo()
    {
        global $conn;
        
        $sql = "SELECT *
                FROM cat_menuItems
                WHERE itemId = " . $_GET['itemId'];
                
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    function getCategories($courseId)
    {
        global $conn;
        
        $sql = "SELECT courseId, courseName
                FROM cat_menuCourse
                ORDER BY courseName";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $record)
        {
            echo "<option ";
            echo ($record['courseId'] == $courseId)?"selected": "";
            echo " value='" . $record['courseId'] . "'>" . $record['courseName'] . " </option>";
            
        }
    }
    
    if(isset($_GET['updateProduct']))
    {
        $sql = "UPDATE cat_menuItems
                SET itemName = :itemName,
                    itemDescription = :itemDescription,
                    productImage = :productImage,
                    price = :price,
                    courseId = :courseId
                WHERE itemId = :itemId";
        $np = array();
        $np[':itemName'] = $_GET['itemName'];
        $np[':itemDescription'] = $_GET['itemDescription'];
        $np[':productImage'] = $_GET['productImage'];
        $np[':price'] = $_GET['price'];
        $np[':courseId'] = $_GET['courseId'];
        $np[':itemId'] = $_GET['itemId'];
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        echo "Product has been updated!";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Product</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    </head>
    
    <body>
        <form>
            <input type="hidden" name="itemId" value="<?=$product['itemId']?>"/>
            <strong>Product Name</strong><input type="text" class="form-control" name="itemName" value="<?=$product['itemName']?>"><br>
            <strong>Image URL</strong><input type="text" class="form-control" name="productImage" value="<?=$product['productImage']?>"><br>
            <strong>Description</strong><textarea name="description" class="form-control" cols=50 rows=4><?=$product['itemDescription']?></textarea><br>
            <strong>Price</strong><input type="text" class="form-control" name="price" value="<?=$product['price']?>"><br>
            <strong>Category</strong><select name="catId" class="form-control">
                <option value="">Select One</option>
                <?php getCategories( $product['courseId'] ); ?>
            </select><br />\
            <input type="submit" name="updateItem" class='btn btn-primary' value="Update Item">
        </form>
        
    </body>
</html>