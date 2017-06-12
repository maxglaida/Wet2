<?php
include '../model/User.php';
include_once '../utility/DB.php';
$db = new DB();
$id=null;
$gender = null;
$name = null;
$surname = null;
$email = null;
$address = null;
$zip = null;
$city = null;
$username = null;
$password = null;
$payment = null;
$status = 1;


if (isset($_POST['submit'])) {
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['surname'])) {
        $surname = $_POST['surname'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
    }
    if (isset($_POST['zip'])) {
        $zip = $_POST['zip'];
    }
    if (isset($_POST['city'])) {
        $city = $_POST['city'];
    }
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (isset($_POST['payment'])) {
        $payment = $_POST['payment'];
    }

$userObject = new User($id, $gender, $name, $surname, $email, $address, $zip, $city, $username, $password, $payment, $status);

    $db->registerUser($userObject);

    //redirect to homepage after successful registration
    echo ("<script language='JavaScript'>
           window.alert('Succesfully registered!')
           window.location.href='index.php';
           </script>");
} else {
    ?>
    <div class="container">
        <h2>User Registration</h2>
        <form class="form-horizontal" action="index.php?id=2" method="post">


            <div class="form-group">
                <label class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-8">
                    <select name="gender" class="form-control" id="gender" required>
                        <option value="">Please choose your gender</option>
                        <option >Male</option>
                        <option >Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Your name</label>
                <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Martin" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Your surname</label>
                <div class="col-sm-8">
                    <input type="text" name="surname" class="form-control" id="surname" placeholder="Musterman" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" name="email" class="form-control" id="email" placeholder="me@home.com" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Your address</label>
                <div class="col-sm-8">
                    <input type="text" name="address" class="form-control" id="address" placeholder="Höchstädtplatz 6" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ZIP</label>
                <div class="col-sm-8">
                    <input type="text" name="zip" class="form-control" id="zip" placeholder="1200" pattern="\d{4,}" title="At least 4 numbers." required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">City</label>
                <div class="col-sm-8">
                    <input type="text" name="city" class="form-control" id="ort" placeholder="Wien" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Payment method</label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <input type="radio" id="payment" name="payment" value="Credit Card" required> Credit card
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="payment" name="payment" value="Bank transfer"> Bank transfer
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="payment" name="payment" value="PayPal"> Paypal
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Your password"
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                           title="Password has to contain at least 8 characters with 1 lower letter, 1 upper letter and 1 number." required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Confirm your password</label>
                <div class="col-sm-8">
                    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Your password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary" onclick="return validatePasswordMatch()">Create account</button>
                </div>
            </div>
        </form>
    </div>

    <!-- password match check !-->
    <script type="text/javascript">
        function validatePasswordMatch() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>

<?php } ?>
