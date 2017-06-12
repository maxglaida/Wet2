<?php

class Order {

    private $orderid = null;
    private $productid = null;
    private $product=null;
    private $amount = null;
    private $datum = null;
    private $payMethod = null;

    function __construct($orderid,$product, $productid, $amount, $datum, $payMethod) {
        $this->orderid = $orderid;
        $this->productid = $productid;
        $this->amount = $amount;
        $this->datum = $datum;
        $this->payMethod = $payMethod;
        $this->product=$product;
    }

        function getProductid() {
        return $this->productid;
    }
    function getDatum() {
        return $this->datum;
    }

    function getPayMethod() {
        return $this->payMethod;
    }

    function getOrderid() {
        return $this->orderid;
    }

    function getProduct() {
        return $this->product;
    }

    function getAmount() {
        return $this->amount;
    }
    
    function setProductid($productid) {
        $this->productid = $productid;
    }

    function setOrderid($orderid) {
        $this->orderid = $orderid;
    }

    function setProduct($product) {
        $this->product = $product;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    function setDatum($datum) {
        $this->datum = $datum;
    }

    function setPayMethod($payMethod) {
        $this->payMethod = $payMethod;
    }

}
