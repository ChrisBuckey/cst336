<?php
	session_start();
	include 'dbConnection.php';
	
	$conn = getDatabaseConnection();
	
	if(!isset($_SESSION['adminName']))
	{
		header("Location:login.php");
	}
	
	function displayAllProducts()
	{
		global $conn;
		$sql = "SELECT * FROM cat_menuItems ORDER BY itemId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
	}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
	<h3>Welcome <?=$_SESSION['adminName']?>!</h3><br/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
	<style type="text/css">
		li {display: inline;}
	</style>
	<script>
        function confirmDelete()
        {
            return confirm("Are you sure you want to delete the product?");
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Admin Access</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="admin.php">Admin Home</a></li>
              <li><a href="addProduct.php">Add Product</a></li>
              <li><a href="reports.php">Reports</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </nav>
    <br />
    
    <?php
    	$records = displayAllProducts();
        echo "<table class='table table-hover'>";
        echo "<thead>
        	    <tr>
            	    <th scope='col'>Item ID</th>
                	<th scope='col'>Name</th>
                    <th scope='col'>Description</th>
                    <th scope='col'>Image</th>
                    <th scope='col'>Price</th>
                    <th scope='col'>Course ID</th>
                    <th scope='col'>Update</th>
                    <th scope='col'>Remove</th>
                </tr>
            </thead>";
        echo "<tbody>";
        foreach($records as $record)
        {
            echo "<tr>";
            echo "<td>" . $record['itemId'] . "</td>";
            echo "<td>" . $record['itemName'] . "</td>";
            echo "<td>" . $record['itemDescription'] . "</td>";
            echo "<td><img src=" . $record['productImage'] . "></td>";
            echo "<td>$" . $record['price'] . "</td>";
            echo "<td>" . $record['courseId'] . "</td>";
            echo "<td><a class='btn btn-primary' href='updateProduct.php?itemId=" . $record['itemId'] . "'>Update</a></td>";
                
            echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
            echo "<input type='hidden' name='itemId' value= " . $record['itemId'] . " />";
            echo "<td><input type='submit' class='btn btn-danger' value='Remove'></td>";
            echo "</form>";
        }
            
        echo "</tbody>";
        echo "</table>";
    ?>

</body>
</html>