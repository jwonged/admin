	 
	
	<select name="Coption" id="Coption" required>
		<option value=''>Correct Option</option>
		<?php 
	
			include('connection.php');
		
			extract($_REQUEST);
			extract($_POST);

			$option1 = $_GET['optionone']; 
			$option2 = $_GET['optiontwo']; 
			$option3 = $_GET['optionthree']; 
			$option4 = $_GET['optionfour']; 
			
		?>												
			<option value='<?php echo $option1; ?>'><?php echo $option1; ?></option>
			<option value='<?php echo $option2; ?>'><?php echo $option2; ?></option>
			<option value='<?php echo $option3; ?>'><?php echo $option3; ?></option>
			<option value='<?php echo $option4; ?>'><?php echo $option4; ?></option>
	</select>
		