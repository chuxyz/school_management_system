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
<div id="header">
<h1>Your School Name</h1>
</div>
<div id="container" class="clearfix">
<h2 class="welcome">Welcome to School Manager</h2>
<div id="main-panel">
<div id="main">
<div class="title-block"><h3>Update Exam</h3></div>
<?php
if($this->session->userdata('error_msg') == TRUE)
{ 
	echo '<div class="error-msg2">'.$this->session->userdata('error_msg').'</div>';
	$this->session->unset_userdata('error_msg');
}
if($this->session->userdata('suc_msg') == TRUE)
{ 
	echo '<div class="suc-msg">'.$this->session->userdata('suc_msg').'</div>';
	$this->session->unset_userdata('suc_msg');
}
?>
<form action="<?php echo current_url(); ?>" method="post">
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
<?php echo form_error('class-id', '<div class="error">', '</div>'); ?><br />
<label class="label">Subject</label>
<select name="subject-id" class="text-field">
<option value="">--Subject--</option>
<?php
foreach($subjects as $subject)
{
	echo '<option value="'.$subject->subjectID.'">'.$subject->subjectName.'</option>';
}
?>
</select>
<?php echo form_error('subject-id', '<div class="error">', '</div>'); ?><br />
<label class="label" style="margin-right:15px;">&nbsp;</label><input type="submit" name="exam" value="Go!" class="button" /> 
</form>
</div>
</div>
<div id="navigation" class="clearfix">
<h2 class="staff-dashboard">Admin Dashboard</h2>
<ul>
<li><a href="<?php echo base_url('new-session'); ?>">Create New Session</a></li>
<li><a href="<?php echo base_url('add-class'); ?>">Add Classes</a></li>
<li><a href="<?php echo base_url('add-student'); ?>">Add Students</a></li>
<li><a href="<?php echo base_url('add-subject'); ?>">Add Subjects</a></li>
<li><a href="<?php echo base_url('assign-subject'); ?>">Assign Subjects</a></li>
<li><a href="<?php echo base_url('update-first-test'); ?>">Update First Test</a></li>
<li><a href="<?php echo base_url('update-second-test'); ?>">Update Second Test</a></li>
<li><a href="<?php echo base_url('update-third-test'); ?>">Update Third Test</a></li>
<li><a href="<?php echo base_url('update-exam'); ?>" class="active">Update Exam</a></li>
<li><a href="<?php echo base_url('print-result'); ?>">Print Result</a></li>
</ul>
</div>
</div>
</body>
</html>