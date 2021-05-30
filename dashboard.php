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

$student_id = $_SESSION['auth']['id'] = 4;
$audiences = $conn->query("SELECT * FROM audience WHERE student_id=$student_id");
$count = 1;
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
                                    <th width="25%">Payment Status</th>
                                    <th width="25%">Approval Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($data = $audiences->fetch_assoc()){?>

                                <?php
                                $event_q = $conn->query("SELECT * FROM events WHERE id='$data[event_id]'");
                                $event   = $event_q->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $event['event']?></td>
                                    <td><?= $event['schedule'] ?></td>
                                    <td>
                                        <?php if($event['payment_type'] == 2){ ?>
                                            <?php if($data['payment_status'] == 0){ ?>
                                                <?= "<span class='badge badge-warning'>Unpaid</span>" ?>
                                            <?php }else{ ?>
                                                <?= "<span class='badge badge-success'>Paid</span>" ?>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            -
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($data['status'] == 0){ ?>
                                            <?= "<span class='badge badge-warning'>Pending</span>" ?>
                                        <?php }else if($data['status'] == 1){ ?>
                                            <?= "<span class='badge badge-warning'>Approved</span>" ?>
                                        <?php }else{ ?>
                                            <?= "<span class='badge badge-success'>Rejected</span>" ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($event['payment_type'] == 2){ ?>
                                            <?php if($data['payment_status'] == 0){ ?>
                                                <a target="_blank" href="<?= $data['receipt'] ?>" class='btn btn-warning'>Make Payment</a>
                                            <?php }else{ ?>
                                                <a target="_blank" href="<?= $data['receipt'] ?>" class='btn btn-info'>View Receipt</a>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php $count++; } ?>
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