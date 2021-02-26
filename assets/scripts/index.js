$(document).ready(function() {
    $('#usermodalshow').modal('show');
    $('#emailotpdiv').hide();
    $('#mobileverifydiv').hide();
    $('#mobileotpdiv').hide();
    $('#detailsdiv').hide();

    getDropdown();

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



// $('#reset').on('click', () => {
//     $('#cedname').val('');
//     $('#cedpassword').val('');
//     $('#cedemail').val('');
//     $('#cedmobile').val('');
// });

$("#pickupLocation").on("change", function() {
    $("#dropLocation option").show();
    $("#dropLocation option[value=" + $(this).val() + "]").hide();

});

$("#dropLocation").on("change", function() {
    $("#pickupLocation option").show();
    $("#pickupLocation option[value=" + $(this).val() + "]").hide();
});


/***LOGIN STARTS */
///Login Check JS

$('#loginsubmit').on('click', () => {

    if ($('#cedemail').val() == "") {
        $('.errors').text(" * Enter Username");

    } else

    if ($('#cedpassword').val() == "") {

        $('.errors').text(" * Enter Password");

    } else {


        let cedpassword = $('#cedpassword').val();
        let cedemail = $('#cedemail').val();

        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {
                'cedpassword': cedpassword,
                'cedemail': cedemail,
                'action': 'logincheck'
            },
            success: (flag) => {

                switch (flag) {
                    case '1':
                        console.log('this is admin');
                        window.location.href = "admin";
                        break;

                    case '0':
                        console.log('this is active customer');
                        window.location.href = "user";
                        break;

                    case '-1':
                        console.log('this is blocked customer');
                        break;

                    case '-2':
                        console.log('this is worng credentials');
                        break;

                    default:
                        console.log('somthing went wrong' + flag);
                        break;
                }
            },
            error: (response) => {
                alert(response);
            }
        });

    }
});

/***LOGIN ENDS */

/***EMAIL VERIFY STARTS */
///Email Check JS

$('#submitemail').on('click', () => {

    if ($('#cedemail').val() == "") {
        $('.errors').text(" * Enter Email");

    } else {

        let cedemail = $('#cedemail').val();

        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {

                'cedemail': cedemail,
                'action': 'emailcheck'
            },
            success: (response) => {
                if (response == 1) {
                    $('#emailverifydiv').hide();
                    $('#emailotpdiv').show();
                    $('.emailotpmsg').text('OTP SENT TO : ' + cedemail);
                } else {
                    alert("Email Already Exists!!")
                }
            },
            error: (response) => {
                alert(response);
            }
        });

    }
});

//JS for Email OTP
$('#submiteotp').on('click', () => {

    if ($('#cedemailotp').val() == "") {
        $('.errors').text(" * Enter OTP");

    } else {

        let cedemailotp = $('#cedemailotp').val();

        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {

                'cedemailotp': cedemailotp,
                'action': 'emailcheckotp'
            },
            success: (response) => {
                if (response == 1) {
                    $('#emailotpdiv').hide();
                    $('#mobileverifydiv').show();
                    $('.mobilemsg').text('EMAIL VERIFIED NOW VERIFY MOBILE');
                } else {
                    alert("Wrong OTP!!")
                }
            },
            error: (response) => {
                alert(response);
            }
        });

    }
});

/***EMAIL VERIFY ENDS */

/***MOBILE VERIFY STARTS */
///Mobile Check JS

$('#mobilesubmit').on('click', () => {

    let cedmobile = $('#cedmobile').val();

    if (cedmobile == "") {
        $('.errors').text(" * Enter Mobile Number");

    } else {

        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {

                'cedmobile': cedmobile,
                'action': 'mobilecheck'
            },
            success: (response) => {
                if (response == 1) {
                    $('#mobileverifydiv').hide();
                    $('#mobileotpdiv').show();
                    $('.mobotpmsg').text('OTP SENT TO : ' + cedmobile);
                } else {
                    alert("Mobile Number Already Exists!!")
                }
            },
            error: (response) => {
                alert(response);
            }
        });

    }
});

//JS for Mobile OTP

$('#submitmotp').on('click', () => {

    let cedmobileotp = $('#cedmobileotp').val();

    if ($('#cedmobileotp').val() == "") {
        $('.errors').text(" * Enter OTP");

    } else {


        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {

                'cedmobileotp': cedmobileotp,
                'action': 'mobilecheckotp'
            },
            success: (response) => {
                if (response == 1) {
                    $('#mobileotpdiv').hide();
                    $('#detailsdiv').show();

                } else {
                    alert("OOPS Not Registered!!")
                }
            },
            error: (response) => {
                alert(response);
            }
        });

    }
});

