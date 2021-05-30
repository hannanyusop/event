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
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="dashboard.php">Profile</a>
                    </li>
                    <li>
                        <a href="#">Event List</a>
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
                        <h4><b>Event List</b></h4>
                        <div class="float-right">
                            <a href="addEvent.php" class="btn btn-success">Request Event</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">Bil</th>
                                    <th width="25%">Venue</th>
                                    <th width="25%">Date</th>
                                    <th width="25%">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $venue = "SELECT *, a.id AS venid FROM venue_booking AS a INNER JOIN venue AS b ON a.venue_id = b.id";
                                $vrslt = $conn->query($venue);
                                if($vrslt->num_rows>0){
                                    while($vrow = $vrslt->fetch_assoc()){
                                        $i++;
                                        $id = $vrow["id"];
                                        $venId = $vrow["venid"];
                                        $location = $vrow["venue"];
                                        $duration = date('d/m/Y', strtotime($vrow["date"]));
                                        $stat = $vrow["status"];
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $location ?></td>
                                            <td><?php echo $duration ?></td>
                                            <td>
                                                <?php
                                                if($stat = 1){
                                                    ?>
                                                    <p style="color: green;">Confirmed</p> 
                                                    <?php
                                                }
                                                else if($stat = 2){
                                                    ?>
                                                    <p style="color: red;">Canceled </p>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    Pending
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <!-- <a href="updateEvent.php?id=<?php echo $id ?>" class="btn btn-primary">Update</a> -->
                                                <a href="deleteProcess.php?id=<?php echo $venId ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
    </body>
</html>