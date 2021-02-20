
    <?php include_once 'header.php' ?>

    <section class="mainsec">


        <div class="bg-img">
            <form method="POST" class="container">

                <h2 class="sectionhead">Wanna Have A Drive Your Way </h2>
                <h2 class="sectionbook">Book Now !!!</h2><br>


                <label for="pickup"><b>PICKUP LOCATION</b></label>
                <select class="selectitem" id="pickupLocation" name="pickupLocation" onchange="showdrop(this)" required>
                    <option value="">Select Pickup Location</option>
                    <?php
                    foreach ($locations as $key => $values) {
                    ?>
                        <option value="<?= trim($values, ''); ?>"><?= $key ?></option>
                    <?php }
                    ?>
                </select>

                <label for="drop"><b>DROP LOCATION</b></label>
                <select class="selectitem" id="dropLocation" name="dropLocation" required>
                    <option value="">Select Drop Location</option>
                    <?php
                    foreach ($locations as $key => $values) {
                    ?>
                        <option value="<?= trim($values, '') ?>"><?= $key ?></option>
                    <?php }
                    ?>

                </select>

                <label for="cabtype"><b>CAB TYPE</b></label>
                <select class="selectitem" id="cabtype" name="cabtype" required>
                    <option value="">Select Cab type</option>
                    <?php
                    foreach ($cabTypes as $key => $values) {
                    ?>
                        <option value="<?= trim($key, '') ?>"><?= $key ?></option>
                    <?php }
                    ?>
                </select>

                <label for=""><b>LUGGAGE</b></label>
                <input type="number" placeholder="" id="luggage" name="luggage" required>


                <button type="submit" class="btn" id="submit" name="submit">CALCULATE FARE</button>
            </form>
        </div>

    </section>



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
                    
                        <div id="detailsdata"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Book </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>





    <?php include_once 'footer.php' ?>
