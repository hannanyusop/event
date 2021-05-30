<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
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

  

       
      

<head>
<title>Schedule</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">   
<link href="css/util.css" type="text/css" rel="stylesheet" media="all">  
<link href="css/main.css" type="text/css" rel="stylesheet" media="all">  
<link href="css/font-awesome.css" rel="stylesheet"> <!-- font-awesome icons -->
<!-- //Custom Theme files -->  
<!-- web-fonts -->  
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;subset=latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body> 
	<!-- banner -->
	<div class="w3ls-banner">
		<div class="w3lsbanner-info">
			<!-- header -->
			<div class="header">
				<div class="container">  
					<div class="header-mdl agileits-logo"><!-- header-two --> 
						<h1><a href="index.html">Bus Schedule</a></h1> 
					</div>
					<div class="header-nav"><!-- header-three --> 	
						<nav class="navbar navbar-default">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button> 
							</div>
							<!-- top-nav -->
							<!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav cl-effect-16">
									<li><a href="index.php" class="active" data-hover="Home">Home</a></li> 
									<li><a href="login.php" data-hover="Login">Login</a></li> 
									<li><a href="complaints.php" data-hover="Complaints">Complaints</a></li>
									<li><a href="studentpage.php" data-hover="Bus Schedule">Bus Schedule</a></li> 
								</ul>  
								<div class="clearfix"> </div>	
							</div>
						</nav>    
					</div>	
				</div>	
			</div>	
			<!-- //header --> 
			
		</div>	
	</div>	-->
	<!-- //banner -->
	
			
	
		<!-- about -->
