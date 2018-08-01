<php


?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
    <img src="./Images/catalanlogo.jpg" alt="catalanlogo" class="welcome">
    <br><br>
    <img src="./Images/catalanfood.jpg" alt="pictureoffood" class="welcome">
    <br><br>
    <div class="instructions">
    <h3>Please Log In To Order</h3>
    <form method="POST" action="loginProcess.php">
        <input type="text" name="username" placeholder="UserName"/>
        <input type="password" name="password" placeholder="Password"/>
        <input type="submit" value="Login" />
    </form>
    </div>
</body>
</html>
