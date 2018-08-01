//Add Item to Cart
$(document).ready(function()
{
    $(".form-item").submit(function(e)
    {   //user clicks form submit button
        var form_data = $(this).serialize(); //prepare form data for Ajax post
        var button_content = $(this).find('button[type=submit]'); //get clicked button info
        button_content.html('Adding...'); //Loading button text //change button text 
        
        $.ajax(
        {   //make ajax request to cartProcess.php
            url: "cartProcess.php",
            type: "POST",
            dataType:"json", //expect json value from server
            data: form_data
        }).done(function(data)
        {   //on Ajax success
            $("#cart-info").html(data.items); //total items count fetch in cart-info element
            button_content.html('Add to Cart'); //reset button text to original text
            alert("Item added to Cart!"); //alert user
            if($(".shopping-cart-box").css("display") == "block")
            {   //if cart box is still visible
                $(".cart-box").trigger( "click" ); //trigger click to update the cart box.
            }
        })
        e.preventDefault();
    });
});

//Remove items from cart
$(document).ready(function()
{
    $("#shopping-cart-results").on('click', 'a.remove-item', function(e)
    {
        e.preventDefault(); 
        var pcode = $(this).attr("data-code"); //get product code
        $(this).parent().fadeOut(); //remove item element from box
        $.getJSON( "cartProcess.php", {"removeCode":pcode} , function(data)
        {   //get Item count from Server
            $("#cart-info").html(data.items); //update Item count in cart-info
            $(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
        });
    });
});

//Show Items in Cart
$(document).ready(function()
{
    $( ".cart-box").click(function(e)
    {   //when user clicks on cart box
        e.preventDefault(); 
        $(".shopping-cart-box").fadeIn(); //display cart box
        $("#shopping-cart-results").html('<img src="Images/ajax-loader.gif">'); //show loading image
        $("#shopping-cart-results" ).load( "cartProcess.php", {"loadCart":"1"}); //Make ajax request using jQuery Load() & update results
    });
});

//Close Cart
$(document).ready(function()
{
    $( ".close-shopping-cart-box").click(function(e)
    {   //user click on cart box close link
        e.preventDefault(); 
        $(".shopping-cart-box").fadeOut(); //close cart-box
    });
});