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
<div id="main-panel"  style="float:none;">
<div id="main" class="clearfix">
<div class="title-block"><h3>Staff Settings</h3></div>
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
<div class="panel clearfix">
<h2>Add Staff</h2>
<form action="<?php echo current_url(); ?>" method="post" style="width:auto;">
<label class="label">Login Name</label>
<input type="text" name="log-name" class="text-field" />
<?php echo form_error('log-name', '<div class="error">', '</div>'); ?><br />
<label class="label">Password</label>
<input type="password" id="password" name="password" class="text-field" />
<?php echo form_error('password', '<div class="error">', '</div>'); ?><br />
<label class="label">Confirm Password</label>
<input type="password" id="c-password" name="c-password" class="text-field" />
<?php echo form_error('c-password', '<div class="error">', '</div>'); ?><br />
<label class="label">Level</label>
<select name="level" class="text-field">
<option value="low-staff">Staff</option>
<option value="high-staff">Principal Staff</option>
<option value="admin">Admin</option>
</select>
<?php echo form_error('level', '<div class="error">', '</div>'); ?><br />
<label class="label">&nbsp;</label>
<input type="submit" name="add-staff" value="Add Admin" class="button" />
</form>
</div>
<!-----------------=====================================---------->
<div class="panel clearfix">
<h2>Update Staff</h2>
<form action="<?php echo current_url(); ?>" method="post" style="width:auto;">
<label class="label">Login Name</label>
<select name="log-name" class="text-field">
<option value="">-- Select --</option>
<?php
foreach($staffs as $staff)
{
	if($staff->level == 'admin') continue;
	else
echo '<option value="'.$staff->userID.'">'.$staff->username.'</option>';
}
?>
</select>
<?php echo form_error('log-name', '<div class="error">', '</div>'); ?><br /><br />
<span class="click-drop">Click to Assign Level</span>
<div class="slide"><label class="label">Level</label>
<select name="level" class="text-field">
<option value="low-staff">Staff</option>
<option value="high-staff">Principal Staff</option>
<option value="admin">Admin</option>
</select>
<?php echo form_error('level', '<div class="error">', '</div>'); ?><br />
<label class="label">&nbsp;</label>
<input type="submit" name="change-level" value="Change Level" class="button" /><br /><br /></div>
<span class="click-drop">Click to Assign Class</span>
<div class="slide"><label class="label">Class</label>
<select name="class-id" class="text-field">
<?php
foreach($classes as $class)
{
	echo '<option value="'.$class->classID.'">'.$class->className.'</option>';
}
?>
</select>
<label class="label">&nbsp;</label>
<input type="submit" name="assign-class" value="Assign Class" class="button" /><br /><br /></div>
<span class="click-drop">Click to Change Password</span>
<div class="slide"><label class="label">Password</label>
<input type="password" name="password" class="text-field" />
<?php echo form_error('password', '<div class="error">', '</div>'); ?><br />
<label class="label">&nbsp;</label>
<input type="submit" name="change-password" value="Change Password" class="button" /><br /><br /></div>
<span class="click-drop">Click to Update Signature</span>
<div class="slide"><label class="label">Signature</label>
<input type="file" name="signature" class="button" style="width:150px;" />
<label class="label">&nbsp;</label>
<input type="submit" name="update-signature" value="Update Signature" class="button" /><br /></div>
</form>
</div>

</div>
</div>
</div>
</body>
</html>