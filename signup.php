<?php include_once 'header.php' ?>

<section class="mainsec">



    <div class="bg-img">

        <form method="POST" class="container">
       
            <h2 class="sectionhead"> COME JOIN US </h2>

            
            <label for="username"><b>NAME</b></label>
            <input type="text" placeholder="Enter Name" id="cedname" name="cedname" autocomplete="on">
            


            <label for="cedpassword"><b>PASSWORD</b></label>
            <input type="password" placeholder="Enter Password" id="cedpassword" name="cedpassword" autocomplete="on">
            


            <label for="cedemail"><b>EMAIL ID</b></label>
            <input type="email" placeholder="Enter Email Id" id="cedemail" name="cedemail" autocomplete="on">
            


            <label for="cedmobile"><b>MOBILE NUMBER</b></label> 
            <input type="number" placeholder="Enter Mobile Number" id="cedmobile" name="cedmobile" autocomplete="on">
           


            <button type="button" class="btnn" id="submit" name="submit" value="insert"> SIGN UP </button>
            <button type="button" class="btnn" id="update" name="update" value="update" hidden> UPDATE </button>
            <button type="button" class="btnn" id="reset" name="reset"> RESET </button>
            <span class="errors"  style="color: red;"></span>
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


<?php include_once 'footer.php' ?>