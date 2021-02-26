$(document).ready(function() {


    getDropdown();
    getTotalrides();
    getUserdetails();
    getCompletedrides();
    getPendingrides();
    getPendingridedetails();
    getCancelledidedetails();
    getTotalamountpaid();
    getCompletedridedetails();

    $('#cabtype').on('change', function() {

        if (this.value == "CedMicro") {

            $('#luggage').prop('disabled', true);
            $('#luggage').val('');
            $('#luggage').attr('placeholder', 'No Luggage Cost');

        } else {

            $('#luggage').prop('disabled', false);
            $('#luggage').attr('placeholder', 'Enter Luggage in kg');

        }
    });


});


$("#pickupLocation").on("change", function() {
    $("#dropLocation option").show();
    $("#dropLocation option[value=" + $(this).val() + "]").hide();

});

$("#dropLocation").on("change", function() {
    $("#pickupLocation option").show();
    $("#pickupLocation option[value=" + $(this).val() + "]").hide();
});


function getDropdown() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'getDropdown'
        },
        success: (response) => {
            let datarespond = JSON.parse(response);

            if (datarespond != 0) {

                for (let i = 0; i < datarespond.length; i++) {

                    $('#pickupLocation')
                        .append($("<option></option>")
                            .attr("value", datarespond[i]['distance'])
                            .text(datarespond[i]['name']));

                    $('#dropLocation')
                        .append($("<option></option>")
                            .attr("value", datarespond[i]['distance'])
                            .text(datarespond[i]['name']));

                }


            } else {
                alert("something is wrong");
            }
        },
        error: (response) => {

            console.log(response);
        }
    });
}

//calculate fare


$('#calsubmit').on('click', () => {

    let pickupLocation = $('#pickupLocation').val();
    let dropLocation = $('#dropLocation').val();
    let cabtype = $('#cabtype').val();
    let luggage = $('#luggage').val();

    if ($('#pickupLocation').val() == "") {
        $('.errors').text(" * Select Pickup");

    } else
    if ($('#dropLocation').val() == "") {
        $('.errors').text(" * Select Drop");

    } else
    if ($('#cabtype').val() == "") {
        $('.errors').text(" * Select Cabtype");

    } else {

        $('.errors').remove();
        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {
                'pickupLocation': pickupLocation,
                'dropLocation': dropLocation,
                'cabtype': cabtype,
                'luggage': luggage,
                'action': 'usercalculatedval'
            },
            success: (response) => {
                console.log(response);
                let jsonData = JSON.parse(response);

                $('#detailsdata').html("<h3>PICKUP LOCATION :" + jsonData.fromLocation + "</h3><h3>DROP LOCATION :" + jsonData.toLocation + "</h3><h3>CAB TYPE :" + cabtype + "</h3><h3>LUGGAGE :" + luggage + " Kg</h3><h3>FARE :" + jsonData.totalfare + " /-Rs</h3><h3>TOTAL DISTANCE :" + jsonData.totaldistance + "Km</h3>");

                $('#modalshow').modal('show');


            },
            error: function() {
                $('#errorsdata').html("<h1 style='color:red;'>Something went wrong</h1>");
                $('#errormodalshow').modal('show');
            }
        });
    }

});

$('#bookcab').on('click', function() {

    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'userinsertdata'
        },
        success: function(response) {
            if (response == 1) {
                window.location.href = "index.php";
            }
        }
    });
});

function getUserdetails() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'gettotalridesdet'
        },
        success: (response) => {


            let datarespond = JSON.parse(response);

            if (datarespond != 0) {

                for (let i = 0; i < datarespond.length; i++) {

                    let status;

                    if (datarespond[i]['status'] == 1) {
                        status = "Pending";

                    } else if (datarespond[i]['status'] == 2) {
                        status = "Complete";

                    } else {
                        status = "Cancelled";

                    }

                    if (datarespond[i]['status'] == 1) {
                        $('#totalridess').append('<tr class="trcss"><td>' + datarespond[i]['SNo'] + '</td> <td>' + datarespond[i]['ride_date'] + '</td><td>' + datarespond[i]['Drop'] + '</td><td>' + datarespond[i]['Pickup'] + '</td><td>' + datarespond[i]['total_distance'] + '</td><td>' + datarespond[i]['luggage'] + '</td><td>' + datarespond[i]['total_fare'] + '</td><td>' + datarespond[i]['cab_type'] + '</td><td><span class="label label-warning">' + status + '<span></td><td><button class="btnn btn-danger" onclick="viewAllRides(' + datarespond[i]['ride_id'] + ')">View Ride</button></td><td><button class="btn btn-danger" id="cancelbutton" onclick="cancelAllRides(' + datarespond[i]['ride_id'] + ')">Cancel Ride</button></td></tr>');
                    } else {
                        $('#totalridess').append('<tr class="trcss"><td>' + datarespond[i]['SNo'] + '</td> <td>' + datarespond[i]['ride_date'] + '</td><td>' + datarespond[i]['Drop'] + '</td><td>' + datarespond[i]['Pickup'] + '</td><td>' + datarespond[i]['total_distance'] + '</td><td>' + datarespond[i]['luggage'] + '</td><td>' + datarespond[i]['total_fare'] + '</td><td>' + datarespond[i]['cab_type'] + '</td><td><span class="label label-primary">' + status + '<span></td><td><button class="btnn btn-danger" onclick="viewAllRides(' + datarespond[i]['ride_id'] + ')">View Ride</button></td><td></td></tr>');
                    }


                }


            } else {
                alert("something is wrong");
            }
        },
        error: (response) => {

            console.log(response);
        }
    });
}

