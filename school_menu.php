
<link href="css/menu_style.css" rel="stylesheet" type="text/css">
<link href="css/menu_drp.css" rel="stylesheet" type="text/css">

<div id="main" style="width:100%;height:auto;">
	<div id="menu" style="float:right;width:100%;background-color:black; ">
		<a class="brand" href="school_homepage.php" style="color:#ffffff;margin-left:0px;font-weight: bold;"><img src="img/logo.png" alt="Smiley face" width="30" height="30">&nbsp;Online Exam</a>
		<ul class="menuH decor1" style="position:relative;width: 82%;float: right;margin-top:5px;"> 
			<li id="liAct"><a class="arrow" href="#">Manage Tests</a>
				<ul>
					<!--<li><a class="#" href="add_school_test.php?value=0">Add School Test</a></li>
					<li><a class="#" href="add_school_test_question.php">Add  School Test Question</a></li>
					<li><a class="#" href="school_test_details.php">School Test Details</a></li>-->
					<li><a class="#" href="school_test_details.php?value=0">Add School Test</a></li>
				</ul>
			</li>
			<li id="liUser"><a class="arrow" href="overall_test_list.php">View Test Results</a> 
				<!--<ul>
					<li><a class="#" href="add_question.php">Add Question</a></li>
					<li><a class="#" href="display_pquestion.php">Practice Questions</a></li>
				</ul>-->
			</li>
			<li id="liAct"><a class="arrow" href="practice_result.php">View Practice Results </a>
				<!--<ul>
					<li><a class="#" href="createtest.php">Create Test</a></li>
					<li><a class="#" href="test_details.php">Tests Details</a></li>
				</ul>-->
			</li>
			<div style=" float:right;color:#ffffff; margin-top:10px; margin-right:20px;">Hello <?php echo $_SESSION["user_name"];?> <a href="logout.php" style="margin-top:-8px;float:right;">
           LogOut</a></div>
		</ul>
	</div>
</div>
				