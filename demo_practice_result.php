<?php

	session_start(); 
	
		if(!isset($_SESSION["user_id"]))
		{	
			header('location:index.php');
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
		/*$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
		$limit = 10;
		$startpoint = ($page * $limit) - $limit;*/
		  
		//to make pagination

		//$statement = "practice_test_details"; 
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Display Practice Result | Objective Exam </title>
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
			function myFunction(schoolid) 
			{
				var answer = confirm(" Are you want to delete?")
				if (!answer)
				{
					window.location = "display_schools.php";
				}
				else
				{
				   window.location = "delete_school.php?schoolid="+schoolid;
				}
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
					   		<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Practice Result</legend>
							<div id="result" style="margin-left:30%;">								
							
							<table border='1' width=90% style="margin:30px;">
								<br>
								<?php
										
									$query = "select * from subject_details";
									$result = mysqli_query($con,$query);
											
									while($row = mysqli_fetch_array($result)) 
									{
										$subjectid = $row['sub_id'];
										//echo $row['sub_name'];
										echo '<h3 style="color:#0051CC; font-weight:bolder;">'.$row['sub_name'].'</h3>';
										$query1 = "select * from topic_details where sub_id=".$subjectid;
										$result1 = mysqli_query($con,$query1);
										while($row1 = mysqli_fetch_array($result1)) 
										{
											
											echo '<span style="color:blue;font-weight:bold">';
											echo $row1['topic_name'].'<br>';
											
											$query2 = "select * from questions where topic_id=".$row1['topic_id'];
											$result2 = mysqli_query($con,$query2);
											$total_questions = mysqli_num_rows($result2);
											$correct_ans_count=0;
											while($row2 = mysqli_fetch_array($result2))
											{
											
												 $query3 = "select * from practice_test_details where ans_id=".$row2['ans_id']." and students_id in(select id from students_details where school_id=".$_SESSION['user_id'].") and question_id=".$row2['question_id']." group by students_id";
												$result3 = mysqli_query($con,$query3);
												$correct_ans_count = $correct_ans_count + mysqli_num_rows($result3);
												
												
											}
												$query4 = "select id from students_details where school_id=".$_SESSION['user_id'];
												$result4 = mysqli_query($con,$query4);
												$total_student_count = mysqli_num_rows($result4);
											
											
											
											
											$total = $total_student_count*$total_questions;
											
											//echo $percentage.'%<br>';
												if($total>0)
											echo (($correct_ans_count/$total)*100)."%<br>";
										else
											echo "0%<br>";
											
											
											
											
										}
										
									}
										
										
										
										
										
										
										
										
										
									/*	
										
												
										$query1 = "select * from subject_details where sub_id = $subjectid";
										$result1 = mysqli_query($con,$query1);
												
										$row1 = mysqli_fetch_array($result1);
										$sub_name = $row1['sub_name'];
										echo '<h3 style="color:#0051CC; font-weight:bolder;">'.$sub_name.'</h3>';
												
										$query2 = "select *from practice_test_details where subject_id = $subjectid group by topic_id DESC";
										$result2 = mysqli_query($con,$query2);
												
										while($row2 = mysqli_fetch_array($result2))
										{
											$topicid = $row2['topic_id'];
													
											$query3 = "select topic_name from topic_details where topic_id = $topicid";
											$result3 = mysqli_query($con,$query3);
											$row3 = mysqli_fetch_array($result3);
											$topicname = $row3['topic_name'];
													
											$query4 = "select * from practice_test_details where topic_id = $topicid group by question_id DESC";
											$result4 = mysqli_query($con,$query4);
											$question_count = mysqli_num_rows($result4);
											$total = 0;
													
											while($row4 = mysqli_fetch_array($result4))
											{ 
												$question_id = $row4['question_id'];
														
												$query5 = "select * from questions where question_id = $question_id";
												$result5 = mysqli_query($con,$query5);
												$count = mysqli_num_rows($result5);
													 
												if($count > 0)
												{
													$row5 = mysqli_fetch_array($result5);
													$right_ansid = $row5['ans_id'];
														
													$query6 = "select max(id),ans_id from practice_test_details where question_id = $question_id group by question_id DESC";
													$result6 = mysqli_query($con,$query6);
															
													while($row6 = mysqli_fetch_array($result6))
													{
														$student_answerid = $row6['ans_id'];	
														if($right_ansid == $student_answerid)
														{
															$total++;
														}
													}		
															
												}
												else
												{
															
												}
														 
											}
													
												
											echo '<span style="color:blue;font-weight:bold">';
											echo $topicname.'<br>';
													
											if($total==0)
											{
												$percentage=0;
											}
											else
											{
												$percentage = ($total/$question_count)*100;
											}
											
											echo $percentage.'%<br>';
													
										}
									}*/
										
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