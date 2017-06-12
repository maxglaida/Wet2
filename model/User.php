<?php

class User {

//put your code here
    private $id = null;
    private $gender = null;
    private $name = null;
    private $surname = null;
    private $email = null;
    private $address = null;
    private $zip = null;
    private $city = null;
    private $username = null;
    private $password = null;
    private $payment = null;
    private $status = null;

    //getter und setter für den Zugriff auf die Objekt-Eigenschaften
//In Netbeans automatisch erzeugt via Insert Code...
    function getId() {
        return $this->id;
    }

    function getStatus() {
        return $this->status;
    }

    function getPayment() {
        return $this->payment;
    }

    function getGender() {
        return $this->gender;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getEmail() {
        return $this->email;
    }

    function getAddress() {
        return $this->address;
    }

    function getZip() {
        return $this->zip;
    }

    function getCity() {
        return $this->city;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPayment($payment) {
        $this->payment = $payment;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setZip($zip) {
        $this->zip = $zip;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

//Konstruktor
//In Netbeans automatisch erzeugt via Insert Code...
    function __construct($id, $gender, $name, $surname, $email, $address, $zip, $city, $username, $password, $payment, $status) {
        $this->id = $id;
        $this->gender = $gender;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->address = $address;
        $this->zip = $zip;
        $this->city = $city;
        $this->username = $username;
        $this->password = $password;
        $this->payment = $payment;
        $this->status = $status;
    }

}
