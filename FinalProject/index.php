<?php
    session_start();
    
    include "dbConnection.php";
    
    $conn = getDatabaseConnection("catalan");
    
    function getAllImages()
    {
        global $conn;
        //$sql = "SELECT itemId, productImage FROM `cat_menuItems`";
        $sql = "SELECT productImage FROM `cat_menuItems`";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $itemURLs = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $itemURLs;
    }
    
    $urls = getAllImages();
    $numURLs = 0;
    foreach($urls as $url)
    {
        if(!empty($url['productImage']))
        {
            $numURLs++;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>To Go Orders: Catalan</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>@import url("css/styles.css");</style>
    </head>
    <body id="homePage">
        <div class="jumbotron text-center">
          <img src="./Images/catalanlogo.jpg" alt="catalanlogo" class="img-circle" width="304" height="236">
        </div>
        
        <!--Login Process-->
        <div class="instructions">
        <h3><font color="white">Please Log In To Order</font></h3>
        <div id="loginBox">
        <form method="post" action="loginProcess.php">
            <input type="text" name="username" placeholder="UserName"/>
            <input type="password" name="password" placeholder="Password"/>
            <br>
            <button class="btn btn-primary" type="submit" value="Login">Login</button>
        </form>
        </div>
        </div>
        
        <br/>
        
        <!--Image Carousel-->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators Here -->
            <ol class="carousel-indicators">
                <?php
                    for ($i=0; $i< $numURLs; $i++)
                    {
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i==0)?" class='active'": "";
                        echo "></li>";
                    }
                ?>
            </ol>
                
            <!-- Wrapper for Image -->
            <div class="carousel-inner" role="listbox">
                <?php
                    $i = 0;
                    foreach($urls as $url)
                    {
                        if(!empty($url['productImage']))
                        {
                            echo '<div class="item ';
                            echo ($i==0) ? "active" : "";
                            echo '">';
                            echo '<img class="img-responsive center-block" src="' . $url['productImage'] . '">';
                            echo '</div>';
                            $i++;
                        }
                    }
                ?>
            </div>
                
            <!-- Controls Here -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
        <!-- This is the footer -->
        <footer>
            <hr id="hr_footer">
                CST 336 Internet Programming. 2018&copy; Buckey, Gonzalez, Holmes<br />
                <strong>Disclaimer:</strong> The information in this webpage is fictious.<br />
                It is used for academic purposes only.
                
                <figure id="csumb">
                    <img src="Images/csumb_logo.png" alt="CSUMB Logo">
                </figure>
            
        </footer>
        <!-- closing footer -->
        
     <!-- link both the CSS and JS libraries for Bootstrap.-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
    </body>
</html>