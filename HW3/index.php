<!DOCTYPE HTML>
<html lang="en">
<?php
    include 'functions.php';
?>
    <head>
	    <meta charset="utf-8">
	    <link rel="stylesheet" type="text/css" href="styles.css">
	    <title>Bankruptcy Form</title>
    </head>

    <body>
    <h1 class="heading">Bankruptcy Means Test</h1>
    <h2 class="subheading">Please fill out the form and hit submit</h2>
        <form>
            <!--Dropbox - How many people are living in your houselhold?  -->
            <p class="question">How many people are currently living with you?</p>
            <select name="livingwithyou" placeholder="# of People Living WIth You">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <br>

            <!--Are your debts primaarily consumer debts (as defined in 11 U.S.C. Section 101(8) -->
            <p class="question">Are your debts primarily consumer debts as defined in the United States Code, Section 101(8)?</p>
            <label for="yesconsumer">Yes</label>
            <input type="radio" name="consumer" id="yesconsumer" value="true">
            <label for="noconsumer">No</label>
            <input type="radio" name="consumer" id="noconsumer" value="false" checked><br>

            <!--Are you a disabled veteran and, if so, did you incur these debts while on active service? -->
            <p class="question">Are you a disabled veteran and, if so, did you incur the debt from the time you were in service?</p>
            <label for="yesdisabled">Yes</label>
            <input type="radio" name="disabled" id="yesdisabled" value="true">
            <label for="nodisabled">No</label>
            <input type="radio" name="disabled" id="nodisabled" value="false" checked><br>

            <!--Are you a member of the Army Reserve, or the National Guard? -->
            <p class="question">Are you a Reservist, or a member of the National Guard?</p>
            <label for="yesarmy">Yes</label>
            <input type="radio" name="army" id="yesarmy" value="true">
            <label for="noarmy">No</label>
            <input type="radio" name="army" id = "noarmy" value="false" checked><br>

            <br /><br />

            <h2 class="subheading">Please enter the amount of income you earn from the given activities per month.  Please use only numbers, no commas or dollar signs</h2>
            <!--1.  Maritial Status of filing -->
            <p class="question">Are you filing for bankruptcy with or without your spouse?</p>
            <label for="yesmarried">With Spouse</label>
            <input type="radio" name="married" id="yesmarried" value=true>
            <label for="nomarried">Without Spouse</label>
            <input type="radio" name="married" id = "nomarried" value=false><br><br>

            <!--2.  Gross Wages, salary, tips, bonuses overtime, comissions -->
            Gross Wages, Salary, Tips, Bonuses, Overtime, Commissions: <input type="text" name="startingincome" value="<?php echo isset($_GET['startingincome']) ? $_GET['startingincome'] : 0; ?>"><br><br>

            <!--3.  Alimony and maintenance payments -->
            Alimony and Maintenance Payments: <input type="text" name="alimony" value="<?php echo isset($_GET['alimony']) ? $_GET['alimony'] : '0'; ?>"><br><br>

            <!--4.  Amounts that other people pay you reguarily -->
            Money that other people pay you regularly: <input type="text" name='otherpeoplesmoney' value="<?php echo isset($_GET['otherpeoplesmoney']) ? $_GET['otherpeoplesmoney'] : '0'; ?>"><br><br>

            <!--5.  Net income from rental and other real property -->
            Net income from rental and other property: <input type="text" name="rentalincome" value="<?php echo isset($_GET['rentalincome']) ? $_GET['rentalincome'] : '0'; ?>"><br><br>

            <!--6.  Interest, dividends, royalties -->
            Income received from interest, dividends, royalties, etc: <input type="text" name="interestetc"  value="<?php echo isset($_GET['interestetc']) ? $_GET['interestetc'] : '0'; ?>"><br><br>

            <!--7.  Net income from business, profession, or farm -->
            Income from your own business, freelancing profession, or farm: <input type="text" name="businessincome" value="<?php echo isset($_GET['businessincome']) ? $_GET['businessincome'] : '0'; ?>""><br><br>

            <!--8.  Unemployment compensation -->
            Income received from unemployment compensation: <input type="text" name="unemployment" value="<?php echo isset($_GET['unemployment']) ? $_GET['unemployment'] : '0'; ?>""><br><br>

            <!--9.  Pension or retirment income -->
            Income received from pension and retirement: <input type="text" name="retirement"  value="<?php echo isset($_GET['retirement']) ? $_GET['retirement'] : '0'; ?>"><br><br>

            <!--10.  Income from all other sources not listed above  -->
            Income from all other sources not listed above: <input type="text" name="everythingelseincome"  value="<?php echo isset($_GET['everythingelseincome']) ? $_GET['everythingelseincome'] : '0'; ?>"><br><br>
            <div class="submitwrapper">  
            <input type="submit" name=Submit value="Submit"/>
            </div>
        <?php
        didipass();
        ?>
        </form>
        <footer>
        <img src="img/csumblogo.png" alt="CSUMB logo">
        <p>This website is not meant to replace legal advice.  Please seek an attorney if you are planning on filing bankruptcy</p></footer> 

    </body>
</html>
