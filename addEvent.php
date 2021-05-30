<?php
session_start();
include('admin/db_connect.php');
$sysName = "SELECT * FROM system_settings LIMIT 1";
$rslt = $conn->query($sysName);
if($rslt->num_rows>0){
    while($row = $rslt->fetch_assoc()){
        $systemName = $row["name"];
    }
}
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
        <?php
        include('header.php');
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Collapsible sidebar using Bootstrap 3</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"></script>
        

        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3><?php echo $systemName ?></h3>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">
                <div class="card">
                    <div class="card-header">
                        <h4><b>Request Event</b></h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <?php
                            if(isset($_GET["vid"])){
                                $eDate = date("d/m/Y" , strtotime($_GET["date"]));
                                $venue = "SELECT * FROM venue WHERE id = '".$_GET["vid"]."'";
                                $vrslt = $conn->query($venue);
                                if($vrslt->num_rows>0){
                                    while($vrow = $vrslt->fetch_assoc()){
                                        $vname = $vrow["venue"];
                                    }
                                }
                                ?>
                                <form action="regEvent.php" method="POST">
                                    <label for="">Venue</label>
                                    <input type="text" class="form-control" value="<?php echo $vname ?>" name="venue" readonly>
                                    <label for="">Date</label>
                                    <input type="text" class="form-control" name="date" value="<?php echo $eDate ?>" readonly>
                                    <label for="">Time</label>
                                    <select name="time" id="" class="form-control" required>
                                        <?php
                                        $check = "SELECT * FROM venue_booking WHERE event_date = '".$_GET["date"]."'";
                                        $crslt = $conn->query($check);
                                        if($crslt->num_rows>0){
                                            while($crow = $crslt->fetch_assoc()){
                                                $eTime = $crow["time"];

                                                $ctime = "SELECT * FROM event_time";
                                                $trslt = $conn->query($ctime);
                                                if($trslt->num_rows>0){
                                                    while($trow = $trslt->fetch_assoc()){
                                                        $checktime = $trow["id"];
                                                        $time = $trow["time"];
                                                        if($checktime != $eTime){
                                                            ?>
                                                            <option value="<?php echo $checktime ?>"><?php echo $time ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        else{
                                            $ctime = "SELECT * FROM event_time";
                                            $trslt = $conn->query($ctime);
                                            if($trslt->num_rows>0){
                                                while($trow = $trslt->fetch_assoc()){
                                                    $checktime = $trow["id"];
                                                    $time = $trow["time"];
                                                    ?>
                                                    <option value="<?php echo $checktime ?>"><?php echo $time ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" class="form-control" value="<?php echo $_GET["vid"] ?>" name="venue1">
                                    <input type="hidden" class="form-control" name="date1" value="<?php echo $_GET["date"] ?>">
                                    <input type="submit" class="btn btn-success" value="Submit" style="margin-top: 20px;">
                                </form>
                                <?php 
                            }
                            else{
                                ?>
                                <form action="addEvent.php" method="GET">
                                    <label for="">Venue</label>
                                    <select name="vid" id="vid" class="form-control" placeholder="Venue">
                                        <?php
                                        $venue = "SELECT * FROM venue";
                                        $vrslt = $conn->query($venue);
                                        if($vrslt->num_rows>0){
                                            while($vrow = $vrslt->fetch_assoc()){
                                                $vid = $vrow["id"];
                                                $vname = $vrow["venue"];
                                                ?>
                                                <option value="<?php echo $vid ?>" ><?php echo $vname ?></option>
                                                <?php
                                            }
                                        }
                                        ?>  
                                    </select>
                                    <label for="">Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                    <input type="submit" value="Submit" class="btn btn-success" style="margin-top: 20px;">
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery CDN -->
         <!-- <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->
         <!-- Bootstrap Js CDN -->
         <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

         <script type="text/javascript">
            $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
            });

            $(document).ready(function() {
                $('#example').DataTable();
            } );
         </script>

         <script>
            function getdata(elem){
                window.location.href =  "addEvent.php?vid=" + elem.value;
                // alert(elem.value);
            }
         </script>
    </body>
</html>