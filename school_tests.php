
	<table id="table2" name="table2" border='1' width=90% style="margin:30px;">
		<tr>
			<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width:112px;height:45px;">&nbsp;&nbsp;School Tests &nbsp;&nbsp;</th>
			<th style="background-color:black;color:white;font-family: 'Helvetica Neue' width: 112px;height: 45px;">&nbsp; Action &nbsp;</th>
		</tr>
		<?php

			include('connection.php');
			
			extract($_REQUEST);
			extract($_POST);

			$sub_id = $_GET['subjectid']; 
			$schoolid = $_GET['school_id'];
				 						
			$query2 = "select * from tests_details where sub_id=$sub_id AND created_by=$schoolid";
			$result2 = $con->query($query2);
										
			while($row3 = mysqli_fetch_assoc($result2)) 
			{
				echo "<tr>";
					echo "<td style='height: 30px;width:430px'><center>" . $row3['name'] . "</center></td>";
											
					$testid = $row3['test_id'];
												
					echo "<td align='center' style='width: 170px;height: 30px;'> <a href='edit_school_test.php?testid=".$row3['test_id']."&subjectid=".$sub_id."' class='button edit'>
							Edit</a>&nbsp;<a href='#' onclick='myFunction(".$testid.");' class='button delete'>Delete</a></td>";
				echo "</tr>";
			}
		?>
	</table>