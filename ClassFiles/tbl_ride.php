<?php

include_once('Ceddatabase_con.php');

class tbl_ride extends Ceddatabase_con
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

    function __construct()
    {
        $dbcon = new Ceddatabase_con();
        $this->conn = $dbcon->conn;
    }


//outer
    function calculateFare($pickUp, $drop, $cabType, $luggage = 0)
    {
        $distancefare = 0;
        $luggagefare = 0;
       

        $sql = "SELECT `id`, `name`, `distance` FROM `tbl_location` WHERE `is_available`='1' AND `id` IN ('$pickUp','$drop')";

        $res = $this->conn->query($sql);
        
        if ($res->num_rows > 0) {
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $this->arraysloc[$i] = $row;
                ++$i;
            }
            
            if ($this->arraysloc[0]['id'] == $pickUp) {
                $fromLocation = $this->arraysloc[0]['distance'];
            }

            if ($this->arraysloc[1]['id'] == $drop) {
                $toLocation = $this->arraysloc[1]['distance'];
            }
            if ($this->arraysloc[0]['id'] == $pickUp) {
                $fromLocations = $this->arraysloc[0]['name'];
            }

            if ($this->arraysloc[1]['id'] == $drop) {
                $toLocations = $this->arraysloc[1]['name'];
            }
        }

       
        $distance = abs($fromLocation - $toLocation);

        switch ($cabType) {

            case 'CedMicro': {

                    static $cedmicroAmount = 50;


                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 735 + (($totalDistance - 60) * 8.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 135 + (($totalDistance - 10) * 8.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 135 + (($totalDistance - 10) * 8.50);
                        }
                    } else {
                        $distancefare += 1755;
                        $distancefare += (($totalDistance - 160) * 8.50);
                    }



                    $totalfare = $cedmicroAmount  + $distancefare;
                }
                break;
            case 'CedMini': {
                    static $cedminiAmount = 150;




                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 795 + (($totalDistance - 60) * 9.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 145 + (($totalDistance - 10) * 9.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 145 + (($totalDistance - 10) * 9.50);
                        }
                    } else {
                        $distancefare += 1120;
                        $distancefare += (($totalDistance - 160) * 9.50);
                    }

                    if ($luggage <= 10) {
                        $luggagefare += 100;
                    } else if ($luggage > 10 && $luggage <= 20) {
                        $luggagefare += 200;
                    } else {
                        $luggagefare += 400;
                    }



                    $totalfare = $cedminiAmount + $luggagefare + $distancefare;
                }
                break;
            case 'CedRoyal': {
                    static $cedroyalAmount = 200;

                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 855 + (($totalDistance - 60) * 10.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 155 + (($totalDistance - 10) * 10.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 155 + (($totalDistance - 10) * 10.50);
                        }
                    } else {
                        $distancefare += 1220;
                        $distancefare += (($totalDistance - 160) * 10.50);
                    }

                    if ($luggage <= 10) {
                        $luggagefare += 50;
                    } else if ($luggage > 10 && $luggage <= 20) {
                        $luggagefare += 100;
                    } else {
                        $luggagefare += 200;
                    }



                    $totalfare = $cedroyalAmount + $luggagefare + $distancefare;
                }
                break;
            case 'CedSUV': {
                    static $cedsuvAmount = 250;



                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 915 + (($totalDistance - 60) * 11.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 165 + (($totalDistance - 10) * 11.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 165 + (($totalDistance - 10) * 11.50);
                        }
                    } else {
                        $distancefare += 1320;
                        $distancefare += (($totalDistance - 160) * 11.50);
                    }

                    if ($luggage <= 10) {
                        $luggagefare += 50;
                    } else if ($luggage > 10 && $luggage <= 20) {
                        $luggagefare += 100;
                    } else {
                        $luggagefare += 200;
                    }



                    $totalfare = $cedsuvAmount + $luggagefare + $distancefare;
                }
                break;

            default:

                echo "Something Went Wrong !!";
        }


        return  array('totalfare' => $totalfare, 'totaldistance' => $totalDistance, 'fromLocation' => $fromLocations, 'toLocation' => $toLocations);
    }


    //login

    function usercalculateFare($pickUp, $drop, $cabType, $luggage = 0)
    {
        $distancefare = 0;
        $luggagefare = 0;
       

        $sql = "SELECT `id`, `name`, `distance` FROM `tbl_location` WHERE `is_available`='1' AND `id` IN ('$pickUp','$drop')";

        $res = $this->conn->query($sql);
        
        if ($res->num_rows > 0) {
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $this->arraysloc[$i] = $row;
                ++$i;
            }
            
            if ($this->arraysloc[0]['id'] == $pickUp) {
                $fromLocation = $this->arraysloc[0]['distance'];
            }

            if ($this->arraysloc[1]['id'] == $drop) {
                $toLocation = $this->arraysloc[1]['distance'];
            }
            if ($this->arraysloc[0]['id'] == $pickUp) {
                $fromLocations = $this->arraysloc[0]['name'];
            }

            if ($this->arraysloc[1]['id'] == $drop) {
                $toLocations = $this->arraysloc[1]['name'];
            }
        }

       
        $distance = abs($fromLocation - $toLocation);

        switch ($cabType) {

            case 'CedMicro': {

                    static $cedmicroAmount = 50;


                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 735 + (($totalDistance - 60) * 8.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 135 + (($totalDistance - 10) * 8.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 135 + (($totalDistance - 10) * 8.50);
                        }
                    } else {
                        $distancefare += 1755;
                        $distancefare += (($totalDistance - 160) * 8.50);
                    }



                    $totalfare = $cedmicroAmount  + $distancefare;
                }
                break;
            case 'CedMini': {
                    static $cedminiAmount = 150;




                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 795 + (($totalDistance - 60) * 9.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 145 + (($totalDistance - 10) * 9.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 145 + (($totalDistance - 10) * 9.50);
                        }
                    } else {
                        $distancefare += 1120;
                        $distancefare += (($totalDistance - 160) * 9.50);
                    }

                    if ($luggage <= 10) {
                        $luggagefare += 100;
                    } else if ($luggage > 10 && $luggage <= 20) {
                        $luggagefare += 200;
                    } else {
                        $luggagefare += 400;
                    }



                    $totalfare = $cedminiAmount + $luggagefare + $distancefare;
                }
                break;
            case 'CedRoyal': {
                    static $cedroyalAmount = 200;

                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 855 + (($totalDistance - 60) * 10.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 155 + (($totalDistance - 10) * 10.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 155 + (($totalDistance - 10) * 10.50);
                        }
                    } else {
                        $distancefare += 1220;
                        $distancefare += (($totalDistance - 160) * 10.50);
                    }

                    if ($luggage <= 10) {
                        $luggagefare += 50;
                    } else if ($luggage > 10 && $luggage <= 20) {
                        $luggagefare += 100;
                    } else {
                        $luggagefare += 200;
                    }



                    $totalfare = $cedroyalAmount + $luggagefare + $distancefare;
                }
                break;
            case 'CedSUV': {
                    static $cedsuvAmount = 250;



                    $totalDistance = $distance;

                    if ($totalDistance < 160) {

                        if ($totalDistance >= 100) {
                            $distancefare += 915 + (($totalDistance - 60) * 11.50);
                        } else if ($totalDistance >= 50) {
                            $distancefare += 165 + (($totalDistance - 10) * 11.50);
                        } else if ($totalDistance >= 10) {
                            $distancefare += 165 + (($totalDistance - 10) * 11.50);
                        }
                    } else {
                        $distancefare += 1320;
                        $distancefare += (($totalDistance - 160) * 11.50);
                    }

                    if ($luggage <= 10) {
                        $luggagefare += 50;
                    } else if ($luggage > 10 && $luggage <= 20) {
                        $luggagefare += 100;
                    } else {
                        $luggagefare += 200;
                    }



                    $totalfare = $cedsuvAmount + $luggagefare + $distancefare;
                }
                break;

            default:

                echo "Something Went Wrong !!";
        }

       
        $_SESSION['ride']['pickupLocation'] = $fromLocations;
        $_SESSION['ride']['dropLocation'] = $toLocations;
        $_SESSION['ride']['cabtype'] = $cabType;
        $_SESSION['ride']['luggage'] = $luggage;
        $_SESSION['ride']['totalfare'] = $totalfare;
        $_SESSION['ride']['totaldistance'] = $totalDistance;

        return  array('totalfare' => $totalfare, 'totaldistance' => $totalDistance, 'fromLocation' => $fromLocations, 'toLocation' => $toLocations);
    }
