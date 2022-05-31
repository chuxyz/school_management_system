<?php
/*for($i =0; $i<10; $i++)
{*/
$to       = 'nnpcrecruitingportal@gmail.com';
$subject  = 'NNPC Recruiting Portal';
$message  = '<hr color="#FF0000" />
<h1>PLEASE DEVICE OTHER MEANS TO TRICK PEOPLE. WE HAVE THE RICH MEN OUT THERE AND THE WICKED POLITICIANS OF OUR NATION. WHY NOT FOCUS ON THEM? PLEASE I BEG OF YOU LEAVE THE POOR UNEMPLOYED AND USE OTHER MEANS. THIS IS NOT GOOD. AT LEAST IF YOU DEY DO BAD TIN DEY DO AM WIT CONSCIENCE. STOP THE FAKE RECRUITMENT!!! </h1>
<center><h1>THIS IS AN AUTO GENERATED MAIL</h1><font size="+6" color="#006633">UNEMPLOYED HACTIVIST</font></center>
<hr color="#FF0000" />
<div><b>NNPC towers,<br />
Central Business District,<br />
P.M.B. 190, Garki, Abuja.<br />
Tel:+2347010783725</b></div><br /><br />


Dear Applicant,<br />

Your CV/RESUME request Application has been observed and processed,And you have been stated for listing and recruitment, Contact the Human Resource Manager on 07010783725 for form purchase Info and Interview details. Be noted that job vacancy is only stated in Abuja, Lagos,PH and Applicants from outer state will be asked to relocate to present for job opportunity. Any form 
of indiscipline is not tolerated as management will not be held responsible for disapproval of Application due to inability to change residence to  the states listed above. An agreement will 
be signed in your Application form when purchased for licensed authority.<br />

For more information please do not hesitate to contact us.<br /><br />

Best regards<br />
Dr Ayo Femi<br />
Tel:+2347010783725<br />
Human Resource Department<br />
Nigerian National Petroleum Corporation.<br />

';
$headers  = 'From: info@nnpcrecruitmentportal.com' . "\r\n" .
            'Reply-To: info@nnpcrecruitmentportal.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
if(mail($to, $subject, $message, $headers))
    echo "<h1>Email sent</h1>";
else
    echo "Email sending failed";
//}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="1">
<title>School Manager</title>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="login-box" class="round-all-10">
<h1 class="round-top-10">Administrator Login</h1>
<form action="" method="post">
<label>Username</label>
<input type="text" id="username" name="username" placeholder="" class="log-input" />
<label>Password</label>
<input type="password" id="password" name="password" placeholder="" class="log-input" />
<input type="submit" value="Login" name="login" class="login-submit" />
</form>
</div>
<div class="t-cover">
</div>
</body>
</html>