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
<a href="<?php echo base_url(); ?>">
<h1>
<img src="<?php echo base_url($this->logo_url); ?>" height="80" width="100" />
<?php echo $this->sch_name; ?>
</h1>
</a>
</div>
<div id="container" class="clearfix">
<!--<h2 class="welcome">Welcome to School Manager</h2>-->
<div id="main-panel"  style="float:none;">
<div id="main">
<div class="title-block"><h3>Installation</h3></div>
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
<form action="<?php echo current_url(); ?>" method="post">
<label class="label">Class</label>
<input type="text" id="new-class" name="new-class" class="text-field" />
<input type="submit" name="create-class" value="Create Class" class="button" /> &nbsp;<span class="eg">e.g. SSS1A</span>
</form>
</div>
</div>
</div>
</body>
</html>