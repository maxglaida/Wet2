<footer class="text-center" id="footer">&copy; Copyright 2017-2017 veggies</footer>


<script>
// logo scroll down effect.
    $(window).scroll(function () {
        var vscroll = $(this).scrollTop();
        $('#tattoo').css({
            "transform": "translate(0px, " + vscroll / 2 + "px)"
        })
    });
// ajax continious search
    function reSearch() {
        var searched = $("#searchfield").val();


        $.post("getSearchedProductsAjax.php", {option_value: searched},
            function (data) {
                $("#prod").html(data);

            }
        );
    }
// loading new product content using ajax
    function load_new_content() {
        var selected_option_value = $("#select1 option:selected").val(); //get the value of the current selected option.

        $.post("getProductsAjax.php", {option_value: selected_option_value},
            function (data) {
                $("#prod").html(data);

            }
        );
    }
// adding products to cart ajax
    function addProductsToCart(productID) {

        $.post("addProductTowarenkorbAjax.php", {p_id: productID, amount: 1},
            function (data) {
                $('#warenkorb').html(data);

            }
        );
    }
// cart management, removing or changing the amount, ajax
    function cartManagement(action, pid) {
         
        $.post("cartOptionsManagementAjax.php", {toDo: action, pid: pid},
            function (data) {
                $('#ccart').html(data);
                addProductsToCart();
            }
        );
    }

// drag and drop fuction of products to the shopping cart
    $( function() {
        $(".droppable").droppable({

            tolerance: "touch",
            drop: function (event, ui) {
                var param = $(ui.draggable).attr('id');
                addProductsToCart(param);
            }
        });

        $( ".draggable" ).draggable({ revert: true,
            helper: "original",
        stop: function(event, ui)
        {

        }
    });



    } );

    </script>
    </body >
    </html>