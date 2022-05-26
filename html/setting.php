    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event Reminder System</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <?php
    session_start();

    if ($_SESSION['loggedIn']) {


        include "../database/conn.php";

        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $userId = $row['id'];
            // echo "Welcome " . $row['fullname'] . $row['id'];

    ?>

    <body>
        <div class="main-container">
            <?php
                    include_once "./sidebar.php"
                    ?>
            <div class="content">
                <div class="changeName">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <label>Change Name </label>
                        <input type="text" name="newName" value="<?php echo $row['fullname'] ?> ">
                        <br>
                        <input name="submit" type="submit">
                    </form>
                    <!-- <form>

                        <label>New Password </label>
                        <input type="password" name="newPassword" placeholder="*******">

                        <label>Confirm Password </label>
                        <input type="password" name="confirmPassword" placeholder="*******">
                    </form> -->
                </div>
            </div>
        </div>
        <?php
            if (isset($_POST['submit'])) {
                $newName = $_POST['newName'];
                // $confirmPassword = md5($_POST['confirmPassword']);
                // $q = "UPDATE `users` SET `fullname`='$newName', `password`='$confirmPassword' WHERE `id`='$userId' ";
                $q = "UPDATE `users` SET `fullname`='$newName' WHERE `id`='$userId' ";
                $query = mysqli_query($conn, $q);
                // if ($conn->query($q)) {
                //     echo "data inserted";
                // } else {
                //     die(mysqli_error($conn));
                // }
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    } else {
        header('location:../login.php');
    }
        ?>
    </body>

    </html>