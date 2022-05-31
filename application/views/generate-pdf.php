<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url('css/styles.css'); ?>" rel="stylesheet" type="text/css">
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
<div id="container" style="background:#FFF;">
<?php
		$i = 0;
		foreach($files as $file)
		{
			$i++;
			if($i < 3) continue;
			else
			{
			echo '<div style="border-bottom:1px solid #CCC; margin:10px;"><img src="'.base_url('images/gen/PDF.gif').'" />';
			echo '<span style="color:#666; position:relative; bottom:15px; font-size:18px;">'.$file.'<span/>&nbsp;<img src="'.base_url('images/gen/tick.png').'" /></div>';
			}
		}
?>
</div>
</body>
</html>