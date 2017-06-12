<div id="headerWrapper">

    <div id="tattoo"></div>
</div>

<div class="container-fluid">

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <h2 class="text-center">Featured Products</h2>
                <?php
                $productObjects = $db->getFeaturedProductsList();

                foreach ($productObjects as $product) {

                    echo "<div class='col-md-3' id='" . $product->getId() . "'>";
                    echo "<div class='draggable'>";
                    echo "<h4 class='productheading'>" . $product->getName() . "</h4>";

                    echo "<img src='../" . $product->getPicture() . "' alt='" . $product->getName() . "' class='img-thumb' />";
                    echo "</div>";
                    echo "<p class='price'>Price $" . $product->getPrice() . "</p>";
                    echo "<p class='price'>Rating:" . $product->getRating() . "</p>";
                    echo "<button class='btn btn-warning' type='submit'><span class='glyphicon glyphicon-shopping-cart'></span>Add To Cart</button>";
                    echo "</div >";
                }
                ?>

            </div>