<?php include_once 'layout/header.php' ?>

<section class="mainsec">



  <div class="bg-img">

    <form method="POST" class="container" id="emailverifydiv">

      <h2 class="sectionhead"> COME VERIFY EMAIL </h2>

      <label for="cedemail"><b>EMAIL ID</b></label>
      <input type="email" placeholder="Enter Email Id" id="cedemail" name="cedemail" autocomplete="on">
      <button type="button" class="btnn" id="submitemail" name="submitemail" > SEND OTP </button>

      <span class="errors" style="color: red;"></span>
    </form>

    <form method="POST" class="container" id="emailotpdiv">
        <h3 class="emailotpmsg"></h3>
      <label for="cedemail"><b>ENTER OTP</b></label>
      <input type="text" placeholder="Enter Otp" id="cedemailotp" name="cedemailotp" autocomplete="on">

      <button type="button" class="btnn" id="submiteotp" name="submiteotp" > VERIFY </button>

      <span class="errors" style="color: red;"></span>
    </form>



    <form method="POST" class="container" id="mobileverifydiv">
    <h3 class="mobilemsg"></h3>
      <label for="cedmobile"><b>MOBILE NUMBER</b></label>
      <input type="number" placeholder="Enter Mobile Number" id="cedmobile" name="cedmobile" autocomplete="on">

          <button type="button" class="btnn" id="mobilesubmit" name="mobilesubmit" > SEND OTP </button>
          <span class="errors" style="color: red;"></span>
    </form>

    <form method="POST" class="container" id="mobileotpdiv">
    <h3 class="mobotpmsg"></h3>
      <label for="cedemail"><b>ENTER OTP</b></label>
      <input type="text" placeholder="Enter OTP" id="cedmobileotp" name="cedmobileotp" autocomplete="on">

      <button type="button" class="btnn" id="submitmotp" name="submitmotp" > VERIFY </button>

      <span class="errors" style="color: red;"></span>
    </form>

    <form method="POST" class="container" id="detailsdiv" >

    <label for="file"><b>UPLOAD PROFILE IMAGE </b></label>
    <input type='file' name='file' id='file' class='form-control' >


      <label for="username"><b>NAME</b></label>
      <input type="text" placeholder="Enter Name" id="cedname" name="cedname" autocomplete="on">

      <label for="cedpassword"><b>PASSWORD</b></label>
      <input type="password"  id="cedpassword" name="cedpassword" autocomplete="on">

      <button type="submit" class="btnn" id="submit" name="submit" value="insert"> SIGN UP </button>
      <span class="errors" style="color: red;"></span>
    </form>


  </div>



</section>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2 id="errormsg"></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>


<?php include_once 'layout/footer.php' ?>