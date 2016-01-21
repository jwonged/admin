<?php
	
	$con = mysqli_connect('multiplechoicedb.db.5214242.hostedresource.com','multiplechoicedb','Naresh1@','multiplechoicedb');
	
	// Check connection
	if (!$con)
	{
		die("Connection error: " . mysqli_connect_errno());
	}
?>