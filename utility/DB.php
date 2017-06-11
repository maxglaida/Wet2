<?php

include_once '../model/Produkt.php';

class DB {

    private $host = "localhost";
    private $user = "root";
    private $pwd = "12345";
    private $dbname = "Webshop";
    private $dbobjekt = null;

    function connectToDB() {
        $this->dbobjekt = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }

    function deActivateUser($id, $status) {
        $this->connectToDB();
        if ($status == 1) {
            $query = "update user set status = 0 "
                    . "where user_id =" . $id;
        } else {
            $query = "update user set status = 1 "
                    . "where user_id =" . $id;
        }
        $this->dbobjekt->query($query);
    }

    function getUserList() {
        $this->connectToDB();
        $userArray = array();
        $query = "select * from user "
                . "join person on person.person_id=user.p_id "
                . "join address on address.address_id=person.a_id where category = 1";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt        }
            $userObject = new User($zeile->user_id, $zeile->anrede, $zeile->vorname, $zeile->nachname, $zeile->email, $zeile->address, $zeile->zip, $zeile->city, $zeile->username, $zeile->password, $zeile->payment, $zeile->status);
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($userArray, $userObject);
        }
        return $userArray;
    }

    function getFeaturedProductsList() {
        $this->connectToDB();
        $productArray = array();
        $query = "SELECT * FROM products WHERE Featured = 1";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $products = new Produkt($zeile->products_id, $zeile->name, $zeile->price, $zeile->categoryid, $zeile->picture, $zeile->rating, $zeile->featured);
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($productArray, $products);
        }

        //Array befüllt mit User-Objekten wird retourniert
        return $productArray;
    }

    function getOrderInfo($id) {

        $this->connectToDB();
        $ordersArray = array();
        $query = "select * from products "
                . "join orderedproducts on products.products_id=orderedproducts.product_id "
                . "WHERE invoice_id = $id";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $Order = new Order($zeile->invoice_id, $zeile->name, $zeile->amount);
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($ordersArray, $Order);
        }
        return $ordersArray;
    }

    function getProductList($category) {

        $this->connectToDB();
        $productArray = array();
        $query = "SELECT * FROM products WHERE Categoryid = $category";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $products = new Produkt($zeile->products_id, $zeile->name, $zeile->price, $zeile->categoryid, $zeile->picture, $zeile->rating, $zeile->featured);
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($productArray, $products);
        }

        foreach ($productArray as $product) {

            echo "<div class='col-md-3'>";
            echo "<h4 class='productheading'>" . $product->getName() . "</h4>";
            echo "<img src='../" . $product->getPicture() . "' alt='Tomato' class='img-thumb' />";
            echo "<p class='price'>Price $" . $product->getPrice() . "</p>";
            echo "<p class='price'>Rating:" . $product->getRating() . "</p>";
            echo "<button class='btn btn-warning' type='submit'><span class='glyphicon glyphicon-shopping-cart'></span>Add To Cart</button>";
            echo "</div >";
        }
    }

    function getSearchedProducts($searchString) {
        $this->connectToDB();
        $productArray = array();
        $query = "SELECT * FROM products WHERE name LIKE '%$searchString%'";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $products = new Produkt($zeile->products_id, $zeile->name, $zeile->price, $zeile->categoryid, $zeile->picture, $zeile->rating, $zeile->featured);
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($productArray, $products);
        }

        foreach ($productArray as $product) {

            echo "<div class='col-md-3'>";
            echo "<h4 class='productheading'>" . $product->getName() . "</h4>";
            echo "<img src='../" . $product->getPicture() . "' alt='Tomato' class='img-thumb' />";
            echo "<p class='price'>Price $" . $product->getPrice() . "</p>";
            echo "<p class='price'>Rating:" . $product->getRating() . "</p>";
            echo "<button class='btn btn-warning' type='submit'><span class='glyphicon glyphicon-shopping-cart'></span>Add To Cart</button>";
            echo "</div >";
        }
    }

    function getCategories() {
        $this->connectToDB();

        $sql = "SELECT * FROM productcategory";
        $results = $this->dbobjekt->query($sql);
        if ($results) {
            # code...
            while ($zeile = $results->fetch_object()) {

                echo "<option value='$zeile->productCategory_id'>$zeile->description</option>";
                # code...
            }
        } else
            echo "Es gibt ein fehlar bei zugriff!";
    }

    function checkUser($user, $pw) {
        $this->connectToDB();
        $query = "select * from user where username = '$user' and password = '$pw' and status = 1";
        $ergebnis = $this->dbobjekt->query($query);
        if (mysqli_num_rows($ergebnis) == 1) {
            while ($zeile = $ergebnis->fetch_object()) {
                $username = $zeile->username;
                $cat = $zeile->category;
                $id = $zeile->user_id;
            }
            $_SESSION['username'] = $username;
            $_SESSION['priviliges'] = $cat;
            $_SESSION['userid'] = $id;

            echo("<script language='JavaScript'>
                   window.alert('Welcome $username!')
                   window.location.href='index.php';
                   </script>");
        } else {
            echo("<script language='JavaScript'>
                   window.alert('Incorrect username or password!')
                   window.location.href='index.php?id=3';
                   </script>");
        }
    }

    function getUserInfo($id) {

        $this->connectToDB();
        $query = "select * from user "
                . "join person on user.p_id=person.person_id "
                . "join address on address.address_id=person.a_id "
                . "where user_id =$id";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            $gender = $zeile->anrede;
            $name = $zeile->vorname;
            $surname = $zeile->nachname;
            $email = $zeile->email;
            $address = $zeile->address;
            $zip = $zeile->zip;
            $city = $zeile->city;
            $username = $zeile->username;
            $payment = $zeile->payment;
            $password = $zeile->password;
            $status = $zeile->status;
        }

        return $userInfoObject = new User($id, $gender, $name, $surname, $email, $address, $zip, $city, $username, $password, $payment, $status);
    }

    function showOrders($userid) {
        $this->connectToDB();
        $ordersArray = array();
        $query = "select invoice_id, datum from bestellung 
                join user using(user_id)
                where user_id=$userid";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $orderid = $zeile->invoice_id;
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($ordersArray, $orderid);
        }
        return $ordersArray;
    }

    function registerUser($userObjekt) {
        $this->connectToDB();

        $query = "INSERT INTO address (address, zip, city) "
                . "VALUES ('" . $userObjekt->getAddress() . "'," . $userObjekt->getZip() . ",'" . $userObjekt->getCity() . "')";

        $this->dbobjekt->query($query);

        $a_id = $this->dbobjekt->insert_id;

        $query = "INSERT INTO person (a_id, anrede, vorname, nachname, email, payment) "
                . "VALUES ('" . $a_id . "','" . $userObjekt->getGender() . "','" . $userObjekt->getName() . "','" . $userObjekt->getSurname() . "','" . $userObjekt->getEmail() . "','" . $userObjekt->getPayment() . "')";

        $this->dbobjekt->query($query);

        $p_id = $this->dbobjekt->insert_id;

        $hashPw = md5($userObjekt->getPassword());
        $query = "INSERT INTO user ("
                . "p_id, "
                . "username, "
                . "password, "
                . "status, "
                . "category) VALUES ("
                . "'" . $p_id . "', "
                . "'" . $userObjekt->getUsername() . "', "
                . "'" . $hashPw . "', "
                . "'1', "
                . "1)";

        $this->dbobjekt->query($query);
    }

    function updateUser($id, $gender, $name, $surname, $email, $address, $zip, $city, $username, $password, $payment) {
        $this->connectToDB();
        $query = "update user set username = '$username', "
                . "password = '$password' "
                . "where user_id =" . $id;
        $this->dbobjekt->query($query);

        $query = "update person join user on user.user_id=person.u_id set anrede = '$gender', "
                . "vorname = '$name', "
                . "nachname = '$surname', "
                . "email = '$email', "
                . "payment = '$payment' "
                . "where user_id = " . $id;
        $this->dbobjekt->query($query);

        $query = "update address join user on user.user_id=address.u_id set address = '$address', "
                . "zip = $zip, "
                . "city = '$city' "
                . "where user_id = " . $id;
        $this->dbobjekt->query($query);
    }

}
