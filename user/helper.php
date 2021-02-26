<?php
session_start();

include_once('../ClassFiles/tbl_location.php');
include_once('../ClassFiles/tbl_ride.php');
include_once('../ClassFiles/tbl_user.php');


if (isset($_POST['action'])) {
    $action = $_POST['action'];

    $rideobject = new tbl_ride();
    $objectloc = new tbl_location();



    switch ($action) {

        case 'storecalculatedval': {
                $bookdetails = $rideobject->storecalculateFare();
                echo $bookdetails;
            }
            break;
        case 'userinsertdata': {

                $savefaresession = $rideobj->ced_savecaldata();
                echo json_encode($savefaresession);
            }
            break;
        case 'usercalculatedval': {
                $bookdetails = $rideobject->usercalculateFare($pickUp, $drop, $cabType, $luggage);
                echo $bookdetails;
            }
            break;
        case 'getDropdown': {

                $selectlocdata = $objectloc->ced_getDropdown();
                echo json_encode($selectlocdata);
            }
            break;
        case 'delsession': {

                $selectsesdata = $rideobject->ced_delsession();
                echo json_encode($selectsesdata);
            }
            break;
        case 'gettotalrides': {
                $gettotalrides = $rideobject->ced_getTotalrides();
                echo json_encode($gettotalrides);
            }
            break;
        case 'gettotalridesdet': {
                $selectuserdata = $rideobject->ced_getUserdata();
                echo json_encode($selectuserdata);
            }
            break;
        case 'viewAllId': {

                $viewAllIdd = $_POST['viewAllIdd'];
                $selectuserdata = $rideobject->ced_viewAllRides($viewAllIdd);

                echo json_encode($selectuserdata);
            }
            break;
        case 'cancelAllId': {

                $viewallid = $_POST['cancelAllId'];
                $selectuserdata = $rideobject->ced_cancelAllRides($viewallid);
                echo json_encode($selectuserdata);
            }
            break;

        case 'getPendingrides': {

                $pendingridedata = $rideobject->ced_getPendingrides();
                echo json_encode($pendingridedata);
            }
            break;

        case 'getPendingridedetail': {

                $pendingridedata = $rideobject->ced_getPendingridedetails();
                echo json_encode($pendingridedata);
            }
            break;

        case 'deletingpendride': {
                $ride_id = $_POST['deleteid'];
                $pendingridedata = $rideobject->ced_delPendingridedet($ride_id);
                echo $pendingridedata;
            }
            break;

        case 'viewPendRides': {
                $ride_id = $_POST['pendingId'];
                $pendingridedata = $rideobject->ced_viewPendRides($ride_id);
                echo json_encode($pendingridedata);
            }
            break;

        case 'getCompletedrides': {
                $getCompletedrides = $rideobject->ced_getCompletedrides();
                echo json_encode($getCompletedrides);
            }
            break;
        case 'getCancelledidedetails': {
                $getCancelledidedetails = $rideobject->ced_getCancelledidedetails();
                echo json_encode($getCancelledidedetails);
            }
            break;
        case 'getCompletedridedetails': {
                $getCompletedridedetails = $rideobject->ced_getCompletedridedetails();
                echo json_encode($getCompletedridedetails);
            }
            break;
        case 'viewcompleterideid': {
                $completerideid = $_POST['completerideid'];
                $viewcompleterideid = $rideobject->ced_viewcompleterideid($completerideid);
                echo json_encode($viewcompleterideid);
            }
            break;
        case 'gettotalamount': {
                $gettotalamount = $rideobject->ced_gettotalamounpaid();
                echo json_encode($gettotalamount);
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

        case 'insertdata': {

                $pickupLocation = $_POST['pickupLocation'];
                $dropLocation = $_POST['dropLocation'];
                $cabtype = $_POST['cabtype'];
                $luggage = $_POST['luggage'];
                $totalfare = $_POST['totalfare'];
                $totaldistance = $_POST['totaldistance'];
                $savefaresession = $rideobj->ced_savecaldata($pickupLocation, $dropLocation, $cabtype, $luggage, $totalfare, $totaldistance);
                echo json_encode($savefaresession);
            }
            break;
        default:

            echo "Something Went Wrong";
    }
} else {
    die("<h1> WOO!! You Can't access </h1>");
}
