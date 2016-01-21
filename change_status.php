<?php
	
	include('connection.php');
	
	extract($_REQUEST);
	extract($_POST);

	$school_id = $_GET['schoolid'];
	
	$status = $_GET['status'];

	if($status=='Active')	
	{
		
		$query = "update school_details set status='Inactive' where school_id=".$school_id;
		
		if ($con->query($query) === TRUE) 
		{
			echo "<script type='text/javascript'>location.href = 'display_schools.php';</script>";
		}
		
	}
	else
	{
		$query = "update school_details set status='Active' where school_id=".$school_id;
		
		if ($con->query($query) === TRUE) 
		{
			echo "<script type='text/javascript'>location.href = 'display_schools.php';</script>";
		}
		
	}
?>