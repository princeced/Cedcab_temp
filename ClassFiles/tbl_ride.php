<?php

class tbl_ride
{

    public $ride_id;
    public $ride_date;
    public $from;
    public  $to;
    public $total_distance;
    public $luggage;
    public $total_fare;
    public $status;
    public $customer_user_id;
    public $cab_type;

    function __construct($ride_date,$from,$to,$total_distance,$luggage,$total_fare,$status,$customer_user_id,$cab_type)
    {
        $this-> ride_date= $ride_date;
        $this-> from= $from;
        $this-> to= $to;
        $this-> total_distance= $total_distance;
        $this-> luggage= $luggage;
        $this-> total_fare= $total_fare;
        $this-> status= $status;
        $this-> customer_user_id= $customer_user_id;
        $this-> cab_type= $cab_type;
    }
}
