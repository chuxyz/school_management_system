<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_ctrl extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('func');
		$this->load->model('action_model');// load location model
	}
	
	public function student_list($class_id, $student_name= NULL)
	{
		$session = $this->action_model->get_current_session()->sessionID;
		$term = $this->action_model->get_current_term()->termID;
		$class_id = (int) $class_id;
		if(!is_numeric($class_id) || $class_id == 0 || $class_id == NULL)
		{
			$class_id = '';
		}
		if($class_id == '' && $student_name == '')
		{
			$query = $this->action_model->get_students();
		}
		elseif($class_id == '' && $student_name != '')
		{
			$query = $this->action_model->get_students_by_name($student_name);
		}
		elseif($class_id != '' && $student_name != '')
		{
			$query = $this->action_model->get_students_by_class_name($class_id, $student_name);
		}
		else
		{
			$query = $this->action_model->get_students_by_classid($class_id);
		}
		$num_row = count($query);
		if($num_row > 0)
		{
		$result =   '<table border="1" class="score-table" style="width:98%;">
					<thead>
					<th width="30">S/N</th>
					<th width="50">&nbsp;</th>
					<th>Name</th>
					<th width="60">Class</th>
					<th width="60">&nbsp;</th>
					<th>&nbsp;</th>
					<th width="60">&nbsp;</th>
					<th>&nbsp;</th>
					</thead>';
		$sn = 1;
		foreach($query as $student)
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
			$result .= '<tr class="click-tr" onDblclick="profile('.$student->studentID.')" title="Double-Click to View '.$student->studentName.'\'s Profile">
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
		$result .= '</table>';
		echo $result;
		}
		else
		{
			echo '<div class="no-result">No Result Found</div>';
		}
	}
}

/* End of file admin_ajax.php */
/* Location: ./application/controllers/admin_ajax.php */