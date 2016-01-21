<?php
	
	session_start(); 
	
	if(!isset($_SESSION["user_id"]))
	{	
		header('location:admin_index.php');
		exit;
	}


?>
<!DOCTYPE html>

<?php

	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$message="";
	$message1="";
	$message2="";
	$message3="";


	if(count($_POST)>0)  
	{
		$schoolname = $_POST['schoolname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$date = date("Y/m/d H:i ");
		
		
		$query1 = "select *from school_details where BINARY school_name='$schoolname'";
		$result1 = mysqli_query($con,$query1);
		
		if(mysqli_num_rows($result1) > 0) 
		{
			$message2= "school already exists";
		}
		else
		{
			
			$query2 = "select *from school_details where username='$username'";
			$result2 = mysqli_query($con,$query2);
		
			if(mysqli_num_rows($result2) > 0)  
			{
				$message3= "username already exists";
			}
			else
			{
				$query = "INSERT INTO school_details VALUES('','$schoolname','$username','$password','Active','$date')";
				
				if ($con->query($query) === TRUE) 
				{  
					/*header("Location:display_schools.php");*/
					/*echo "<script type='text/javascript'>location.href = 'display_schools.php';</script>";*/
					$message= "School added successfully";
				}
				else
				{
					$message1= "School not added";
				}
			}
		}
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add School | Online Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">

		<style type="text/css">
			.message {
			color: #39B54A;
			font-weight: bold;
			text-align: center;
			width: 100%;
			}
			.message1 {
			color:#FF0000;
			font-weight: bold;
			text-align: center;
			width: 100%;
			}
		</style>
		
		<script type="text/javascript">
		
			function reset()
			{
				
			}
			
		</script>
		<style>
			input[type="checkbox"]
			{
			  width: 23px; /*Desired width*/
			  height: 23px; /*Desired height*/
			}
		</style>
		
		<!-- Time Picker -->
			  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

			  <script type="text/javascript" src="js/jquery.timepicker.js"></script>
			  <link rel="stylesheet" type="text/css" href="js/jquery.timepicker.css" />

			  <script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
			  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />

			  <script type="text/javascript" src="lib/site.js"></script>
			  <link rel="stylesheet" type="text/css" href="lib/site.css" />
			  
			  <script>
                $(function() {
                    $('#opentime').timepicker();
                });
              </script>
			  
			  <script>
                $(function() {
                    $('#closetime').timepicker();
                });
              </script>
		<!-- End -->
		</head>
	<body>    

	<!-- Navbar
    ================================================== -->

	<div class="navbar navbar-inverse navbar-fixed-top">
		<!--<div class="navbar-inner">
				<div class="container"> 
					<div style=" float:right;color:#ffffff; margin-top:10px; margin-right:20px;"> Hello <?php echo $_SESSION["user_name"];?> 
						<a style="margin-left:20px;" href="logout.php">LogOut</a>
					</div>
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#" style="color:#ffffff;">Online Exam</a>
				</div>
            </div>-->
		<?php include_once('menu.php'); ?>
	</div>
	<br>
	<br>
	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="" method="post" name="create_school" enctype="multipart/form-data" onsubmit="return(validate());">
               
					<fieldset>
						<legend style="text-align:center;color:#29AAE1 ; font-weight:bolder;">Add School</legend>
						<div class="control-group">
                        <div class="message"><?php if($message!="") { echo $message; } ?></div>
                        <div class="message1"><?php if($message1!="") { echo $message1; } ?></div>
						<div class="message1"><?php if($message2!="") { echo $message2; } ?></div>
						<div class="message1"><?php if($message3!="") { echo $message3; } ?></div>
                         <br>
						    <div class="control-label">
								<label style="color:#29AAE1 ;">School Name :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="schoolname" maxlength="100" minlength="3" pattern="[\S]+[a-zA-Z.,'\s]+[0-9]*" required>
							</div> 
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">UserName :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="username" maxlength="14" minlength="2" pattern="[\S]+[a-zA-Z-_@]+[0-9]*" title="Only enter letters" required>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Password :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="password" maxlength="14" minlength="7" name="password" required>
							</div>
							<br>
						</div>
						
						<div class="control-group">
                       
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Submit</button>
							<input type="button" id="clear" value="Reset" style="width: 77px;height: 30px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="reset();">
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
		

		<!--<table class="table table-bordered">
			<thead>
				  	<tr>
				  		<th>ID</th>
				  		<th>Subject</th>
				  		<th>Description</th>
				  		<th>Unit</th>
				  		<th>Semester</th>
				 		
				 
				  	</tr>	
				  </thead>
			<?php
				/*$SQLSELECT = "SELECT * FROM subject ";
				$result_set =  mysql_query($SQLSELECT, $conn);
				while($row = mysql_fetch_array($result_set))
				{*/
				?>
			
					<tr>
						<td><?php// echo $row['SUBJ_ID']; ?></td>
						<td><?php //echo $row['SUBJ_CODE']; ?></td>
						<td><?php// echo $row['SUBJ_DESCRIPTION']; ?></td>
						<td><?php //echo $row['UNIT']; ?></td>
						<td><?php //echo $row['SEMESTER']; ?></td>
					

					</tr>
				<?php
				//}
			?>
		</table>-->
	</div>

	</div>

	</body>
</html>