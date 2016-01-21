<?php

	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$questionid = $_GET['questionlid'];
	
	$query = "delete from questions where question_id =".$questionid;
	
	if ($con->query($query) === TRUE) 
	{  
		header("Location:display_pquestion.php");
	}
	else
	{
		$show['msg'] = 'failed';
		echo json_encode($show);
	}
	
?>