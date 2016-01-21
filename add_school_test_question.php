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
	
	extract($_REQUEST);
	extract($_POST);

	$message="";
	$message1="";

	$subjectid = $_GET['sub'];
	$_SESSION["subjectid"] = $subjectid;
	
	$testname = $_GET['testnm']; 
	$_SESSION["test"] = $testname;
	
	if(count($_POST)>0)  
	{        
		$question = $_POST['qtext'];
		$topic = 0;//$_POST['topic'];
		$date = date("Y/m/d H:i");
		$schoolid = $_SESSION['user_id'];
		
		$opt1 = $_POST['Option1'];
		$opt2 = $_POST['Option2'];
		$opt3 = $_POST['Option3'];
		$opt4 = $_POST['Option4'];
		
		$correct_option = $_POST['Coption'];		
		$complexity = $_POST['Complexity'];
		$explane = $_POST['Explanation'];
		
		
		$query = "INSERT INTO test_questions VALUES('','$question','$subjectid','$topic','','$complexity','$explane','$schoolid','$date')";
		$result = mysqli_query($con,$query);
		$question_id = mysqli_insert_id($con);
					
		if($question_id!=0)	
		{
			$query1 = "INSERT INTO test_questions_answer (answer, question_id) VALUES ('$opt1','$question_id')";
			$result1 = mysqli_query($con,$query1);
			
			$query2 = "INSERT INTO test_questions_answer (answer, question_id) VALUES ('$opt2','$question_id')";
			$result2 = mysqli_query($con,$query2);
			
			$query3 = "INSERT INTO test_questions_answer (answer, question_id) VALUES ('$opt3','$question_id')";
			$result3 = mysqli_query($con,$query3);
			
			$query4 = "INSERT INTO test_questions_answer (answer, question_id) VALUES ('$opt4','$question_id')";
			$result4 = mysqli_query($con,$query4);
			
			$query5 = "select *from test_questions_answer where answer = '$correct_option'  AND question_id = $question_id";
			$result5 = mysqli_query($con,$query5);
							
			$row5 = mysqli_fetch_assoc($result5);
			$ansid = $row5['ans_id'];
			
			if($ansid=="")
			{
				$ansid=$correct_option;
			}
		
			$query6 = "update test_questions set ans_id=$ansid where question_id = $question_id";
			
			if ($con->query($query6) === TRUE) 
			{  
				
				if(isset($_SESSION["q_id"]))
				{
					$_SESSION["q_id"] = $question_id .','.$_SESSION["q_id"];
					
				}
				else
				{
					$_SESSION["q_id"] = $question_id;	
				}
				
				echo "<script type='text/javascript'>location.href = 'add_school_test.php';</script>";
				
			}
			else
			{
				$message1= "Question are not added";
			}
		}
		else
		{
			$message1= "Question are not added";			
		}
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add School Questions | Online Exam </title>
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
				window.location.href="add_school_test.php";
			}
			
		</script>
		
		<style>
			input[type="checkbox"]
			{
			  width: 23px; /*Desired width*/
			  height: 23px; /*Desired height*/
			}
		</style>
		
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
					
						function load_drp4()
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
						
						function show_topics()
						{
							var subid = document.getElementById('subject').value;
							 
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
										$('#topics').html(xmlhttp.responseText);
										$('#topics').show();
									}
									else
									{

									}
								}	

							xmlhttp.open("GET","get_topics.php?subjectid="+subid,true);
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
				<form class="form-horizontal well" action="" method="post" name="add_question" enctype="multipart/form-data" >
               
					<fieldset>
						<legend style="text-align:center;color:#29AAE1 ; font-weight:bolder;">Add Test Question</legend>
						<div class="control-group">
                         <div class="message"><?php if($message!="") { echo $message; } ?></div>
                         <div class="message1"><?php if($message1!="") { echo $message1; } ?></div>
                         
						    <div class="control-label">
								<label style="color:#29AAE1 ;">Question Text :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<textarea rows="4" cols="50" name="qtext" required minlength="3" maxlength="500"></textarea>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Subject :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
									<?php 
										$testname = $_GET['testnm'];
										$subname = $_GET['sub'];
										
										$query8 = "select * from subject_details where sub_id=".$subname;
										$result8 = $con->query($query8);
										$row8 = mysqli_fetch_assoc($result8);
											
									?>	
									<input type="text" name="sub_name" id="sub_name" value="<?php echo $row8['sub_name'] ?>"disabled required>
								</div>
							<!--<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Topics :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls" id="topics" name="topics">
								<select name="topic" id="topic" required>
									<option value=''>Select Topic</option>
									<?php 
									
										/*$query7 = "select * from topic_details";
										$result7 = $con->query($query7);
														
										while($row7 = mysqli_fetch_array($result7)) 
										{
											echo '<option value='.$row7['topic_id'].'>'.$row7['topic_name'].'</option>';
										}*/
										
									?>	
								</select>
							</div>-->
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Option 1 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls"> 
								<input type="text" name="Option1" id="Option1" onchange="load_drp1();" required>
							</div>                                                                               
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Option 2 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="Option2" id="Option2" onchange="load_drp2();" required>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Option 3 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="Option3" id="Option3" onchange="load_drp3();" required>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Option 4 :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<input type="text" name="Option4" id="Option4" onchange="load_drp4();" required>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Correct Option :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls" id="drp" name="drp">
								<select name="Coption" id="Coption" required>
									<option value=''>Correct Option</option>
								</select>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Complexity :<span style="color:#F00;">*</span></label>
							</div>
							<div class="controls">
								<select name="Complexity" id="Complexity" required>
									<option value=''>Select Complexity</option>
									<?php 
									
										$query9 = "select * from complexity";
										$result9 = $con->query($query9);
														
										while($row9 = mysqli_fetch_array($result9)) 
										{
											echo '<option value='.$row9['complexity_id'].'>'.$row9['Complexity'].'</option>';
										}
										
									?>	
								</select>
							</div>
							<br>
							<div class="control-label">
								<label style="color:#29AAE1 ;">Explanation :<span style="color:#F00;"></span></label>
							</div>
							<div class="controls">
								<textarea rows="4" cols="50" name="Explanation" maxlength="200"></textarea>
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