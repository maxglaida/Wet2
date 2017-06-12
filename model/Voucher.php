<?php

class Voucher {
    
    
    private $code;
    private $val;
    private $validDate;
    
     public function __construct($code, $val, $validDate)
    {
        $this->code = $code;
        $this->val = $val;
        $this->validDate = $validDate;
    }
    
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param null $id
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
    
    public function getVal()
    {
        return $this->val;
    }

    /**
     * @param null $id
     */
    public function setVal($val)
    {
        $this->val = $val;
    }
    
    public function getValidDate()
    {
        return $this->validDate;
    }

    /**
     * @param null $id
     */
    public function setValidDate($validDate)
    {
        $this->validDate = $validDate;
    }
    
}
