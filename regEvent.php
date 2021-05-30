<?php
session_start();
$uid = $_SESSION["id"];

include('admin/db_connect.php');

$user = "SELECT * FROM students WHERE id = '".$uid."'";
$urslt = $conn->query($user);
if($urslt->num_rows>0){
    while($urow = $urslt->fetch_assoc()){
        $name = $urow["name"];
        $email = $urow["email"];
        $phone = $urow["phone"];
    }
}

$venue = $_POST["venue1"];
$date = $_POST["date1"];
$time = $_POST["time"];

$insert = "INSERT INTO venue_booking (name, email, contact, venue_id, date, time, datetime, status) VALUES ('".$name."', '".$email."', '".$phone."', '".$venue."', '".$date."', '".$time."', NOW(), '0')";
if($conn->query($insert) == TRUE){
    header('Location: dashboard.php');
}
else{
    echo "ERROR" . $conn->error;
}
?>