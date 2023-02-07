<?php  
$conn = mysqli_connect("localhost","root","","tasks");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>