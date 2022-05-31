<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_install()
	{
		$this->db->select('*')
		->from('install')
		->where(array('ID'=> 1));
		$query = $this->db->get();
		return $query->row();
	}
	public function session_row_count($val)
	{
		$this->db->select('*')
		->from('session')
		->where(array('sessionName'=>$val));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_active_session()
	{
		$this->db->select('sessionID, sessionName')
		->from('session')
		->where(array('currentSession'=>'YES'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function class_row_count($val)
	{
		$this->db->select('*')
		->from('classes')
		->where(array('className'=>$val));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function subject_row_count($val)
	{
		$this->db->select('*')
		->from('subjects')
		->where(array('subjectName'=>$val));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_classes()
	{
		$this->db->select('*')
		->from('classes');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_subjects()
	{
		$this->db->select('*')
		->from('subjects')
		->order_by('subjectName');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_subject_list($class_id)
	{
		$this->db->select('subjectList')
		->from('classes')
		->where(array('classID'=>$class_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_class_name($class_id)
	{
		$this->db->select('className')
		->from('classes')
		->where(array('classID'=>$class_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_subject_name($subject_id)
	{
		$this->db->select('subjectName')
		->from('subjects')
		->where(array('subjectID'=>$subject_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_student_name($student_id)
	{
		$this->db->select('studentName')
		->from('students')
		->where(array('studentID'=>$student_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_students_by_class($class_id)
	{
		$this->db->select('*')
		->from('students')
		->where(array('classID'=>$class_id));
		//->order_by('studentname ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_current_session()
	{
		$this->db->select('*')
		->from('session')
		->where(array('currentSession'=>'YES'));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_current_term()
	{
		$this->db->select('*')
		->from('term')
		->where(array('currentTerm'=>'YES'));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_term()
	{
		$this->db->select('*')
		->from('term');
		$query = $this->db->get();
		return $query->result();
	}
	public function check_record($class_id, $student_id, $subject_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('assessment')
		->where(array('classID'=>$class_id,'studentID'=>$student_id, 'subjectID'=>$subject_id, 'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_assessment($class_id, $student_id, $subject_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('assessment')
		->where(array('classID'=>$class_id,'studentID'=>$student_id, 'subjectID'=>$subject_id, 'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_students()
	{
		$this->db->select('*')
		->from('students s')
		->join('classes c', 's.classID = c.classID')
		->order_by('className,studentName');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_students_by_name($student_name)
	{
		$this->db->select('*')
		->from('students s')
		->join('classes c', 's.classID = c.classID')
		->like('studentName', $student_name)
		->order_by('className,studentName');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_students_by_classid($class_id)
	{
		$this->db->select('*')
		->from('students s')
		->join('classes c', 's.classID = c.classID')
		->where('c.classID', $class_id)
		->order_by('className,studentName');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_students_by_class_name($class_id, $student_name)
	{
		$this->db->select('*')
		->from('students s')
		->join('classes c', 's.classID = c.classID')
		->where(array('c.classID'=>$class_id))
		->like('studentName', $student_name)
		->order_by('className,studentName');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_student_by_id($student_id)
	{
		$this->db->select('*')
		->from('students s')
		->join('classes c', 's.classID = c.classID')
		->where(array('studentID'=>$student_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_all_session()
	{
		$this->db->select('*')
		->from('session')
		->order_by('sessionID','desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_session_name($session_id)
	{
		$this->db->select('sessionName')
		->from('session')
		->where(array('sessionID' => $session_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_term_name($term_id)
	{
		$this->db->select('termName')
		->from('term')
		->where(array('termID' => $term_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_settings()
	{
		$this->db->select('*')
		->from('settings')
		->where('ID',1);
		$query = $this->db->get();
		return $query->row();
	}
	public function check_palcomment()
	{
		$this->db->select('*')
		->from('palcomment')
		->where('commentID', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_palcomment()
	{
		$this->db->select('*')
		->from('palcomment')
		->where('commentID', 1);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_subject_total($class_id, $subject_id, $term_id, $session_id)
	{
		$this->db->select('DISTINCT(total)')
		->from('assessment')
		->where(array('classID'=>$class_id,'subjectID'=>$subject_id, 'termID'=>$term_id, 'sessionID'=>$session_id))
		->order_by('total', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function count_same_total($total,$class_id, $subject_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('assessment')
		->where(array('total'=>$total,'classID'=>$class_id,'subjectID'=>$subject_id, 'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_aggregate($class_id, $student_id, $term_id, $session_id)
	{
		$this->db->select_sum('total')
		->from('assessment')
		->where(array('classID'=>$class_id, 'studentID'=>$student_id, 'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_distinct_aggregate($class_id, $term_id, $session_id)
	{
		$this->db->distinct()
		->select('(aggregate)')
		->from('aggregates')
		->where(array('classID'=>$class_id, 'termID'=>$term_id, 'sessionID'=>$session_id))
		->order_by('aggregate', 'desc');
		//$query = $this->db->query("SELECT DISTINCT(aggregate)  FROM `aggregates` order by aggregate desc");
		$query = $this->db->get();
		return $query->result();
	}
	public function count_same_aggregate($aggregate, $class_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('aggregates')
		->where(array('aggregate'=>$aggregate,'classID'=>$class_id, 'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function check_aggregate($class_id, $student_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('aggregates')
		->where(array('classID'=>$class_id, 'studentID'=>$student_id, 'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_result($class_id, $student_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('classes cl')
		->join('students st', 'cl.classID = st.classID')
		->join('assessment a', 'st.studentID = a.studentID')
		->join('aggregates ag', 'a.studentID = ag.studentID')
		->join('subjects sj', 'a.subjectID = sj.subjectID')
		->where(array('ag.classID'=>$class_id, 'ag.studentID'=>$student_id, 'ag.termID'=>$term_id, 'ag.sessionID'=>$session_id))
		->order_by('subjectName');
		$query = $this->db->get();
		return $query->result();
	}
	public function total_in_class($class_id, $term_id, $session_id)
	{
		$this->db->select('DISTINCT(studentID)')
		->from('assessment')
		->where(array('classID' => $class_id, 'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function check_vrdate($term_id, $session_id)
	{
		$this->db->select('*')
		->from('vrdate')
		->where(array('termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_vrdate($term_id, $session_id)
	{
		$this->db->select('*')
		->from('vrdate')
		->where(array('termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_staff()
	{
		$this->db->select('*')
		->from('staff');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_level($username)
	{
		$this->db->select('level')
		->from('staff')
		->where(array('username'=>$username));
		$query = $this->db->get();
		return $query->row();
	}
	public function check_psycho($student_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('psychomotor')
		->where(array('studentID'=>$student_id,'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function check_staffcomment($student_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('staffcomment')
		->where(array('studentID'=>$student_id,'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function get_psycho($student_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('psychomotor')
		->where(array('studentID'=>$student_id,'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->row();
	}
	public function get_staffcomment($student_id, $term_id, $session_id)
	{
		$this->db->select('*')
		->from('staffcomment')
		->where(array('studentID'=>$student_id,'termID'=>$term_id, 'sessionID'=>$session_id));
		$query = $this->db->get();
		return $query->row();
	}
	
}