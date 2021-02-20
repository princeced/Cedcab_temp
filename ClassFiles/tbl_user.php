<?php
include_once('ClassFiles/Ceddatabase_con.php');

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


   // function __construct($email_id, $name, $mobile, $password)
   // {
   //    $dbcon = new Ceddatabase_con();
   //    $this->conn = $dbcon->conn;

   //    $this->email_id = $email_id;
   //    $this->name = $name;
   //    $this->mobile = $mobile;
   //    $this->password = $password;
   // }


   function ced_registerUser($email_id, $name, $mobile, $password)
   {


      try {

         $sql = "INSERT INTO `tbl_user`( `email_id`, `name`, `dateofsignup`, `mobile`, `status`, `password`) VALUES  ('$email_id','$name',now(),'$mobile','1','$password')";


         $res = $this->conn->query($sql);

         if ($res == true) {
            return "Record created successfully";
         } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
         }
      } catch (Exception $e) {
         return $e;
      }
   }


   function ced_loginUser($email_id, $password)
   {
      $this->email = $email_id;
      $this->password = md5($password);

      try {

         $sql = "SELECT  `email_id`, `password` FROM `tbl_user` WHERE `email_id`=$this->email AND `password`= $this->password";

         $res = $this->conn->query($sql);

         if ($res->num_rows > 0) {

            $users = $res->fetch_assoc();

            return 1;
         }


      } catch (Exception $e) {
         return $e;
      }
   }
}
