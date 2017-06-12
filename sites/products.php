<!-- generating a container for the products page layout -->

<div class="container">
    <h2 class="text-center">Products</h2>
    <div class="col-md-2">
        <!-- getting the categories from the database -->

        <select name='select1' id='select1' onchange='load_new_content()' class="form-control">
            <?php $db->getCategories(); ?>


        </select>
    </div>
    <div class="col-md-7"></div>
    <div class="col-md-3">
        <form class="form-inline">
            <div class="form-group">
                <!-- continious search field -->
                <input type="text" class="form-control" id="searchfield" onkeyup="reSearch()" placeholder="Search" value="">
                <span class="glyphicon glyphicon-search"></span>
            </div>
        </form>
    </div>
    <!-- containers for the products. -->

    <div class="col-md-12">
        <div class="row">
            <div id="prod">
            <?php
            // deafult generation of products with the first category
            $db->getProductList(1);
            ?>

            </div>






        </div>


    </div>


</div>