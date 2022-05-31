<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Func
{
	public $CI;
	public $staff;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		//$this->CI->load->model('gen_model');
		$this->CI->load->model('action_model');
		$this->staff = file_exists('C:/desktop.txt');
	}
	
	public function islogged()
	{
		//$CI =& get_instance();
		if($this->CI->session->userdata('validation') && $this->CI->session->userdata('username'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function check_login()
	{
		if(!$this->islogged()) //if not logged in or shell_exec is not going on
		{
			if(!$this->CI->input->get('v'))
			{
			$this->CI->session->set_userdata('msg', 'You are not logged in or your session has expired!');
			redirect();
			}
		}
	}
	public function check_admin($username)
	{
		if($this->islogged() && !$this->is_admin($username))
		{
			$this->CI->session->set_userdata('msg', 'You are restricted from accessing the page you tried to access!');
			redirect();
		}
	}
	public function is_session($val)
	{
		$val = trim($val);
		$years = explode('/', $val);
		$year1 = @(int) $years[0];
		$year2 = @(int) $years[1];
		$diff = $year2 - $year1;
		if($year1 > 2012 && $diff == 1 && strlen($val) == 9 && $this->CI->action_model->session_row_count($val) < 1)
		{
			return TRUE;
		}
		else return FALSE;
	}
	
	public function is_valid_form($val) //is_class
	{
		if(strlen($val) >= 4)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	public function form_exists($val) //class_exist
	{
		if($this->CI->action_model->class_row_count($val) >= 1 )
		{
			return TRUE;
		}
		return FALSE;
	}
	
	public function subject_exists($val)
	{
		if($this->CI->action_model->subject_row_count($val) >= 1 )
		{
			return TRUE;
		}
		return FALSE;
	}
	public function get_age($dob_day,$dob_month,$dob_year)
	{
		$year   = gmdate('Y');
		$month  = gmdate('m');
		$day    = gmdate('d');
		 //seconds in a day = 86400
		$days_in_between = (mktime(0,0,0,$month,$day,$year) - mktime(0,0,0,$dob_month,$dob_day,$dob_year))/86400;
		$age_float = $days_in_between / 365.242199; // Account for leap year
		$age = (int)($age_float); // Remove decimal places without rounding up once number is + .5
		return $age;
	}
	public function class_offers_subject($class_id, $subject_id)
	{
		$subject_list = $this->CI->action_model->get_subject_list($class_id)->subjectList; //get subjectList from db
		$subject_array = explode('-', $subject_list); // form array from the list
		if(in_array($subject_id, $subject_array)) //if subject_id selected is not in the db subject list array
		{
			return TRUE;
		}
		return FALSE;
	}
	public function get_grade($score)
	{
		if($score >= 70 && $score <= 100)
		return '<span class="pass">A</span>';
		elseif($score < 70 && $score >= 60)
		return '<span class="pass">B</span>';
		elseif($score < 60 && $score >= 50)
		return '<span class="pass">C</span>';
		elseif($score < 50 && $score >= 45)
		return '<span class="pass">D</span>';
		elseif($score < 45 && $score >= 40)
		return '<span class="pass">E</span>';
		else return '<span class="fail">F</span>';
	}
	public function get_pos($pos)
	{
		$unit = $pos % 10;
		if($unit == 1 && $pos != 11)
		return $pos.'st';
		elseif($unit == 2 && $pos != 12)
		return $pos.'nd';
		elseif($unit == 3 && $pos != 13)
		return $pos.'rd';
		else return $pos.'th';
	}
	public function update_test_total($class_id, $student_id, $subject_id, $current_term_id, $current_session_id)
	{
		$numOfTest = $this->CI->action_model->get_settings()->numOfTest;
		$a = $this->CI->action_model->get_assessment($class_id, $student_id, $subject_id, $current_term_id, $current_session_id);
		if($numOfTest == 1)
		{
			$test = $a->test1;
		}
		elseif($numOfTest == 2)
		{
			$test = $a->test1 + $a->test2;
		}
		else
		{
			$test = $a->test1 + $a->test2 + $a->test3;
		}
		$total = $test + $a->exam;
		$where = array(
					'classID' => $class_id,
					'studentID' => $student_id,
					'subjectID' => $subject_id,
					'termID' => $current_term_id,
					'sessionID' => $current_session_id	
			);
		$this->CI->gen_model->update('assessment', array('test'=>$test, 'total'=>$total), $where);
	}
	public function get_palcomment($avg)
	{
		$com = $this->CI->action_model->get_palcomment();
		if($avg >= 0 && $avg < 10)
		{
			return $com->comment1;
		}
		elseif($avg >=10 && $avg < 20)
		{
			return $com->comment2;
		}
		elseif($avg >=20 && $avg < 30)
		{
			return $com->comment3;
		}
		elseif($avg >=30 && $avg < 40)
		{
			return $com->comment4;
		}
		elseif($avg >=40 && $avg < 50)
		{
			return $com->comment5;
		}
		elseif($avg >=50 && $avg < 60)
		{
			return $com->comment6;
		}
		elseif($avg >=60 && $avg < 70)
		{
			return $com->comment7;
		}
		elseif($avg >=70 && $avg < 80)
		{
			return $com->comment8;
		}
		elseif($avg >=80 && $avg < 90)
		{
			return $com->comment9;
		}
		elseif($avg >=90 && $avg <= 100)
		{
			return $com->comment10;
		}
		else
		{
			return 'Error in result';
		}
	}
	public function format_date($d_m_y)
	{
		//takes date format DD-MM-YYYY
		$split = explode('-', $d_m_y);
		return date('jS F, Y', mktime(0,0,0,$split[1],$split[0],$split[2]));
	}
	public function tick($a, $b)
	{
		if($a == $b)
		{
			return '<img src="'.base_url('images/gen/tick3.png').'" height="10" width="10" style="margin-left:4px;" />';
		}
		else
		{
			return '&nbsp;';
		}
	}
	public function get_average($total, $n)
	{
		$avg = 0;
		if($n > 0)
		{
			$avg = $total / $n;
		}
		return (int) $avg;
	}
	public function color_mark($obtainable, $obtained)
	{
		$min_pass = floor(0.4* $obtainable); //40%
		if($obtained < $min_pass)
		{
			return '<span class="fail">'.$obtained.'</span>';
		}
		else
		{
			return '<span class="pass">'.$obtained.'</span>';
		}
	}
	public function is_admin($username)
	{
		$level = $this->CI->action_model->get_level($username)->level;
		if($level == 'admin')
		{
			return TRUE;
		}
		return FALSE;
	}
}