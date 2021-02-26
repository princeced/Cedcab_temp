<?php session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
	die("You can not access !");
}else if(!isset($_SESSION['user']['email_id'])){
    header('location:index.php');
}
else
?>
<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>CEDCAB-Admin</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>
</head>
<body>


<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">CEDCABWA</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php"><h4>Welcome  <?=  $_SESSION['user']['email_id']; ?></h4></a></li>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> LOG OUT</a></li>
            </ul>
        </div>
    </nav>
</header>
