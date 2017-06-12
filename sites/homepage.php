

<!-- generating the logos of the front page -->
<div id="headerWrapper">

    <div id="tattoo"></div>
</div>
<!-- featured products container -->
<div class="container-fluid">

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <h2 class="text-center">Featured Products</h2>

                <?php
                // get featured products from db
                $productObjects = $db->getFeaturedProductsList();
                //spawn each product on the page
                foreach ($productObjects as $product) {

                    echo "<div class='col-md-3 draggable' id='".$product->getId()."'>";
                    echo "<h4 class='productheading'>" . $product->getName() . "</h4>";
                    echo "<img src='../" . $product->getPicture() . "' alt='" . $product->getName() . "' class='img-thumb' />";
                    echo "<p class='price'>Price $" . $product->getPrice() . "</p>";
                    echo "<p class='price'>Rating:" . $product->getRating() . "</p>";
                    echo "<button class='btn btn-warning' onclick='addProductsToCart(" . $product->getId() . ")' type='submit'><span class='glyphicon glyphicon-shopping-cart'></span>Add To Cart</button>";
                    echo "</div >";

                }
                ?>

            </div>