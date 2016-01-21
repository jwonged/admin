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
			$limit = 10;

			$startpoint = ($page * $limit) - $limit;
		  
			//to make pagination

			
			$statement = "school_details";
		}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Test Result | Online Exam </title>
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
											
							<div id="question_details" name="question_details">	
							<table id="table2" name="table2" border='1' width=90% style="margin:30px;">
								<br>
								<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Test Result</legend>
								<tr>
									<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width:112px;height:45px;">&nbsp;&nbsp; Question &nbsp;&nbsp;</th>
									<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width: 112px;height: 45px;">&nbsp; Correct Answer &nbsp;</th>
									<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width: 112px;height: 45px;">&nbsp; Student Choice &nbsp;</th>
									<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width: 112px;height: 45px;">&nbsp; Correct % &nbsp;</th>
								</tr>
									
								<?php
										
									$test_id = $_GET['testid'];	
									
									$query = "select * from test_result_details where test_id=$test_id group by questions_id" ;
									$result = mysqli_query($con,$query);
									$count = mysqli_num_rows($result);
									
									if($count>0)
									{
										while($row=mysqli_fetch_assoc($result))
										{
											$question_id = $row['questions_id'];
											
											
											$query1 = "select * from test_questions where question_id =$question_id";
											$result1 = mysqli_query($con,$query1);
											
											while($row1=mysqli_fetch_assoc($result1))
											{
												$question = $row1['question'];
												$ansid = $row1['ans_id'];
												
												$query2 = "select * from test_questions_answer where ans_id =$ansid";
												$result2 = mysqli_query($con,$query2);
												$row2 = mysqli_fetch_assoc($result2);
											
												echo '<tr>';
													echo "<td style='height: 30px;align=left;width:400px;'><center>" . $question . "</center></td>";
													echo "<td style='height: 30px;align=left;'><center>" . $row2['answer'] . "</center></td>";
												
														$query3 = "select * from test_result_details where questions_id =$question_id group by student_ans_id ";
														$result3 = mysqli_query($con,$query3);
														$total1=0;
														$final_ans=0;
														while($row3=mysqli_fetch_assoc($result3))
														{
															$student_ans_id = $row3['student_ans_id'];
															$query4 = "select * from test_result_details where student_ans_id =$student_ans_id";
															$result4 = mysqli_query($con,$query4);
															
															$total = mysqli_num_rows($result4);
															if($total>$total1){
																$total1=$total;
																
																$row4=mysqli_fetch_assoc($result4);
																$final_ans=$row4['student_ans_id'];
															}
															
														}
														$query5 = "select * from test_questions_answer where ans_id =$final_ans";
														$result5 = mysqli_query($con,$query5);
														$row5 = mysqli_fetch_assoc($result5);
														
														if($ansid==$final_ans)
														{
															echo "<td style='height: 30px;color:green;'><center>" . $row5['answer']. "</center></td>";
														}
														else
														{
															echo "<td style='height: 30px;color:red;'><center>" . $row5['answer']. "</center></td>";
														}
													
														$query6 = "select * from test_result_details where test_id=$test_id and questions_id=$question_id" ;
														$result6 = mysqli_query($con,$query6);
														
														$count6 = mysqli_num_rows($result6);
														$correct_ans_count=0;
														
														while($row6 = mysqli_fetch_assoc($result6))
														{
															if($ansid==$row6['student_ans_id'])
																$correct_ans_count++;
														}
														$per = ($correct_ans_count/$count6)*100;
													 
													echo "<td style='height: 30px;'><center>" . $per. "%</center></td>";
													 
												echo '<tr>';
												
											}
										}
									}
									else
									{
										echo '<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Test result not available...</legend>';
									}
									
								?>
								
							</table>
							<br>
							<br>
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