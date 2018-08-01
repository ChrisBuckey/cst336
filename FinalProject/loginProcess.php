<?php

    //using session varaibles to store admin name and display on other pages
    session_start();
    
    include "dbConnection.php";
    
    $conn = getDatabaseConnection("catalan");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    echo $username;
    $sql;
    
    //Login with admin username querying admin db
    if($username == "admin")
    {
        $sql = "SELECT * FROM cat_admin where username = :username AND password = :password";
    }
    
    //Regular user login
    else
    {
        $sql = "SELECT * FROM cat_user where email = :username AND password = :password";
    }
    //integrate this with database
    //$sql = "SELECT * FROM cat_admin where username = :username AND password = :password";
    
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    echo $sql;

    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (empty($record)){
        $_SESSION['incorrect'] = true;
        header("Location:login.php");
    }
    //elseif($_SESSION['incorrect'] = false && $_SESSION['adminName'] == $record['firstName'] . " " > $record['lastName'])
    elseif($username == "admin"){
        $_SESSION['incorrect'] = false;
        $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName']; 
        header("Location:admin.php");
    }
    else{
        $_SESSION['incorrect'] = false;
        $_SESSION['userName'] = $record['firstName'] . " " . $record['lastName'];
        $_SESSION['userId'] = $record['userId'];
        header("Location:menu.php");
    }
?>