<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Africa/Lagos');
		$this->load->model('gen_model');
		$this->load->model('auth_model');
		$this->load->model('action_model');
		$this->load->library('func');
		//$this->load->library('admin_lib', '', 'admin'); //load admin library
		
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s field must not be empty');
		$this->form_validation->set_message('is_numeric', '%s field must be numeric');
		$this->form_validation->set_message('is_unique', 'The value you inserted in the %s field already exists');
		
	}
	////////////////////////////////////////
	 public function valid_date($date)
	 {
		 $split = explode('-',$date);
		 $segment = count($split);
		 foreach($split as &$splt)
		 {
			 if(!$splt) $splt = 0;
		 }
		 if(checkdate(@$split[1], @$split[0], @$split[2]) && @$split[2] >= 2013 )
		 {
			 return TRUE;
		 }
		 $this->form_validation->set_message('valid_date', 'The %s field must be a valid date');
		 return FALSE;
	 }
	 ///////////////////////////////////////////
	 public function install()
	 {
		 $this->func->check_login();
		 $this->func->check_admin($this->session->userdata('username'));
		 $view = 'install';
		 $data['title'] = $this->sch_abbr.' | Install';
		 
		 $this->load->view($view, $data);
	 }
	 public function settings()
	 {
		 $this->func->check_login();
		 $this->func->check_admin($this->session->userdata('username'));
		 $view = 'settings';
		 $data['title'] = $this->sch_abbr.' | Settings';
		 $current_session= $this->action_model->get_current_session()->sessionID;
		 $current_term = $this->action_model->get_current_term()->termID;
		 if($this->input->post('update-settings') == TRUE)
		 {
			 $no_of_test = $this->input->post('no-of-test');
			 $max_score1 = $this->input->post('max-score1');
			 $max_score2 = $this->input->post('max-score2');
			 $max_score3 = $this->input->post('max-score3');
			 $max_score_ex = $this->input->post('max-score-ex');
			 $this->form_validation->set_rules('no-of-test', 'No. of Test', 'required');
			 $this->form_validation->set_rules('max-score1', '1st Test Max Score', 'required|is_numeric|less_than[100]');
			 if($no_of_test >= 2 || $no_of_test == '')
			 {
			 $this->form_validation->set_rules('max-score2', '2nd Test Max Score', 'required|is_numeric|less_than[100]');
			 }
			 if($no_of_test == 3 || $no_of_test == '')
			 {
			 	$this->form_validation->set_rules('max-score3', '3rd Test Max Score', 'required|is_numeric|less_than[100]');
			 }
			 $this->form_validation->set_rules('max-score-ex', 'Exam Max Score', 'required|is_numeric|less_than[100]');
			 
			 if($this->form_validation->run() == FALSE)
			 {
				 $this->session->set_userdata('err_msg', 'The following errors occured');	 
			 }
			 else
			 {
				 if(!$max_score2)
				 {
					 $max_score2 = 0;
				 }
				 if(!$max_score3)
				 {
					 $max_score3 = 0;
				 }
				 $total = $max_score1 + $max_score2 + $max_score3 + $max_score_ex;
				 if($total != 100)
				 {
					 $this->session->set_userdata('err_msg', 'The Sum of all inputs must be equal to 100');
				 }
				 else
				 {
					 $db_in = array(
							'numOfTest'=>$no_of_test,
							'maxTest1'=>$max_score1,
							'maxTest2'=>$max_score2,
							'maxTest3'=>$max_score3,
							'maxExam'=>$max_score_ex
						);
					 if($this->auth_model->check_settings() < 1)
					 {
						$this->gen_model->insert('settings', $db_in); 
						$this->session->set_userdata('suc_msg', 'Settings Inserted Successfully');
					 }
					 else
					 {
						 $this->gen_model->update('settings', $db_in, array('ID'=>1));
						 $this->session->set_userdata('suc_msg', 'Settings Updated Successfully');
					 }
				 }
			 }
		 }
		 if($this->input->post('set-active') == TRUE)
		 {
			 $session_id = $this->input->post('session-id');
			 $term_id = $this->input->post('term-id');
			 $session_name = @$this->action_model->get_session_name($session_id)->sessionName;
			 $term_name = @$this->action_model->get_term_name($term_id)->termName;
			 $this->form_validation->set_rules('session-id', 'Session', 'required');
			 $this->form_validation->set_rules('term-id', 'Term', 'required');
			 if($this->form_validation->run() == FALSE)
			 {
				$this->session->set_userdata('err_msg', 'Session or Term field was left blank'); 
			 }
			 else
			 {
				 $this->db->update('session', array('currentSession'=>'NO'));
				 $this->db->update('session', array('currentSession'=>'YES'), array('sessionID'=>$session_id));
				 $this->db->update('term', array('currentTerm'=>'NO'));
				 $this->db->update('term', array('currentTerm'=>'YES'), array('termID'=>$term_id));
				 $this->session->set_userdata('suc_msg', 'Active Session set to: <b>'.$session_name.'</b>  and Active Term set to: <b>'.$term_name.'</b>'); 
			 }
		 }
		 if($this->input->post('update-comments') == TRUE)
		 {
			 $comments = $this->input->post('comment');
			 $this->form_validation->set_rules('comment[]', 'Comments', 'required');
			 if($this->form_validation->run() == FALSE)
			 {
				$this->session->set_userdata('err_msg', 'No comment field should be left blank'); 
			 }
			 else
			 {
				 if(is_array($comments))
				 {
					 $i = 1;
					 $com = 'com';
					 $com1 = $com2 = $com3 = $com4 = $com5 = $com6 = $com7 = $com8 = $com9 = $com10 = ''; 
					 foreach($comments as $comment)
					 {
						 ${$com.$i} = $comment;
						 $i++;
					 }
				 }
				 $ins = array(
				 			'comment1' => $com1,
							'comment2' => $com2,
							'comment3' => $com3,
							'comment4' => $com4,
							'comment5' => $com5,
							'comment6' => $com6,
							'comment7' => $com7,
							'comment8' => $com8,
							'comment9' => $com9,
							'comment10' => $com10
				 		);
				 if($this->action_model->check_palcomment() > 0)
				 {
					 $this->gen_model->update('palcomment', $ins, array('commentID'=>1));
					 $this->session->set_userdata('suc_msg', 'Record updated successfully'); 
				 }
				 else
				 {
					 $this->gen_model->insert('palcomment', $ins);
					 $this->session->set_userdata('suc_msg', 'Record added successfully');
				 }
			 } 
		 }
		 if($this->input->post('set-vrdate') == TRUE)
		 {
			 $times_open = $this->input->post('times-open');
			 $v_date = $this->input->post('v-date');
			 $r_date = $this->input->post('r-date');
			 $this->form_validation->set_rules('times-open', 'No. of times Sch Opened', 'required|is_numeric');
			 $this->form_validation->set_rules('v-date', 'Vacation Date', 'require|callback_valid_date');
			 $this->form_validation->set_rules('r-date', 'Resumption Date', 'require|callback_valid_date');
			 
			 if($this->form_validation->run() == FALSE)
			 {
				 $this->session->set_userdata('err_msg', 'The following error has occured'); 
			 }
			 else
			 {
				 $in = array(
				 		'thisVacation'=>$v_date,
						'nextResumption'=>$r_date,
						'timesOpen'=>$times_open,
						'termID'=>$current_term,
						'sessionID'=>$current_session
				 );
				 $up = array(
				 		'thisVacation'=>$v_date,
						'nextResumption'=>$r_date,
						'timesOpen'=>$times_open,
						'termID'=>$current_term
				 );
				 if($this->action_model->check_vrdate($current_term, $current_session) <= 0)
				 {
					  $this->gen_model->insert('vrdate', $in);
					  $this->session->set_userdata('suc_msg', 'Vacation &amp; Resumption date Added Successfully'); 
				 }
				 else
				 {
					 $this->gen_model->update('vrdate', $up, array('termID'=>$current_term, 'sessionID'=>$current_session));
					 $this->session->set_userdata('suc_msg', 'Vacation &amp; Resumption date Updated Successfully');
				 }
			 }
		 }
		 $data['current_session'] = $this->action_model->get_current_session();
		 $data['current_term'] = $this->action_model->get_current_term();
		 $data['all_session'] = $this->action_model->get_all_session();
		 $data['all_term'] = $this->action_model->get_term();
		 $data['palcomment'] = $this->action_model->get_palcomment();
		 $data['vrdate'] = $this->action_model->get_vrdate($current_term, $current_session);
		 $this->load->view($view, $data);
	 }
	 public function staff_settings()
	 {
		 $this->func->check_login();
		 $this->func->check_admin($this->session->userdata('username'));
		 $view = 'staff-settings';
		 $data['title'] = $this->sch_abbr.' | Staff Settings';
		 if($this->input->post('add-staff') == TRUE)
		 {
			 $log_name = trim($this->input->post('log-name'));
			 $password = md5(trim($this->input->post('password')));
			 $level = $this->input->post('level');
			 $this->form_validation->set_rules('log-name','Login Name','required|is_unique[staff.username]|min-length[4]');
			 $this->form_validation->set_rules('password','Password','required|min-length[4]');
			 $this->form_validation->set_rules('c-password','Confirm Password','required|matches[password]');
			 if($this->form_validation->run() == FALSE)
			 {
				 $this->session->set_userdata('err_msg', 'The following error has occured');
			 }
			 else
			 {
				 $this->gen_model->insert('staff',array('username'=>$log_name, 'password'=>$password, 'level'=>$level));
				 $this->session->set_userdata('suc_msg', '<b>'.$log_name.'</b> added successfully');
			 }
		 }
		 $data['staffs'] = $this->action_model->get_staff();
		 $data['classes'] = $this->action_model->get_classes();
		 $this->load->view($view, $data);
	 }
}

/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */