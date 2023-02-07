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
                <label for="uname">Username</label>
                <input type="text" name="uname" placeholder="Enter Username" id="uname">
                <label for="password">Password</label>
                <input type="password" placeholder="Enter Username" name="password">
                <button type="submit" name="bt_login">Login</button>
                <p>I do not have an account <a href="reges.php">Create an account?</a></p>

                <?php
                if (isset($_POST['bt_login'])) {
                    $username = $_POST['uname'];
                    $password = $_POST['password'];

                    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        session_start();
                        $_SESSION['login'] = 1;
                        $_SESSION['uname'] = $username;
                        header("Location: main.php");
                    } else {
                        echo "<p  style=\"color: red;\">user dose not exist</p>";
                    }
                }
                ?>
            </div>
        </form>
    </section>


</body>

</html>