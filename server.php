<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'event_db');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form

  $email = mysqli_real_escape_string($db, $_POST['email']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $matric_no = mysqli_real_escape_string($db, $_POST['matric_no']);
  $faculty = mysqli_real_escape_string($db, $_POST['faculty']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  
 // if (empty($email)) { array_push($errors, "Email is required"); }
 // if (empty($password)) { array_push($errors, "Password is required"); }
 // if (empty($name)) { array_push($errors, "Username is required"); }
 // if (empty($matric_no)) { array_push($errors, "Matric number is required"); }
 // if (empty($phone)) { array_push($errors, "Contact is required"); }
  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM students WHERE name='$name' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['name'] === $name) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO students (email, name, matric_no, faculty, phone, password) 
  			  VALUES('$email', '$name', '$matric_no', '$faculty', '$phone', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['name'] = $name;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}


if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['name']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM student WHERE name='$name' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['name'] = $name;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>