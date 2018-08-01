<?php
function getDatabaseConnection($dbname = 'catalan'){
    $host = 'localhost';
    $username = 'root';
    $password = '';
    
        //when connecting from Heroku
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 

    //creates dbconnection
    $dbconn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    
    //display errors when accessing tables
    $dbconn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbconn;
}
?>

