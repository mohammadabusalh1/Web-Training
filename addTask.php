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
    <link rel="stylesheet" href="css/addTask.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Main</title>
</head>

<body>

    <header>
        <i class="fas fa-home">
            <h4>HOME</h4>
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
            $priority = ($priority == "") ? 1 : $priority;
            $assigned_member = $_POST["assigned_member"];
            $status = "Pending";

            if (strtotime($end_date) < strtotime($start_date)) {
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