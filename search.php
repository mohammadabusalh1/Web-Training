<!DOCTYPE html>
<html lang="en">

<?php
include 'conn/connc.php';
session_start();
$name = $_SESSION['uname'];
if ($_SESSION['login'] == 0) {
    echo '<script> window.location.replace("login.php")</script>';
}

$sql = "SELECT mem_id FROM users WHERE username = '$name'";
$result = mysqli_query($conn, $sql);
$mem_id = 0;
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $mem_id = $row["mem_id"];
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/team.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Main</title>
</head>

<body>

    <header>
        <i class="fas fa-home">
        <a href="main.php"><h4>HOME</h4></a>
        </i>
        <div id="links">
            <a href="about.php">About us</a>
            <a href="about.php">Contact us</a>
            <a href="logout.php">logout</a>
        </div>
    </header>

    <nav id="breadcrumb_navigation">
        <a href="addTask.php">Add task</a><br>
        <a href="search.php">Team members tasks</a><br>
        <a href="Late.php">Late</a><br>
        <a href="Pending.php">Pending</a><br>
        <a href="Active.php">Active</a><br>

    </nav>

    <section id="hero">
        <form method="post">
            <select name="searchOp" id="searchOp">
                <option value="star_date">start date</option>
                <option value="end_date">end date</option>
                <option value="priority">priority</option>
                <option value="assigned_member">assigned member</option>
                <option value="status">status</option>
            </select>
            <input type="text" name="searchIn" id="searchIn" placeholder="#Search">
            <button type="submit" name="bt_search">search</button>
        </form>

        <form method="post" id="form2">
            <select name="orderOp" id="orderOp">
                <option value="star_date">start date</option>
                <option value="end_date">end date</option>
                <option value="priority">priority</option>
                <option value="assigned_member">assigned member</option>
                <option value="status">status</option>
            </select>
            <button type="submit" name="bt_order">Order</button>
        </form>

        <div id="contaner">

            <?php

            $sql1 = "SELECT * FROM `tasks` WHERE assigning_member = '" . $mem_id . "'";
            $result1 = mysqli_query($conn, $sql1);
            if (isset($_POST["bt_order"])) {

                $searchOp = $_POST["orderOp"];
                $sql1 = "SELECT * FROM `tasks` WHERE assigning_member = '" . $mem_id . "' ORDER BY " . $searchOp . "";

                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $id  = $row1["id"];
                        $title = $row1["title"];
                        $priority = $row1["priority"];
                        $assigned_member = $row1["assigned_member"];
                        $status = $row1["status"];
                        $star_date = $row1["star_date"];
                        $end_date = $row1["end_date"];

                        $style = "";

                        if ($status == "Active") {
                            $style = "background-color: yellow;";
                        } else if ($status == "Finished") {
                            $style = "background-color: green;";
                        } else if ($status == "Late") {
                            $style = "background-color: red; color:white;";
                        }

                        $sql2 = "SELECT * FROM `members` WHERE `id` = '" . $assigned_member . "'";
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            $row2 = mysqli_fetch_assoc($result2);
                            $name = $row2["name"];
                            echo "<a href=\"editTask.php?id=$id\"><div style=\"" . $style . "\" class=\"card\"> <h2>Title: $title</h2> <h6>Priority: $priority</h6> <h6>Status: $status</h6> <h6>Assigned by: $name</h6>" .
                                "<h6>start date: $star_date</h6> <h6>end date: $end_date</h6>  " .
                                "<a href=\"accept.php?id=$id\"> <button name=\"bt_accept\">Accept</button></a>" .
                                "<a href=\"finsh.php?id=$id\"> <button name=\"bt_finsh\">Finish</button></a></div></a>";
                        }
                    }
                }
            }

            if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $id  = $row1["id"];
                    $title = $row1["title"];
                    $priority = $row1["priority"];
                    $assigned_member = $row1["assigned_member"];
                    $status = $row1["status"];
                    $star_date = $row1["star_date"];
                    $end_date = $row1["end_date"];

                    $style = "";

                    if ($status == "Active") {
                        $style = "background-color: yellow;";
                    } else if ($status == "Finished") {
                        $style = "background-color: green;";
                    } else if ($status == "Late") {
                        $style = "background-color: red; color:white;";
                    }

                    $sql2 = "SELECT * FROM `members` WHERE `id` = '" . $assigned_member . "'";
                    $result2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($result2) > 0) {
                        $row2 = mysqli_fetch_assoc($result2);
                        $name = $row2["name"];
                        echo "<a href=\"editTask.php?id=$id\"><div style=\"" . $style . "\" class=\"card\"> <h2>Title: $title</h2> <h6>Priority: $priority</h6> <h6>Status: $status</h6> <h6>Assigned by: $name</h6>" .
                            "<h6>start date: $star_date</h6> <h6>end date: $end_date</h6>  " .
                            "<a href=\"accept.php?id=$id\"> <button name=\"bt_accept\">Accept</button></a>" .
                            "<a href=\"finsh.php?id=$id\"> <button name=\"bt_finsh\">Finish</button></a></div></a>";
                    }
                }
            }

            if (isset($_POST["bt_search"])) {

                $searchOp = $_POST["searchOp"];
                $searchIn = $_POST["searchIn"];

                $sql1 = "SELECT * FROM `tasks` WHERE assigning_member = '" . $mem_id . "'";

                switch ($searchOp) {
                    case "star_date":
                        $sql1 .= " AND `star_date` = '$searchIn'";
                        break;
                    case "end_date":
                        $sql1 .= " AND `end_date` = '$searchIn'";
                        break;
                    case "priority":
                        $sql1 .= " AND `priority` = '$searchIn'";
                        break;
                    case "assigned_member":
                        $sql2 = "SELECT `id` FROM `members` WHERE `name` = '" . $searchIn . "'";
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            $row2 = mysqli_fetch_assoc($result2);
                            $id = $row2["id"];
                            $sql1 .= " AND `assigned_member` = '$id'";
                        }
                        break;
                    case "status":
                        $sql1 .= " AND `status` = '$searchIn'";
                        break;
                    default:
                        break;
                }

                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $id  = $row1["id"];
                        $title = $row1["title"];
                        $priority = $row1["priority"];
                        $assigned_member = $row1["assigned_member"];
                        $status = $row1["status"];
                        $star_date = $row1["star_date"];
                        $end_date = $row1["end_date"];

                        $style = "";

                        if ($status == "Active") {
                            $style = "background-color: yellow;";
                        } else if ($status == "Finished") {
                            $style = "background-color: green;";
                        } else if ($status == "Late") {
                            $style = "background-color: red; color:white;";
                        }

                        $sql2 = "SELECT * FROM `members` WHERE `id` = '" . $assigned_member . "'";
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            $row2 = mysqli_fetch_assoc($result2);
                            $name = $row2["name"];
                            echo "<a href=\"editTask.php?id=$id\"><div style=\"" . $style . "\" class=\"card\"> <h2>Title: $title</h2> <h6>Priority: $priority</h6> <h6>Status: $status</h6> <h6>Assigned by: $name</h6>" .
                                "<h6>start date: $star_date</h6> <h6>end date: $end_date</h6>  " .
                                "<a href=\"accept.php?id=$id\"> <button name=\"bt_accept\">Accept</button></a>" .
                                "<a href=\"finsh.php?id=$id\"> <button name=\"bt_finsh\">Finish</button></a></div></a>";
                        }
                    }
                }
            }
            ?>
        </div>


    </section>

    <footer>
        <i class="fas fa-home">
            <h4>HOME</h4>
        </i>
        <div id="box_cont">
            <div class="box">
                <h4>Links</h4>
                <a href="about.php">About us</a>
                <a href="about.php">Contact us</a>
                <a href="logout.php">logout</a>
            </div>

            <?php
            $sql = "SELECT name, id, nationality, address, phone, email, work, experience, qualification FROM members WHERE id = '$mem_id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row["name"];
                $id = $row["id"];
                $nationality = $row["nationality"];
                $address = $row["address"];
                $phone = $row["phone"];
                $email = $row["email"];
                $work = $row["work"];
                $experience = $row["experience"];
                $qualification = $row["qualification"];
            }
            ?>


            <div class="box">
                <h4>Contact us</h4>
                <a href="#"><i class="fa fa-phone" aria-hidden="true"></i>
                    <h6><?php echo "" . $phone . "<br>"; ?> </h6>
                </a>
                <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>
                    <h6> <?php echo "" . $email . "<br>"; ?> </h6>
                </a>
            </div>
        </div>
    </footer>


</body>

</html>