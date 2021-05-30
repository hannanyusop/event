<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <?php
        include('admin/db_connect.php');
        $sysName = "SELECT * FROM system_settings limit 1";
        $rslt = $conn->query($sysName);
        if($rslt->num_rows>0){
            while($row = $rslt->fetch_assoc()){
                $systemName = $row["name"];
                $systemCover = $row["cover_img"];
                $systemEmail = $row["email"];
                $systemContact = $row["contact"];
            }
        }
        include('header.php');
        ?>
        <style>
            .masthead {
                background: url(admin/assets/uploads/<?php echo $systemCover ?>);
                background-repeat: no-repeat;
                background-size: cover;
            }
            body, footer {
                background: #000000e6 !important;
            }
            .card {
                font-family: sans-serif;
                width: 500px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 3em;
                margin-bottom:3em;
                border-radius: 10px;
                background-color: #ffff;
                padding: 1.8rem;
                box-shadow: 2px 5px 20px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white"></div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $systemName ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=venue">Events</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="schedule.php?page=venue">Bus Schedule</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="regStudent.php?page=register">Register/Login</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" style="text-align: center; margin-top: 100px;">
            <div class="card">
                <form class="well form-horizontal" action="loginProcess.php " method="POST">
                    <fieldset>
                        <!-- Form Name -->
                        <legend><h2><b>Login</b></h2></legend><br>

                        <!-- Error Message -->
                        <?php
                            if(isset($_GET["err"])){
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Wrong email or Password
                                </div>
                                <?php
                            }
                        ?>
                        
                        <!-- Text input-->
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control" required>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Login">
                        </div>
                        <div class="form-group">
                            Did not have an account? <a href="regStudent.php?page=register">Register Here</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
    <?php $conn->close() ?>
</html>
