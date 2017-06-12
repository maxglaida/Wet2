<?php

include_once '../model/Produkt.php';
include_once '../model/Order.php';
include_once '../model/Address.php';

class DB {

    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbname = "Wet2";
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
    function getProducts($id) {
        $this->connectToDB();
        $productArray = array();
        $query = "SELECT * FROM products WHERE products_id = $id";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            
            $products = new Produkt($zeile->products_id, $zeile->name, $zeile->price, $zeile->categoryid, $zeile->picture, $zeile->rating, $zeile->featured);
    }
         return $products;
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
    
    function getAllVouchers() {
        return $voucherArray;
    }
    
    function setNewVoucher($wert,$date) {
        
        $this->connectToDB();

        $query = "INSERT INTO address (address, zip, city) "
                . "VALUES ('" . $userObjekt->getAddress() . "'," . $userObjekt->getZip() . ",'" . $userObjekt->getCity() . "')";
        
    }

    function deleteProduct($product, $invoice) {
        $this->connectToDB();
        $query = "select count(*) as count from orderedproducts where invoice_id=$invoice";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            $count = $zeile->count;
            if ($count <= 1) {
                $query = "delete bestellung.* from bestellung where invoice_id=$invoice";
                $this->dbobjekt->query($query);
            }
        }
        $query = "delete orderedproducts.* from orderedproducts where product_id=$product and invoice_id=$invoice";
        $this->dbobjekt->query($query);
    }

    function getOrderInfo($id) {
        $this->connectToDB();
        $query = "select * from bestellung 
                  join orderedproducts using(invoice_id) 
                  join user using(user_id) 
                  join person on person.person_id=user.p_id 
                  join products on products.products_id=orderedproducts.product_id 
                  where invoice_id=$id";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $Order = new Order($id, $zeile->name, $zeile->product_id, $zeile->amount, $zeile->datum, $zeile->payment);
            //jedes User-Objekt wird in das Array $userArray abgelegt
        }
        return $Order;
    }

    function getAddressByUserId($userid) {
        $this->connectToDB();
        $query = "select address.* from user join person on user.p_id=person.person_id join address on address.address_id=person.a_id  where user_id=$userid";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            $address = new Address($zeile->address, $zeile->zip, $zeile->city);
        }
        return $address;
    }

    function getProductsByInvoice($id) {

        $this->connectToDB();
        $orderArray = array();
        $query = "select * from bestellung 
                  join orderedproducts using(invoice_id) 
                  join user using(user_id) 
                  join person on person.person_id=user.p_id 
                  join products on products.products_id=orderedproducts.product_id 
                  where invoice_id=$id";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $order = new Order($id, $zeile->name, $zeile->product_id, $zeile->amount, $zeile->datum, $zeile->payment);
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($orderArray, $order);
        }
        return $orderArray;
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

            echo "<div class='col-md-3 draggable' id='".$product->getId()."'>";
            echo "<h4 class='productheading'>" . $product->getName() . "</h4>";
            echo "<img src='../" . $product->getPicture() . "' alt='Tomato' class='img-thumb' />";
            echo "<p class='price'>Price $" . $product->getPrice() . "</p>";
            echo "<p class='price'>Rating:" . $product->getRating() . "</p>";
            echo "<button class='btn btn-warning' onclick='addProductsToCart(".$product->getId().")' type='submit'><span class='glyphicon glyphicon-shopping-cart'></span>Add To Cart</button>";
            echo "</div >";
        }
    }

    function getAllProducts() {
        $this->connectToDB();
        $productArray = array();
        $query = "select * from products join productcategory on products.categoryid=productcategory.productcategory_id";
        $ergebnis = $this->dbobjekt->query($query);
        while ($zeile = $ergebnis->fetch_object()) {
            //pro DB-Zeile wird neues User-Objekt erzeugt
            $product = new Produkt($zeile->products_id, $zeile->name, $zeile->price, $zeile->description, $zeile->picture, $zeile->rating, $zeile->featured);
            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($productArray, $product);
        }
        return$productArray;
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

            echo "<div class='col-md-3 draggable' id='".$product->getId()."'>";
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

    function getBillId($orderid, $userid) {
        $this->connectToDB();
        $billId = null;
        $query = "select id from bill where invoice_id=$orderid";
        $ergebnis = $this->dbobjekt->query($query);

        while ($zeile = $ergebnis->fetch_object()) {
            $billId = $zeile->id;
        }if (!isset($billId)) {
            $randnr = rand(1000, 10000);
            $billId = "RN$randnr";
            $query = "insert into bill values ('$billId', $userid, $orderid, curdate())";
            $ergebnis = $this->dbobjekt->query($query);
        }


        return $billId;
    }

    function showOrders($userid) {
        $this->connectToDB();
        $ordersArray = array();
        $query = "select invoice_id, datum from bestellung join user using(user_id) where user_id=$userid order by datum";
        ;
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

    function updateUser($id, $gender, $name, $surname, $email, $address, $zip, $city, $username, $password, $payment, $status) {
        $this->connectToDB();
        $query = "update user set username = '$username', "
            . "password = '$password' "
            . "where user_id =" . $id;
        $this->dbobjekt->query($query);
        $query = "update person join user on user.p_id=person.person_id set anrede = '$gender', "
            . "vorname = '$name', "
            . "nachname = '$surname', "
            . "email = '$email', "
            . "payment = '$payment' "
            . "where user_id = " . $id;
        $this->dbobjekt->query($query);
        $query = "update address "
            . "join person on address.address_id=a.person_id "
            . "join user on user.p_id=person.person_id "
            . "set address = '$address', zip = $zip, city = '$city' where user_id = $id";
        $this->dbobjekt->query($query);
    }

}
