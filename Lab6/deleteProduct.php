<?php
    include "dbConnection.php";
    
    $conn = getDatabaseConnection("ottermart");

    $sql = "DELETE FROM om_product WHERE productId = " . $_GET['productId'];
    $statement = $conn->prepare($sql);
    $statement->execute();
    
    header("Location: admin.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Delete a Product</title>
</head>

<body>
    <script>
        function confirmDelete(){
            return comfirm("Are you sure you want to delete the product?");
        }
    </script>
</body>
</html>