<!DOCTYPE html>
<html lang="en">

<?php
include 'conn/connc.php';
session_start();
$name = $_SESSION['uname'];
if ($_SESSION['login'] == 0) {
    echo '<script> window.location.replace("login.php")</script>';
}

$id = $_GET['id'];
$sql = "SELECT * FROM tasks WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$task = mysqli_fetch_assoc($result);
$title = $task["title"];
$description = $task["description"];
$start_date = $task["star_date"];
$end_date = $task["end_date"];
$priority = $task["priority"];
$assigned_member = $task["assigned_member"];
$assigning_member = $task["assigning_member"];
$status = $task["status"];

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>

<body style="padding: 60px;">

    <form method="post">
        <input type="hidden" name="task_id" value="<?php echo $id; ?>">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $description; ?></textarea>
        </div>
        <div>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
        </div>
        <div>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
        </div>
        <div>
            <label for="priority">Priority:</label>
            <select id="priority" name="priority">
                <option value="1" <?php if ($priority == "1") echo "selected"; ?>>1</option>
                <option value="2" <?php if ($priority == "2") echo "selected"; ?>>2</option>
                <option value="3" <?php if ($priority == "3") echo "selected"; ?>>3</option>
            </select>
        </div>
        <div>
            <label for="assigned_member">Assigned Member:</label>
            <select id="assigned_member" name="assigned_member">
                <?php
                $sql = "SELECT * FROM members";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["id"];
                    $name = $row["name"];
                    echo "<option value='$id'";
                    if ($id == $assigned_member) echo "selected";
                    echo ">$name</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Pending" <?php if ($status == "Pending") echo "selected"; ?>>Pending</option>
                <option value="Active" <?php if ($status == "In Progress") echo "selected"; ?>>In Progress</option>
                <option value="Finished" <?php if ($status == "Completed") echo "selected"; ?>>Completed</option>
            </select>
        </div>
        <button name="update_task">Update</button>
    </form>

    <?php

    if (isset($_POST["update_task"])) {
        $task_id = $_POST["task_id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $priority = $_POST["priority"];
        $assigned_member = $_POST["assigned_member"];
        $status = $_POST["status"];

        $sql = "UPDATE tasks SET title='$title', description='$description', star_date='$start_date', end_date='$end_date', priority='$priority', assigned_member='$assigned_member', status='$status' WHERE id='$task_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Task updated successfully";
        } else {
            echo "Error updating task: " . mysqli_error($conn);
        }
    }


    ?>

</body>

</html>