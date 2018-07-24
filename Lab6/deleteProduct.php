<?php
    include "dbConnection.php";
    
    $conn = getDatabaseConnection("ottermart");

    $sql = "DELETE FROM om_product WHERE productId = " . $_GET['productId'];
    $statement = $conn->prepare($sql);
    $statement->execute();
    
    header("Location: admin.php");
?>
