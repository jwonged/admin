<?php

	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$test_id = $_GET['testid'];
	$question_id = $_GET['question_id'];
	
	$query2 = "select *from tests_details where test_id = $test_id";
	$result2 = $con->query($query2);
	
	$row2 = mysqli_fetch_assoc($result2);
	$subid = $row2['sub_id'];
	
	$query1 = "delete from tests_details where question_id = question_id=".$question_id;
	$result1 = $con->query($query1);
	
	$query = "delete from test_question_details where test_id='$test_id' AND question_id='$question_id'";
	
	if ($con->query($query) === TRUE) 
	{  
		/*header("Location:edit_test.php?testid=$test_id");*/
		echo "<script type='text/javascript'>location.href = 'edit_school_test.php?testid=$test_id&subjectid=$subid';</script>";
		
	}
	else
	{
		$show['msg'] = 'failed';
		echo json_encode($show);
	}
	

?>