function viewAllRides(viewallid) {


    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {
            'viewAllIdd': viewallid,
            'action': 'viewAllId'
        },
        success: (response) => {

            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                let status;

                if (datarespond[i]['status'] == 1) {
                    status = "Pending";
                } else if (datarespond[i]['status'] == 2) {
                    status = "Complete";
                } else {
                    status = "Cancelled";
                }



                $('#totaltridesdetails').html("<h3>Ride Date :" + datarespond[i]['ride_date'] + "</h3> <h3>Drop :" + datarespond[i]['Drop'] + "</h3>  <h3>Pick Up :" + datarespond[i]['Pickup'] + "</h3><h3>LUGGAGE :" + datarespond[i]['luggage'] + " Kg</h3> <h3>Cab Type :" + datarespond[i]['cab_type'] + "</h3><h3>Total Fare :" + datarespond[i]['total_fare'] + "-/RS</h3><h3>Status :" + status + "</h3>");

            }

            $('#totalridemodalshow').show();
        },
        error: (response) => {

            console.log(response);
        }
    });

}

function cancelAllRides(viewallid) {

    if (confirm("Are You Sure Want To Update Data?") == true) {

        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {
                'cancelAllId': viewallid,
                'action': 'cancelAllId'
            },
            success: (response) => {;
                if (response == 1) {
                    alert("Update Successfully");
                    location.reload();
                } else {
                    alert("Not Updated");
                }
            },
            error: (response) => {

                console.log(response);
            }
        });

    } else {
        console.log("OK");
    }


}

//Pending Rides
function getPendingrides() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'getPendingrides'
        },
        success: (response) => {
            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#pendingrides').text(datarespond[i]['countrides']);
            }
        },
        error: (response) => {

            console.log(response);
        }
    });
}

function getPendingridedetails() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'getPendingridedetail'
        },
        success: (response) => {

            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#tbtr').append('<tr class="trcss"><td>' + datarespond[i]['SNo'] + '</td> <td>' + datarespond[i]['ride_date'] + '</td><td>' + datarespond[i]['Drop'] + '</td><td>' + datarespond[i]['Pickup'] + '</td><td>' + datarespond[i]['total_distance'] + '</td><td>' + datarespond[i]['luggage'] + '</td><td>' + datarespond[i]['total_fare'] + '</td><td>' + datarespond[i]['cab_type'] + '</td><td><button class="btnn btn-danger" onclick="viewPendRides(' + datarespond[i]['ride_id'] + ')">View Ride</button></td><td><button class="btnn btn-danger" onclick="deletependingRides(' + datarespond[i]['ride_id'] + ')">Cancel Ride</button></td></tr>');
            }
        },
        error: (response) => {

            console.log(response);
        }
    });
}

function deletependingRides(valueid) {


    if (confirm("Are You Sure Want To Delete Data?") == true) {

        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {
                'deleteid': valueid,
                'action': 'deletingpendride'
            },
            success: (response) => {;
                if (response == 1) {
                    alert("Deleted Successfully");
                    location.reload();
                } else {
                    alert("NotDeleted");
                }
            },
            error: (response) => {

                console.log(response);
            }
        });

    } else {
        console.log("OK");
    }


}

