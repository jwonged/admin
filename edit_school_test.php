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
		
		$message="";
		if(count($_POST)>0) 
		{
			$testname = $_REQUEST['testname'];
			$testid= $_GET['testid'];
			
			$query = "update tests_details set name ='$testname' where test_id = $testid";

			if ($con->query($query) === TRUE) 
			{  
				/*header("Location:test_details.php");*/
				echo "<script type='text/javascript'>location.href = 'school_test_details.php';</script>";
			}
			else
			{
				$message= "Test not update";
			}
		}	
		else
		{
			$testid = $_GET['testid'];
			$subjectid = $_GET['subjectid'];
			
			$query = "select *from tests_details where test_id=$testid AND sub_id = $subjectid";
			$result = $con->query($query);
			
			if(mysqli_num_rows($result) > 0)	
			{
				$row = mysqli_fetch_array($result);
				 
				$query2 = "select *from subject_details where sub_id = $subjectid";
				$result2 = $con->query($query2);
				
				$row2 = mysqli_fetch_array($result2);
			}
			else
			{
				
			}
		}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Display paractice Question | Objective Exam </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">
		<script src="js/jquery-1.11.1.min.js"></script>
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
				margin: 0.5em;
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
				width: 1em;
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
			
			function show_sub_question() 
			{
				var subId = document.getElementById('subject').value;
							
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();	
				}
				else
				{// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
					xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{	
							
							document.getElementById("question_details").innerHTML = "";
							$( "#question_details" ).empty();
							$('#question_details').html('');
							$('#question_details').html(xmlhttp.responseText);
							$('#question_details').show();

						}
						else
						{

						}
					}	

				xmlhttp.open("GET","edit_test.php?subjectid="+subId,true);
				xmlhttp.send();
			}
		</script>
		
		<script type="text/javascript">
			function myFunction(testid,questionid) 
			{
				var answer = confirm("Are you want to delete?")
				if (!answer)
				{
					window.location = "edit_school_test.php";
				}
				else
				{
					window.location = "delete_school_test_question.php?testid="+testid+"&question_id="+questionid;
				}
				
				
			}
		</script>
		<script>
			
			function add_question(testid,subid)
			{ 
				window.location.href="add_question_in_schhol_test.php?test="+testid+"&sub="+subid;
			}
				
		</script>
	</head>
	<body>    
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
						<div class="message"><?php if($message!="") { echo $message; } ?></div>
                     
						<form name="edit_test" action="" method="post" enctype="multipart/form-data" style="background-color:#f5f5f5;width: 1060px;margin-left: -228px;border-radius: 4px;" onsubmit="return(validate());">
						
							<table style="margin-left: 15%;">
								<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Edit Test Details</legend>
								<br>
								<tr style="background-color: white;">
									<td style="background-color: #f5f5f5;">
										<label style="color:#0051CC;">Test Name :<span style="color:#F00;">*</span></label>
									</td>
									<td style="background-color: #f5f5f5;">
										<input type="text" name="testname" value="<?php echo $row['name'] ?>" pattern="[a-zA-Z\+-x*\s]+[0-9]*" title="Only enter letters" required>
									</td>
								</tr>	
								<tr>
									<td style="background-color: #f5f5f5;">
										<label style="color:#0051CC;">Subject :<span style="color:#F00;">*</span></label>
									</td>
									<td style="background-color: #f5f5f5;">
										<input type="text" name="subjectname" value="<?php echo $row2['sub_name'] ?>" pattern="[a-zA-Z\s]*" title="Only enter letters" required  disabled>
									</td>
								</tr>
							</table>	
							<div class="control-label"> 
									
							</div>&nbsp;
							<div class="controls" id="que" name="que" style="margin-left:243px;">
								<input type="button" id="clear" name="clear" value="Add Question" style="width: 220px;height: 40px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="add_question('<?php echo $testid ?>','<?php echo $subjectid ?>');">
							</div>	
							<div id="question_details" name="question_details">	
								<center>
								<table id="table2" name="table2" border='1' width=80% style="margin:30px;">
									<tr>
										<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width:112px;height:45px;">&nbsp;&nbsp; Questions &nbsp;&nbsp;</th>
										<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width: 112px;height: 45px;">&nbsp; Action &nbsp;</th>
									</tr>
									
									<?php
									
										$query4 = "SELECT * FROM test_question_details WHERE test_id = $testid";	
										$result4 = $con->query($query4);
									
										while($row4 = mysqli_fetch_assoc($result4))
										{
											$questionid = $row4['question_id'];
											
											$query1 = "SELECT * FROM test_questions WHERE question_id=$questionid";	
											$result1 = $con->query($query1);
											
											while($row1 = mysqli_fetch_assoc($result1))
											{
												$queid = $row1['question_id'];	
												echo "<tr>";
												echo "<td style='height: 30px;'><center>" . $row1['question'] . "</center></td>";
												echo "<td align='center' style='width: 268px;height: 30px;'><a href='edit_school_test_questions.php?queid=".$row1['question_id']."&testid=".$testid."&subjectid=".$subjectid."' class='button edit'>Edit</a>&nbsp;<a href='#' class='button delete' onclick='myFunction(".$testid.",".$queid.");'>Delete</a></td>";
												echo "</tr>";
											}
										}	
											
									?>
								
								</table>
								</center>
							</div>
							<div class="control-group" style="width: 185px;margin-left:70%;">
                       			<div class="controls">
									<button type="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Update</button>
									<input type="button" id="clear" value="Back" style="width: 77px;height: 30px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="back();">
								</div>
							</div>
							<br>
						</form>
					</div>
					<div class="span3 hidden-phone"></div>
				</div>
			</div>
		</div>
	</body>
		<script type="text/javascript">
			function back()
			{ 
				window.location.href="school_test_details.php";
			}
		</script>
</html>