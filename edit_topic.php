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

	$topic_id = $_GET['topicid'];
	
	if(count($_POST)>0)  
	{
		$topic_name = $_POST['tpname'];
		$subject = $_POST['subject'];
		
		$query = "update topic_details set topic_name ='$topic_name', sub_id ='$subject' where topic_id=$topic_id";
		
		if ($con->query($query) === TRUE) 
		{  
			/*header("Location:display_schools.php");*/
			echo "<script type='text/javascript'>location.href = 'display_topic.php';</script>";
		}
		else
		{
			$message1 = "topic not updated";
		}
	}
	else
	{
	
		
		$query = "select *from topic_details where topic_id = $topic_id";
		$result = $con->query($query);
		
		$row = mysqli_fetch_assoc($result);	
	
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit Topic | Online Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">

		<style type="text/css">
			.message {
			color: #FF0000;
			font-weight: bold;
			text-align: center;
			width: 100%;
			}
			.message1 {
			color:#090;
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
					<form class="form-horizontal well" action="" method="post" name="edit_school" enctype="multipart/form-data" onsubmit="return(validate());">
				   
						<fieldset>
							<legend style="text-align:center;color:#29AAE1; font-weight:bolder;">Edit Topic</legend>
							<div class="control-group">
							<div class="message"><?php if($message!="") { echo $message; } ?></div>
							<div class="message1"><?php if($message1!="") { echo $message1; } ?></div>
							 
								<div class="control-label">
									<label style="color:#29AAE1;">Topic Name :<span style="color:#F00;">*</span></label>
								</div>
								<div class="controls">
									<input type="text" name="tpname" value="<?php echo $row['topic_name'] ?>" maxlength="50" pattern="[\S]+[a-zA-Z.,\s]+[0-9]*" title="Only enter letters" required>
								</div>
								<br>
								<div class="control-label">
									<label style="color:#29AAE1;">Subject :<span style="color:#F00;">*</span></label>
								</div>
								<div class="controls">
									<select name="subject" id="subject">
										
										<?php 
										
											$subid = $row['sub_id'];
											
											$query1 = "select * from subject_details";
											$result1 = $con->query($query1);
															
											while($row1 = mysqli_fetch_array($result1)) 
											{
												$id = $row1['sub_id'];
												if($subid == $id)
												{
													echo '<option value='.$id.' selected="selected">'.$row1['sub_name'].'</option>';
												}
												else
												{
													echo '<option value='.$id.'>'.$row1['sub_name'].'</option>';
												}
											}
											
										?>	
									</select>
								</div>
								<br>
							</div>
							
							<div class="control-group">
						   
								<div class="controls">
								<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Update</button>
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