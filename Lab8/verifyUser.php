<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
$statement = $connect->prepare($sql);
$data = array(":username" => $_POST['username'], ":password" => sha1($_POST['password']));
$statement->execute($data);
$user = $statement->fetch(PDO::FETCH_ASSOC);



//Checking credentials in database


//redirecting user to quiz if credentials are valid
if(isset($user['username'])){
    $_SESSION['username'] = $user['username'];
    header('Location: index.php');
}
else {
    echo "The values you entered were incorrect. <a href='login.php' >Retry</a>";
    

    
}
?>

<form method="POST" action="verifyUser.php">
    <input type="text" name="username" placeholder="Username"/><br />
    <input type="password" name="password" placeholder="Password" /> <br />
    <input type="submit" name="submit" value="Login"/>
</form>

