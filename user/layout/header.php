<?php session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 0 ) {
	die("You can not access !");
}
else if(!isset($_SESSION['user']['email_id'])){
    header('location:index.php');
}
else
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>CEDCAB</title>
    <link rel="stylesheet" href="../user/assets/styles/style.css">
</head>

<body>
<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">CEDCABWA</a>
            </div>
            <ul class="nav navbar-nav">

                <li class="active"><h4 style="color: white;">Welcome user <?=  $_SESSION['user']['email_id']; ?></h4></li>
                <li><a class="navbar-olink" href="#">PASSWORD CHANGE</a></li> 
                <li><a class="navbar-olink" href="#">PROFILE UPDATE</a></li> 
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a class="navbar-olink" href="bookcab.php">BOOK CAB</a></li>
             <li><img id="profilepic" class="profilepics" src="../user/assets/images/profile.png"></li> 
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> SIGN OUT</a></li>
                
                <!-- <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li> -->
            </ul>
        </div>
    </nav>
</header>

