<?php
    session_start();

    include 'dbConnection.php';

    $conn = getDatabaseConnection();
    
     if(!isset($_SESSION['adminName']))
    {
        header("Location:login.php");
    }
    
    function getCategories()
    {
        
        global $conn;
        
        $sql = "SELECT courseId, courseName FROM cat_menuCourse ORDER BY courseName";
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($records as $record)
        {
            echo "<option value'" . $record["courseId"] ."'>" . $record['courseName'] . " </option>";
        }
    }
    
    
    if(isset($_GET['submitItem']))
    {
        $itemName = $_GET['itemName'];
        $itemDescription = $_GET['description'];
        
        $itemPrice = $_GET['price'];
        $courseId = $_GET['courseId'];
        $productImage = $_GET['productImage'];
        $sql = "INSERT INTO cat_menuItems
                ( itemName, itemDescription, productImage, price, courseId )
                VALUES ( :itemName, :itemDescription, :productImage, :price, :courseId)";
                
        $namedParameters = array();
        $namedParameters[':itemName'] = $itemName;
        $namedParameters[':itemDescription'] = $itemDescription;
        $namedParameters[':productImage'] = $productImage;
        $namedParameters[':price'] = $itemPrice;
        $namedParameters[':courseId'] = $courseId;
        $statement = $conn->prepare($sql);
        $statement->execute($namedParameters);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Item</title>
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   
    </head>
    
    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Admin Access</a> 
            </div>
            <ul class="nav navbar-nav">
              <li><a href="admin.php">Admin Home</a></li>
              <li class="active"><a href="addProduct.php">Add Product</a></li>
              <li><a href="reports.php">Reports</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </nav>
    <br />
    
        <form>
            <strong>Item Name</strong><input type="text" class="form-control" name="itemName"><br>
            <strong>Description</strong><textarea name="description" class="form-control" cols=50 rows=4></textarea><br>
            <strong>Price</strong><input type="text" class="form-control" name="price"><br>
            <strong>Category</strong><select name="courseId" class="form-control">
                <option value="">Select One</option>
                <?php getCategories(); ?>
            </select><br />
            <input type="submit" name="submitItem" class='btn btn-primary' value="Add Item">
        </form>
        
    </body>
</html>