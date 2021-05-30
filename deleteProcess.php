<?php
include('admin/db_connect.php');
if(isset($_GET["id"])){

    $del = "DELETE FROM venue_booking WHERE id = '".$_GET["id"]."'";
    if($conn->query($del) == TRUE){
        header('Location: dashboard.php');
    }
}
?>