<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event reminder system";
    $conn = mysqli_connect($servername, $username, $password, $dbname);


    mysqli_select_db($conn, 'dbname');
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $userId = $row['id'];
        // echo "Welcome " . $row['fullname'] . $row['id'];
    ?>

    <div class="sidebar">
        <div class="navTitle">
            <div class="logo">
                <div class="img">
                    <img src="/ers/css/images/logo.png">
                </div>
            </div>
            <div class="navTitleDetails">
                <div class="navTitleName">
                    <h1><?php echo "Welcome, " . $row['fullname'];
                        }

                            ?></h1>
                </div>
                <div class="navTitleDate">
                    <script>
                    var today = new Date();
                    var todayDate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    document.write(`<h1>${todayDate} </h1>`)
                    </script>
                    <div id="timer">
                        <script>
                        setInterval(function() {
                            var currentTime = new Date();
                            var currentHours = currentTime.getHours();
                            var currentMinutes = currentTime.getMinutes();
                            var currentSeconds = currentTime.getSeconds();
                            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
                            var timeOfDay = (currentHours < 12) ? "AM" : "PM";
                            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
                            currentHours = (currentHours == 0) ? 12 : currentHours;
                            var currentTimeString = currentHours + ":" + currentMinutes + ":" +
                                currentSeconds + " " + timeOfDay;
                            document.getElementById("timer").innerHTML = currentTimeString;
                        }, 10);
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu">
            <div class="home">
                <a href="/ers/dashboard.php">Home </a>
            </div>
            <div class="events">
                <a href="/ers/html/events.php">Events </a>
            </div>
            <div class="completed">
                <a href="/ers/html/completed.php">Completed Events </a>
            </div>
            <div class="setting">
                <a href="/ers/html/setting.php">Setting </a>
            </div>
            <div class="logout">
                <a href="/ers/php/logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>