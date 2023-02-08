<?php
include 'conn/connc.php';
$id = $_GET['id'];

$new_status = "Active";

$sql = "UPDATE tasks SET status='$new_status' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: main.php");
} else {
    echo "Error updating task status: " . mysqli_error($conn);
}
?>