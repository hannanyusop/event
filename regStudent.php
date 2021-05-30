<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>

  <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');
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
                <!-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=venue">News</a></li> -->
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
    <form class="well form-horizontal" action="server.php " method="post"  id="contact_form">
      <fieldset>
        <!-- Form Name -->
        <legend><center><h2><b>Registration Form</b></h2></center></legend><br>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label">E-Mail</label>  
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" >Name</label> 
            <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input name="name" placeholder="Name" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label">Matric Number</label>  
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input  name="matric_no" placeholder="Matric Number" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group"> 
          <label class="col-md-4 control-label">Faculty</label>
          <div class="col-md-4 selectContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select name="faculty" class="form-control selectpicker">
                <option value="">Select your faculty</option>
                <option value="FTMK">FTMK</option>
                <option value="FPTT">FPTT</option>
                <option value="FKEKK">FKEKK</option>
                <option value="FKE">FKE</option>
                <option value="FKM">FKM</option>
                <option value="FKP">FKP</option>
                <option value="FTKEE">FTKEE</option>
                <option value="FTKMP">FTKMP</option>
              </select>
            </div>
          </div>
        </div>
    
        <!-- Text input--> 
        <div class="form-group">
          <label class="col-md-4 control-label">Contact No.</label>  
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                <input name="phone" placeholder="(+60)" class="form-control" type="text">
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" >Password</label> 
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input name="password" placeholder="Password" class="form-control"  type="password">
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" >Confirm Password</label> 
          <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input name="confirm_password" placeholder="Confirm Password" class="form-control"  type="password">
            </div>
          </div>
        </div>

        <!-- Select Basic -->

        <!-- Success message -->
        <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4"><br>
            <button type="submit" class="btn btn-warning" name="reg_user" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
          </div>
        </div>
        <div class="form-group">
          Already have an account? <a href="login.php?page=login">Login Here</a>
        </div>
      </fieldset>
    </form>
  </div>
</body>
<script>
  $('#password, #confirm_password').on('keyup', function() {

    if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else
        $('#message').html('Not Matching').css('color', 'red');
  });

   $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
             email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your Email Address'
                    },
                    emailAddress: {
                        message: 'Please enter a valid Email Address'
                    }
                }
            },
            name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please enter your  Name'
                    }
                }
            },
            matric_no: {
                validators: {
                     stringLength: {
                        max: 10,
                    },
                    notEmpty: {
                        message: 'Please enter your Matric Number'
                    }
                }
            },
             faculty: {
                validators: {
                    notEmpty: {
                        message: 'Please select your Faculty'
                    }
                }
            },
            phone: {
                validators: {
                  stringLength: {
                        min: 10, 
                        max: 11,
                    notEmpty: {
                        message: 'Please enter your Contact No.'
                     }
                }
            },
             password: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please enter your Password'
                    }
                }
            },
      confirm_password: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please confirm your Password'
                    }
                }
            },
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
  });
</script>
</html>

