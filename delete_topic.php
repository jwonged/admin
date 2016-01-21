<?php

	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$topic_id = $_GET['topicid'];
	
	$query = "delete from topic_details where topic_id = $topic_id";
	$result = $con->query($query);
	
	$query1 = "delete from questions where topic_id = $topic_id";
		
	if ($con->query($query1) === TRUE) 
	{  
		header("Location:display_topic.php");
	}
	else
	{
		$show['msg'] = 'failed';
		echo json_encode($show);
	}
	
?>