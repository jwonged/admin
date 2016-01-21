	<?php
		
		include('connection.php');		
		
			$sub_id = $_GET['subject_id'];
			
			$ids = array();
			$values = array();
					
			$query2 = "SELECT * FROM test_questions WHERE subject_id=$sub_id AND created_by=0";	
			$result2 = $con->query($query2);
					
			if($result2>0)
			{
				while($row2 = mysqli_fetch_assoc($result2))
				{
					$questions_id = $row2['question_id'];
					array_push($ids,$questions_id);
					
					$questions = $row2['question'];
					array_push($values,$questions);
				}
			}
			else
			{
						
			}
			
	?>
	
	<select name="question[]" id="question" multiple="multiple" class="multiselect" required>
		 
		<?php									
				for($j=0;$j<count($values);$j++)
				{
					echo '<option value='.$ids[$j].'>'.$values[$j].'</option>';
				}	
		?>
	</select>
	<script type="text/javascript">
	
	$(function()	{		$(".multiselect").multiselect({header: false});	});
	</script>