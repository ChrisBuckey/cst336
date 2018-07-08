<?php
        
    function meanstestmilitary(){
        
        $disabled = "false";
        $army = "false";
        $consumer = "false";
        
        if(isset($_GET['consumer'])){
            $consumer = $_GET['consumer'];
        }
        if(isset($_GET['disabled'])){
            $disabled = $_GET['disabled'];
        }
        if(isset($_GET['army'])){
            $army = $_GET['army'];
        }   
        if ($disabled=="true" || $army=="true" || $consumer=="true"){
            $meanstestmilitary = true;
        }
        else{
            $meanstestmilitary = false;
        }

        return $meanstestmilitary;
    }

    
    function calculateincome(){
        //define variables
        $startingincome = 0;
        $alimony = 0;
        $otherpeoplesmoney = 0;
        $rentalincome = 0;
        $interest = 0;
        $businessincome = 0;
        $unemploy = 0;
        $retire = 0;
        $everythingelse = 0;
        
        //validate input and fill variables
        if(isset($_GET['startingincome'])){
            $startingincome=$_GET['startingincome'];
        }
        if(isset($_GET['alimony'])){
            $alimony = $_GET['alimony'];
        }
        if(isset($_GET['otherpeoplesmoney'])){
            $otherpeoplesmoney = $_GET['otherpeoplesmoney'];
        }
        if(isset($_GET['rentalincome'])){
            $rentalincome = $_GET['rentalincome'];
        }
        if(isset($_GET['interestetc'])){
            $interest = $_GET['interestetc'];
        }
        if(isset($_GET['businessincome'])){
            $businessincome = $_GET['businessincome'];
        }
        if(is_numeric($_GET['unemployment'])){
            $unemploy = $_GET['unemployment'];
        }
        if(isset($_GET['retirement'])){
            $retire = $_GET['retirement'];
        }
        if(isset($_GET['everythingelseincome'])){
            $everythingelse = $_GET['everythingelseincome'];
        }


        
        //add up the means of income to get the total monthly income
        $totalincome = $startingincome + $alimony + $otherpeoplesmoney + $rentalincome + $interest + $businessincome + $unemploy + $retire + $everythingelse;

        //multiply monthly income by 12 to get annual income
        $annualincome = $totalincome * 12;

        return $annualincome;
    }
    
    function compareincometoaverage(){
        //census bureau median family income by family size
        $averageincome = array(54787, 73162, 79061, 91349, 99749, 108149, 116549, 124949, 133349, 141749, 150149, 158549);
        
        $numberliving = $_GET['livingwithyou'];
        $annualincome = calculateincome();
        //compare annual income to median family income
        if($averageincome[$numberliving] < $annualincome){
            $financialmeanstest = "false";
        }
        else{
            $financialmeanstest = "true";
            }
        return $financialmeanstest;
    }

    function didipass(){
        if(isset($_GET['Submit'])){
            $military = meanstestmilitary();
            $compare = compareincometoaverage();
            $annualincome = calculateincome();
        
             echo "'<p class='result'>Your annual income is $$annualincome</p><br />'";
        
             if($_GET['consumer']=="true"){
                echo"<p class='result'>As a possessor of mostly non-consumer debts, you are exempt from the means test</p><br /><br />";
             }
             if($_GET['disabled']=="true"){
                echo"<p class='result'>As a disabled member of the military, you are exempt from the means test</p><br /><br />";
             }
             if($_GET['army']=="true"){
                echo"<p class='result'>As a member of the Reserve or National Guard, you are exempt from the means test</p><br /><br />";
             }       
             if($compare=="true"){ 
                echo "<p class='result'>Your income is below the average median.</p><br /><br />";
             }
             if($military=="true" || $compare=="true"){
                echo "<p class='result'>You may proceed with your bankruptcy.</p><br /><br />";
             }       
             if($military=="false" && $compare=="false"){
                echo "<p class='result'>You have failed the means test.  However, there are still several options you might want to consider in order to move forward with your bankruptcy.  Please contact a licensed bankruptcy attorney for details.</p><br /><br />";
             }
        }
        else{
        //do nothing
        }
    }
?>
