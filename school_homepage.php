<?php
	
	session_start();
	
	if(!isset($_SESSION["user_id"]))
	{	
		header('location:index.php');
		exit;
	}
	include 'connection.php';
	
?>	
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Online Exam | Admin Panel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">

		<style>
		
			body 
			{
				background: url(img/bg.jpg) no-repeat center center fixed; 
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;

			 }
		
		</style>
	</head>
	<body>    

	<!-- Navbar
    ================================================== -->

	<div class="navbar navbar-inverse navbar-fixed-top">
		<!--<div class="navbar-inner">
        
			<div class="container"> 
            <div style=" float:right;color:#ffffff; margin-top:10px; margin-right:20px;"> School Name: <?php echo $_SESSION["user_name"];?> <a style="margin-left:20px;" href="logout.php">
           LogOut</a></div>
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#" style="color:#ffffff;">Online Exam</a>
				
			</div>
            
		</div>-->
		<?php include_once('school_menu.php'); ?>
	</div>
	<br>
	<br>
	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
								
								
								
				<h1 style="text-align:center;color:#29AAE1; font-weight:bolder;">Welcome To School Admin Panel!</h1>
											
			</div> 
			<div class="span3 hidden-phone"></div>
		</div>
	</div>
	</div>

	</body>
</html>