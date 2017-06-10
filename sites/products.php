<div class="container">
    <h2 class="text-center">Products</h2>
    <div class="col-md-2">

        <select name='select1' id='select1' onchange='load_new_content()' class="form-control">
            <?php $db->getCategories(); ?>

        </select>
    </div>
    <div class="col-md-7"></div>
    <div class="col-md-3">
        <form class="form-inline">
            <div class="form-group">
                <input type="text" class="form-control" id="searchfield" onkeyup="reSearch()" placeholder="Search" value="">
                <span class="glyphicon glyphicon-search"></span>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div id="prod">


            <?php
            $db->getProductList(1);

            ?>

            </div>



        </div>


    </div>


</div>