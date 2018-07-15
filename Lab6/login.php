<?php
    session_start();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>

<body>

    <form method="POST" action="loginProcess.php">
        Username: <input type="text" name="username"/> <br />
        Password: <input type="password" name="password"/> <br />
        <input type="submit" name="submitForm" value="Login!" />
        <br /><br />
        
        <?php
            if($_SESSION['incorrect']){
                echo "<p class = 'lead' id = 'error' style='color:red'>";
                echo "<strong>Incorrect Username or Password!</strong></p>";
            }
        ?>
    </form>


</body>
</html>
