<?php
session_start();
include('admin/db_connect.php');

$email = $_POST["email"];
$password1 = $_POST["password"];
$password = md5($password1);

$login = "SELECT * FROM students WHERE email = '".$email."' AND password = '".$password."'";
$rslt = $conn->query($login);
if($rslt->num_rows>0){
    while($row = $rslt->fetch_assoc()){

    	$_SESSION['auth'] = [
    		'id' => $row["id"],
    		'name' => $row["name"]
    	];
        $_SESSION["id"] = $row["id"];
        header('Location: index.php');
    }
}
else{
    header('Location: login.php?err');
}
?>