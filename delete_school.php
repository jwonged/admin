<?php

	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$school_id = $_GET['schoolid'];
	
	$query = "delete from school_details where school_id = $school_id";
		
	if ($con->query($query) === TRUE) 
	{  
		header("Location:display_schools.php");
	}
	else
	{
		$show['msg'] = 'failed';
		echo json_encode($show);
	}
	
?>