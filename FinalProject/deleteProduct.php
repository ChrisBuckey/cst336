<?php
    session_start();
    
    include 'dbConnection.php';

    $conn = getDatabaseConnection();
    
    if(!isset($_SESSION['adminName']))
    {
        header("Location:login.php");
    }
    
    $sql = "DELETE FROM cat_menuItems WHERE itemId = " . $_GET['itemId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location:admin.php");

?>