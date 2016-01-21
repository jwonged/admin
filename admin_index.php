<?php session_start(); ?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Login | Objective Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">

		<style type="text/css">
			.message 
			{
				color: #FF0000;
				font-weight: bold;
				text-align: center;
				width: 100%;
			}
		</style>
		
		<script type = 'text/javascript'>
			function myFunction()
			{		
				document.login_form.userName.value="";
				document.login_form.pass.value="";
				document.login_form.userName.focus() ;
			}				
		</script>
		<script type="text/javascript">
		
			function reset()
			{
				
			}
			
		</script>
		
		<style>
			.clearable
			{
			  background: #fff url(img/closer.gif) no-repeat right -10px center;
			  background-size: 10px 10px;
			  border: 1px solid #999;
			  padding: 3px 18px 3px 4px; /* Use the same right padding (18) in jQ! */
			  border-radius: 3px;
			  transition: background 0.4s;
			}
			.clearable.x  { background-position: right 5px center; }
			.clearable.onX{ cursor: pointer; }
			.clearable::-ms-clear {display: none; width:0; height:0;}

			
		  </style>
		  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		  <script>
				jQuery(function($) 
				{
				  function tog(v){return v?'addClass':'removeClass';} 
				  $(document).on('input', '.clearable', function(){
					$(this)[tog(this.value)]('x');
				  }).on('mousemove', '.x', function( e ){
					$(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');   
				  }).on('touchstart click', '.onX', function( ev ){
					ev.preventDefault();
					$(this).removeClass('x onX').val('').change();
				  });
				  
				  
				});
		  
		  </script>
	</head>
	<body onload="myFunction();">    

	<!-- Navbar
    ================================================== -->

		<?php
			include('connection.php');
			
			extract($_REQUEST);
			extract($_POST);
			
			
			$message="";
			
						
				if(count($_POST)>0) 
				{
					$user = $_POST["userName"];
					
					
					$result = $con->query("SELECT * FROM admin_details WHERE BINARY userName='".$_POST["userName"]."' and BINARY password = '".$_POST["pass"]."'");
					$row  = mysqli_fetch_array($result);
 
					if(is_array($row)) 
					{
						$_SESSION["user_id"] = $row['id'];
						$_SESSION["user_name"] = $user;
							
						echo "<script type='text/javascript'>location.href = 'welcomepage.php';</script>";
					}
					else 
					{
						$message = "Invalid Username or Password!";
					}
					
				}
		?>

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="" method="post" name="login_form" enctype="multipart/form-data" style="background-color:#34495E;">
               
					<fieldset>
						<legend style="text-align:center;color:#fff; font-weight:bolder;">Admin Login</legend>
						<div class="control-group">
                         <div class="message"><?php if($message!="") { echo $message; } ?></div>
							<div class="control-label">
								<label style="color:#fff;">User Name:</label>
							</div>
							<div class="controls">
								<input type="text" class="clearable" name="userName" required>
							</div>
                            <br>
                            <div class="control-label">
								<label style="color:#fff;">Password:</label>
							</div>
							<div class="controls">
								<input type="password" class="clearable" name="pass" required>
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
								<button type="submit" id="submit" name="Import" class="btn btn-primary btn-lg" data-loading-text="Loading..." style="width: 120px; margin-left: 40px;">Login</button>
								<!--<input type="button" id="clear" value="Reset" style="width: 77px;height: 30px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="reset();">-->
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
		

		
	</div>

	</div>

	</body>
</html>