<?php

	session_start(); 
	
	if(!isset($_SESSION["user_id"]))
	{	
		header('location:index.php');
		exit;
	}

?>	

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
		  width: 30%;
		}
	</style>
	<table id="table2" class="table_legenda" name="table2" border='1' width=90% style="margin:30px;">
	<tr>
		<th class="row-1 row-que" style="background-color:black;color:white;font-family:'Helvetica Neue'height:45px;">&nbsp;&nbsp; Questions &nbsp;&nbsp;</th>
		<th class="row-1 row-action" style="background-color:black;color:white;font-family:'Helvetica Neue'height: 45px;">&nbsp; Action &nbsp;</th>
	</tr>	
	<?php
		include('connection.php');
		
		extract($_REQUEST);
		extract($_POST);

		$sub_id = $_GET['subjectid']; 
			
		$query2 = "select * from topic_details where sub_id=$sub_id";
		$result2 = $con->query($query2);
						
		while($row2=mysqli_fetch_assoc($result2))
		{
			$topicid = $row2['topic_id'];
										
			$query3 = "select * from questions where topic_id=$topicid";
			$result3 = $con->query($query3);
										
			if($result3)
			{
				while($row3 = mysqli_fetch_assoc($result3)) 
				{
					$quesid = $row3['question_id'];
											
					$query4 = "select * from questions where question_id=$quesid";
					$result4 = $con->query($query4);
		
					while($row4 = mysqli_fetch_assoc($result4))
					{	
						echo "<tr>";
							echo "<td style='height:auto;'><center><div>" . $row4['question'] . "</div></center></td>";
														
							$questionlid = $row4['question_id'];
														
							echo "<td align='center' style='height: 30%;'> <a href='edit_practice_question.php?questionlid=".$row4['question_id']."' class='button edit'>
							Edit</a>&nbsp;<a href='#' onclick='myFunction(".$questionlid.");' class='button delete'>Delete</a></td>";
						echo "</tr>";
					}
				}
			}
			else
			{
											
							
			}
		}
					

	?>
		</table>