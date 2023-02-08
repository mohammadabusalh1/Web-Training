<?php
session_start();
$_SESSION['login'] =0;
echo '<script> window.location.replace("login.php")</script>';
?>