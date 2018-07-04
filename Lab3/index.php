<?php
    $backgroundImage="img/sea.jpg";
    
    
    if(empty($_GET['keyword']) && empty($_GET['category'])){
        echo "Please enter a keyword or a layout";
    }
    elseif(empty($_GET['keyword'])){  //if user selects category, searches for category
        include 'api/pixabayAPI.php';
        $keyword = $_GET['category'];
        $imageURLs = getImageURLs($_GET['category'], $_GET['layout']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)]; //sets background image with random image from collected images
    }
    elseif (empty($_GET['category'])){  //if user selects keyword, searches for keyword
        include 'api/pixabayAPI.php';
        $keyword = $_GET['keyword'];
        $imageURLs = getImageURLs($_GET['keyword'], $_GET['layout']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)]; //sets background image with random image from collected images
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <style>
            @import url("css/styles.css");
            body{
                background-image: url(<?=$backgroundImage?>);  
            }          
        </style>      
    </head>
    <body>
        <br>
        <?php
            if(!isset($imageURLs)){
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            }
            else{
        
        ?>
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-inner" role="listbox">
                <?php
                for($i=0; $i < 7; $i++){ //enter keyword, see first five search results
                    echo"<li data-target='#carousel-example-generic' data-slide-to='$i'";
                    echo($i==0) ? "class='active'" : "";
                    echo "></li>";
                }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
            <?php
                for($i=0; $i < 7; $i++){
                    do{
                        $randomIndex = rand(0,count($imageURLs));
                    } while(!isset($imageURLs[$randomIndex]));
                    echo '<div class"item ';
                    echo ($i==0) ? "active" : "";
                    echo '">';
                    echo '<img src="' . $imageURLs[$randomIndex] . '">';
                    echo '</div>';
                    unset($imageURLs[$randomIndex]);
                }
            ?>
        </div>    
            
        <!--Controls-->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="Next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
        <?php
        }
        ?>
        <br>
        
        <form>
            <input type="text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>  <!--keyword input-->
            <input type="radio" id="lhorizontal" name="layout" value="horizontal">  <!--radio button for horizontal-->
            <label for="Horizontal"></label><label for="lhorizontal">Horizontal</label>
            <input type="radio" id="lvertical" name="layout" value="vertical">  <!--radio button for vertical-->
            <label for="Vertical"></label><label for="lvertical">Vertical</label>

            <select name = "category">  <!--dropdown menu for input-->
                <option value ="">Select One</option>
                <option value="Ocean">Sea</option>
                <option value="Forest">Forest</option>
                <option value="Mountain">Mountain</option>
                <option value="Snow">Snow</option>
                <option value="Birds">Birds</option>
            </select>
            <input type="submit" value="Search"/>
        </form>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
