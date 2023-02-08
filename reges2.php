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
                <label for="Phone">Phone</label>
                <input type="number" name="Phone" placeholder="Enter Phone" id="Phone">
                <label for="Email">Email</label>
                <input type="Email" placeholder="Enter Email" name="Email">
                <label for="Work">Work</label>
                <input type="text" placeholder="Enter Work" name="Work">
                <label for="Experience">Experience</label>
                <input type="text" placeholder="Enter Experience" name="Experience">
                <label for="Qualification">Qualification</label>
                <input type="text" placeholder="Enter Qualification" name="Qualification">
                <button type="submit" name="bt_next">Next</button>
                <p>I have account <a href="login.php">login?</a></p>

                <?php
                if (isset($_POST['bt_next'])) {

                    session_start();
                    $_SESSION['Phone'] = $_POST['Phone'];
                    $_SESSION['Email'] = $_POST['Email'];
                    $_SESSION['Work'] = $_POST['Work'];
                    $_SESSION['Experience'] = $_POST['Experience'];
                    $_SESSION['Qualification'] = $_POST['Qualification'];

                    header("Location: reges3.php");
                }
                ?>
            </div>
        </form>
    </section>


</body>

</html>