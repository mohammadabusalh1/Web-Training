<!DOCTYPE html>
<html lang="en">

<?php
include 'conn/connc.php';

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css\style.css">
</head>

<body>

    <section id="login">
        <form method="post">
            <div id="info">
                <label for="Photo">Photo</label>
                <input type="file" name="Photo" placeholder="Enter Photo" id="Photo">
                <label for="CV">CV</label>
                <input type="file" placeholder="Enter CV" name="CV">
                <button type="submit" name="bt_next">Sign Up</button>
                <p>I have account <a href="login.php">login?</a></p>

                <?php
                if (isset($_POST['bt_next'])) {

                    session_start();
                    $sql = "INSERT INTO `members`(`name`, `id`, `nationality`, `address`, `phone`, `email`, `work`, `experience`, `qualification`, `photo`, `CV`) VALUES ('".$_SESSION['name']."','".$_SESSION['Id']."','".$_SESSION['Nationality']."','".$_SESSION['Address']."','".$_SESSION['Phone']."','".$_SESSION['Email']."','".$_SESSION['Work']."','".$_SESSION['Experience']."','".$_SESSION['Qualification']."','".$_POST['Photo']."','".$_POST['CV']."')";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        header("Location: eAccount.php");
                    } else {
                        echo "<p  style=\"color: red;\">There exist problem</p>";
                    }

                    header("Location: eAccount.php");
                }
                ?>
            </div>
        </form>
    </section>


</body>

</html>