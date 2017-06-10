<?php

class Produkt{

    private $id = null;
    private $name = null;
    private $price = null;
    private $categoryid = null;
    private $picture = null;
    private $rating = null;
    private $featured = null;
    /**
     * product constructor.
     * @param null $name
     * @param null $price
     * @param null $categoryid
     * @param null $picture
     * @param null $rating
     * @param null $featured
     */
    public function __construct($id, $name, $price, $categoryid, $picture, $rating, $featured)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->categoryid = $categoryid;
        $this->picture = $picture;
        $this->rating = $rating;
        $this->featured = $featured;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return null
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * @param null $categoryid
     */
    public function setCategoryid($categoryid)
    {
        $this->categoryid = $categoryid;
    }

    /**
     * @return null
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param null $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param null $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return null
     */
    public function getFeatured()
    {
        return $this->featured;
    }
    /**
     * @param null $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

}


