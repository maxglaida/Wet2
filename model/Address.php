<?php

class Address {

    private $address = null;
    private $zip = null;
    private $city = null;

    function __construct($address, $zip, $city) {
        $this->address = $address;
        $this->zip = $zip;
        $this->city = $city;
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

    function setAddress($address) {
        $this->address = $address;
    }

    function setZip($zip) {
        $this->zip = $zip;
    }

    function setCity($city) {
        $this->city = $city;
    }

}
