<?php include_once 'layout/header.php'; {
    if (!isset($_SESSION['ride']['isridestore'])) {


?>

        <section class="mainseccc">

            <div>

            </div>

            <div class="outercont">
                <div class="container1">
                    <h3>Cancelled Rides</h3>
                    <h1 id="cancelledrides">0</h1>
                    <button class="btnc" onclick="opencancelpage()">Cancelled Rides</button>
                </div>
                <div class="container2">
                    <h3>Pending Rides</h3>
                    <h1 id="pendingrides">0</h1>
                    <button class="btnc" onclick="openpendingpage()">Pending Rides</button>
                </div>
                <div class="container3">
                    <h3>Total Rides</h3>
                    <h1 id="totalrides">0</h1>
                    <button class="btnc" onclick="opentotalridepage()">Total Rides</button>
                </div>
                <div class="container4">
                    <h3>Total Spent</h3>
                    <h1 id="tamountpaid">0</h1>
                    <button class="btnc" onclick="opentotalspentpage()">Total Spent</button>
                </div>
            </div>

<div class="selectsdiv">
            <div class="form-group">

                <label for="exampleInputEmail1">Select To Filter</label>
                <select class="form-select" id="rideselect" aria-label="Default select example">
                    <option selected>Please Select</option>
                    <option value="ride_date">Ride Date</option>
                    <option value="from">Pickup Location</option>
                    <option value="status">Status</option>
                </select>
            </div>

            <div class="form-group">

                <label for="exampleInputEmail1">Select To Order</label>
                <select class="form-select" id="rideselect" aria-label="Default select example">
                    <option selected>Please Select</option>
                    <option value="ride_date">Ride Date</option>
                    <option value="from">Pickup Location</option>
                    <option value="status">Status</option>
                </select>
            </div>
            </div>

            <div id="tbl_div">





                <table id="mytable" class="table table-striped table-bordered table-sm tbb">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">RIDE DATE</th>
                            <th scope="col">FROM</th>
                            <th scope="col">TO</th>
                            <th scope="col">TOTAL DISTANCE</th>
                            <th scope="col">LUGGAGE</th>
                            <th scope="col">TOTAL FARE</th>
                            <th scope="col">CAB TYPE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbtr">

                    </tbody>
                </table>
            </div>


            <div class="modal" tabindex="-1" role="dialog" id="pendmodalshow">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">PENDING RIDE DETAILS</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div id="penddetails"></div>
                            <div class="modal-footer">

                                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        include_once 'layout/footer.php';
    } else {   ?>



        <div class="modal" tabindex="-1" role="dialog" id="modalshow">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">FARE CALCULATE</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div id="detailsdata">
                            <h3>PICKUP LOCATION : <?= $_SESSION['ride']['pickupLocation'] ?> </h3>
                            <h3>DROP LOCATION : <?= $_SESSION['ride']['dropLocation'] ?></h3>
                            <h3>CAB TYPE : <?= $_SESSION['ride']['cabtype'] ?></h3>
                            <h3>LUGGAGE : <?= $_SESSION['ride']['luggage'] ?> Kg</h3>
                            <h3>FARE : <?= $_SESSION['ride']['totalfare'] ?> /-Rs</h3>
                            <h3>TOTAL DISTANCE : <?= $_SESSION['ride']['totaldistance'] ?> Km</h3>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="bookcab" class="btn btn-primary"> Book </button>
                            <button type="button" id="closedel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                getTotalrides();
                getUserdetails();
                getCompletedrides();
                getPendingrides();
                getCompletedridedetails();

                getTotalamountpaid();
                $('#modalshow').modal('show');
            });


            $('#bookcab').on('click', () => {

                $.ajax({
                    url: 'helper.php',
                    type: 'POST',
                    data: {
                        'action': 'storecalculatedval'
                    },
                    success: (response) => {
                        if (response == 1) {
                            $('#modalshow').modal('hide');
                            location.reload();
                        }

                    },
                    error: function(response) {
                        $('#detailsdata').html("something went wrong");
                        $('#modalshow').modal('show');
                    }
                });

            });

            $('#closedel').on('click', () => {

                $.ajax({
                    url: 'helper.php',
                    type: 'POST',
                    data: {

                        'action': 'delsession'
                    },
                    success: (response) => {
                        if (response == 1) {
                            $('#modalshow').modal('hide');
                        }

                    },
                    error: function(response) {
                        $('#detailsdata').html("something went wrong");
                        $('#modalshow').modal('show');
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
                        console.log(datarespond);
                        if (datarespond != 0) {

                            for (let i = 0; i < datarespond.length; i++) {

                                //$('#tbtr').append('<tr class="trcss"><td>' + datarespond[i]['SNo'] + '</td> <td>' + datarespond[i]['ride_date'] + '</td><td>' + datarespond[i]['Drop'] + '</td><td>' + datarespond[i]['Pickup'] + '</td><td>' + datarespond[i]['total_distance'] + '</td><td>' + datarespond[i]['luggage'] + '</td><td>' + datarespond[i]['total_fare'] + '</td><td>' + datarespond[i]['cab_type'] + '</td><td>' + datarespond[i]['status'] + '</td><td><button type="button" class="btn btn-warning">Cancel</button></td></tr>');

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

            function getPendingrides() {
                $.ajax({
                    url: 'helper.php',
                    type: 'POST',
                    data: {

                        'action': 'getPendingrides'
                    },
                    success: (response) => {
                        let datarespond = JSON.parse(response);
                        console.log(response);
                        for (let i = 0; i < datarespond.length; i++) {

                            $('#pendingrides').text(datarespond[i]['countrides']);
                        }
                    },
                    error: (response) => {

                        console.log(response);
                    }
                });
            }

            //completed

            function getCompletedrides() {
                $.ajax({
                    url: 'helper.php',
                    type: 'POST',
                    data: {

                        'action': 'getCompletedrides'
                    },
                    success: (response) => {
                        let datarespond = JSON.parse(response);
                        console.log(response);
                        for (let i = 0; i < datarespond.length; i++) {

                            $('#completerides').text(datarespond[i]['countrides']);
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
                        console.log(response);
                        for (let i = 0; i < datarespond.length; i++) {

                            $('#completerides').text(datarespond[i]['countrides']);
                        }
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
                        let datarespond = JSON.parse(response);
                        console.log(response);
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
                        console.log(response);
                        let datarespond = JSON.parse(response);
                        console.log(response);
                        for (let i = 0; i < datarespond.length; i++) {

                            $('#tamountpaid').text(datarespond[i]['countrides']);
                        }
                    },
                    error: (response) => {

                        console.log(response);
                    }
                });
            }
        </script>
<?php
    }
}

?>