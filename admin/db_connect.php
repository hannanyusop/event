<?php
//require('../helper.php');
$conn= new mysqli('localhost','root','','event_db')or die("Could not connect to mysql".mysqli_error($con));


$GLOBALS['toyyib_deposit_code'] = 'u0cy2zy1';
$GLOBALS['toyyib_secret_key'] = 's5lmg44e-qplu-u8j9-ij35-upawm1q07uc7';
$GLOBALS['toyyib_url'] = 'https://dev.toyyibpay.com/';