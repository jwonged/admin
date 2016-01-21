<?php

	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$question_id = $_GET['questionid'];
	
	$query = "delete from test_questions where question_id=".$question_id;
	
	if ($con->query($query) === TRUE) 
	{  
		/*header("Location:edit_test.php?testid=$test_id");*/
		echo "<script type='text/javascript'>location.href = 'createtest.php';</script>";
		
	}
	else
	{
		$show['msg'] = 'failed';
		echo json_encode($show);
	}
	
?>