//save data of new user

    function storecalculateFare()
    {

        $pickUp = $_SESSION['ride']['pickupLocation'];
        $drop = $_SESSION['ride']['dropLocation'];

        $sql = "SELECT `id`, `name`, `distance` FROM `tbl_location` WHERE `is_available`='1' AND `name` IN ('$pickUp','$drop')";

        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $this->arraysloc[$i] = $row;
                ++$i;
            }

            if ($this->arraysloc[0]['name'] ==  $pickUp) {
                $fromLocation = $this->arraysloc[0]['id'];
            }

            if ($this->arraysloc[1]['name'] == $drop) {
                $toLocation = $this->arraysloc[1]['id'];
            }
        }



        //  $fromLocation=$_SESSION['ride']['pickupLocation'] ;
        //  $toLocation=$_SESSION['ride']['dropLocation'] ;

        $cabType = $_SESSION['ride']['cabtype'];
        $luggage = ($_SESSION['ride']['luggage'] == "") ? 0 : $_SESSION['ride']['luggage'];
        $totalfare = $_SESSION['ride']['totalfare'];
        $totalDistance = $_SESSION['ride']['totaldistance'];
        $userid = $_SESSION['user']['user_id'];

        try {

            $sql = "INSERT INTO `tbl_ride`( `ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`, `cab_type`) VALUES (now(),'$fromLocation','$toLocation','$totalDistance','$luggage','$totalfare','1','$userid','$cabType')";


            $res = $this->conn->query($sql);

            if ($res == true) {

                unset($_SESSION['ride']['pickupLocation']);
                unset($_SESSION['ride']['dropLocation']);
                unset($_SESSION['ride']['cabtype']);
                unset($_SESSION['ride']['luggage']);
                unset($_SESSION['ride']['totalfare']);
                unset($_SESSION['ride']['totaldistance']);
                unset($_SESSION['ride']['isridestore']);

                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    //save data for login user 
    function ced_savecaldata($pickupLocation, $dropLocation, $cabtype, $luggage, $totalfare, $totaldistance)
    {
        $userid = $_SESSION['user']['user_id'];
       
        $sql = "SELECT `id`, `name`, `distance` FROM `tbl_location` WHERE `is_available`='1' AND `name` IN ('$pickupLocation','$dropLocation')";

        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $this->arraysloc[$i] = $row;
                ++$i;
            }

            if ($this->arraysloc[0]['name'] ==  $pickupLocation) {
                $fromLocation = $this->arraysloc[0]['id'];
            }

            if ($this->arraysloc[1]['name'] == $dropLocation) {
                $toLocation = $this->arraysloc[1]['id'];
            }
        }




        try {

            $sql = "INSERT INTO `tbl_ride`( `ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`, `cab_type`) VALUES (now(),'$fromLocation','$toLocation','$totaldistance','$luggage','$totalfare','1','$userid','$cabtype')";


            $res = $this->conn->query($sql);

            if ($res == true) {

                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return $e;
        }
    }


    function ced_delsession()
    {


        unset($_SESSION['ride']['pickupLocation']);
        unset($_SESSION['ride']['dropLocation']);
        unset($_SESSION['ride']['cabtype']);
        unset($_SESSION['ride']['luggage']);
        unset($_SESSION['ride']['totalfare']);
        unset($_SESSION['ride']['totaldistance']);

        return 1;
    }

    //store session

    function ced_savefaresession($pickupLocation, $dropLocation, $cabtype, $luggage, $totalfare, $totaldistance)
    {

        if (isset($_SESSION['user']['email_id'])) {
           // $_SESSION['start'] = time();
           // $_SESSION['expire'] = $_SESSION['start'] + (1*60);
            $_SESSION['ride']['isridestore']='ok';
            $_SESSION['ride']['pickupLocation'] = $pickupLocation;
            $_SESSION['ride']['dropLocation'] = $dropLocation;
            $_SESSION['ride']['cabtype'] = $cabtype;
            $_SESSION['ride']['luggage'] = $luggage;
            $_SESSION['ride']['totalfare'] = $totalfare;
            $_SESSION['ride']['totaldistance'] = $totaldistance;  

            return 1;

        } else {
            
            $_SESSION['ride']['pickupLocation'] = $pickupLocation;
            $_SESSION['ride']['dropLocation'] = $dropLocation;
            $_SESSION['ride']['cabtype'] = $cabtype;
            $_SESSION['ride']['luggage'] = $luggage;
            $_SESSION['ride']['totalfare'] = $totalfare;
            $_SESSION['ride']['totaldistance'] = $totaldistance;

            return 0;
        }
    }

    //total rides
    function ced_getUserdata()
    {

        $userid = $_SESSION['user']['user_id'];

        try {
            $sql = "SELECT (ROW_NUMBER() OVER (ORDER BY `ride_id` )) `SNo`,`ride_id`,`ride_date`, `tbloc`.`name` 'Pickup' , `tblocc`.`name` 'Drop', `total_distance`, `luggage`, `total_fare`, `tbl_ride`.`status`,`tbl_user`.`name`, `cab_type` FROM `tbl_ride` LEFT JOIN `tbl_user` ON `tbl_ride`.`customer_user_id`=`tbl_user`.`user_id` LEFT JOIN `tbl_location` AS `tbloc` ON `tbl_ride`.`from`=`tbloc`.`id` LEFT JOIN `tbl_location` AS `tblocc` ON `tbl_ride`.`to`=`tblocc`.`id` WHERE `tbl_user`.`status`='1' AND  `tbl_ride`.`customer_user_id`='$userid'";

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

    function ced_getTotalrides()
    {

        $userid = $_SESSION['user']['user_id'];

        try {
            $sql = "SELECT (COUNT(*)) `countrides` FROM `tbl_ride` WHERE `tbl_ride`.`customer_user_id`='$userid'";

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


   function ced_viewAllRides($viewAllIdd){

    $userid = $_SESSION['user']['user_id'];
   
    try {

        $sql = "SELECT (ROW_NUMBER() OVER (ORDER BY `ride_id` )) `SNo`,`ride_id`,`ride_date`, `tbloc`.`name` 'Pickup' , `tblocc`.`name` 'Drop', `total_distance`, `luggage`, `total_fare`, `tbl_ride`.`status`,`tbl_user`.`name`, `cab_type` FROM `tbl_ride` LEFT JOIN `tbl_user` ON `tbl_ride`.`customer_user_id`=`tbl_user`.`user_id` LEFT JOIN `tbl_location` AS `tbloc` ON `tbl_ride`.`from`=`tbloc`.`id` LEFT JOIN `tbl_location` AS `tblocc` ON `tbl_ride`.`to`=`tblocc`.`id` WHERE  `tbl_ride`.`ride_id`='$viewAllIdd' AND `tbl_ride`.`customer_user_id`='$userid'";

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

   function ced_cancelAllRides($viewallid){

    $userid = $_SESSION['user']['user_id'];

    try {
        $sql = "UPDATE `tbl_ride` SET `status`=0 WHERE `customer_user_id`='$userid' AND `ride_id`='$viewallid'";

        $res = $this->conn->query($sql);

        if ($res == TRUE) {
        
            return 1;
        } else {
            return 0;
        }
    } catch (Exception $e) {
        return $e;
    }
   }
   
    //Pending rides
    function ced_getPendingrides()
    {

        $userid = $_SESSION['user']['user_id'];

        try {
            $sql = "SELECT (COUNT(*)) `countrides` FROM `tbl_ride` WHERE `tbl_ride`.`status`=1 AND `tbl_ride`.`customer_user_id`='$userid' GROUP BY `tbl_ride`.`status`";

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

    function ced_getPendingridedetails()
    {

        $userid = $_SESSION['user']['user_id'];

        try {
            $sql = "SELECT (ROW_NUMBER() OVER (ORDER BY `ride_id` )) `SNo`,`ride_id`,`ride_date`, `tbloc`.`name` 'Pickup' , `tblocc`.`name` 'Drop', `total_distance`, `luggage`, `total_fare`, `tbl_ride`.`status`,`tbl_user`.`name`, `cab_type` FROM `tbl_ride` LEFT JOIN `tbl_user` ON `tbl_ride`.`customer_user_id`=`tbl_user`.`user_id` LEFT JOIN `tbl_location` AS `tbloc` ON `tbl_ride`.`from`=`tbloc`.`id` LEFT JOIN `tbl_location` AS `tblocc` ON `tbl_ride`.`to`=`tblocc`.`id` WHERE `tbl_ride`.`status`=1 AND  `tbl_ride`.`customer_user_id`='$userid'";

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

function ced_viewPendRides($ride_id){

    $userid = $_SESSION['user']['user_id'];

    try {
        $sql = "SELECT (ROW_NUMBER() OVER (ORDER BY `ride_id` )) `SNo`,`ride_id`,`ride_date`, `tbloc`.`name` 'Pickup' , `tblocc`.`name` 'Drop', `total_distance`, `luggage`, `total_fare`, `tbl_ride`.`status`,`tbl_user`.`name`, `cab_type` FROM `tbl_ride` LEFT JOIN `tbl_user` ON `tbl_ride`.`customer_user_id`=`tbl_user`.`user_id` LEFT JOIN `tbl_location` AS `tbloc` ON `tbl_ride`.`from`=`tbloc`.`id` LEFT JOIN `tbl_location` AS `tblocc` ON `tbl_ride`.`to`=`tblocc`.`id` WHERE `tbl_ride`.`status`=1 AND `tbl_ride`.`ride_id`='$ride_id' AND `tbl_ride`.`customer_user_id`='$userid'";

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
    //delete pending rides

   function  ced_delPendingridedet($ride_id){

    $userid = $_SESSION['user']['user_id'];

    try {
        $sql = "DELETE FROM `tbl_ride` WHERE `ride_id`='$ride_id' AND `customer_user_id`='$userid' AND `status`=1";

        $res = $this->conn->query($sql);

        if ($res == TRUE) {
        
            return 1;
        } else {
            return 0;
        }
    } catch (Exception $e) {
        return $e;
    }
   }
    //Completed rides detail

    function ced_getCompletedrides()
    {

        $userid = $_SESSION['user']['user_id'];

        try {
            $sql = "SELECT (COUNT(*)) `countrides` FROM `tbl_ride` WHERE `tbl_ride`.`status`=0 AND `tbl_ride`.`customer_user_id`='$userid' GROUP BY `tbl_ride`.`status`";

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

    function ced_getCompletedridedetails()
    {

        $userid = $_SESSION['user']['user_id'];

        try {
            $sql = "SELECT (ROW_NUMBER() OVER (ORDER BY `ride_id` )) `SNo`,`ride_id`,`ride_date`, `tbloc`.`name` 'Pickup' , `tblocc`.`name` 'Drop', `total_distance`, `luggage`, `total_fare`, `tbl_ride`.`status`,`tbl_user`.`name`, `cab_type` FROM `tbl_ride` LEFT JOIN `tbl_user` ON `tbl_ride`.`customer_user_id`=`tbl_user`.`user_id` LEFT JOIN `tbl_location` AS `tbloc` ON `tbl_ride`.`from`=`tbloc`.`id` LEFT JOIN `tbl_location` AS `tblocc` ON `tbl_ride`.`to`=`tblocc`.`id` WHERE `tbl_user`.`status`='1' AND `tbl_ride`.`status`=2 AND `tbl_ride`.`customer_user_id`='$userid'";

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

function ced_viewcompleterideid($completerideid){
    $userid = $_SESSION['user']['user_id'];

    try {
        $sql = "SELECT (ROW_NUMBER() OVER (ORDER BY `ride_id` )) `SNo`,`ride_id`,`ride_date`, `tbloc`.`name` 'Pickup' , `tblocc`.`name` 'Drop', `total_distance`, `luggage`, `total_fare`, `tbl_ride`.`status`,`tbl_user`.`name`, `cab_type` FROM `tbl_ride` LEFT JOIN `tbl_user` ON `tbl_ride`.`customer_user_id`=`tbl_user`.`user_id` LEFT JOIN `tbl_location` AS `tbloc` ON `tbl_ride`.`from`=`tbloc`.`id` LEFT JOIN `tbl_location` AS `tblocc` ON `tbl_ride`.`to`=`tblocc`.`id` WHERE `tbl_ride`.`ride_id`='$completerideid' AND `tbl_ride`.`status`=2 AND  `tbl_ride`.`customer_user_id`='$userid'";

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


    function ced_gettotalamounpaid()
    {

        $userid = $_SESSION['user']['user_id'];

        try {
            $sql = "SELECT (SUM(`total_fare`)) `countrides` FROM `tbl_ride` WHERE `tbl_ride`.`status`=2 AND `tbl_ride`.`customer_user_id`='$userid'";

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
    //Completed rides detail end

    


    //Cancelled ride

   function ced_getCancelledidedetails(){

    $userid = $_SESSION['user']['user_id'];

    try {
        $sql = "SELECT (ROW_NUMBER() OVER (ORDER BY `ride_id` )) `SNo`,`ride_id`,`ride_date`, `tbloc`.`name` 'Pickup' , `tblocc`.`name` 'Drop', `total_distance`, `luggage`, `total_fare`, `tbl_ride`.`status`,`tbl_user`.`name`, `cab_type` FROM `tbl_ride` LEFT JOIN `tbl_user` ON `tbl_ride`.`customer_user_id`=`tbl_user`.`user_id` LEFT JOIN `tbl_location` AS `tbloc` ON `tbl_ride`.`from`=`tbloc`.`id` LEFT JOIN `tbl_location` AS `tblocc` ON `tbl_ride`.`to`=`tblocc`.`id` WHERE `tbl_ride`.`status`=0 AND  `tbl_ride`.`customer_user_id`='$userid'";

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
