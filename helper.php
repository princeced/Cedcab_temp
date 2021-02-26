<?php
session_start();

include_once('ClassFiles/tbl_location.php');
include_once('ClassFiles/tbl_ride.php');
include_once('ClassFiles/tbl_user.php');





if (isset($_POST['action'])) {

    $selectuser = new tbl_user();
    $selectloc = new tbl_location();
    $rideobj = new tbl_ride();


    $action = $_POST['action'];

    switch ($action) {

        case 'emailcheck': {
                $email_id = $_POST['cedemail'];
                $_SESSION["email"] = $email_id;
                $selectdata = $selectuser->ced_emailCheck($email_id);
                echo $selectdata;
            }

            break;

        case 'emailcheckotp': {
                $cedemailotp = $_POST['cedemailotp'];
                $selectdata = $selectuser->ced_emailCheckotp($cedemailotp);
                echo $selectdata;
            }

            break;

        case 'mobilecheck': {
                $mobile = $_POST['cedmobile'];
                $_SESSION["mobilenumber"] = $mobile;
                $selectdata = $selectuser->ced_mobileCheck($mobile);

                echo $selectdata;
            }

            break;

        case 'mobilecheckotp': {
                $cedmobileotp = $_POST['cedmobileotp'];
                $selectdata = $selectuser->ced_mobileCheckotp($cedmobileotp);
                echo $selectdata;
            }

            break;

        case 'insert': {

                $name = $_POST['cedname'];
                $password = $_POST['cedpassword'];
                $email_id = $_SESSION["email"];
                $mobile = $_SESSION["mobilenumber"];

                $filename = $_FILES['file']['name'];

                $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
                $f_extension = strtolower($file_extension);

                $image_ext = array("jpg", "png", "jpeg", "gif");

                $response = 0;
                if (in_array($f_extension, $image_ext)) {

                    $newfilename =  $filename . "_" . $name . "." . $f_extension;

                    $location = 'user/upload/' . $newfilename;

                    move_uploaded_file($_FILES['file']['tmp_name'], $location);
                }


                if ($email_id != "" && $mobile != "") {

                    $insertdata = $selectuser->ced_registerUser($email_id, $name, $mobile, $password,  $location);

                    echo  $insertdata;
                } else {

                    echo 0;
                }
            }
            break;
        case 'logincheck': {

                $email_id = $_POST['cedemail'];
                $password = $_POST['cedpassword'];

                $selectdata = $selectuser->ced_loginUser($email_id, $password);

                echo $selectdata;
            }
            break;

        case 'getDropdown': {

                $selectlocdata = $selectloc->ced_getDropdown();
                echo json_encode($selectlocdata);
            }

            break;

        case 'calculate': {

                $pickupLocation = $_POST['pickupLocation'];
                $dropLocation = $_POST['dropLocation'];
                $cabtype = $_POST['cabtype'];
                $luggage = $_POST['luggage'];

                $calculatedFare = $rideobj->calculateFare($pickupLocation, $dropLocation, $cabtype, $luggage);
                echo json_encode($calculatedFare);
            }
            break;
        case 'savefaresession': {

            $pickupLocation=$_POST['pickupLocation'];
            $dropLocation=$_POST['dropLocation'];
            $cabtype=$_POST['cabtype'];
            $luggage=$_POST['luggage'];
            $totalfare=$_POST['totalfare'];
            $totaldistance=$_POST['totaldistance'];
                $savefaresession = $rideobj->ced_savefaresession($pickupLocation, $dropLocation, $cabtype, $luggage,$totalfare,$totaldistance);
                echo json_encode($savefaresession);

            }
            break;
        default:
            echo "Something Went Wrong";
    }
} else {
    die("<h1> WOO!! You Can't access </h1>");
}
