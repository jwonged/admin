<?php 
	session_start();  
	
	if(!isset($_SESSION["user_id"]))
	{	
		header('location:school_index.php');
		exit;
	}
?>

<!DOCTYPE html>

<?php
	
		include('connection.php');
		
		if(count($_POST)>0) 
		{
			
		}
		else
		{
			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$limit = 70;

			$startpoint = ($page * $limit) - $limit;
		  
			//to make pagination

			
			$statement = "school_details";
		}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Overall Test | Online Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">
		<script src="js/jquery-1.11.1.min.js"></script>
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
		
		.message1 
		{
			color:#090;
			font-weight: bold;
			text-align: center;
			width: 100%;
		}
		
		tr:nth-child(even) {background: #FFF}
		tr:nth-child(odd) {background: #CCC}
		</style>
		<script type="text/javascript">
			onload=function()
			{
				var e=document.getElementById("refreshed");
				if(e.value=="no")e.value="yes";
				else{e.value="no";location.reload();}
			}
		</script>
		
	</head>
	<body>    
		<div class="navbar navbar-inverse navbar-fixed-top">
			<!--<div class="navbar-inner">
			
				<div class="container"> 
					<div style=" float:right;color:#ffffff; margin-top:10px; margin-right:20px;"> Hello <?php echo $_SESSION["user_name"];?> <a style="margin-left:20px;" href="logout.php">
				   LogOut</a></div>
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#" style="color:#ffffff;">Objective Exam</a>
					
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
							
						<form name="menuitemgroupoption_form" enctype="multipart/form-data" style="background-color:#f5f5f5;width: 1060px;margin-left: -228px;border-radius: 4px;">
							<table id="table1" name="table1" border='1' width=90% style="margin:30px;">
								
								
							<div id="question_details" name="question_details">	
							<table id="table2" name="table2" border='1' width=90% style="margin:30px;">
								<br>
								<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Overall Test List</legend>
								<br>
								<tr>
									<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width:112px;height:45px;">&nbsp;&nbsp; Test &nbsp;&nbsp;</th>
									<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width: 112px;height: 45px;">&nbsp; Action &nbsp;</th>
								</tr>
									
								<?php
										
									$school_id = $_SESSION['user_id'];	
									$query3 = "select * from tests_details where created_by=$school_id" ;
									$result3 = mysqli_query($con,$query3);
									$count = mysqli_num_rows($result3);
									
									if($count > 0)
									{
										while($row3 = mysqli_fetch_assoc($result3)) 
										{
											echo "<tr>";
												echo "<td style='height: 30px;'><center>" . $row3['name'] . "</center></td>";
												echo "<td align='center' style='width: 170px;height: 30px;'> <a href='test_result.php?testid=".$row3['test_id']."'>View</a></td>";
											echo "</tr>";
										}
									}
									else
									{
										
									}
								?>
							</table>
							</div>
							<br>
						</form>
					</div>
					<div class="span3 hidden-phone"></div>
				</div>
			</div>
		</div>
	</body>
</html>