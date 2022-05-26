<?php
include '../database/conn.php';

$id = $_REQUEST['id'];
$qy = "UPDATE `eventdetails` SET `complete`='0' WHERE event_id = $id";
$query = mysqli_query($conn, $qy);

header('location://localhost/ers/html/completed.php');