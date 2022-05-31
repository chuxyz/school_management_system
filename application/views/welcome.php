<?php //echo shell_exec("C:/wkhtmltopdf/bin/wkhtmltopdf http://www/schman/result-preview");
//echo shell_exec("C:/wkhtmltopdf/bin/wkhtmltopdf http://www/schman/result-preview-all/3/2/1 C:/wamp/www/schman/test3.pdf");
 ?>
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
<div id="transparent-cover">
</div>
<div class="popup pr-popup round-all-10">
<img src="<?php echo base_url('images/gen/close.gif'); ?>" class="close-img" title="Close" onClick="endPopup('.pr-popup');" />
<br />
<form action="<?php echo current_url(); ?>" method="post">
<label class="label" style="width:100px;">Class</label>
<select name="class-id" class="text-field">
<?php 
foreach($classes as $class)
{
	echo '<option value="'.$class->classID.'">'.$class->className.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">Session</label>
<select name="session-id" class="text-field">
<?php 
foreach($session as $ses)
{
	echo '<option value="'.$ses->sessionID.'">'.$ses->sessionName.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">Term</label>
<select name="term-id" class="text-field">
<?php 
foreach($terms as $term)
{
	echo '<option value="'.$term->termID.'">'.$term->termName.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">&nbsp;</label>
<input type="submit" name="preview-result" value="Preview Result" class="button" />
</form>
</div>
<!--=================================================================-->
<div class="popup pdf-popup round-all-10">
<img src="<?php echo base_url('images/gen/close.gif'); ?>" class="close-img" title="Close" onClick="endPopup('.pdf-popup');" />
<br />
<form action="<?php echo current_url(); ?>" method="post">
<label class="label" style="width:100px;">Class</label>
<select name="class-id" class="text-field">
<?php 
foreach($classes as $class)
{
	echo '<option value="'.$class->classID.'">'.$class->className.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">Session</label>
<select name="session-id" class="text-field">
<?php 
foreach($session as $ses)
{
	echo '<option value="'.$ses->sessionID.'">'.$ses->sessionName.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">Term</label>
<select name="term-id" class="text-field">
<?php 
foreach($terms as $term)
{
	echo '<option value="'.$term->termID.'">'.$term->termName.'</option>';
}
?>
</select><br />
<label class="label" style="width:100px;">&nbsp;</label>
<input type="submit" name="generate-pdf" value="Generate PDF" class="button" />
</form>
</div>
<?php
if($this->session->userdata('msg') == TRUE)
{ 
	echo '<div class="restriction">'.$this->session->userdata('msg').'</div>';
	$this->session->unset_userdata('msg');
}
?>
<div id="header">
<a href="<?php echo base_url(); ?>">
<h1>
<img src="<?php echo base_url($this->logo_url); ?>" height="80" width="100" />
<?php echo $this->sch_name; ?>
</h1>
</a>
</div>
<div id="container">
<h2 class="welcome">Welcome to School Manager
<span style="float:right; font-size:16px; line-height:40px;"><?php echo $this->session->userdata('username'); ?>
&nbsp;(<a href="<?php echo base_url('logout'); ?>" style="color:#FFF;">Logout</a>)
</span></h2>

<div id="dashboard" class="clearfix round-all-10">
<?php
if($this->func->is_admin($this->session->userdata('username')))
{
?>
<a href="<?php echo base_url('settings'); ?>"><div class="dash"><img src="<?php echo base_url('images/large/grey/Tools.png'); ?>" /><span>General Settings</span></div></a>
<a href="<?php echo base_url('new-session'); ?>"><div class="dash"><span>Create New Session</span></div></a>
<a href="<?php echo base_url('staff-settings'); ?>"><div class="dash"><span>Staff Settings</span></div></a>
<?php
}
?>
<a href="<?php echo base_url('add-class'); ?>"><div class="dash"><span>Add Classes</span></div></a>
<a href="<?php echo base_url('add-student'); ?>"><div class="dash"><span>Add Students</span></div></a>
<a href="<?php echo base_url('student-profile'); ?>"><div class="dash"><span>Students' Profile</span></div></a>
<a href="<?php echo base_url('promote-student'); ?>"><div class="dash"><span>Promote Students</span></div></a>
<a href="<?php echo base_url('add-subject'); ?>"><div class="dash"><span>Add Subjects</span></div></a>
<a href="<?php echo base_url('assign-subject'); ?>"><div class="dash"><span>Assign Subjects</span></div></a>
<a href="<?php echo base_url('update-first-test'); ?>"><div class="dash"><span>Update First Test</span></div></a>
<a href="<?php echo base_url('update-second-test'); ?>"><div class="dash"><span>Update Second Test</span></div></a>
<a href="<?php echo base_url('update-third-test'); ?>"><div class="dash"><span>Update Third Test</span></div></a>
<a href="<?php echo base_url('update-exam'); ?>"><div class="dash"><span>Update Exam Scores</span></div></a>
<a href="<?php echo base_url('position-students'); ?>"><div class="dash"><span>Position Students</span></div></a>
<?php
if($this->func->is_admin($this->session->userdata('username')))
{
?>
<a href="#" onclick="startPopup('.pr-popup');"><div class="dash"><span>Preview Result</span></div></a>
<a href="#" onclick="startPopup('.pdf-popup');"><div class="dash"><span>Convert Result to PDF</span></div></a>
<?php
}
?>
</div>
</div>
</body>
</html>