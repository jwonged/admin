<?php

	session_start();
	$unm = $_SESSION["user_name"];
	if($unm == 'admin')
	{
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_name"]);
		header("Location:index.html");
	}
	else
	{
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_name"]);
		header("Location:index.html");
	}
?>
