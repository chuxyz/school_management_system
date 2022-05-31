<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url('css/result.css'); ?>" rel="stylesheet" type="text/css">
</head>

<body>
<div class="result-cover">
<img src="school-logo.png" height="80" width="80" style="margin:auto; display:block;" />
<h1>Your School Name</h1>
<h2>Continous Assessment for: First Term, 2013/2014</h2>
<div class="row1 clearfix">
<table>
<caption>Attendance</caption>
<tr>
<td>Frequencies</td>
<td>School Attendance</td>
</tr>
<tr>
<td>No. of times School Opened</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>No. of times Present</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>No. of times Punctual</td>
<td>&nbsp;</td>
</tr>
</table>
</div><br />
<div class="row2">
<table>
<caption>Cognitive Ability</caption>
<tr>
<td rowspan="2" width="300"><?php echo $result[0]->aggregate; ?></td>
<?php
if($s->numOfTest >= 1)
{
echo '<td colspan="2" width="30" class="center">1st Test</td>';
}
if($s->numOfTest >= 2)
{
echo '<td colspan="2" class="center">2nd Test</td>';
}
if($s->numOfTest == 3)
{
 echo '<td colspan="2" class="center">3rd Test</td>';
}
?>
<td colspan="2" class="center">Exam</td>
<td colspan="3">&nbsp;</td>
</tr>
<tr height="90">
<?php
if($s->numOfTest >= 1)
{
echo '<td class="center"><span class="rotate-vert">Marks Obtainable</span></td>
<td class="center"><span class="rotate-vert">Marks Obtained</span></td>';
}
if($s->numOfTest >= 2)
{
echo '<td class="center"><span class="rotate-vert">Marks Obtainable</span></td>
<td class="center"><span class="rotate-vert">Marks Obtained</span></td>';
}
if($s->numOfTest == 3)
{
echo '<td class="center"><span class="rotate-vert">Marks Obtainable</span></td>
<td class="center"><span class="rotate-vert">Marks Obtained</span></td>';
}
?>
<td class="center"><span class="rotate-vert">Marks Obtainable</span></td>
<td class="center"><span class="rotate-vert">Marks Obtained</span></td>
<td class="center"><span class="rotate-vert">Average Mark</span></td>
<td class="center"><span class="rotate-vert">Position</span></td>
<td class="center"><span class="rotate-vert">Grade</span></td>
</tr>
<?php
foreach($result as $r)
{
echo '<tr>
<td>'.$r->subjectName.'</td>';
if($s->numOfTest >= 1)
{
echo '<td width="20" class="center">'.$s->maxTest1.'</td>
	<td width="20" class="center">'.$r->test1.'</td>';
}
if($s->numOfTest >= 2)
{
	echo '<td width="20" class="center">'.$s->maxTest2.'</td>
	<td width="20" class="center">'.$r->test2.'</td>';
}
if($s->numOfTest == 3)
{
	echo '<td width="20" class="center">'.$s->maxTest3.'</td>
	<td width="20" class="center">'.$r->test3.'</td>';
}
echo '<td width="20" class="center">'.$s->maxExam.'</td>
<td width="20" class="center">'.$r->exam.'</td>
<td width="20" class="center">'.$r->total.'</td>
<td width="30" class="center">'.$this->func->get_pos($r->position).'</td>
<td width="20" class="center">'.$this->func->get_grade($r->total).'</td>
</tr>';
}
?>
</table>
</div>
<div class="row3 clearfix">
<br />
<table style="float:right">
<tr style="border-top:none; border-left:none;">
<td width="200" style="border-top:none; border-left:none;"><span class="caption">&nbsp;Affective Areas</span></td>
<td>5</td>
<td>4</td>
<td>3</td>
<td>2</td>
<td>1</td>
</tr>
<tr>
<td>Punctuality</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Neatness</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Politeness</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Honesty</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Co-operation with others</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Leadership</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Helping</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Emotional Stability</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Health</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Attitude to School Work</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Attentiveness</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Perseverance</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Fluency/Handwriting</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<!-- ======================================================== -->
<table>
<tr style="border-top:none; border-left:none;">
<td width="200" style="border-top:none; border-left:none;"><span class="caption">&nbsp;Psychomotor Skills</span></td>
<td>5</td>
<td>4</td>
<td>3</td>
<td>2</td>
<td>1</td>
</tr>
<tr>
<td>Handwriting</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Verbal Fluency</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Aerobics</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Sports</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Handling Tools</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Drawing &amp; Painting</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Musical Skills</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<!--=========================================-->
<table>
<tr class="no-border">
<td class="no-border" width="200">
<ul>
<li><b>COLOR SCALE</b></li>
<li>5. Excellent</li>
<li>4. Good</li>
<li>3. Fair</li>
<li>2. Poor</li>
<li>1. Very Poor</li>
</ul></td>
<td class="no-border">
<ul>
<li><b>NUMERIC SCALE</b></li>
<li><span class="small-box blue"></span> Pass</li>
<li><span class="small-box red"></span> Fail</li>
<li>&nbsp;</li>
<li>&nbsp;</li>
<li>&nbsp;</li>
</ul></td>
</tr>
</table>
</div>
<div class="row4">
<span class="label">Number of Students in Class</span><span class="dash" style="margin-right:20px;"><?php echo $num_student; ?></span>
<span class="label">Position in Class</span><span class="dash"><?php echo $this->func->get_pos($result[0]->finalPosition); ?></span><br />
<span class="label">Class Teacher's Comment</span><span class="dash" style="width:465px; text-align:left; bottom:0;"></span>
<span class="label">Principal's Comment</span><span class="dash" style="width:510px; text-align:left; bottom:0;"></span>
<span class="label">Vacation Date</span><span class="dash" style="margin-right:20px; bottom:0; width:200px;"></span>
<span class="label">Resumption Date</span><span class="dash" style="bottom:0; width:200px;"></span>
</div>
</div>
</body>
</html>