<?php
session_start();
$_SESSION = [];
session_destroy();
setcookie("user_email", $user_email, strtotime("-1 days"));
header('Location: login.php');
?>