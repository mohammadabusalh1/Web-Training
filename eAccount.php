<!DOCTYPE html>
<html lang="en">

<?php
include 'conn/connc.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css\style.css">
</head>

<body>

    <section id="login">
        <form method="post">
            <div id="info">
                <h3>Enter Your Username And Password</h3>
                <label for="uname">Username</label>
                <input type="text" name="uname" placeholder="Enter Username" id="uname">
                <label for="password">Password</label>
                <input type="password" placeholder="Enter Username" name="password">
                <button type="submit" name="bt_login">Sign Up</button>
                <?php
                if (isset($_POST['bt_login'])) {

                    $member_id = 0;
                    do {
                        $member_id = rand(100000, 999999);
                        $sql = "SELECT * FROM users WHERE mem_id = '$member_id'";
                        $result = mysqli_query($conn, $sql);
                    } while (mysqli_num_rows($result) > 0);


                    session_start();
                    $sql1 = "INSERT INTO `users`(`username`, `password`, `mem_id`) VALUES ('" . $_POST['uname'] . "','" . $_POST['password'] . "','" . $_SESSION['Id'] . "')";
                    $result1 = mysqli_query($conn, $sql1);
                    header("Location: login.php");
                }
                ?>
            </div>
        </form>
    </section>


</body>

</html>