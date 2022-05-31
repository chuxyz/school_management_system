<?php $dir = dirname(dirname($_SERVER['DOCUMENT_ROOT'])); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url('css/result.css'); ?>" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#FFFFFF !important;">
<?php
	$result = $this->action_model->get_result($class_id, $student_id, $term_id, $session_id);
	$err = 0;
	if(count($result) > 0) // Record Found
	{
	$avg = $this->func->get_average($result[0]->aggregate, count($result));
?>
<div class="result-cover">
<img src="<?php echo base_url($this->logo_url); ?>" height="80" width="80" style="margin:auto; float:left; display:inline-block;" />
<h1><?php echo $this->sch_name; ?></h1><br />
<h2>Continous Assessment for: 
<?php echo $this->action_model->get_term_name($term_id)->termName.', '.$this->action_model->get_session_name($session_id)->sessionName; ?> Session</h2>
<div class="student-info">
<img src="<?php echo base_url($result[0]->passport); ?>" alt="Pasport Photograph" />
<span><?php echo $result[0]->studentName; ?></span>
<span style="font-weight:normal;"><?php echo $result[0]->className; ?></span>
</div>
<div class="row1 clearfix">
<table>
<caption>Attendance</caption>
<tr>
<td>Frequencies</td>
<td>School Attendance</td>
</tr>
<tr>
<td>No. of times School Opened</td>
<td><?php echo @$this->action_model->get_vrdate($term_id, $session_id)->timesOpen; ?></td>
</tr>
<tr>
<td>No. of times Present</td>
<td>
<?php
$staffcomment = @$this->action_model->get_staffcomment($student_id, $term_id, $session_id);
echo @$staffcomment->timesPresent;
?>
</td>
</tr>
<tr>
<td>No. of times Punctual</td>
<td>&nbsp;</td>
</tr>
</table>
</div><br />
<div class="row2">
<div class="float-l clearfix" style="width:65%;">
<table>
<caption>Cognitive Ability</caption>
<tr>
<td rowspan="2" width="300"><div class="avg"><?php echo $avg; ?></div></td>
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
	<td width="20" class="center">'.$this->func->color_mark($s->maxTest1, $r->test1).'</td>';
}
if($s->numOfTest >= 2)
{
	echo '<td width="20" class="center">'.$s->maxTest2.'</td>
	<td width="20" class="center">'.$this->func->color_mark($s->maxTest2, $r->test2).'</td>';
}
if($s->numOfTest == 3)
{
	echo '<td width="20" class="center">'.$s->maxTest3.'</td>
	<td width="20" class="center">'.$this->func->color_mark($s->maxTest3, $r->test3).'</td>';
}
echo '<td width="20" class="center">'.$s->maxExam.'</td>
<td width="20" class="center">'.$this->func->color_mark($s->maxExam, $r->exam).'</td>
<td width="20" class="center">'.$this->func->color_mark(100, $r->total).'</td>
<td width="30" class="center">'.$this->func->get_pos($r->position).'</td>
<td width="20" class="center">'.$this->func->get_grade($r->total).'</td>
</tr>';
}
?>
</table>
<br />
<!--=======================================-->
<div class="row3 clearfix">
<table>
<tr class="no-border">
<td class="no-border" width="150">
<ul>
<li><b>NUMERIC SCALE</b></li>
<li>5. Excellent</li>
<li>4. Good</li>
<li>3. Fair</li>
<li>2. Poor</li>
<li>1. Very Poor</li>
<li>&nbsp;</li>
</ul></td>
<td class="no-border" width="150">
<ul>
<li><b>ALPHA SCALE</b></li>
<li>A. Alpha</li>
<li>B. Alpha</li>
<li>C. Credit</li>
<li>D. Pass</li>
<li>E. Pass</li>
<li>F. Fail</li>
</ul></td>
<td class="no-border">
<ul>
<li><b>COLOR SCALE</b></li>
<li><span class="small-box blue"></span> Pass</li>
<li><span class="small-box red"></span> Fail</li>
<li>&nbsp;</li>
<li>&nbsp;</li>
<li>&nbsp;</li>
<li>&nbsp;</li>
</ul></td>
</tr>
</table>
</div>
</div>
<!--============================================================-->
<div class="psycho float-l clearfix">
<?php
$psy = @$this->action_model->get_psycho($student_id, $term_id, $session_id)->psyValues;
$psyV = @explode('-',$psy);
?>
<table>
<tr style="border-top:none; border-left:none;">
<td width="300" style="border-top:none; border-left:none;"><span class="caption">&nbsp;Affective Areas</span></td>
<td>5</td>
<td>4</td>
<td>3</td>
<td>2</td>
<td>1</td>
</tr>
<tr>
<td>Punctuality</td>
<td><?php echo @$this->func->tick(5,$psyV[0]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[0]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[0]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[0]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[0]); ?></td>
</tr>
<tr>
<td>Neatness</td>
<td><?php echo @$this->func->tick(5,$psyV[1]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[1]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[1]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[1]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[1]); ?></td>
</tr>
<tr>
<td>Politeness</td>
<td><?php echo @$this->func->tick(5,$psyV[2]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[2]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[2]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[2]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[2]); ?></td>
</tr>
<tr>
<td>Honesty</td>
<td><?php echo @$this->func->tick(5,$psyV[3]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[3]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[3]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[3]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[3]); ?></td>
</tr>
<tr>
<td>Co-operation with others</td>
<td><?php echo @$this->func->tick(5,$psyV[4]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[4]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[4]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[4]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[4]); ?></td>
</tr>
<tr>
<td>Leadership</td>
<td><?php echo @$this->func->tick(5,$psyV[5]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[5]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[5]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[5]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[5]); ?></td>
</tr>
<tr>
<td>Helping</td>
<td><?php echo @$this->func->tick(5,$psyV[6]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[6]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[6]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[6]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[6]); ?></td>
</tr>
<tr>
<td>Emotional Stability</td>
<td><?php echo @$this->func->tick(5,$psyV[7]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[7]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[7]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[7]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[7]); ?></td>
</tr>
<tr>
<td>Health</td>
<td><?php echo @$this->func->tick(5,$psyV[8]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[8]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[8]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[8]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[8]); ?></td>
</tr>
<tr>
<td>Attitude to School Work</td>
<td><?php echo @$this->func->tick(5,$psyV[9]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[9]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[9]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[9]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[9]); ?></td>
</tr>
<tr>
<td>Attentiveness</td>
<td><?php echo @$this->func->tick(5,$psyV[10]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[10]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[10]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[10]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[10]); ?></td>
</tr>
<tr>
<td>Perseverance</td>
<td><?php echo @$this->func->tick(5,$psyV[11]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[11]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[11]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[11]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[11]); ?></td>
</tr>
<tr>
<td>Fluency/Handwriting</td>
<td><?php echo @$this->func->tick(5,$psyV[12]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[12]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[12]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[12]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[12]); ?></td>
</tr>
</table>
<br />
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
<td><?php echo @$this->func->tick(5,$psyV[13]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[13]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[13]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[13]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[13]); ?></td>
</tr>
<tr>
<td>Verbal Fluency</td>
<td><?php echo @$this->func->tick(5,$psyV[14]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[14]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[14]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[14]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[14]); ?></td>
</tr>
<tr>
<td>Aerobics</td>
<td><?php echo @$this->func->tick(5,$psyV[15]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[15]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[15]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[15]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[15]); ?></td>
</tr>
<tr>
<td>Sports</td>
<td><?php echo @$this->func->tick(5,$psyV[16]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[16]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[16]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[16]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[16]); ?></td>
</tr>
<tr>
<td>Handling Tools</td>
<td><?php echo @$this->func->tick(5,$psyV[17]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[17]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[17]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[17]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[17]); ?></td>
</tr>
<tr>
<td>Drawing &amp; Painting</td>
<td><?php echo @$this->func->tick(5,$psyV[18]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[18]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[18]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[18]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[18]); ?></td>
</tr>
<tr>
<td>Musical Skills</td>
<td><?php echo @$this->func->tick(5,$psyV[19]); ?></td>
<td><?php echo @$this->func->tick(4,$psyV[19]); ?></td>
<td><?php echo @$this->func->tick(3,$psyV[19]); ?></td>
<td><?php echo @$this->func->tick(2,$psyV[19]); ?></td>
<td><?php echo @$this->func->tick(1,$psyV[19]); ?></td>
</tr>
</table>
<!--=========================================-->
</div>
</div>
<div class="row4">
<span class="label">Number of Students in Class</span><span class="dash" style="margin-right:20px;"><?php echo $num_student; ?></span>
<span class="label">Position in Class</span><span class="dash"><?php echo $this->func->get_pos($result[0]->finalPosition); ?></span><br />
<span class="label">Class Teacher's Comment</span><span class="dash" style="width:200mm; text-align:center; bottom:0;"><?php echo @$staffcomment->comment; ?></span>
<br />
<span class="label">Principal's Comment</span><span class="dash" style="width:250mm; text-align:center; bottom:0;"><?php echo $this->func->get_palcomment($avg); ?></span>
<br />
<span class="label">Vacation Date</span><span class="dash" style="margin-right:20px; bottom:5px; width:100mm;"><?php echo $this->func->format_date($vrdate->thisVacation); ?></span>
<span class="label">Resumption Date</span><span class="dash" style="bottom:5px; width:100mm;"><?php echo $this->func->format_date($vrdate->nextResumption); ?></span>
</div>
</div>
<br /><br />
<?php
	}
	else
	{
		$err++;
	}
if($err > 0)
{
	echo '<h1 style="color:#999; text-align:center;">No Result Found!<br /><a href="'.base_url().'">&laquo;Go Back</a></h1>';
}
?>
</body>
</html>