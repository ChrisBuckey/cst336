console.log("Javascript Loaded!");

//Variables
var startingincome = 0;
var alimony = 0;
var otherpeoplesmoney = 0;
var rentalincome = 0;
var interest = 0;
var businessincome = 0;
var unemploy = 0;
var retire = 0;
var everythingelse = 0;

//calculate the income of the user
function calculateIncome() {
    startingincome = $(".startingincome").val();
    alimony = $(".alimony").val();
    otherpeoplesmoney = $(".freeloadin").val();
    rentalincome = $(".rentalincome").val();
    interest = $(".interestetc").val();
    businessincome = $(".businessincome").val();
    unemploy = $(".unemployment").val();
    retire = $(".retirement").val();
    everythingelse = $(".everythingelseincome").val();
    
    var totalincome = parseFloat(startingincome) + parseFloat(alimony) + parseFloat(otherpeoplesmoney) + parseFloat(rentalincome) + parseFloat(interest) + parseFloat(businessincome) + parseFloat(unemploy) 
    + parseFloat(retire) + parseFloat(everythingelse);
    
    return parseFloat(totalincome);
}

//calculate if user has passed the means test based on their membership or certain criteria
function membershipMeansTest(){
    var meansTest = false;
    
    if($("input[type=radio][name=consumer]:checked").val() == "yes"){
        meansTest = true;
    }
    else if($("input[type=radio][name=disabled]:checked").val() == "yes"){
        meansTest = true;
    }
    else if($("input[type=radio][name=army]:checked").val() == "yes"){
        meansTest = true;
    }
    return meansTest;
}

//calculate if user has passed the means test based on their income
function calculateFinancialMeans(){
    var financialmeanstest = false;
    
    var averageincome = [54787, 73162, 79061, 91349, 99749, 108149, 116549, 124949, 133349, 141749, 150149, 158549];
    var income = calculateIncome();
    
    var livingwithyou = $("select.livingwithyou option:checked").val();
    
    if (averageincome[livingwithyou] > income){
        financialmeanstest = true;
    }
    return financialmeanstest;
    
}

function calculateMeans(){
    $('#results').empty(); //empty the results div every time the button is clicked
    
    var passMembership = membershipMeansTest();
    var passFinance = calculateFinancialMeans();
    
    if(passMembership == true){ //pass
        $("#results").append("<span class='results'>Based on your criteria, you passed the means test!</span> <br/>");
    }
    else if(passFinance == true){  //pass
        $("#results").append("<span class='results'>Based on your income, you passed the means test!</span>");
    }
    else{  //fail
        $("#results").append("<span class='results'>You did not pass the means test.  However, you might have other options regarding bankruptcy.  Please consult a lawyer for details.</span>");
    }
}
