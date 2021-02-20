$('#submit').on('click', () => {
    //validateData();

    if ($('#cedname').val() == "") {
        $('.errors').text(" * Enter Username");

    } else

    if ($('#cedpassword').val() == "") {

        $('.errors').text(" * Enter Password");

    } else
    if ($('#cedemail').val() == "") {

        $('.errors').text(" * Enter Email Id");

    } else
    if ($('#cedmobile').val() == "") {

        $('.errors').text(" * Enter Mobile Number");

    } else {



        let cedname = $('#cedname').val();
        let cedpassword = $('#cedpassword').val();
        let cedemail = $('#cedemail').val();
        let cedmobile = $('#cedmobile').val();
        //let action = ($('.btnn').val() == 'insert') ? 'insert' : 'update';



        $.ajax({
            url: 'helper.php',
            type: 'POST',
            data: {
                'cedname': cedname,
                'cedpassword': cedpassword,
                'cedemail': cedemail,
                'cedmobile': cedmobile,
                'action': 'insert'
            },
            success: (response) => {
                alert(response);
            },
            error: (response) => {
                console.log(response);
            }
        });

    }
});

$('#reset').on('click', () => {
    $('#cedname').val('');
    $('#cedpassword').val('');
    $('#cedemail').val('');
    $('#cedmobile').val('');
});


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
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });

    }
});