/***MOBILE VERIFY ENDS */

/***REGISTER JS STARTS  */

$('#detailsdiv').on('submit', (e) => {

    e.preventDefault();

    var formddatas = new FormData(document.getElementById("detailsdiv"));


    formddatas.append('file', $('input[type=file]')[0].files[0]);
    formddatas.append('action', 'insert');


    if ($('#cedname').val() == "") {
        $('.errors').text(" * Enter Username");

    } else

    if ($('#cedpassword').val() == "") {

        $('.errors').text(" * Enter Password");

    } else {



        $.ajax({
            url: 'helper.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: formddatas,

            success: (response) => {
                if (response == 1) {
                    window.location.href = "login.php";
                } else {
                    alert("something went wrong");
                }
            },
            error: (response) => {
                alert(response);
            }
        });

    }
});

/**REGISTER ENDS */

/***LOGOUT STARTS*/


$('#logoutsubmit').on('click', () => {

    $.ajax({
        url: 'helper.php',
        type: 'POST',
        data: {
            'action': 'logout'
        },
        success: (response) => {
            if (response == 1) {
                window.location.href = "login.php";
            } else {
                alert("something went wrong");
            }
        },
        error: (response) => {

            alert(response);
        }
    });


});

/***LOG OUT ENDS */



/***Fare Calculater Starts*/
//dropdown

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
                            .attr("value", datarespond[i]['id'])
                            .text(datarespond[i]['name']));

                    $('#dropLocation')
                        .append($("<option></option>")
                            .attr("value", datarespond[i]['id'])
                            .text(datarespond[i]['name']));

                }



            } else {
                alert("something is wrong");
            }
        },
        error: (response) => {

            alert(response);
        }
    });
}




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
                'action': 'calculate'
            },
            success: (response) => {
                let jsonData = JSON.parse(response);

                $('#detailsdata').html("<h3>PICKUP LOCATION :" + jsonData.fromLocation + "</h3><h3>DROP LOCATION :" + jsonData.toLocation + "</h3><h3>CAB TYPE :" + cabtype + "</h3><h3>LUGGAGE :" + luggage + " Kg</h3><h3>FARE :" + jsonData.totalfare + " /-Rs</h3><h3>TOTAL DISTANCE :" + jsonData.totaldistance + "Km</h3>");

                $('#modalshow').modal('show');


                $('#bookcab').on('click', function() {

                    $('#quesdata').html("<h1>Are You Registered</h1>");
                    $('#modalcheckuser').modal('show');
                    $('#yeslogin').on('click', () => {

                        $.ajax({
                            url: 'helper.php',
                            type: 'POST',
                            data: {
                                'pickupLocation': jsonData.fromLocation,
                                'dropLocation': jsonData.toLocation,
                                'cabtype': cabtype,
                                'luggage': luggage,
                                'totalfare': jsonData.totalfare,
                                'totaldistance': jsonData.totaldistance,
                                'action': 'savefaresession'
                            },
                            success: function(response) {
                                if (response == 1) {
                                    window.location.href = "login.php";
                                }
                            }
                        });
                        $('#nosignup').on('click', () => {
                            window.location.href = "signup.php";
                        });
                    });
                });
            },
            error: function(response) {
                $('#detailsdata').html("something went wrong");
                $('#modalshow').modal('show');
            }
        });
    }

});






/***Fare Calculater End*/

// $('#bookcab').on('click', function() {

//     $.ajax({
//         url: 'helper.php',
//         type: 'POST',
//         data: {
//             'pickupLocation': jsonData.fromLocation,
//             'dropLocation': jsonData.toLocation,
//             'cabtype': cabtype,
//             'luggage': luggage,
//             'totalfare': jsonData.totalfare,
//             'totaldistance': jsonData.totaldistance,
//             'action': 'storecalculatedval'
//         },
//         success: (response) => {
//             if (response == 0) {
//                 $('#quesdata').html("<h1>Are You Registered</h1>");
//                 $('#modalcheckuser').modal('show');
//                 $('#yeslogin').on('click', () => {
//                     window.location.href = "login.php";
//                 });
//                 $('#nosignup').on('click', () => {
//                     window.location.href = "signup.php";
//                 });
//             }
//         }
//     });


// });


// $('#calsubmit').on('click', () => {

//     let pickupLocation = $('#pickupLocation').val();
//     let dropLocation = $('#dropLocation').val();
//     let cabtype = $('#cabtype').val();
//     let luggage = $('#luggage').val();

