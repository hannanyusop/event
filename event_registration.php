<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>

  <?php
    session_start();
    include('admin/db_connect.php');
    include('helper.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');

    if(isset($_GET['id'])){

        $event_id = $_GET['id'];
        $event_q = $conn->query("SELECT * FROM events WHERE id=$event_id");

        $event = $event_q->fetch_assoc();

        if(!$event){
            echo "<script>alert('Invalid event!');window.location='index.php?page=venue'</script>";
        }

        if(!isset($_SESSION['auth'])){
            echo "<script>alert('Please login to join event.');window.location='login.php'</script>";
        }

//        var_dump($event);exit();

        $student_id = $_SESSION['auth']['id'];
        $student_q = $conn->query("SELECT * FROM students WHERE id=$student_id ");
        $student = $student_q->fetch_assoc();

        if(isset($_POST['event_id'])){

            $uri = "http://".$_SERVER['HTTP_HOST']."/event_payment_checking.php";
            if($event['payment_type'] == 2){
                $billDescription = "FEE FOR EVENT ".$event['event'];
                $billAmount = $event['amount']*100;
                $billReturnUrl = $uri;
                $billCallbackUrl = $uri;
                $billTo = $student['name'];
                $billEmail = $student['email'];
                $billPhone = $student['phone'];

                $code = createBill($GLOBALS['toyyib_deposit_code'], "REGISTRATION FEE", $billDescription, $billAmount, $billReturnUrl, $billCallbackUrl, $billTo, $billEmail,$billPhone);

                $receipt = $GLOBALS['toyyib_url'].$code;

                $insert = $conn->query("INSERT INTO audience (student_id,name,contact,email,address,event_id,payment_status,receipt,billcode)
 VALUES ('$student[id]', '$student[name]', '$student[phone]', '$student[email]',' ', '$event[id]', 0,'$receipt' ,'$code' )");

                header("Location:".$receipt);exit();
            }else{

                $insert = $conn->query("INSERT INTO audience (student_id,name,contact,email,address,event_id,payment_status,receipt,billcode)
 VALUES ('$student[id]', '$student[name]', '$student[phone]', '$student[email]',' ', '$event[id]', 1,null ,null )");

                echo "<script>alert('Registration successfully!');window.location='index.php?page=venue'</script>";
            }
        }

    }else{
        echo "<script>alert('Invalid url!');window.location='index.php?page=venue'</script>";
    }
  ?>

  <style>
    header.masthead {
      background: url(admin/assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
      background-repeat: no-repeat;
      background-size: cover;
    }
  
    #viewer_modal .btn-close {
      position: absolute;
      z-index: 999999;
      /*right: -4.5em;*/
      background: unset;
      color: white;
      border: unset;
      font-size: 27px;
      top: 0;
    }
    #viewer_modal .modal-dialog {
      width: 80%;
      max-width: unset;
      height: calc(90%);
      max-height: unset;
    }
    #viewer_modal .modal-content {
      background: black;
      border: unset;
      height: calc(100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    #viewer_modal img,#viewer_modal video{
      max-height: calc(100%);
      max-width: calc(100%);
    }
    body, footer {
      background: #000000e6 !important;
    }
  </style>

  <style>#success_message{ display: none;} </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js" type="text/javascript"> </script>
</head>
<body>

  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white"></div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=venue">Events</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="schedule.php?page=venue">Bus Schedule</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                <?php if(!isset($_SESSION['auth'])){ ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login.php?page=login">Register/Login</a></li>
                    <?php }else{ ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>
                    <?php } ?>
            </ul>
        </div>
    </div>
  </nav>

  <div class="container" style="text-align: center;">
    <form class="well form-horizontal" method="post"  id="contact_form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
        <input type="hidden" name="event_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
      <fieldset>
        <!-- Form Name -->
        <legend><center><h2><b>Event Registration Form</b></h2></center></legend><br>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label">E-Mail</label>  
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" value="<?= $student['email'] ?>" readonly>
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" >Name</label> 
            <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input name="name" placeholder="Name" class="form-control"  type="text" value="<?=$student['name'] ?>" readonly>
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label">Matric Number</label>  
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
              <input  name="matric_no" placeholder="Matric Number" class="form-control"  type="text" value="<?= $student['matric_no'] ?>" readonly>
            </div>
          </div>
        </div>

        <!-- Text input--> 
        <div class="form-group">
          <label class="col-md-4 control-label" for="event_name">Event Name</label>
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input name="event_name" id="event_name" class="form-control" type="text" value="<?= $event['event'] ?>" readonly>
            </div>
          </div>
        </div>

              <?php if($event['payment_type'] == 2){ ?>
              <div class="form-group">
                  <label class="col-md-4 control-label" for="fee">Fee</label>
                  <div class="col-md-4 inputGroupContainer">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                          <input id="fee" name="fee" class="form-control" type="text" value="<?= $event['amount'] ?>" readonly>
                      </div>
                  </div>
              </div>
          <?php } ?>
        <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4"><br>
              <?php if($event['payment_type'] == 2){ ?>
                  <button type="submit" class="btn btn-warning" name="reg_user" >CONTINUE TO PAYMENT SITE <span class="glyphicon glyphicon-send"></span></button>
              <?php }else{ ?>
                  <button type="submit" class="btn btn-warning" name="reg_user" >SUBMIT <span class="glyphicon glyphicon-send"></span></button>
              <?php } ?>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</body>
</html>

