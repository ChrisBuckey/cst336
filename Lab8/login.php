<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>Login</h1>
        <h2>Credentials required before submiting form.</h2>
        <p>You can log in using usernames <strong>user_1</strong> or <strong>user_2</strong>. The password is <strong>s3cr3t</strong>.</p>
        
        <!--Form to enter credentials-->
        <form method="POST" action="verifyUser.php">
            <input type="text" name="username" placeholder="Username"/><br />
            <input type="password" name="password" placeholder="Password"/><br />
            <input type="submit" name="submit" placeholder="Login"/><br />
        </form>
    </body>
</html>