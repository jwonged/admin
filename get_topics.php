			<select name="topic" id="topic" required>
				<option value=''>Select Topic</option>
				<?php 
								
					include('connection.php');
	
					extract($_REQUEST);
					extract($_POST);	
					
					$sub_id = $_GET['subjectid'];

					$query7 = "select * from topic_details where sub_id=$sub_id";
					$result7 = $con->query($query7);
														
					while($row7 = mysqli_fetch_array($result7)) 
					{
						echo '<option value='.$row7['topic_id'].'>'.$row7['topic_name'].'</option>';
					}
										
				?>	
			</select>