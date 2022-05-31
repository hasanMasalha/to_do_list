<?php session_start();?>
<?php require_once("header.php");?>
<?php 
    if(!isset($_SESSION['user_email']))
    {
        //if user is not logged in.
        header('Location: login.php');
        exit;
    } 
?>
<?php require_once("footer.php");?>