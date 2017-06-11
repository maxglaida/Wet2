<?php

class Order {

    private $orderid = null;
    private $product = null;
    private $amount = null;

    function __construct($orderid, $product, $amount) {
        $this->orderid = $orderid;
        $this->product = $product;
        $this->amount = $amount;
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

    function setOrderid($orderid) {
        $this->orderid = $orderid;
    }

    function setProduct($product) {
        $this->product = $product;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

}
