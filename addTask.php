<!DOCTYPE html>
<html lang="en">

<?php
include 'conn/connc.php';
session_start();
$name = $_SESSION['uname'];

$sql = "SELECT mem_id FROM users WHERE username = '$name'";
$result = mysqli_query($conn, $sql);
$mem_id = 0;
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $mem_id = $row["mem_id"];
    echo "Your id is $mem_id";
}

if ($_SESSION['login'] == 0) {
    echo '<script> window.location.replace("login.php")</script>';
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body style="padding: 60px;">

    <form method="post">
        <label for="title">*Title:</label><br>
        <input type="text" id="title" name="title"><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="start_date">*Start Date:</label><br>
        <input type="date" id="start_date" name="start_date"><br><br>

        <label for="end_date">*End Date:</label><br>
        <input type="date" id="end_date" name="end_date"><br><br>

        <label for="priority">Priority:</label><br>
        <select id="priority" name="priority">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select><br><br>

        <label for="assigned_member">*Assigned Member:</label><br>
        <input type="text" id="assigned_member" name="assigned_member"><br><br>

        <button type="submit" name="addTast">Add</button>
    </form>

    <?php
    if (isset($_POST['addTast'])) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $priority = $_POST["priority"];
        $priority = ($priority == "")?1:$priority;
        $assigned_member = $_POST["assigned_member"];
        $status = "Pending";

        if (strtotime($end_date) <= strtotime($start_date)) {
            echo "Error: End date must be greater than start date.";
            exit;
        } else {
            $sql = "SELECT * FROM members WHERE id = '$assigned_member'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $sql = "INSERT INTO tasks (title, description, star_date, end_date, priority, assigned_member, assigning_member, status)
                VALUES ('$title', '$description', '$start_date', '$end_date', '$priority', '$assigned_member', '$mem_id', '$status')";

                if (mysqli_query($conn, $sql)) {
                    echo "New task added successfully";
                } else {
                    echo "Error adding task: " . mysqli_error($conn);
                }
            } else {
                echo "Error: Assigned member with id '$assigned_member' does not exist.";
            }
        }
    }
    ?>

</body>

</html>