<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url('css/styles.css'); ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/scripts.js'); ?>"></script>
</head>

<body>
<div id="transparent-cover"></div>
<!-- popup1 -->
<div class="popup popup1 round-all-10">
<p class="prompt">Are you sure you want to delete <?php echo $student->studentName; ?></p>
<div class="btns"><button class="yes" onclick="deleteProfile(<?php echo $student->studentID; ?>, '.popup1');">YES</button><button class="no" onclick="endPopup('.popup1');">NO</button>
</div>
</div><!-- end popup1 -->
<div class="popup popup2 round-all-10"> <!-- popup2 -->
<form action="<?php echo current_url(); ?>" method="post" style="margin-top:10px;">
<label class="label" style="width:100px;">Session</label>
<select name="session-id" class="text-field">
<?php
foreach($all_session as $session)
{
	echo '<option value="'.$session->sessionID.'">'.$session->sessionName.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">Term</label>
<select name="term-id" class="text-field">
<option value="1">First Term</option>
<option value="2">Second Term</option>
<option value="3">Third Term</option>
</select>
<div class="btns" style="bottom:0px; left:-60px;">
<input type="submit" name="get-result" value="Go" class="yes" />
<button class="no" onclick="endPopup('.popup2');">Cancel</button>
</div>
</form>
</div> <!-- end popup2 -->

<div class="popup popup3 round-all-10"> <!-- popup3 -->
<form action="<?php echo current_url(); ?>" method="post" style="margin-top:10px;">
<label class="label" style="width:100px;">Session</label>
<select name="session-id" class="text-field">
<?php
foreach($all_session as $session)
{
	echo '<option value="'.$session->sessionID.'">'.$session->sessionName.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">Term</label>
<select name="term-id" class="text-field">
<option value="1">First Term</option>
<option value="2">Second Term</option>
<option value="3">Third Term</option>
</select>
<div class="btns" style="bottom:0px; left:-60px;">
<input type="submit" name="edit-result" value="Go" class="yes" />
<button class="no" onclick="endPopup('.popup3');">Cancel</button>
</div>
</form>
</div> <!-- end popup3 -->
<div class="popup popup4 round-all-10"> <!-- popup4 -->
<form action="<?php echo current_url(); ?>" method="post" style="margin-top:10px; margin-left:20px;">
<label class="label" style="width:100px;">Promote to:</label>
<select name="class-id" class="text-field">
<?php
foreach($classes as $class)
{
	echo '<option value="'.$class->classID.'">'.$class->className.'</option>';
}
?>
</select>
<div class="btns" style="bottom:0px; left:-60px;">
<input type="submit" name="promote" value="Go" class="yes" />
<button class="no" onclick="endPopup('.popup4');">Cancel</button>
</div>
</form>
</div> <!-- end popup4 -->
<div class="popup popup5 round-all-10" style="margin-top:100px; width:auto;"><!-- popup5 -->
<?php
echo form_open_multipart();
$name = explode(' ', $student->studentName);
if(!@$name[2])
{
	$name[2] = '';
}
?>
<label class="label">Surname</label>
<input type="text" id="surname" name="surname" value="<?php echo $name[0]; ?>" class="text-field" style="width:250px;" />
<br />
<label class="label">First name</label>
<input type="text" id="firstname" name="firstname" value="<?php echo $name[1]; ?>" class="text-field" style="width:250px;" />
<br />
<label class="label">Middle name</label>
<input type="text" id="middlename" name="middlename" value="<?php echo $name[2]; ?>" class="text-field" style="width:250px;" />
<br />
<label class="label">Sex</label>
<select name="sex" class="text-field">
<option value="">--Sex--</option>
<option value="M">Male</option>
<option value="F">Female</option>
</select>
<br />
<label class="label">Class</label>
<select name="class-id" class="text-field">
<option value="">--Class--</option>
<?php 
foreach($classes as $class)
{
	echo '<option value="'.$class->classID.'">'.$class->className.'</option>';
}
?>
</select>
<br />
<label class="label textarea-label">Student's Address</label>
<textarea name="address" class="text-field addr-textarea"><?php echo $student->address; ?></textarea>
<br />
<label class="label" style="margin-right:10px;">&nbsp;</label>
<input type="submit" name="update-student" value="Update Student" class="button" /> 
</form>
<button class="no" onclick="endPopup('.popup5');">Cancel</button>

</div><!-- end popup5 -->
<div id="header">
<h1>Your School Name</h1>
</div>
<div id="container" class="clearfix">
<h2 class="welcome">Welcome to School Manager</h2>
<div id="main-panel">
<div id="main" class="clearfix">
<div class="title-block"><h3><?php echo $student->studentName; ?></h3></div>
<?php
if($this->session->userdata('err_msg') == TRUE)
{ 
	echo '<div class="error-msg2">'.$this->session->userdata('err_msg').'</div>';
	$this->session->unset_userdata('err_msg');
}
if($this->session->userdata('suc_msg') == TRUE)
{ 
	echo '<div class="suc-msg">'.$this->session->userdata('suc_msg').'</div>';
	$this->session->unset_userdata('suc_msg');
}
?>
<div id="a" class="float-left clearfix">
<img src="<?php echo base_url($student->passport); ?>" width="99%" height="99%" class="box-shadow" />
</div>
<div id="b" class="float-left clearfix">
<ul class="click-button">
<li><a href="#" onClick="startPopup('.popup1');">Delete Student</a></li>
<li><a href="#" onClick="startPopup('.popup2');">Print Student's Result</a></li>
<li><a href="#" onClick="startPopup('.popup3');">Edit Student's Result</a></li>
<li><a href="#" onClick="startPopup('.popup4');">Promote Student</a></li>
<li><a href="#" onClick="startPopup('.popup5');">Edit <?php echo $student->studentName; ?></a></li>
</ul>
</div>
<div id="c" class="float-left clearfix">
<ul id="box-prop-labels">
<li>Name</li>
<li>Sex</li>
<li>Date of Birth</li>
<li>Age</li>
<li>Class</li>
<li>Home Address</li>
</ul>
</div>
<div id="d" class="float-left clearfix">
<ul id="box-val-labels">
<?php
$d = explode('-', $student->dob);
echo '<li>'.$student->studentName.'</li>
<li>'.$student->sex.'</li>
<li>'.$student->dob.'</li>
<li>'.$this->func->get_age($d[0],$d[1],$d[2]).'</li>
<li>'.$student->className.'</li>
<li>'.$student->address.'</li>';
?>
</ul>
</div>
</div>
</div>
<div id="navigation" class="clearfix">
<h2 class="staff-dashboard">Admin Dashboard</h2>
<ul>
<li><a href="<?php echo base_url('new-session'); ?>">Create New Session</a></li>
<li><a href="<?php echo base_url('add-class'); ?>" class="active">Add Classes</a></li>
<li><a href="<?php echo base_url('add-student'); ?>">Add Students</a></li>
<li><a href="<?php echo base_url('add-subject'); ?>">Add Subjects</a></li>
<li><a href="<?php echo base_url('update-first-test'); ?>">Update First Test</a></li>
<li><a href="<?php echo base_url('update-second-test'); ?>">Update Second Test</a></li>
<li><a href="<?php echo base_url('update-third-test'); ?>">Update Third Test</a></li>
<li><a href="<?php echo base_url('update-exam'); ?>">Update Exam</a></li>
<li><a href="<?php echo base_url('print-result'); ?>">Print Result</a></li>
</ul>
</div>
</div>
</body>
</html>