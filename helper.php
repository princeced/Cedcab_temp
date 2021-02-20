<?php
include_once('ClassFiles/tbl_location.php');
include_once('ClassFiles/tbl_ride.php');
include_once('ClassFiles/tbl_user.php');


if (isset($_POST['action'])) {

    $action = $_POST['action'];




    switch ($action) {
        case 'insert': {

                $name = $_POST['cedname'];
                $password = $_POST['cedpassword'];
                $email_id = $_POST['cedemail'];
                $mobile = $_POST['cedmobile'];

                $inserttouser = new tbl_user();

                $insertdata = $inserttouser->ced_registerUser($email_id, $name, $mobile, $password);

                echo  $insertdata;
            }
            break;
        case 'logincheck': {

                $password = $_POST['cedpassword'];
                $email_id = $_POST['cedemail'];

                $selectuser = new tbl_user();

                $selectdata = $selectuser->ced_loginUser($email_id, $password);

                print_r($selectdata);
                
            }
            break;
        default:
            echo "Something Went Wrong";
    }
} else {
    die("<h1> WOO!! You Can't access </h1>");
}
