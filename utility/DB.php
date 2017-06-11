<?php
include_once '../model/Produkt.php';

class DB
{

    private $host = "localhost";
    private $user = "root";
    private $pwd = "12345";
    private $dbname = "Webshop";
    private $dbobjekt = null;

    function connectToDB()
    {
        $this->dbobjekt = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }


    function getFeaturedProductsList()
    {
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

    function getProductList($category)
    {

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

    function getSearchedProducts($searchString)
    {
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

            echo "<div class='col-md-3' id='draggable'>";
            echo "<h4 class='productheading'>" . $product->getName() . "</h4>";
            echo "<img src='../" . $product->getPicture() . "' alt='Tomato' class='img-thumb' />";
            echo "<p class='price'>Price $" . $product->getPrice() . "</p>";
            echo "<p class='price'>Rating:" . $product->getRating() . "</p>";
            echo "<button class='btn btn-warning' type='submit'><span class='glyphicon glyphicon-shopping-cart'></span>Add To Cart</button>";
            echo "</div >";
        }
    }

    function getCategories()
    {
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


    function checkUser($user, $pw)
    {
        $this->connectToDB();
        $query = "select * from user where username = '$user' and password = '$pw' and status = 1";
        $ergebnis = $this->dbobjekt->query($query);
        if (mysqli_num_rows($ergebnis) == 1) {
            while ($zeile = $ergebnis->fetch_object()) {
                $username = $zeile->username;
                $cat = $zeile->category;
                $id = $zeile->p_id;
            }
            $_SESSION['username'] = $username;
            $_SESSION['priviliges'] = $cat;
            $_SESSION['personid'] = $id;

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

    function getUserInfo($id)
    {

        $this->connectToDB();
        $query = "select * from user "
            . "join person on user.p_id=person.person_id "
            . "join address on address.address_id=person.a_id "
            . "where p_id =$id";
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

        return $userInfoObject = new User($gender, $name, $surname, $email, $address, $zip, $city, $username, $password, $payment, $status);
    }

    function registerUser($userObjekt)
    {
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

    function updateUser($id, $gender, $name, $surname, $email, $address, $zip, $city, $username, $password, $payment)
    {
        $this->connectToDB();
        $query = "update user set username = '$username', "
            . "password = '$password' "
            . "where p_id =" . $id;
        $this->dbobjekt->query($query);

        $query = "update person set anrede = '$gender', "
            . "vorname = '$name', "
            . "nachname = '$surname', "
            . "email = '$email', "
            . "payment = '$payment' "
            . "where person_id = " . $id;
        $this->dbobjekt->query($query);

        $query = "update address join person on address.address_id=person.a_id set address = '$address', "
            . "zip = $zip, "
            . "city = '$city' "
            . "where person_id = " . $id;
        $this->dbobjekt->query($query);
    }

}



