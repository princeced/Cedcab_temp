<?php


include_once('Ceddatabase_con.php');
include_once('user/sendmail.php');
include_once('user/sendmobileotp.php');

class tbl_user extends Ceddatabase_con
{

   public  $user_id;
   public $email_id;
   public $name;
   public  $dateofsignup;
   public $mobile;
   public $status;
   public $password;
   public $is_admin;


   function __construct()
   {
      $dbcon = new Ceddatabase_con();
      $this->conn = $dbcon->conn;
   }


   function ced_emailCheck($email_id)
   {

      try {

         $sql = "SELECT  `email_id` FROM `tbl_user` WHERE `email_id`='$email_id'";

         $res = $this->conn->query($sql);

         if ($res->num_rows > 0) {

            return 0;
         } else {

            $sendmailer = new sendmail();
            $mailsend = $sendmailer->sendemailOtp($email_id);
            return $mailsend;
         }
      } catch (Exception $e) {
         return $e;
      }
   }

   function ced_emailCheckotp($cedemailotp)
   {
      try {
         if ($cedemailotp == $_SESSION["emailotp"]) {
            unset($_SESSION["emailotp"]);
            
            return 1;
         } else {
            return 0;
         }

      } catch (Exception $e) {
         return $e;
      }

   }

   function ced_mobileCheck($mobile)
   {
      try {

         $sql = "SELECT  `mobile` FROM `tbl_user` WHERE `mobile`='$mobile' ";

         $res = $this->conn->query($sql);

         if ($res->num_rows > 0) {

            return 0;
         } else {

            $sendmobileotp = new sendmobileotp();
            $otpsend = $sendmobileotp->send_mobileOtp($mobile);

            return $otpsend;

         }
      } catch (Exception $e) {
         return $e;
      }
   }

   function ced_mobileCheckotp($cedmobileotp)
   {
      try {
         if ($cedmobileotp == $_SESSION["mobileotp"]) {
            unset($_SESSION["mobileotp"]);
            
            return 1;
         } else {
            return 0;
         }
      } catch (Exception $e) {
         return $e;
      }
   }


   
   function ced_registerUser($email_id, $name, $mobile, $password,$location)
   {

      try {

         $sql = "INSERT INTO `tbl_user`( `email_id`, `name`, `dateofsignup`, `mobile`, `status`, `password`,`is_admin`,`profilepic`) VALUES  ('$email_id','$name',now(),'$mobile','1',md5('$password'),'0','$location')";


         $res = $this->conn->query($sql);

         if ($res == true) {

            return 1;
         } else {
            return 0;
         }
      } catch (Exception $e) {
         return $e;
      }
   }


   function ced_loginUser($email_id, $password)
   {
      $temp=md5($password);
      try {

         $sql = "SELECT * FROM `tbl_user` WHERE `email_id`='$email_id' AND `password`= '$temp' AND `status`=1";
         
         $res = $this->conn->query($sql);

         if ($res->num_rows > 0) {
            $users = $res->fetch_assoc();
           
            if ($users['is_admin'] == 1) {
               $_SESSION['user']['email_id'] = $users['email_id'];
               $_SESSION['user']['is_admin'] = $users['is_admin'];
               $_SESSION['user']['name'] = $users['name'];
               $_SESSION['user']['mobile'] = $users['mobile'];
               $_SESSION['user']['user_id'] = $users['user_id'];
               $flag = 1;
            }
            else{
               if ($users['status'] == 1) {
               $_SESSION['user']['email_id'] = $users['email_id'];
               $_SESSION['user']['is_admin'] = $users['is_admin'];
               $_SESSION['user']['name'] = $users['name'];
               $_SESSION['user']['mobile'] = $users['mobile'];
               $_SESSION['user']['user_id'] = $users['user_id'];
               $flag = 0;
               }
               else {
                 $flag = -1;
               }
            }

         } else {
            $flag = -2;
         }
         return $flag;
      } catch (Exception $e) {
         return $e;
      }
   }




}
