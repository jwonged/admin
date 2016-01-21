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
			
			.row-test 
			{
			  width: 30%;
			}
			.row-created 
			{
			  width: 30%;
			}
			.row-action 
			{
			  width: 30%;
			}
		</style>
	<table id="table2" name="table2" border='1' width=90% style="margin:30px;">
		<tr>
			<th class="row-1 row-test" style="background-color:black;color:white;font-family:'Helvetica Neue' height:45px;">&nbsp;&nbsp; Test &nbsp;&nbsp;</th>
			<th class="row-1 row-created" style="background-color:black;color:white;font-family:'Helvetica Neue' height:45px;">&nbsp;&nbsp; Created By &nbsp;&nbsp;</th>
			<th class="row-1 row-action" style="background-color:black;color:white;font-family:'Helvetica Neue' height: 45px;">&nbsp; Action &nbsp;</th>
		</tr>
		<?php

			include('connection.php');
			
			extract($_REQUEST);
			extract($_POST);

			$sub_id = $_GET['subjectid']; 
			
			$query2 = "select * from tests_details where sub_id=$sub_id AND created_by=0";
			$result2 = $con->query($query2);
										
			while($row3 = mysqli_fetch_assoc($result2)) 
			{
				echo "<tr>";
					echo "<td style='height: 30px;width:430px'><center>" . $row3['name'] . "</center></td>";
											
					$testid = $row3['test_id'];
					
					if($row3['created_by']==0)
					{
						echo "<td style='height:30px;'><center>Admin</center></td>";
					}
					else
					{
						$query3 = "select * from school_details where school_id=".$row3['created_by'];
						$result3 = $con->query($query3);
												
						$row2 = mysqli_fetch_assoc($result3);
									
						echo "<td style='height: 30px;'><center>" . $row2['school_name'] . "</center></td>";
					}
												
					echo "<td align='center' style='width: 170px;height: 30px;'> <a href='edit_test.php?testid=".$row3['test_id']."&subjectid=".$sub_id."' class='button edit'>
							Edit</a>&nbsp;<a href='#' onclick='myFunction(".$testid.");' class='button delete'>Delete</a></td>";
				echo "</tr>";
			}
		?>
	</table>