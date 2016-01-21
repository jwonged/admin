<?php

	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$test_id = $_GET['testid'];
	 
	$query2 = "delete from tests_details where test_id =".$test_id;
	$result2 = $con->query($query2);
	
	$query = "delete from test_question_details where test_id=".$test_id;
	
	if ($con->query($query) === TRUE) 
	{  
		/*header("Location:edit_test.php?testid=$test_id");*/
		echo "<script type='text/javascript'>location.href = 'school_test_details.php';</script>";
		
	}
	else
	{
		$show['msg'] = 'failed';
		echo json_encode($show);
	}
?>