//     if ($('#pickupLocation').val() == "") {
//         $('.errors').text(" * Select Pickup");

//     } else
//     if ($('#dropLocation').val() == "") {
//         $('.errors').text(" * Select Drop");

//     } else
//     if ($('#cabtype').val() == "") {
//         $('.errors').text(" * Select Cabtype");

//     } else {

//         $('.errors').remove();
//         $.ajax({
//             url: 'helper.php',
//             type: 'POST',
//             data: {
//                 'pickupLocation': pickupLocation,
//                 'dropLocation': dropLocation,
//                 'cabtype': cabtype,
//                 'luggage': luggage,
//                 'action': 'calculate'
//             },
//             success: (response) => {
//                 let jsonData = JSON.parse(response);

//                 $('#detailsdata').html("<h3>PICKUP LOCATION :" + jsonData.fromLocation + "</h3><h3>DROP LOCATION :" + jsonData.toLocation + "</h3><h3>CAB TYPE :" + cabtype + "</h3><h3>LUGGAGE :" + luggage + " Kg</h3><h3>FARE :" + jsonData.totalfare + " /-Rs</h3><h3>TOTAL DISTANCE :" + jsonData.totaldistance + "Km</h3>");

//                 $('#modalshow').modal('show');

//                 /**CAB BOOK */

//                 $('#bookcab').on('click', function() {

//                     $('#quesdata').html("<h1>Are You Registered</h1>");
//                     $('#modalcheckuser').modal('show');
//                     $('#yeslogin').on('click', () => {
//                         window.location.href = "login.php";

//                         $('#bookinsert').on('click', () => {

//                             $.ajax({
//                                 url: '../helper.php',
//                                 type: 'POST',
//                                 data: {
//                                     'pickupLocation': jsonData.fromLocation,
//                                     'dropLocation': jsonData.toLocation,
//                                     'cabtype': cabtype,
//                                     'luggage': luggage,
//                                     'totalfare': jsonData.totalfare,
//                                     'totaldistance': jsonData.totaldistance,
//                                     'action': 'storecalculatedval'
//                                 },
//                                 success: (response) => {
//                                     console.log(response);
//                                 }
//                             });


//                         });
//                     });
//                     $('#nosignup').on('click', () => {
//                         window.location.href = "signup.php";
//                     });
//                 });
//                 /**CAB BOOK ENDS */

//             },
//             error: function(response) {
//                 $('#detailsdata').html("something went wrong");
//                 $('#modalshow').modal('show');
//             }
//         });
//     }

// });
/**CAB BOOK */

/**CAB BOOK ENDS */

//
/**CAB BOOK */

// $('#bookcab').on('click', function() {

//     $('#quesdata').html("<h1>Are You Registered</h1>");
//     $('#modalcheckuser').modal('show');
//     $('#yeslogin').on('click', () => {
//         window.location.href = "login.php";

//         $('#bookinsert').on('click', () => {

//             $.ajax({
//                 url: './helper.php',
//                 type: 'POST',
//                 data: {
//                     'pickupLocation': jsonData.fromLocation,
//                     'dropLocation': jsonData.toLocation,
//                     'cabtype': cabtype,
//                     'luggage': luggage,
//                     'totalfare': jsonData.totalfare,
//                     'totaldistance': jsonData.totaldistance,
//                     'action': 'storecalculatedval'
//                 },
//                 success: (response) => {
//                     console.log(response);
//                 }
//             });


//         });
//     });
//     $('#nosignup').on('click', () => {
//         window.location.href = "signup.php";
//     });
// });
/**CAB BOOK ENDS */

//bhj


// $('#bookcab').on('click', function() {

//     $.ajax({
//         url: 'helper.php',
//         type: 'POST',
//         data: {
//             'pickupLocation': jsonData.fromLocation,
//             'dropLocation': jsonData.toLocation,
//             'cabtype': cabtype,
//             'luggage': luggage,
//             'totalfare': jsonData.totalfare,
//             'totaldistance': jsonData.totaldistance,
//             'action': 'storecalculatedval'
//         },
//         success: (response) => {
//             if (response == 0) {
//                 $('#quesdata').html("<h1>Are You Registered</h1>");
//                 $('#modalcheckuser').modal('show');
//                 $('#yeslogin').on('click', () => {
//                     window.location.href = "login.php";
//                 });
//                 $('#nosignup').on('click', () => {
//                     window.location.href = "signup.php";
//                 });
//             }
//         }
//     });
// });