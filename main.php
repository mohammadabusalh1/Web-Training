<!DOCTYPE html>
<html lang="en">

<?php
include 'conn/connc.php';
session_start();
$name = $_SESSION['uname'];
if ($_SESSION['login'] == 0) {
    echo '<script> window.location.replace("login.php")</script>';
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="css\style.css">
</head>

<body>
<a href="addTask.php">Add task</a>

    <?php
    $sql = "SELECT mem_id FROM users WHERE username = '$name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $mem_id = $row["mem_id"];

        $sql1 = "SELECT * FROM `tasks` WHERE `assigning_member` = '".$mem_id."'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            $row1 = mysqli_fetch_assoc($result1);
            
        }
    } else {
        echo "Username and password not found";
    }
    ?>

</body>

</html>