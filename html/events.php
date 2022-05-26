<!DOCTYPE html>
<html lang="en">
<style>
.hide {
    display: none;
}

.show {
    display: block;
}
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERS Events</title>
    <link rel="stylesheet" href="../css/style.css">
</head><?php session_start();

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

            <div class="content-list"><button id="listofEventBtn">List of events</button></div>
            <div class="content-features"><button id="addEventBtn" onclick="addevent()">Add Event</button></div>
            <div class="popupAddevent" id="addDetails" style="display: none;">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"><label>
                        <h3>Enter Event</h3>
                    </label><input type="text" name="eventTitle" placeholder="Event Title"><input type="text"
                        name="eventDesc" placeholder="Event Description"><input type="date" name="eventDate"
                        placeholder="Event Date"><input type="time" name="eventTime" placeholder="Event Time"><input
                        name="submit" type="submit"></form>
            </div>
            <div class="content-all">
                <div class="eventlist"><?php $q = "SELECT * FROM `eventdetails` WHERE userID=$userId ORDER BY date DESC;";
                                                $qy = "select event_id from eventdetails WHERE userId= $userId";
                                                $query = mysqli_query($conn, $q);

                                                // $res = $conn->query($q);
                                                while ($res = mysqli_fetch_array($query)) {
                                                    if (!$res['complete'] >= 1) {
                                                ?><div class="eventDetails">
                        <div class="eventDetailsTop">
                            <div class="eventTitle">
                                <h1><?php echo $res['event_title'];
                                                    ?></h1>
                            </div>
                            <div class="eventDate">
                                <h1><?php echo $res['date'];
                                                    ?></h1>
                            </div>
                        </div>
                        <div class="eventDetailsDown">
                            <div class="eventDescription">
                                <h3><?php echo $res['event_desc'];
                                                    ?></h3>
                            </div>
                            <div class="eventTime">
                                <h3><?php echo $res['time']; ?></h3>
                            </div>
                        </div>
                        <div class="btnevents">
                            <button id="editEventBtn" class="editBtn">Edit event</button>
                            <button id="deleteEventBtn"><a
                                    href="../php/delete.php?id=<?php echo $res['event_id']; ?>">Delete
                                </a>
                            </button><button id="completeEventBtn"><a
                                    href="../php/complete.php?id=<?php echo $res['event_id']; ?>">Mark as Done
                                </a></button><button id="setReminderBtn">Set Reminder</button>
                        </div>
                    </div>
                    <div class="hide">
                        <form action=" ../php/edit.php?id=<?php echo $res['event_id']; ?>" method="post"><label>
                                <h3>Change Event</h3>
                            </label><input type="text" name="eeventTitle" placeholder="Event Title"
                                value=" <?php echo $res['event_title'] ?> "><input type="text" name="eeventDesc"
                                placeholder="Event Description" value=" <?php echo $res['event_desc'] ?> "><input
                                type="date" name="eeventDate" placeholder="Event Date"
                                value=" <?php echo $res['date'] ?> "><input type="time" name="eeventTime"
                                placeholder="Event Time" value=" <?php echo $res['time'] ?> "><input name="esubmit"
                                type="submit"></form>
                    </div>
                    <script>

                    </script>

                    <?php
                                                    }

                                                    // }
                                                }

                            ?>
                </div>
            </div>
            <script>
            var showButton = document.querySelector('.editBtn');
            var hideForm = document.querySelector('.hide');
            showButton.addEventListener('click', () => {
                hideForm.classList.toggle('show');
            })

            function addevent() {
                var addDetails = document.getElementById('addDetails');
                if (addDetails.style.display === "none") {
                    addDetails.style.display = "block";
                } else {
                    addDetails.style.display = "none";
                }
            }
            </script>
        </div><?php if (isset($_POST['submit'])) {
                            $eventTitle = $_POST['eventTitle'];
                            $eventDesc = $_POST['eventDesc'];
                            $eventDate = $_POST['eventDate'];
                            $eventTime = $_POST['eventTime'];

                            $q = "INSERT INTO `eventdetails`(`event_title`, `event_desc`, `date`, `time`,`userId`) VALUES ('$eventTitle','$eventDesc','$eventDate','$eventTime','$userId')";
                            $query = mysqli_query($conn, $q);
                            //    if($conn->query($q)) {
                            //        echo "data inserted";
                            //    }
                            //    else{
                            //       die(mysqli_error($conn));
                            //        } 
                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                    }
                } else {
                    header('location:../login.php');
                }

                        ?>
</body>

</html>