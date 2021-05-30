<?php include('db_connect.php');?>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Student Registered Event List</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_register">
					<i class="fa fa-plus"></i> New</button>
				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Event Information</th>
									<th class="">Student Information</th>
									<th class="">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$registering = $conn->query("SELECT a.*,e.event,e.payment_type,e.type,e.amount,e.schedule from audience a inner join events e on e.id = a.event_id");
								while($row=$registering->fetch_assoc()):
									
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p>Event: <b><?php echo ucwords($row['event']) ?></b></p>
										 <p><small>Schedule: <b><?php echo date("M d,Y h:i A",strtotime($row['schedule'])) ?></b></small></p>
										 <p><small>Type: <b><?php echo $row['type']  == 1 ? "Public Event" : "Private Event" ?></small></b></p>
										 <p><small>Fee: <b><?php echo $row['payment_type']  == 1 ? "Free" : $row['amount'] ?></small></b></p>
									</td>
									<td class="">
										 <p>Name: <b><?php echo  ucwords($row['name']) ?></b></p>
										 <p><small>Email: <b><?php echo  ucwords($row['email']) ?></b></small></p>
										 <p><small>Contact: <b><?php echo  ucwords($row['contact']) ?></b></small></p>
										 <p><small>Matric Number: <b><?php echo  ucwords($row['address']) ?></b></small></p>
										<!--<p><small>Payment Status: <b><?php echo $row['payment_type']  == 1 ? "N/A" : ($row['payment_status'] == 1 ? "Paid" : "Unpaid") ?></small></b></p>  -->
									</td>
									<td class="text-center">
										 <?php if($row['status'] == 0): ?>
										 	<span class="badge badge-secondary">For Verification</span>
										 <?php elseif($row['status'] == 1): ?>
										 	<span class="badge badge-primary">Confirmed</span>
										<?php elseif($row['status'] == 2): ?>
										 	<span class="badge badge-danger">Cancelled</span>
										 <?php endif; ?>
									</td>
									<td class="text-center">

                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <?php if(in_array($row['status'],array(0))): ?>
                                                <button class="btn btn-sm btn-success audience_confirm" type="button" data-id="<?php echo $row['id'] ?>" >Confirm</button>
                                                <button class="btn btn-sm btn-warning audience_reject" type="button" data-id="<?php echo $row['id'] ?>" >Reject</button>
                                            <?php endif; ?>
                                            <!--										<button class="btn btn-sm btn-outline-primary edit_register" type="button" data-id="--><?php //echo $row['id'] ?><!--" >Edit</button>-->
                                            <?php if(in_array($row['status'],array(0,2))): ?>
                                                <button class="btn btn-sm btn-danger delete_register" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                            <?php endif; ?>
                                        </div>

                                    </td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_register').click(function(){
		uni_modal("New Entry","manage_register.php")
	})
	
	$('.edit_register').click(function(){
		uni_modal("Manage register Details","manage_register.php?id="+$(this).attr('data-id'))
		
	})

    $('.audience_confirm').click(function(){
        _conf("Are you sure to approve this audience?","audience_confirm",[$(this).attr('data-id')])
    })

    function audience_confirm($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=audience_confirm',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Audience approved!",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
            }
        })
    }

    $('.audience_reject').click(function(){
        _conf("Are you sure to decline this audience?","audience_reject",[$(this).attr('data-id')])
    })

    function audience_reject($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=audience_reject',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Audience rejected!",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
            }
        })
    }

	$('.delete_register').click(function(){
		_conf("Are you sure to delete this Person?","delete_register",[$(this).attr('data-id')])
	})

	function delete_register($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_register',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>