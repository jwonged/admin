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
		$questionid = $_GET['queid'];
		
		$testid = $_GET['testid'];
		$subjectid = $_GET['subjectid'];
		
		$question = $_POST['qtext']; 
		/*$topic = $_POST['topic'];*/
		
		$opt1 = $_POST['Option1'];
		$opt2 = $_POST['Option2'];
		$opt3 = $_POST['Option3'];
		$opt4 = $_POST['Option4'];
		
		$optid1 = $_POST['Option11'];
		$optid2 = $_POST['Option22'];
		$optid3 = $_POST['Option33'];
		$optid4 = $_POST['Option44'];
		
		$correct_option = $_POST['Coption'];
		$complexity = $_POST['Complexity'];
		$explane = $_POST['Explanation'];
		
		$query = "update test_questions set question = '$question', complexity = '$complexity', explanation ='$explane' where question_id = $questionid";
		
		if ($con->query($query) === TRUE) 	
		{
			$query1 = "update test_questions_answer set answer = '$opt1' where ans_id = $optid1";
			$result1 = mysqli_query($con,$query1);
			
			$query2 = "update test_questions_answer set answer = '$opt2' where ans_id = $optid2";
			$result2 = mysqli_query($con,$query2);
			
			$query3 = "update test_questions_answer set answer = '$opt3' where ans_id = $optid3";
			$result3 = mysqli_query($con,$query3);
			
			$query4 = "update test_questions_answer set answer = '$opt4' where ans_id = $optid4";
			$result4 = mysqli_query($con,$query4);
			
			$query5 = "select *from test_questions_answer where answer = '$correct_option'  AND question_id = $questionid";
			$result5 = $con->query($query5);
							
			$row5 = mysqli_fetch_array($result5);
			$ansid = $row5['ans_id'];
			
			if($ansid=="")
			{
				$ansid=$correct_option;
			}
		
			$query6 = "update test_questions set ans_id=$ansid where question_id = $questionid";
					
			if ($con->query($query6) === TRUE) 
			{  
				/*header("Location:display_pquestion.php");*/
				echo "<script type='text/javascript'>location.href = 'createtest.php';</script>";
			}
			else
			{
				$message= "failed to update";
			}
		}
		else
		{
			$message1= "failed to update question";			
		}
	}
	else
	{
		$questionid = $_GET['queid'];
		
		/*$testid = $_GET['testid'];*/
		$subjectid = $_GET['subjectid'];
		
		$query10 = "select *from test_questions where question_id = $questionid";
		$result10 = mysqli_query($con,$query10);
		
		$row10 = mysqli_fetch_array($result10);
		
		$topicid = $row10['topic_id'];
		
		$query11 = "select *from topic_details where topic_id = $topicid";
		$result11 = mysqli_query($con,$query11);
		
		$row11 = mysqli_fetch_array($result11);
		$subid = $row11['sub_id'];
		
		$query12 = "select *from subject_details where sub_id = $subjectid";
		$result12 = mysqli_query($con,$query12);
		$row12 = mysqli_fetch_array($result12);
		
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit Practice Questions | Objective Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">

		<style type="text/css">
			.message {
			color: RED;
			font-weight: bold;
			text-align: center;
			width: 100%;
			}
			.message1 {
			color:RED;
			font-weight: bold;
			text-align: center;
			width: 100%;
			}
		</style>
		
		<script type="text/javascript">
		
			function back()
			{
				window.location.href="createtest.php";
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
				<!-- Ajax Call -->
					<script src="js/jquery-1.11.1.min.js"></script>
					
					<script>
					
						function load_drp1()
						{
							var opt1 = document.getElementById('Option1').value;
							var opt2 = document.getElementById('Option2').value;
							var opt3 = document.getElementById('Option3').value;
							var opt4 = document.getElementById('Option4').value;
							
							if (window.XMLHttpRequest)
							{
								xmlhttp=new XMLHttpRequest();	
							}
							else
							{
								xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
							}
								xmlhttp.onreadystatechange=function()
								{
									if (xmlhttp.readyState==4 && xmlhttp.status==200)
									{	
										$('#drp').html(xmlhttp.responseText);
										$('#drp').show();
									}
									else
									{

									}
								}	

							xmlhttp.open("GET","load_dropdown.php?optionone="+opt1+"&optiontwo="+opt2+"&optionthree="+opt3+"&optionfour="+opt4,true);
							xmlhttp.send();
							
						}
						
						function load_drp2()
						{
							var opt1 = document.getElementById('Option1').value;
							var opt2 = document.getElementById('Option2').value;
							var opt3 = document.getElementById('Option3').value;
							var opt4 = document.getElementById('Option4').value;
							
							if (window.XMLHttpRequest)
							{
								xmlhttp=new XMLHttpRequest();	
							}
							else
							{
								xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
							}
								xmlhttp.onreadystatechange=function()
								{
									if (xmlhttp.readyState==4 && xmlhttp.status==200)
									{	
										$('#drp').html(xmlhttp.responseText);
										$('#drp').show();
									}
									else
									{

									}
								}	

							xmlhttp.open("GET","load_dropdown.php?optionone="+opt1+"&optiontwo="+opt2+"&optionthree="+opt3+"&optionfour="+opt4,true);
							xmlhttp.send();
							
						}
						
						function load_drp3()
						{
							var opt1 = document.getElementById('Option1').value;
							var opt2 = document.getElementById('Option2').value;
							var opt3 = document.getElementById('Option3').value;
							var opt4 = document.getElementById('Option4').value;
							
							if (window.XMLHttpRequest)
							{
								xmlhttp=new XMLHttpRequest();	
							}
							else
							{
								xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
							}
								xmlhttp.onreadystatechange=function()
								{
									if (xmlhttp.readyState==4 && xmlhttp.status==200)
									{	
										$('#drp').html(xmlhttp.responseText);
										$('#drp').show();
									}
									else
									{

									}
								}	

							xmlhttp.open("GET","load_dropdown.php?optionone="+opt1+"&optiontwo="+opt2+"&optionthree="+opt3+"&optionfour="+opt4,true);
							xmlhttp.send();
							
						}
					
						function load_drp()
						{
							var opt1 = document.getElementById('Option1').value;
							var opt2 = document.getElementById('Option2').value;
							var opt3 = document.getElementById('Option3').value;
							var opt4 = document.getElementById('Option4').value;
							
							if (window.XMLHttpRequest)
							{
								xmlhttp=new XMLHttpRequest();	
							}
							else
							{
								xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
							}
								xmlhttp.onreadystatechange=function()
								{
									if (xmlhttp.readyState==4 && xmlhttp.status==200)
									{	
										$('#drp').html(xmlhttp.responseText);
										$('#drp').show();
									}
									else
									{

									}
								}	

							xmlhttp.open("GET","load_dropdown.php?optionone="+opt1+"&optiontwo="+opt2+"&optionthree="+opt3+"&optionfour="+opt4,true);
							xmlhttp.send();
							
						}
					</script>
				<!-- End Ajax Call -->
		</head>
	<body>    

	<!-- Navbar
    ================================================== -->

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
		<?php include_once('menu.php'); ?>
	</div>
	<br>
	<br>
	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="" method="post" name="edit_practice_question" enctype="multipart/form-data" onsubmit="return(validate());">
               
					<fieldset>
						<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Edit Question Field</legend>
						<div class="control-group">
                         <div class="message"><?php if($message!="") { echo $message; } ?></div>
                         <div class="message1"><?php if($message1!="") { echo $message1; } ?></div>
                         
						    <div class="control-label">
								<label style="color:#0051CC;">Question Text :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<textarea rows="4" cols="50" name="qtext" minlength="3" maxlength="500" required><?php echo $row10['question'] ?></textarea>
							</div>
							<br>
							 <div class="control-label">
								<label style="color:#0051CC;">Subject :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="subjectname" value="<?php echo $row12['sub_name'] ?>" pattern="[a-zA-Z\s]*" title="Only enter letters" required  disabled>
							</div>
							<br>
							<!--<div class="control-label">
								<label style="color:#0051CC;">Topics :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<select name="topic" id="topic" required>
									<option value=''>Select Topic</option>
									<?php 
									
										/*$topicid = $row10['topic_id'];
										
										$query7 = "select * from topic_details where sub_id = ".$row12['sub_id'];
										$result7 = $con->query($query7);
														
										while($row7 = mysqli_fetch_array($result7)) 
										{	
											$id = $row7['topic_id'];
											
											if($topicid == $id)
											{
												echo '<option value='.$row7['topic_id'].' selected="selected">'.$row7['topic_name'].'</option>';
											}
											else
											{
												echo '<option value='.$row7['topic_id'].'>'.$row7['topic_name'].'</option>';
											}
										}*/
										
									?>	
								</select>
							</div>
							<br>-->
							<?php 
								
								$query11 = "select *from test_questions_answer where question_id = $questionid";
								$result11 = mysqli_query($con,$query11);	
								
								$option = array();
								$optionid = array();
								
								while($row11 = mysqli_fetch_array($result11))
								{
									array_push($option,$row11['answer']);
									array_push($optionid,$row11['ans_id']);
								}
								
							?>	
							<div class="control-label">
								<label style="color:#0051CC;">Option 1 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls"> 
								<input type="text" name="Option1" id="Option1" value="<?php echo $option[0]; ?>" onchange="load_drp1();" required>
								<input type="hidden" name="Option11" id="Option11" value="<?php echo $optionid[0]; ?>">
							</div> 
							<br>
							<div class="control-label">
								<label style="color:#0051CC;">Option 2 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="Option2" id="Option2" value="<?php echo $option[1]; ?>"  onchange="load_drp2();"required>
								<input type="hidden" name="Option22" id="Option22" value="<?php echo $optionid[1]; ?>">
							</div>
							<br>
							<div class="control-label">
								<label style="color:#0051CC;">Option 3 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="Option3" id="Option3" value="<?php echo $option[2]; ?>" onchange="load_drp3();" required>
								<input type="hidden" name="Option33" id="Option33" value="<?php echo $optionid[2]; ?>">
							</div>
							<br>
							<div class="control-label">
								<label style="color:#0051CC;">Option 4 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="Option4" id="Option4" onchange="load_drp();" value="<?php echo $option[3]; ?>" required>
								<input type="hidden" name="Option44" id="Option44" value="<?php echo $optionid[3]; ?>">
							</div>
							
							<br>
							<div class="control-label">
								<label style="color:#0051CC;">Correct Option :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls" id="drp" name="drp">
								<select name="Coption" id="Coption" required> 
									<option value=''>Correct Option</option>
									<?php 
											
										$ansid = $row10['ans_id'];
										
										$query12 = "select *from test_questions_answer where question_id = $questionid";
										$result12 = mysqli_query($con,$query12);	
										
										while($row12 = mysqli_fetch_array($result12)) 
										{
											$id = $row12['ans_id'];
											
											if($ansid == $id)
											{
												echo '<option value='.$row12['ans_id'].' selected="selected">'.$row12['answer'].'</option>';
											}	
											else
											{
												echo '<option value='.$row12['ans_id'].'>'.$row12['answer'].'</option>';
											}	
										}
										
									?>	
								</select>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#0051CC;">Complexity :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<select name="Complexity" id="Complexity" required>
									<option value=''>Select Complexity</option>
									<?php 
									
										$com_id = $row10['complexity'];	
										
										$query9 = "select * from complexity";
										$result9 = $con->query($query9);
														
										while($row9 = mysqli_fetch_array($result9)) 
										{
											$id = $row9['complexity_id'];
											
											if($com_id == $id)
											{
												echo '<option value='.$row9['complexity_id'].' selected="selected">'.$row9['Complexity'].'</option>';
											}
											else
											{
												echo '<option value='.$row9['complexity_id'].'>'.$row9['Complexity'].'</option>';
											}		
										}
										
									?>	
								</select>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#0051CC;">Explanation :<span style="color:#F00;"></span></label>
							</div>
							<div class="controls">
								<!--<input type="text" name="Explanation" value="<?php echo $row10['explanation'] ?>" pattern="[a-zA-Z\+-x*\s]+[0-9]*" title="Only enter letters" required>-->
								<textarea rows="4" cols="50" name="Explanation" required><?php echo $row10['explanation'] ?></textarea>
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