function viewPendRides(pendinid) {

    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {
            'pendingId': pendinid,
            'action': 'viewPendRides'
        },
        success: (response) => {
            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#penddetails').html("<h3>Ride Date :" + datarespond[i]['ride_date'] + "</h3> <h3>Drop :" + datarespond[i]['Drop'] + "</h3>  <h3>Pick Up :" + datarespond[i]['Pickup'] + "</h3><h3>LUGGAGE :" + datarespond[i]['luggage'] + " Kg</h3> <h3>Cab Type :" + datarespond[i]['cab_type'] + "</h3><h3>Total Fare :" + datarespond[i]['total_fare'] + "-/RS</h3>");

            }

            $('#pendmodalshow').show();
        },
        error: (response) => {

            console.log(response);
        }
    });
}

//completed rides

function getCompletedrides() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'getCompletedrides'
        },
        success: (response) => {
            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#cancelledrides').text(datarespond[i]['countrides']);
            }
        },
        error: (response) => {

            console.log(response);
        }
    });
}

function getCompletedridedetails() {

    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'getCompletedridedetails'
        },
        success: (response) => {
            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#totalspendride').append('<tr class="trcss"><td>' + datarespond[i]['SNo'] + '</td> <td>' + datarespond[i]['ride_date'] + '</td><td>' + datarespond[i]['Drop'] + '</td><td>' + datarespond[i]['Pickup'] + '</td><td>' + datarespond[i]['total_distance'] + '</td><td>' + datarespond[i]['luggage'] + '</td><td>' + datarespond[i]['total_fare'] + '</td><td>' + datarespond[i]['cab_type'] + '</td><td>Completed</td><td><button class="btnn btn-danger" onclick="viewAllCompleteRides(' + datarespond[i]['ride_id'] + ')">View Ride</button></td></tr>');
            }
        },
        error: (response) => {

            console.log(response);
        }
    });

}

function viewAllCompleteRides(completerideid) {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {
            'completerideid': completerideid,
            'action': 'viewcompleterideid'
        },
        success: (response) => {

            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {



                $('#totalspentdetails').html("<h3>Ride Date :" + datarespond[i]['ride_date'] + "</h3> <h3>Drop :" + datarespond[i]['Drop'] + "</h3>  <h3>Pick Up :" + datarespond[i]['Pickup'] + "</h3><h3>LUGGAGE :" + datarespond[i]['luggage'] + " Kg</h3><h3>DISTANCE :" + datarespond[i]['total_distance'] + " Km</h3> <h3>Cab Type :" + datarespond[i]['cab_type'] + "</h3><h3>Total Fare :" + datarespond[i]['total_fare'] + "-/RS</h3>");

            }

            $('#totalspentmodalshow').show();
        },
        error: (response) => {

            console.log(response);
        }
    });

}

function getTotalrides() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'gettotalrides'
        },
        success: (response) => {
            console.log(response);
            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#totalrides').text(datarespond[i]['countrides']);
            }
        },
        error: (response) => {

            console.log(response);
        }
    });

}

function getTotalamountpaid() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'gettotalamount'
        },
        success: (response) => {

            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#tamountpaid').text(datarespond[i]['countrides']);
            }
        },
        error: (response) => {

            console.log(response);
        }
    });
}

//cancelled rides

function getCancelledidedetails() {
    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {

            'action': 'getCancelledidedetails'
        },
        success: (response) => {
            let datarespond = JSON.parse(response);

            for (let i = 0; i < datarespond.length; i++) {

                $('#canceltbl').append('<tr class="trcss"><td>' + datarespond[i]['SNo'] + '</td> <td>' + datarespond[i]['ride_date'] + '</td><td>' + datarespond[i]['Drop'] + '</td><td>' + datarespond[i]['Pickup'] + '</td><td>' + datarespond[i]['total_distance'] + '</td><td>' + datarespond[i]['luggage'] + '</td><td>' + datarespond[i]['total_fare'] + '</td><td>' + datarespond[i]['cab_type'] + '</td><td><span style="color:red;border-radius:15px">Cancelled<span></td><td><button class="btnn btn-danger" onclick="viewRides(' + datarespond[i]['ride_id'] + ')">View Ride</button></td></tr>');

            }
        },
        error: (response) => {

            console.log(response);
        }
    });

}





$('#close').on('click', () => {
        $('#canelmodalshow').hide();
        $('#pendmodalshow').hide();
        $('#totalridemodalshow').hide();
        $('#pendmodalshow').hide();
        $('#totalspentmodalshow').hide();
    })
    //cancel ends


//opening pages

function opencancelpage() {
    location.href = "cancelrides.php";
}

function openpendingpage() {
    location.href = "index.php";
}

function opentotalridepage() {
    location.href = "totalride.php";
}

function opentotalspentpage() {
    location.href = "totalspentrides.php";
}