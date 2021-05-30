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
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
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
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="regStudent.php?page=register">Register/Login</a></li>
                        
                     
                    </ul>
                </div>
            </div>
        </nav>
       
      
<head>
<title>Schedule</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">   
<link href="css/font-awesome.css" rel="stylesheet"> <!-- font-awesome icons -->
<!-- //Custom Theme files -->  
<!-- web-fonts -->  
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;subset=latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body> 

	
			
	
		<!-- about -->
<div class="about">
	<div class="container">
	<div class="wthree_head_section">
				<h3 class="w3l_header">Bus Schedule </h3>
				
	</div>	
	<!-- ButtonToAnotherPage -->
	<div class="content">
									
				<center><td>Buses From Hostel To Campus</td></center><br>
				<center>
				<a href="studentschedule.php" ><input class="btn" value="To Kampus Teknologi"></a>
				</center><br><br>
				
				<center><td>Buses From Hostel To Campus </td></center><br>
				<center>
				<a href="studentschedule2.php" ><input class="btn" value="To Kampus Induk"></a>
				</center><br><br>
					
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
    </body>

    <?php $conn->close() ?>

   	
		<!-- footer -->
	<!--<div class="footer">
	<div class="container">
		<div class="f-bg-w3l">
		<div class="col-md-4 w3layouts_footer_grid">
					<h2>Contact <span>Information</span></h2>
					    <ul class="con_inner_text">
							<li><span class="fa fa-map-marker" aria-hidden="true"></span>Technical University of Malaysia Malacca,<label> Hang Tuah Jaya, 76100 Durian Tunggal, Melaka</label></li>
							<li><span class="fa fa-envelope-o" aria-hidden="true"></span> <a href="mailto:info@example.com">canselori@utem.edu.my</a></li>
							<li><span class="fa fa-phone" aria-hidden="true"></span> +606 331 6243 / 6249 </li>
						</ul> 

					
				</div>
				<div class="col-md-4 w3layouts_footer_grid">
					<h2>Any <span>Complaints</span></h2>
					<p>If you have any problems with our bus driver or bus schedule, you can share with us. To make a complaints by simply in a Home Menu</p>
					
				</div>
				
				<div class="clearfix"> </div>
			</div>
			</div>
			<p class="copyright">© WORKSHOP 1 SYAMSUL AMRI B031710093</p>
	</div> 
	<!-- //footer -->
  
	<!-- js --> 
	<script src="js/jquery-2.2.3.min.js"></script> 
	<script src="js/SmoothScroll.min.js"></script>
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