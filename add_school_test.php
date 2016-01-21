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
	$message2="";
	
	if(isset($_GET['value']))
	{
		unset($_SESSION["q_id"]);
		unset($_SESSION["subjectid"]);
		unset($_SESSION["test"]);
	}
	else
	{
		if(count($_POST)>0)  
		{        
			
			$testnm = $_POST['test'];
			$subjectid = $_POST['subject'];
			
			$schoolid = $_SESSION['user_id'];
			/*$test_time = $_POST['testtime'];*/
		
			$ques_id = array();
			
			array_push($ques_id,$_SESSION['q_id']);
			
			$question_id = implode(",",$ques_id);
			$questionid = explode(",", $question_id);
			
			$date = date("Y/m/d H:i");
			 
			$query1 = "select *from tests_details where name='$testnm' and created_by=".$schoolid;
			$result1 = mysqli_query($con,$query1);
			
			if(mysqli_num_rows($result1) > 0) 
			{
				$message2= "test already added";
				unset($_SESSION["q_id"]);
				unset($_SESSION["subjectid"]);
				unset($_SESSION["test"]);				
			}
			else
			{
				$query = "INSERT INTO tests_details VALUES('','$testnm','$subjectid','$schoolid','','$date')";
				$result = mysqli_query($con,$query);
				
				$test_id = mysqli_insert_id($con);
				
				if($test_id>0)
				{
					for($j=0;$j<count($questionid);$j++)
					{
						$query2 = "INSERT INTO test_question_details VALUES('','$test_id','$questionid[$j]')";
						$result = $con->query($query2);
					}
					
					  
					/*header("Location:test_details.php");*/
					/*echo "<script type='text/javascript'>location.href = 'test_details.php';</script>";**/
					$message= "Test added successfully";
					unset($_SESSION["q_id"]);
					unset($_SESSION["subjectid"]);
					unset($_SESSION["test"]);
				}
				else
				{
					$message= "Test can't add successfully";
				}
			}			
		}
		else
		{
			$schoolid = $_SESSION['user_id'];
		}
	}
	
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add School Test | Online Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">
	 
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
		<style>
			 
			.button
			{        
				display: inline-block;
				white-space: nowrap;
				background-color: #ddd;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));
				background-image: -webkit-linear-gradient(top, #eee, #ccc);
				background-image: -moz-linear-gradient(top, #eee, #ccc);
				background-image: -ms-linear-gradient(top, #eee, #ccc);
				background-image: -o-linear-gradient(top, #eee, #ccc);
				background-image: linear-gradient(top, #eee, #ccc);
				border: 1px solid #777;
				padding: 0 1.5em;
				margin: 0.2em;
				font: bold 1em/2em Arial, Helvetica;
				text-decoration: none;
				color: #333;
				text-shadow: 0 1px 0 rgba(255,255,255,.8);
				-moz-border-radius: .2em;
				-webkit-border-radius: .2em;
				border-radius: .2em;
				-moz-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
				-webkit-box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
				box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
			}
			
			.button:hover
			{
				background-color: #eee;        
				background-image: -webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#ddd));
				background-image: -webkit-linear-gradient(top, #fafafa, #ddd);
				background-image: -moz-linear-gradient(top, #fafafa, #ddd);
				background-image: -ms-linear-gradient(top, #fafafa, #ddd);
				background-image: -o-linear-gradient(top, #fafafa, #ddd);
				background-image: linear-gradient(top, #fafafa, #ddd);
			}
			
			.button:active
			{
				-moz-box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
				-webkit-box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
				box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
				position: relative;
				top: 1px;
			}
			
			.button:focus
			{
				outline: 0;
				background: #fafafa;
			}    
			
			.button:before
			{
				background: #ccc;
				background: rgba(0,0,0,.1);
				float: left;        
				width: 2.9em;
				text-align: center;
				font-size: 1.5em;
				margin: 0 1em 0 -1em;
				padding: 0 .2em;
				-moz-box-shadow: 1px 0 0 rgba(0,0,0,.5), 2px 0 0 rgba(255,255,255,.5);
				-webkit-box-shadow: 1px 0 0 rgba(0,0,0,.5), 2px 0 0 rgba(255,255,255,.5);
				box-shadow: 1px 0 0 rgba(0,0,0,.5), 2px 0 0 rgba(255,255,255,.5);
				-moz-border-radius: .15em 0 0 .15em;
				-webkit-border-radius: .15em 0 0 .15em;
				border-radius: .15em 0 0 .15em;     
				pointer-events: none;		
			}
			
			/* Buttons and inputs */
			
			button.button, input.button 
			{ 
				cursor: pointer;
				overflow: visible; /* removes extra side spacing in IE */
			}
			
			/* removes extra inner spacing in Firefox */
			button::-moz-focus-inner 
			{
			  border: 0;
			  padding: 0;
			}
			
			/* If line-height can't be modified, then fix Firefox spacing with padding */
			 input::-moz-focus-inner 
			{
			  padding: .4em;
			}

			/* The disabled styles */
			.button[disabled], .button[disabled]:hover, .button.disabled, .button.disabled:hover 
			{
				background: #eee;
				color: #aaa;
				border-color: #aaa;
				cursor: default;
				text-shadow: none;
				position: static;
				-moz-box-shadow: none;
				-webkit-box-shadow: none;
				box-shadow: none;		
			}
			
			/* Hexadecimal entities for the icons */
			
			.add:before
			{
				content: "\271A";
			}
			
			.edit:before
			{
				content: "\270E";        
			}
			
			.delete:before
			{
				content: "\2718";        
			}
			
			.save:before
			{
				content: "\2714";        
			}
			
			.email:before
			{
				content: "\2709";        
			}
			
			.like:before
			{
				content: "\2764";        
			}
			
			.next:before
			{
				content: "\279C";
			}
			
			.star:before
			{
				content: "\2605";
			}
			
			.spark:before
			{
				content: "\2737";
			}
			
			.play:before
			{
				content: "\25B6";
			}

		</style>
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
			.message2 {
			color:#FF0000;
			font-weight: bold;
			text-align: center;
			width: 100%;
			}
			
		</style>
		
		<script type="text/javascript">
		
			function visible()
			{
				var sub = document.getElementById('subject').value;
				 
				if(sub!='')	
				{
					document.getElementById("clear").disabled = false;
				}
				else
				{
					document.getElementById("clear").disabled = true;
				}
				
				
			}
			
			function add_questions()
			{
				var test_name = document.getElementById('test').value;
				var subject = document.getElementById('subject').value;
				 
				window.location.href="add_school_test_question.php?testnm="+test_name+"&sub="+subject;
			}
			
		</script>
		<script>
			
			function back()
			{ 
				window.location.href="school_test_details.php";
			}
				
		</script>
		
		<style>
			input[type="checkbox"]
			{
			  width: 23px; /*Desired width*/
			  height: 23px; /*Desired height*/
			}
		</style>
		<script type="text/javascript">
			function myFunction(questionid) 
			{	
				var answer = confirm("Are you want to delete?")
				if (!answer)
				{
					window.location = "add_school_test.php";
				}
				else
				{
				   window.location = "delete_school_createtest_question.php?questionid="+questionid;
				}
			}
		</script>
					
		<link rel="stylesheet" type="text/css" href="multiselectResorces/jquery.multiselect.css" />
		<link rel="stylesheet" type="text/css" href="multiselectResorces/assets/jquery-ui.css" />
		<script type="text/javascript" src="multiselectResorces/src/jquery.js"></script>
		<script type="text/javascript" src="multiselectResorces/src/jquery-ui.min.js"></script>
		<script type="text/javascript" src="multiselectResorces/src/jquery.multiselect.min.js"></script>
		
		<script type="text/javascript">
		$(function()
		{
			$(".multiselect").multiselect({
			header: false,
			minWidth:245
			});
		});

		</script>
			<!-- End Ajax Call -->
			
		<style>
		table.table_legenda
		{
			table-layout: fixed;
			word-wrap:break-word;
		} 
		
		.table_legenda td
		{
		  
		  overflow: hidden;
		  text-overflow: ellipsis;
		}
		
		.row-que 
		{
		  width: 60%;
		}
		.row-action 
		{
		  width: 31%;
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
		<?php include_once('school_menu.php'); ?>
	</div>
	<br>
	<br>
	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="" method="post" name="add_question" enctype="multipart/form-data" style="background-color:#f5f5f5;width: 1060px;margin-left: -228px;border-radius: 4px;">
               
					<fieldset>
						<legend style="text-align:center;color:#29AAE1 ; font-weight:bolder;">Add Test</legend>
						<div class="control-group">
                         <div class="message"><?php if($message!="") { echo $message; } ?></div>
                         <div class="message1"><?php if($message1!="") { echo $message1; } ?></div>
						  <div class="message2"><?php if($message2!="") { echo $message2; } ?></div>
							
							<div style="margin-left:30%;">
								<div class="control-label">
									<label style="color:#29AAE1 ;">Test Name :<span style="color:#F00;">*</span></label>
								</div>
								<div class="controls">
									<?php

										if(isset($_SESSION["test"]))
										{
									?>		
											<input type="text" name="test" id="test" value="<?php echo $_SESSION["test"] ?>" minlength="4" maxlength="50" pattern="[\S]+[a-zA-Z\+-x*\s]+[0-9]*" required >
									<?php
										}
										else
										{
									?>
											<input type="text" name="test" id="test" minlength="4" maxlength="50" pattern="[\S]+[a-zA-Z\+-x*\s]+[0-9]*" required >
									<?php
										}
									?>
								</div>
								<br>
								<div class="control-label">
									<label style="color:#29AAE1 ;">Subject :<span style="color:#F00;">*</span></label>
								</div>
								<div class="controls">
									<select name="subject" id="subject" required onchange="visible()">
										<option value=''>Select Subject</option>
										<?php 
										
											$query7 = "select * from subject_details";
											$result7 = $con->query($query7);
															
											while($row7 = mysqli_fetch_array($result7)) 
											{
												$id = $row7['sub_id'];
												if($_SESSION['subjectid'] == $id)
												{
													echo '<option value='.$row7['sub_id'].' selected="selected">'.$row7['sub_name'].'</option>';
												}
												else
												{
													echo '<option value='.$row7['sub_id'].'>'.$row7['sub_name'].'</option>';
												}				
											}
											 
										?>	
									</select>
								</div>
								<br>
								<div class="control-label"> 
									
								</div>
								<div class="controls" id="que" name="que">
									
									<input type="button" id="clear" name="clear" value="Add Question" style="width: 220px;height: 40px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="add_questions();" disabled>
									<!--<a href='add_test_question.php' class='button add'>Add Questions</a>-->
									<script type="text/javascript">
										visible();
									</script>
								</div>
							</div>
							
							<div id="question_details" name="question_details">	
								<center>
								<table id="table2" name="table2" border='1' width=90% style="margin:30px;" class="table_legenda">
									<tr>
										<th class="row-que" style="background-color:black;color:white;font-family:'Helvetica Neue' height:45px;">&nbsp;&nbsp; Questions &nbsp;&nbsp;</th>
										<th class="row-action" style="background-color:black;color:white;font-family:'Helvetica Neue' height: 45px;">&nbsp; Action &nbsp;</th>
									</tr>
									
									<?php
									
										if(isset($_SESSION['q_id']))
										{
											$id = array();
											
											array_push($id,$_SESSION['q_id']);
											
											if (strpos($_SESSION['q_id'],',') !== false)
											{
												$questionids = implode(',',$id);											
												$question_ids = explode(',',$questionids);
											}
											else
											{	
												$question_ids = array();
												array_push($question_ids,$_SESSION['q_id']);	
											}
											
											for($i=0;$i<count($question_ids);$i++)
											{
												$query1 = "SELECT * FROM test_questions WHERE question_id=".$question_ids[$i];	
												$result1 = $con->query($query1);
												
												while($row1 = mysqli_fetch_assoc($result1))
												{
													$queid = $row1['question_id'];	
													echo "<tr>";
													echo "<td style='height: 30px;'><center>" . $row1['question'] . "</center></td>";
													echo "<td align='center' style='width: 330px;height: 30px;'><a href='edit_school_createtest_question.php?queid=".$row1['question_id']."&subjectid=".$_SESSION['subjectid']."' class='button edit'>Edit</a>&nbsp;<a href='#' class='button delete' onclick='myFunction(".$row1['question_id'].");'>Delete</a></td>";
													echo "</tr>";
												}
											}	
										}	
									?>
								
								</table>
								</center>
							</div>
						</div>
						
						<div class="control-group" style="float:right;margin-right:54px;">
                       
							<div class="controls">
							<button type="submit" id="submit" name="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Submit</button>
							<input type="button" id="clear" value="Back" style="width: 77px;height: 30px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="back();">
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