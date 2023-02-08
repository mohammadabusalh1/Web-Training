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
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter Username" id="name">
                <label for="Id">Id</label>
                <input type="number" placeholder="Enter Id" name="Id">
                <label for="Nationality">Nationality</label>
                <input type="text" placeholder="Enter Nationality" name="Nationality">
                <label for="Address">Address</label>
                <input type="text" placeholder="Enter Address" name="Address">
                <button type="submit" name="bt_next">Next</button>
                <p>I have account <a href="login.php">login?</a></p>

                <?php
                if (isset($_POST['bt_next'])) {

                    session_start();

                    $_SESSION['name'] = $_POST['name'];
                    $_SESSION['Id'] = $_POST['Id'];
                    $_SESSION['Nationality'] = $_POST['Nationality'];
                    $_SESSION['Address'] = $_POST['Address'];

                    header("Location: reges2.php");
                }
                ?>
            </div>
        </form>
    </section>


</body>

</html>