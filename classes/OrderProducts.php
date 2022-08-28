<?php

class OrderProducts {
    public $id;
    public $product;

    public function __construct($id,$product)
    {
        $this->id = $id;
        $this->product = $product;
    }
}
?>