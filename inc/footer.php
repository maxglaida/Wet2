<footer class="text-center" id="footer">&copy; Copyright 2017-2017 veggies</footer>


<!-- details modal-->


<script>

    $(window).scroll(function () {
        var vscroll = $(this).scrollTop();
        $('#tattoo').css({
            "transform": "translate(0px, " + vscroll / 2 + "px)"
        })
    });

    function reSearch() {
        var searched = $("#searchfield").val();


        $.post("getSearchedProductsAjax.php", {option_value: searched},
            function (data) {
                $("#prod").html(data);

            }
        );
    }

    function load_new_content() {
        var selected_option_value = $("#select1 option:selected").val(); //get the value of the current selected option.

        $.post("getProductsAjax.php", {option_value: selected_option_value},
            function (data) {
                $("#prod").html(data);

            }
        );
    }

    function addProductsToCart(productID) {

        $.post("addProductTowarenkorbAjax.php", {p_id: productID, amount: 1},
            function (data) {
                $('#warenkorb').html(data);

            }
        );
    }


    $( function() {
        $(".droppable").droppable({

            tolerance: "touch",
            drop: function (event, ui) {
                var param = $(ui.draggable).attr('id');
                alert(param);
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