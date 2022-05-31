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
<div class="title-block"><h3>General Settings</h3></div>
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
<h2>Assessment Settings</h2>
<form action="<?php echo current_url(); ?>" method="post" style="width:auto;">
<label class="label">No. of Test per term</label>
<select name="no-of-test" class="text-field" id="no-of-test">
  <option value="">--No of Test -- </option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
</select><?php echo form_error('no-of-test', '<div class="error">', '</div>'); ?><br />
<label class="label">1st Test Max. Score</label>
<input type="text" id="max-score1" name="max-score1" class="text-field" />
<?php echo form_error('max-score1', '<div class="error">', '</div>'); ?><br />
<label class="label">2nd Test Max. Score</label>
<input type="text" id="max-score2" name="max-score2" class="text-field" />
<?php echo form_error('max-score2', '<div class="error">', '</div>'); ?><br />
<label class="label">3rd Test Max. Score</label>
<input type="text" id="max-score3" name="max-score3" class="text-field" />
<?php echo form_error('max-score3', '<div class="error">', '</div>'); ?><br />
<label class="label">Exam Max. Score</label>
<input type="text" id="max-score-ex" name="max-score-ex" class="text-field" />
<?php echo form_error('max-score-ex', '<div class="error">', '</div>'); ?><br />
<label class="label">&nbsp;</label>
<input type="submit" name="update-settings" value="Update Settings" class="button" />
</form>
</div>

<div class="panel clearfix" style="width:300px;">
<h2>Set Active Session &amp; Term</h2>
<ul>
<li><span>Current Session</span> <b><?php echo $current_session->sessionName; ?></b></li>
<li><span>Current Term</span> <b><?php echo $current_term->termName; ?></b></li>
</ul>
<form action="<?php echo current_url(); ?>" method="post">
<label class="label" style="width:80px;">Session</label>
<select name="session-id" class="text-field">
<option value="">-- Session --</option>
<?php
foreach($all_session as $session)
{
echo '<option value="'.$session->sessionID.'">'.$session->sessionName.'</option>';
}
?>
</select><br />
<label class="label" style="width:80px;">Term</label>
<select name="term-id" class="text-field">
<option value="">-- Term --</option>
<?php
foreach($all_term as $term)
{
echo '<option value="'.$term->termID.'">'.$term->termName.'</option>';
}
?>
</select>
<br />
<label class="label" style="width:80px;">&nbsp;</label>
<input type="submit" name="set-active" value="Update" class="button" />
</form>
</div>

<div class="panel clearfix" style="width:480px;">
<h2>Set Vacation &amp; Resumption Date</h2>
<form action="<?php echo current_url(); ?>" method="post">
<label class="label" style="width:250px;">Number of time school opened</label>
<input type="text" name="times-open" value="<?php echo @$vrdate->timesOpen; ?>" class="text-field" style="width:35px; font-weight:bold;" />
<?php echo form_error('times-open', '<div class="error">', '</div>'); ?><br />
<label class="label" style="width:150px;">This Term's Vacation Date</label>
<input type="text" name="v-date" value="<?php echo @$vrdate->thisVacation; ?>" maxlength="10" class="text-field" style="font-weight:bold;" /><span class="eg">&nbsp;DD-MM-YYYY</span>
<?php echo form_error('v-date', '<div class="error">', '</div>'); ?><br />
<label class="label" style="width:150px;">Next Term's Resumption Date</label>
<input type="text" name="r-date" value="<?php echo @$vrdate->nextResumption; ?>" maxlength="10" class="text-field" style="font-weight:bold;" /><span class="eg">&nbsp;DD-MM-YYYY</span>
<?php echo form_error('r-date', '<div class="error">', '</div>'); ?><br />
<label class="label" style="width:145px;">&nbsp;</label>
<input type="submit" name="set-vrdate" value="Update" class="button" />
</form>
</div>

<div class="panel clearfix">
<h2>Principal's Comments on Average Score</h2>
<form action="<?php echo current_url(); ?>" method="post" style="width:auto;">
<label class="label label2">0 - 9</label>
<textarea name="comment[]"><?php echo $palcomment->comment1 ?></textarea>
<label class="label label2">10 - 19</label>
<textarea name="comment[]"><?php echo $palcomment->comment2 ?></textarea>
<label class="label label2">20 - 29</label>
<textarea name="comment[]"><?php echo $palcomment->comment3 ?></textarea>
<label class="label label2">30 - 39</label>
<textarea name="comment[]"><?php echo $palcomment->comment4 ?></textarea>
<label class="label label2">40 - 49</label>
<textarea name="comment[]"><?php echo $palcomment->comment5 ?></textarea>
<label class="label label2">50 - 59</label>
<textarea name="comment[]"><?php echo $palcomment->comment6 ?></textarea>
<label class="label label2">60 - 69</label>
<textarea name="comment[]"><?php echo $palcomment->comment7 ?></textarea>
<label class="label label2">70 - 79</label>
<textarea name="comment[]"><?php echo $palcomment->comment8 ?></textarea>
<label class="label label2">80 - 89</label>
<textarea name="comment[]"><?php echo $palcomment->comment9 ?></textarea>
<label class="label label2">90 - 100</label>
<textarea name="comment[]"><?php echo $palcomment->comment10 ?></textarea>
<label class="label label2">&nbsp;</label>
<input type="submit" name="update-comments" value="Update Comments" class="button" />
</form>
</div>
</div>
</div>
</div>
</body>
</html>