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

	if(count($_POST)>0)  
	{        
		$topicname = $_POST['topicname'];
		$subject = $_POST['subject'];
		
		$query1 = "select *from topic_details where BINARY topic_name='$topicname'";
		$result1 = mysqli_query($con,$query1);
		
		if(mysqli_num_rows($result1) > 0) 
		{
			$message1 = "topic name already exists";		
		}
		else
		{
			
			$query = "INSERT INTO topic_details VALUES('','$topicname','$subject')";
			
			if ($con->query($query) === TRUE) 
			{  
				$message= "Topic added successfully";
			}
			else
			{
				$message1= "Failed to add topic";
			}
		}
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add Topic | Online Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">
	 
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">

		<style type="text/css">
			.message {
			color: green;
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
		
			function back()
			{
				window.location.href="display_topic.php";
			}
			
		</script>
		
		<style>
			input[type="checkbox"]
			{
			  width: 23px; /*Desired width*/
			  height: 23px; /*Desired height*/
			}
		</style>
	</head>
	<body>    
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
						<form class="form-horizontal well" action="" method="post" name="add_question" enctype="multipart/form-data" >
							<fieldset>
								<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Add Topics</legend>
								<div class="control-group">
									<div class="message"><?php if($message!="") { echo $message; } ?></div>
									<div class="message1"><?php if($message1!="") { echo $message1; } ?></div>
								 
									<div class="control-label">
										<label style="color:#0051CC;">Topic Name :<span style="color:#F00;">*</span></label>
									</div>
									<div class="controls">
										<input type="text" name="topicname" minlength="4" maxlength="50" pattern="[\S]+[a-zA-Z.,\s]+[0-9]*" title="Only enter letters" required>
									</div>
									<br>
									<div class="control-label">
										<label style="color:#0051CC;">Subject :<span style="color:#F00;">*</span></label>
									</div>
									<div class="controls">
										<select name="subject" id="subject" required onchange="show_topics()">
											<option value=''>Select Subject</option>
											<?php 
											
												$query8 = "select * from subject_details";
												$result8 = $con->query($query8);
																
												while($row8 = mysqli_fetch_array($result8)) 
												{
													echo '<option value='.$row8['sub_id'].'>'.$row8['sub_name'].'</option>';
												}
												
											?>	
										</select>
									</div>
									<br>
								</div>
								
								<div class="control-group">
							   
									<div class="controls">
									<button type="submit" id="submit" name="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Submit</button>
									<input type="button" id="clear" value="Back" style="width: 77px;height: 30px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="back();">
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