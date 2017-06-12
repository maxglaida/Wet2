<?php
if ($_SESSION['priviliges'] == 2) {
    $products = $db->getAllProducts();
    ?>
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">   
            <br>
            <?php foreach ($products as $oneProduct) {
                ?>
                <form class="form-horizontal" action="index.php?id=4" method="get">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Product name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $oneProduct->getName() ?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-8">
                            <input type="text" name="price" class="form-control" id="name" placeholder="<?php echo $oneProduct->getPrice() ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-8">
                            <input type="text" name="category" class="form-control" id="surname" placeholder="<?php echo $oneProduct->getCategoryid() ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Picture</label>
                        <div class="col-sm-8">
                            <input type="email" name="picture" class="form-control" id="email" placeholder="<?php echo $oneProduct->getPicture() ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating</label>
                        <div class="col-sm-8">
                            <input type="text" name="rating" class="form-control" id="address" placeholder="<?php echo $oneProduct->getRating() ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-5">
                            <button type="submit" name="submit" class="btn btn-primary" >Update product</button>
                        </div>
                        <div class="bind_right col-sm-offset-1 col-sm-5">
                            <button type="submit" name="submit" class="btn btn-primary" >Update product</button>
                        </div>                           
                    </div>
                </form>
            <?php }
            ?>
        </div>

    </div>

    <?php
} else
    header("location: index.php");