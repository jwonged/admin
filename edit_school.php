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
		$school_id = $_GET['schoolid'];
		
		$schoolname = $_POST['schoolname'];
		$username = $_POST['username'];
		$status = $_POST['status'];
		$pass = $_POST['pwd'];
		
		$query = "update school_details set school_name ='$schoolname', username ='$username', password='$pass', status ='$status' where school_id=$school_id";
		
		if ($con->query($query) === TRUE) 
		{  
			/*header("Location:display_schools.php");*/
			echo "<script type='text/javascript'>location.href = 'display_schools.php';</script>";
		}
		else
		{
			$message= "School not Created";
		}
	}
	else
	{
		$school_id = $_GET['schoolid'];
		
		$query = "select *from school_details where school_id = $school_id";
		$result = $con->query($query);
		
		$row = mysqli_fetch_assoc($result);	
	
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit School | Online Exam </title>
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
				window.location.href="display_schools.php";
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
				<form class="form-horizontal well" action="" method="post" name="edit_school" enctype="multipart/form-data" onsubmit="return(validate());">
               
					<fieldset>
						<legend style="text-align:center;color:#29AAE1; font-weight:bolder;">Edit School</legend>
						<div class="control-group">
                         <div class="message"><?php if($message!="") { echo $message; } ?></div>
                         <div class="message1"><?php if($message1!="") { echo $message1; } ?></div>
                         
						    <div class="control-label">
								<label style="color:#29AAE1;">School Name :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="schoolname" value="<?php echo $row['school_name'] ?>" maxlength="50" pattern="[\S]+[a-zA-Z.,\s]+[0-9]*" title="Only enter letters" required>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1;">UserName :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="username" value="<?php echo $row['username'] ?>" pattern="[\S]+[a-zA-Z-_@]+[0-9]*" title="Only enter letters" required>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1;">Password :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="password" name="pwd" value="<?php echo $row['password'] ?>" pattern="[\S]+[a-zA-Z-_@]+[0-9]*" title="Only enter letters" required>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1;">Status :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<select name="status" id="status">
									
									<?php 
									
										$status = $row['status'];
										
										$query1 = "select * from status";
										$result1 = $con->query($query1);
														
										while($row1 = mysqli_fetch_array($result1)) 
										{
											$id = $row1['status'];
											if($status == $id)
											{
												echo '<option value='.$id.' selected="selected">'.$row1['status'].'</option>';
											}
											else
											{
												echo '<option value='.$id.'>'.$row1['status'].'</option>';
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