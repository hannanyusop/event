<?php

include('admin/db_connect.php');
include('helper.php');

if(isset($_GET['billcode'])){

    $status_id = $_GET['status_id'];
    $billcode = $_GET ['billcode'];
    $order_id = $_GET ['order_id'];
    $msg = $_GET ['msg'];
    $transaction_id = $_GET ['transaction_id'];

    if($status_id == 1){

        $query = $conn->query("UPDATE audience SET payment_status=1 WHERE billcode='$billcode'");

        echo "<script>alert('Payment success!');window.location='index.php?page=venue'</script>";
    }else{
        echo "<script>alert('Payment failed!');window.location='index.php?page=venue'</script>";
    }


}