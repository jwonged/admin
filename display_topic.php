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

	if(count($_POST)>0) 
	{
			
	}
	else
	{
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
		$limit = 70;

		$startpoint = ($page * $limit) - $limit;
		  
		//to make pagination
	
		$statement = "topic_details  order by topic_id desc";
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Display Topics | Online Exam </title>
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
			function myFunction(topicid) 
			{
				var answer = confirm(" Are you want to delete?")
				if (!answer)
				{
					window.location = "display_topic.php";
				}
				else
				{
				   window.location = "delete_topic.php?topicid="+topicid;
				}
			}
		</script>
		<script type="text/javascript">
					
			function add_topic()
			{ 
				window.location.href="add_topic.php";
			}
		</script>
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
		
		.row-topic 
		{
		  width: 50%;
		}
		
		.row-subject
		{
		  width: 20%;
		}
		.row-action 
		{
		  width: 30%;
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
						<form name="menuitemgroupoption_form" enctype="multipart/form-data" style="background-color:#f5f5f5;width: 1060px;margin-left: -228px;border-radius: 4px;">
					   										
							<table border='1' width=90% style="margin:30px;" class="table_legenda">
								<br>
								<legend style="text-align:center;color:#0051CC; font-weight:bolder;">Topic Details</legend>
								<div class="control-label"> 
									
								</div>&nbsp;
								<div class="controls" id="que" name="que" style="margin-left:376px;">
									<input type="button" id="clear" name="clear" value="Add Topic" style="width: 220px;height: 40px;" class="btn btn-primary button-loading" data-loading-text="Loading..." onclick="add_topic();">
								</div>	
								<tr>
									<th class="row-1 row-topic" style="background-color:black;color:white;font-family: 'Helvetica Neue' width:112px;height:45px;">&nbsp;&nbsp; Topic Name &nbsp;&nbsp;</th>
									<th class="row-1 row-subject" style="background-color:black;color:white;font-family: 'Helvetica Neue' width:112px;height:45px;">&nbsp;&nbsp; Subject Name &nbsp;&nbsp;</th>
									<th class="row-1 row-action" style="background-color:black;color:white;font-family: 'Helvetica Neue' width:70px;height: 45px;">&nbsp; Action &nbsp;</th>
								</tr>
									<?php
										
										$query = "select * from {$statement} LIMIT {$startpoint} ,	{$limit}";
										$result = $con->query($query);

										while($row = mysqli_fetch_array($result)) 
										{	
											$query1 = "select * from subject_details where sub_id =".$row['sub_id'];
											$result1 = $con->query($query1);
											$row1 = mysqli_fetch_array($result1);	
										
											echo "<tr>";
												echo "<td style='height:30px;width:50%;'><center>" . $row['topic_name'] . "</center></td>";
												echo "<td style='height:30px;width:20%;'><center>" . $row1['sub_name'] . "</center></td>";
												echo "<td align='center' style='width:30%;height: 30px;'> <a href='edit_topic.php?topicid=".$row['topic_id']."' class='button edit'>Edit</a>&nbsp;<a href='#' class='button delete' onclick='myFunction(".$row['topic_id'].");'>Delete</a></td>";
											echo "</tr>";
										}
									?>
							</table>
							<br>
						</form>
					</div>
					<div class="span3 hidden-phone"></div>
				</div>
			</div>
		</div>
	</body>
</html>