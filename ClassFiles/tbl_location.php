<?php

class tbl_location{

    
    public $name;
    public  $distance;
    public $is_available;

    function __construct($name,$distance,$is_available){

        $this->$name=$name;
        $this->$distance=$distance;
        $this->$is_available=$is_available;
    }
    
   
}

?>