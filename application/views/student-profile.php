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
<div id="transparent-cover" class="fixed"></div>
<div class="popup comment-fill round-all-10 fixed">
<img src="<?php echo base_url('images/gen/close.gif'); ?>" style="float:right; cursor:pointer;" title="close" onClick="endPopup('.comment-fill');" />
<form action="<?php echo current_url(); ?>" method="post" id="comment-form">
<input type="hidden" name="seed-id" value="" class="seed-value" />
<label class="label" style="display:block; width:300px; text-align:left;">Class Teacher's Comment</label>
<textarea name="staff-comment" class="text-field" style="resize:none; width:280px; height:50px;"></textarea><br />
<label class="label" style="width:180px;">Number of times Present</label>
<input type="text" name="times-present" size="1" maxlength="3" class="text-field" id="times-present" />
<input type="submit" name="stfcomment" value="Go!" class="button" />
</form>
</div>
<div class="popup psyco-fill round-all-10">
<img src="<?php echo base_url('images/gen/close.gif'); ?>" style="float:right; cursor:pointer;" title="close" onClick="endPopup('.psyco-fill');" />
<form action="<?php echo current_url(); ?>" method="post" id="psyco-form">
<input type="hidden" name="seed-id" value="" class="seed-value" />
<table>
<tr style="border-top:none; border-left:none;">
<td width="200" style="border-top:none; border-left:none;"><span class="caption"><font color="#339966">PYSCOMOTOR</font></span></td>
<td width="15">5</td>
<td width="15">4</td>
<td width="15">3</td>
<td width="15">2</td>
<td width="15">1</td>
</tr>
<tr>
<td>Punctuality</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[punctuality]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[punctuality]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[punctuality]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[punctuality]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[punctuality]" /></td>
</tr>
<tr>
<td>Neatness</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[neatness]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[neatness]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[neatness]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[neatness]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[neatness]" /></td>
</tr>
<tr>
<td>Politeness</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[politeness]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[politeness]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[politeness]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[politeness]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[politeness]" /></td>
</tr>
<tr>
<td>Honesty</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[honesty]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[honesty]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[honesty]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[honesty]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[honesty]" /></td>
</tr>
<tr>
<td>Co-operation with others</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[cooperation]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[cooperation]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[cooperation]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[cooperation]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[cooperation]" /></td>
</tr>
<tr>
<td>Leadership</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[leadership]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[leadership]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[leadership]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[leadership]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[leadership]" /></td>
</tr>
<tr>
<td>Helping</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[helping]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[helping]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[helping]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[helping]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[helping]" /></td>
</tr>
<tr>
<td>Emotional Stability</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[emotional]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[emotional]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[emotional]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[emotional]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[emotional]" /></td>
</tr>
<tr>
<td>Health</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[health]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[health]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[health]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[health]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[health]" /></td>
</tr>
<tr>
<td>Attitude to School Work</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[schwork]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[schwork]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[schwork]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[schwork]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[schwork]" /></td>
</tr>
<tr>
<td>Attentiveness</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[attentiveness]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[attentiveness]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[attentiveness]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[attentiveness]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[attentiveness]" /></td>
</tr>
<tr>
<td>Perseverance</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[persevere]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[persevere]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[persevere]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[persevere]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[persevere]" /></td>
</tr>
<tr>
<td>Fluency/Handwriting</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[fluency]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[fluency]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[fluency]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[fluency]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[fluency]" /></td>
</tr>
<!--===================================-->
<tr>
<td>Handwriting</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[handwriting]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[handwriting]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[handwriting]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[handwriting]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[handwriting]" /></td>
</tr>
<tr>
<td>Verbal Fluency</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[vfluency]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[vfluency]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[vfluency]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[vfluency]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[vfluency]" /></td>
</tr>
<tr>
<td>Aerobics</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[aerobics]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[aerobics]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[aerobics]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[aerobics]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[aerobics]" /></td>
</tr>
<tr>
<td>Sports</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[sports]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[sports]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[sports]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[sports]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[sports]" /></td>
</tr>
<tr>
<td>Handling Tools</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[handtool]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[handtool]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[handtool]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[handtool]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[handtool]" /></td>
</tr>
<tr>
<td>Drawing &amp; Painting</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[drawing]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[drawing]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[drawing]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[drawing]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[drawing]" /></td>
</tr>
<tr>
<td>Musical Skills</td>
<td><input type="radio" class="psyco-radio" value="5" name="p[musical]" /></td>
<td><input type="radio" class="psyco-radio" value="4" name="p[musical]" /></td>
<td><input type="radio" class="psyco-radio" value="3" name="p[musical]" /></td>
<td><input type="radio" class="psyco-radio" value="2" name="p[musical]" /></td>
<td><input type="radio" class="psyco-radio" value="1" name="p[musical]" /></td>
</tr>
</table>
<label class="label" style="width:350px;">&nbsp;</label>
<input type="submit" name="psychomotor" value="Update Psycomotor" class="button" />
</form>
</div>
<div id="header">
<h1>Your School Name</h1>
</div>
<div id="container" class="clearfix">
<h2 class="welcome">Welcome to School Manager</h2>
<div id="main-panel">
<div id="main">
<div class="title-block"><h3>Student List</h3></div>
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
<div class="ajax-form-div">
<form action="<?php echo current_url(); ?>" method="post">
<label class="label">Class</label>
<select name="class-id" class="text-field" id="ajax-class-id">
<option value="0">--Class--</option>
<?php 
foreach($classes as $class)
{
	echo '<option value="'.$class->classID.'">'.$class->className.'</option>';
}
?>
</select>
<label class="label" style="width:auto; margin-left:20px;">Name</label>
<input type="text" name="student-name" class="text-field" id="student-name" />
<input type="submit" name="student-list" value="Go!" class="button" /> 
</form>
</div>

<table border="1" class="score-table" style="width:98%;">
<thead>
<tr>
<th width="30">S/N</th>
<th width="50">&nbsp;</th>
<th>Name</th>
<th>Class</th>
<th width="60">&nbsp;</th>
<th>&nbsp;</th>
<th width="60">&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<?php
//var_dump($students_by_class);
$sn = 1;
foreach($students as $student)
{
	if($this->action_model->check_psycho($student->studentID, $term, $session) <= 0)
	{
		$psycho_img = 'images/gen/cancel.png';
	}
	else
	{
		$psycho_img = 'images/gen/tick.png';
	}
	if($this->action_model->check_staffcomment($student->studentID, $term, $session) <= 0)
	{
		$comm_img = 'images/gen/cancel.png';
	}
	else
	{
		$comm_img = 'images/gen/tick.png';
	}
	$ft_val = @$this->action_model->get_assessment($student->studentID, $subject_id, $term_id, $session_id)->test1;
	echo '<tr class="click-tr" onDblclick="profile('.$student->studentID.')" title="Double-Click to View '.$student->studentName.'\'s Profile">
	<td><span>'.$sn.'</span></td>
	<td><img src="'.base_url($student->passport).'" width=50"" height="50" /></td>
	<td><span>'.$student->studentName.'</span></td>
	<td><span>'.$this->action_model->get_class_name($student->classID)->className.'</span></td>
	<td><button class="psyco-button button" onclick="psychoFill('.$student->studentID.');">Psycho</button></td>
	<td><img src="'.base_url($psycho_img).'" /></td>
	<td><button class="comment-button button" onclick="commentFill('.$student->studentID.');">Comment</button></td>
	<td><img src="'.base_url($comm_img).'" /></td>
	</tr>';
	$sn++;
}
?>
</table>
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