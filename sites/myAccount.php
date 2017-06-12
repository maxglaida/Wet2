<?php
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    include '../model/User.php';
//include '../model/Order.php';
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $allOrders = $db->showOrders($userid);

    $user = $db->getUserInfo($userid);

    $gender = $user->getGender();
    $name = $user->getName();
    $surname = $user->getSurname();
    $email = $user->getEmail();
    $address = $user->getAddress();
    $zip = $user->getZip();
    $city = $user->getCity();
    $hashPass = $user->getPassword();
    $payment = $user->getPayment();
    $password = "*************";


    if (isset($_POST['submit'])) {

        if (isset($_POST['gender']) && !empty($_POST['gender'])) {
            $gender = $_POST['gender'];
        }
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_POST['surname']) && !empty($_POST['surname'])) {
            $surname = $_POST['surname'];
        }
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_POST['address']) && !empty($_POST['address'])) {
            $address = $_POST['address'];
        }
        if (isset($_POST['zip']) && !empty($_POST['zip'])) {
            $zip = $_POST['zip'];
        }
        if (isset($_POST['city']) && !empty($_POST['city'])) {
            $city = $_POST['city'];
        }
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $hashPass = md5($_POST['password']);
        }
        if (isset($_POST['payment']) && !empty($_POST['payment'])) {
            $payment = $_POST['payment'];
        }
        $db->updateUser($userid, $gender, $name, $surname, $email, $address, $zip, $city, $username, $hashPass, $payment,1);
    }
    ?>
    <div class="container col-sm-12">
        <div class="container col-sm-8">
            <h2><?php echo $username . "' profile" ?></h2>
            <form class="form-horizontal" action="index.php?id=4" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-8">
                        <select name="gender" class="form-control" id="gender">
                            <option >Male</option>
                            <option >Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Your name</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $name ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Your surname</label>
                    <div class="col-sm-8">
                        <input type="text" name="surname" class="form-control" id="surname" placeholder="<?php echo $surname ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $email ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Your address</label>
                    <div class="col-sm-8">
                        <input type="text" name="address" class="form-control" id="address" placeholder="<?php echo $address ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ZIP</label>
                    <div class="col-sm-8">
                        <input type="text" name="zip" class="form-control" id="zip" placeholder="<?php echo $zip ?>" pattern="\d{4,}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-8">
                        <input type="text" name="city" class="form-control" id="ort" placeholder="<?php echo $city ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Payment method</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" id="payment" name="payment" value="Credit card"> Credit card
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="payment" name="payment" value="Bank transfer"> Bank transfer
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="payment" name="payment" value="PayPal"> PayPal
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" id="password" placeholder="<?php echo $password ?>"
                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                               title="Password has to contain at least 8 characters with 1 lower letter, 1 upper letter and 1 number.">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" onclick=showPopup() class="btn btn-primary" >Update account</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="container col-sm-4">
            <br>
            <?php
            if ($allOrders == null) {
                echo "No orders.";
            }
            foreach ($allOrders as $oneOrder) {
                echo "<div class='col-md-12'>";
                echo "<div class='col-md-6'>";

                echo"<h4>Order number: $oneOrder</h4>";

                $allProducts = $db->getProductsByInvoice($oneOrder);

                foreach ($allProducts as $oneProduct) {

                }
                echo "</div>";

                echo"<div class='col-md-3'>";
                echo "<a href='index.php?id=11&userid=$userid&orderid=$oneOrder' class='  btn btn-primary btn-sm active' role='button'>Details</a>";
                echo"</div>";

                echo"<div class='col-md-3'>";
                echo "<a href='billPrint.php?userid=$userid&orderid=$oneOrder' target='_blank' class='  btn btn-primary btn-sm active' role='button'>Print invoice</a>";
                echo"</div>";
                echo"</div>";
            }
            ?>
        </div>
    </div>
    <script>
        $('#gender').val("<?php echo $gender ?>").trigger('chosen:updated');
        $("input[name=payment][value='<?php echo $payment ?>']").prop("checked", true);

        //    DOESNT WORK

    </script>
    <?php
} else
    header("location: index.php")
?>

