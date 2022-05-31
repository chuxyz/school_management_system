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
<div id="main" class="clearfix">
<div class="title-block"><h3>Update Third Test - <?php echo $subject_name; ?></h3></div>
<?php
echo form_error('score[]', '<div class="error-msg2">', '</div>');
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
<form action="<?php echo current_url(); ?>" method="post" style="width:auto;">
<table border="1" class="score-table">
<thead>
<th width="30">S/N</th>
<th>Name</th>
<th width="60">Class</th>
<th width="60">Score</th>
<th width="60">Didn't offer?</th>
</thead>
<?php
//var_dump($students_by_class);
$sn = 1;
foreach($students_by_class as $student)
{
	$ft_val = @$this->action_model->get_assessment($class_id, $student->studentID, $subject_id, $term_id, $session_id)->test3;
	echo '<tr>
	<td><span>'.$sn.'</span></td>
	<td><span>'.$student->studentName.'</span></td>
	<td><span>'.$this->action_model->get_class_name($student->classID)->className.'</span></td>
	<td><input type="text" maxlength="3" name="score['.$student->studentID.']" value="'.$ft_val.'" class="num-field text-field" /></td>
	<td><input type="checkbox" name="offer[]" value="'.$student->studentID.'"  '.set_checkbox('offer[]', $student->studentID).' /></td>
	</tr>';
	$sn++;
}
?>
</table>
<input type="submit" name="utt" value="Submit" class="button" style="float:right; margin-right:11%;" />
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
<li><a href="<?php echo base_url('update-third-test'); ?>"  class="active">Update Third Test</a></li>
<li><a href="<?php echo base_url('update-exam'); ?>">Update Exam</a></li>
<li><a href="<?php echo base_url('print-result'); ?>">Print Result</a></li>
</ul>
</div>
</div>
</body>
</html>