<div class="about">
	<div class="container">
	
		<div class="table100 ver1 m-b-110">
		
					
					<table data-vertable="ver1">
					<h3>Kediaman Satria >> Lestari >> Kampus Induk </h3>
						<thead>
							<tr class="row100 head">
								<th class="column100 column2" data-column="column2">Monday</th>
								<th class="column100 column3" data-column="column3">Tuesday</th>
								<th class="column100 column4" data-column="column4">Wednesday</th>
								<th class="column100 column5" data-column="column5">Thursday</th>
								<th class="column100 column6" data-column="column6">Friday</th>	
							</tr>
						</thead>
						<tbody>		
							<tr class="row100">
								<td class="column100 column2" data-column="column2">7.30 am</td>
								<td class="column100 column3" data-column="column3">7.30 am</td>
								<td class="column100 column4" data-column="column4">7.30 am</td>
								<td class="column100 column5" data-column="column5">7.30 am</td>
								<td class="column100 column6" data-column="column6">7.30 am</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">8.30 am</td>
								<td class="column100 column3" data-column="column3">8.30 am</td>
								<td class="column100 column4" data-column="column4">8.30 am</td>
								<td class="column100 column5" data-column="column5">8.30 am</td>
								<td class="column100 column6" data-column="column6">8.30 am</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">9.30 am</td>
								<td class="column100 column3" data-column="column3">9.30 am</td>
								<td class="column100 column4" data-column="column4">9.30 am</td>
								<td class="column100 column5" data-column="column5">9.30 am</td>
								<td class="column100 column6" data-column="column6">9.30 am</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">1.30 pm</td>
								<td class="column100 column3" data-column="column3">1.30 pm</td>
								<td class="column100 column4" data-column="column4">1.30 pm</td>
								<td class="column100 column5" data-column="column5">1.30 pm</td>
								<td class="column100 column6" data-column="column6">2.30 pm</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">2.30 pm</td>
								<td class="column100 column3" data-column="column3">2.30 pm</td>
								<td class="column100 column4" data-column="column4">2.30 pm</td>
								<td class="column100 column5" data-column="column5">2.30 pm</td>
								<td class="column100 column6" data-column="column6">3.30 pm</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">5.00 pm</td>
								<td class="column100 column3" data-column="column3">5.00 pm</td>
								<td class="column100 column4" data-column="column4">5.00 pm</td>
								<td class="column100 column5" data-column="column5">5.00 pm</td>
								<td class="column100 column6" data-column="column6">5.00 pm</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">7.30 pm</td>
								<td class="column100 column3" data-column="column3">7.30 pm</td>
								<td class="column100 column4" data-column="column4">7.30 pm</td>
								<td class="column100 column5" data-column="column5">7.30 pm</td>
								<td class="column100 column6" data-column="column6">7.30 pm</td>
							</tr>
						</tbody>
					</table><br><br><br><br>

					<table data-vertable="ver1">
					<h3>Kampus Induk >> Kediaman Satria >> Kediaman Lestari </h3>
						<thead>
							<tr class="row100 head">
								<th class="column100 column2" data-column="column2">Monday</th>
								<th class="column100 column3" data-column="column3">Tuesday</th>
								<th class="column100 column4" data-column="column4">Wednesday</th>
								<th class="column100 column5" data-column="column5">Thursday</th>
								<th class="column100 column6" data-column="column6">Friday</th>	
							</tr>
						</thead>
						<tbody>		
							<tr class="row100">
								<td class="column100 column2" data-column="column2">11. 00 am</td>
								<td class="column100 column3" data-column="column3">11. 00 am</td>
								<td class="column100 column4" data-column="column4">11. 00 am</td>
								<td class="column100 column5" data-column="column5">11. 00 am</td>
								<td class="column100 column6" data-column="column6">11.30 am</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">12.00 pm</td>
								<td class="column100 column3" data-column="column3">12.00 pm</td>
								<td class="column100 column4" data-column="column4">12.00 pm</td>
								<td class="column100 column5" data-column="column5">12.00 pm</td>
								<td class="column100 column6" data-column="column6">12.30 pm</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">1.00 pm</td>
								<td class="column100 column3" data-column="column3">1.00 pm</td>
								<td class="column100 column4" data-column="column4">1.00 pm</td>
								<td class="column100 column5" data-column="column5">1.00 pm</td>
								<td class="column100 column6" data-column="column6">--</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">4.00 pm</td>
								<td class="column100 column3" data-column="column3">4.00 pm</td>
								<td class="column100 column4" data-column="column4">4.00 pm</td>
								<td class="column100 column5" data-column="column5">4.00 pm</td>
								<td class="column100 column6" data-column="column6">--</td>
							</tr>
							
							<tr class="row100">
								<td class="column100 column2" data-column="column2">5.00 pm</td>
								<td class="column100 column3" data-column="column3">5.00 pm</td>
								<td class="column100 column4" data-column="column4">5.00 pm</td>
								<td class="column100 column5" data-column="column5">5.00 pm</td>
								<td class="column100 column6" data-column="column6">5.30 pm</td>
							</tr>

							<tr class="row100">
								<td class="column100 column2" data-column="column2">7.00 pm</td>
								<td class="column100 column3" data-column="column3">7.00 pm</td>
								<td class="column100 column4" data-column="column4">7.00 pm</td>
								<td class="column100 column5" data-column="column5">7.00 pm</td>
								<td class="column100 column6" data-column="column6">7.00 pm</td>
							</tr>

							<tr class="row100">
								<td class="column100 column2" data-column="column2">10.15 pm</td>
								<td class="column100 column3" data-column="column3">10.15 pm</td>
								<td class="column100 column4" data-column="column4">10.15 pm</td>
								<td class="column100 column5" data-column="column5">10.15 pm</td>
								<td class="column100 column6" data-column="column6">10.15 pm</td>
							</tr>
						</tbody>
					</table><br><br>
						
				</div>		
	
	</div>
</div>



   	
		
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class=" py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0 text-white">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                    </div>
                </div>
            </div>
            <br>
            <div class="container"><div class="small text-center text-muted">PSM 1 <?php echo $_SESSION['system']['name'] ?> | <a href="https://www.sourcecodester.com/" target="_blank">UTeM CGT SYSTEM</a></div></div>
        </footer>
        
       <?php include('footer.php') ?>
  
	<!-- js --> 
	<script src="js/jquery-2.2.3.min.js"></script> 
	<script src="js/SmoothScroll.min.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/maintable.js"></script>
	<!-- //js --> 
	<!-- start-smooth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>	
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
			
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
	<!-- //end-smooth-scrolling -->	
	<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->  
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>