//Place order and destroy session
$(document).ready(function()
{
    $(".check-out").submit(function(e)
    {   //user clicks form submit button
        var button_content = $(this).find('button[type=submit]'); //get clicked button info
        button_content.html('Placing order...'); //Loading button text //change button text 
        $.ajax(
        {   //make ajax request to cartProcess.php
            url: "checkout.php",
            type: "POST",
            dataType:"json", //expect json value from server
           // data: '<%=$_SESSION["cartProducts"]%>'
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