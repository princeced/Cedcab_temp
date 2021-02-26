<?php

include_once('Ceddatabase_con.php');

class tbl_location extends Ceddatabase_con
{


    public $name;
    public  $distance;
    public $is_available;
    public $arraysloc = array();
    public $fromLocation;
    public $toLocation;


    function __construct()
    {
        $dbcon = new Ceddatabase_con();
        $this->conn = $dbcon->conn;
    }

    function ced_getDropdown()
    {

        try {

            $sql = "SELECT `id`,`name`, `distance` FROM `tbl_location` WHERE `is_available`='1'";

            $res = $this->conn->query($sql);


            if ($res->num_rows > 0) {
                $i = 0;
                while ($row = $res->fetch_assoc()) {
                    $this->arraysloc[$i] = $row;
                    ++$i;
                }
                return $this->arraysloc;
            } else {

                return 0;
            }
        } catch (Exception $e) {
            return $e;
        }
    }



}
