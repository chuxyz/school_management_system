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

<div id="login-box" class="round-all-10">
<h1 class="round-top-10">Administrator Login</h1>
<form action="<?php echo current_url(); ?>" method="post">
<label>Username</label>
<input type="text" id="username" name="username" placeholder="" class="log-input" />
<label>Password</label>
<input type="password" id="password" name="password" placeholder="" class="log-input" />
<input type="submit" value="Login" name="login" class="login-submit" />
</form>
</div>
<div class="t-cover">
</div>
<?php
if($this->session->userdata('msg') == TRUE)
{ 
	echo '<div class="error-msg round-all-10">'.$this->session->userdata('msg').'</div>';
	$this->session->unset_userdata('msg');
}
?>
</body>
</html>