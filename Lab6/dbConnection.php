<?php
function getDatabaseConnection($dbname = 'ottermart'){
    $host = 'localhost';
    $username = 'root';
    $password = '';
    
    //creates dbconnection
    $dbconn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    
    //display errors when accessing tables
    $dbconn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbconn;
}
?>

