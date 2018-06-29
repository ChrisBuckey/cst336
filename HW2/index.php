<!DOCTYPE html>
<html>
    <?php 
    include 'functions.php';
    ?>
    <head>
        <meta charset="UTF-8" lang="en">
        <link href="css/styles.css" rel="stylesheet">
        <title>Deal Me Some Cards</title>
    </head>
    <body>
        <h1 class="welcome">Welcome to the Casino</h1>
        
        <div id="main">
            <?php 
                displayCards(); 
            ?>  
            <form>
            <input type="submit" value="Deal!!" />
            </form> 
        </div>       
    </body>
</html>
