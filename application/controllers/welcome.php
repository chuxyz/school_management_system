<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
	public $staff;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Africa/Lagos');
		//$this->load->model('listing_model');
		$this->load->model('auth_model');
		$this->load->model('gen_model');
		$this->load->library('func');
		//$this->load->library('admin_lib', '', 'admin'); //load admin library
		
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', '%s field must not be empty');
		$this->form_validation->set_message('is_unique', 'The value you inserted in the %s field already exists in the database');
		$this->staff = file_exists('C:/desktop.txt');
		
	}
	public function index()
	{
		$view = 'home';
		$data['title'] = $this->sch_abbr.' | Login';
		if($this->session->userdata('validation') === TRUE)
		{
			$view = 'welcome';
			$data['title'] = $this->sch_abbr.' | Dashboard';
		}
		if($this->input->post('login') == TRUE) //if login is done
		{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			if($this->auth_model->check_user($username, $password) == 1 && $this->staff)
			{
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('validation', TRUE);
				$view = 'welcome'; 
				$data['title'] = $this->sch_abbr.' | Dashboard';
			}
			else
			{
				$this->session->set_userdata('msg', 'Your inserted the wrong Login Credentials');
			}
			
		}
		if($this->input->post('preview-result') == TRUE)
		{
			$class_id = $this->input->post('class-id');
			$session_id = $this->input->post('session-id');
			$term_id = $this->input->post('term-id');
			redirect('result-preview-all/'.$class_id.'/'.$term_id.'/'.$session_id);
		}
		if($this->input->post('generate-pdf') == TRUE)
		{
			$class_id = $this->input->post('class-id');
			$session_id = $this->input->post('session-id');
			$term_id = $this->input->post('term-id');
			redirect('generate-pdf/'.$class_id.'/'.$term_id.'/'.$session_id);
		}
		$data['sch_name'] = $this->sch_name;
		$data['classes'] = $this->action_model->get_classes();
		$data['session'] = $this->action_model->get_all_session();
		$data['terms'] = $this->action_model->get_term();
		$this->load->view($view, $data);
	}
	
	public function new_session()
	{
		$this->func->check_login();
		$this->func->check_admin($this->session->userdata('username'));
		$view = 'new-session';
		$data['title'] = $this->sch_abbr.' | New Session';
		if($this->input->post('create-session') == TRUE)
		{
			$session_val = $this->input->post('new-session');
			if($this->func->is_session($session_val))
			{
				$this->gen_model->insert('session', array('sessionName'=>trim($session_val)));
				$this->session->set_userdata('suc_msg', 'New Session Created Successfully');
			}
			else
			{
				$this->session->set_userdata('err_msg', 'Invalid Session Value or Session already exists');
			}
		}
		$this->load->view($view, $data);
	}
	
	public function add_class()
	{
		$this->func->check_login();
		$view = 'add-class';
		$data['title'] = $this->sch_abbr.' | Add Class';
		if($this->input->post('create-class') == TRUE)
		{
			$new_class = strtoupper($this->input->post('new-class'));
			if($this->func->form_exists($new_class))
			{
				$this->session->set_userdata('err_msg', 'This Class already exists!');
			}
			elseif(!$this->func->is_valid_form($new_class))
			{
				$this->session->set_userdata('err_msg', 'Invalid Class Value');
			}
			else
			{
				$this->gen_model->insert('classes', array('className'=>trim($new_class)));
				$this->session->set_userdata('suc_msg', 'New Class Added Successfully');
			}
		}
		$this->load->view($view, $data);
	}
	
	public function add_student()
	{
		$this->func->check_login();
		$view = 'add-student';
		$data['title'] = $this->sch_abbr.' | Add Student';
		if($this->input->post('create-student') == TRUE)
		{
			$surname = $this->input->post('surname');
			$firstname = $this->input->post('firstname');
			$middlename = $this->input->post('middlename');
			$name = ucwords(strtolower(trim($surname.' '.$firstname.' '.$middlename)));
			$sex = $this->input->post('sex');
			$dob_day = $this->input->post('dob-day');
			$dob_month = $this->input->post('dob-month');
			$dob_year = $this->input->post('dob-year');
			$dob = $dob_day.'-'.$dob_month.'-'.$dob_year;
			$class_id = $this->input->post('class-id');
			$address = $this->input->post('address');
			
			$this->form_validation->set_rules('surname', 'Surname', 'required|min_length[3]');
			$this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[3]');
			$this->form_validation->set_rules('middlename', 'Middle Name', 'min_length[3]');
			$this->form_validation->set_rules('sex', 'Sex', 'required');
			$this->form_validation->set_rules('dob-day', 'Day', 'required');
			$this->form_validation->set_rules('dob-month', 'Month', 'required');
			$this->form_validation->set_rules('dob-year', 'Year', 'required');
			$this->form_validation->set_rules('class-id', 'Class', 'required');
			$this->form_validation->set_rules('address', 'Student\'s Address', 'required|min_length[3]|max_length[255]');
			
			$upload_path = 'photos/';
			$config['upload_path'] = './'.$upload_path;
			$config['encrypy_name'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '250';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$this->load->library('upload', $config);
			
			if($this->form_validation->run() == FALSE && !$this->upload->do_upload('passport'))
			{
				$data['upload_error'] = $this->upload->display_errors();
				$this->session->set_userdata('error_msg', 'The following error occured while trying to add a new student');
			}
			else
			{
				if($this->upload->do_upload('passport'))
				{
				$upload = $this->upload->data();
				$ext = $upload['file_ext']; // get file extension
				$encrpt_file = md5($upload['file_name'].time());
				$full_path = $upload_path.$upload['file_name'];
				}
				$insert_array = array(
					'studentName' => $name,
					'dob' => $dob,
					'sex' => $sex,
					'classID' => $class_id,
					'address' => $address,
					'passport' => ''//$full_path
				);
				$this->gen_model->insert('students', $insert_array);
				$this->session->set_userdata('suc_msg', 'New Student added successfully');
			}
		}
		$data['classes'] = $this->action_model->get_classes();
		$this->load->view($view, $data);
	}
	
	public function add_subject()
	{
		$this->func->check_login();
		$view = 'add-subject';
		$data['title'] = $this->sch_abbr.' | Add Subject';
		if($this->input->post('create-subject') == TRUE)
		{
			$subject_name = strtolower($this->input->post('new-subject'));
			$this->form_validation->set_rules('new-subject', 'Subject', 'required|min_length[4]|is_unique[subjects.subjectName]');
			if ($this->form_validation->run() == FALSE)
			{
			}
			else
			{
				$this->gen_model->insert('subjects', array('subjectName'=> ucwords($subject_name)));
				$this->session->set_userdata('suc_msg', 'New Subject added successfully');
			}
		}
		$this->load->view($view, $data);
	}
	
	public function assign_subject()
	{
		$this->func->check_login();
		$view = 'assign-subject';
		$data['title'] = $this->sch_abbr.' | Assign Subject';
		
		if($this->input->post('assign-subject') == TRUE)
		{
			$this->form_validation->set_rules('class-id', 'Class', 'required');
			$subject_list = $this->input->post('subject-list');
			$class_id = $this->input->post('class-id');
			if($this->form_validation->run() == FALSE)
			{
			}
			else
			{

				if(!$subject_list) // if no subject selected
				{
					$this->session->set_userdata('error_msg', 'You must select at least one subject');
				}
				else
				{
					$db_subject_list = $this->action_model->get_subject_list($class_id); //get subject list from db
					$db_subject_array = explode('-', $db_subject_list->subjectList); //form an array with the list
					if(is_array($subject_list)) //check if subject-list post value is an array, if true
					{
						$s_list = '';
						foreach($subject_list as $list) //loop through post value of subject list
						{
							if(in_array($list, $db_subject_array)) //if this subject already exists for this particular class
							{
								continue;   //skip and continue, else,
							}
							else
							{
								if($s_list == '') // if this is the first iteration
								{
									$s_list = $s_list.$list; // save first value, else
								}
								else
								{
									$s_list = $s_list.'-'.$list; // this is not the first, so seperate previous values with hyphen
								}
							}
							
						}
						$classname = $this->action_model->get_class_name($class_id)->className;
						if($s_list == '') //if no new value is added,
						{
							$this->session->set_userdata('error_msg', 'Subject(s) already assigned to '.$classname.' previously');
						}
						else
						{
							$new_db_list = $db_subject_list->subjectList.'-'.$s_list; //return new db_list 4-5-7[-1-2]
							if(!$db_subject_list->subjectList) //if empty subjectList field in DB
							{
								$new_db_list = $s_list; //insert new subject list to prevent [-1-2]
							}
							$this->gen_model->update('classes', array('subjectList'=>$new_db_list), array('classID'=>$class_id)); //update new_db_list in DB
							$this->session->set_userdata('suc_msg', 'You have successfully assigned new subject(s) to '.$classname);
						}
						
					}
				}
			}
			
		}
		$data['classes'] = $this->action_model->get_classes();
		$data['subjects'] = $this->action_model->get_subjects();
		$this->load->view($view, $data);
	}
	
	public function update_first_test()
	{
		$this->func->check_login();
		$view = 'update-first-test';
		$data['title'] = $this->sch_abbr.' | Update First Test';
		$data['classes'] = $this->action_model->get_classes();
		$data['subjects'] = $this->action_model->get_subjects();
		if($this->input->post('first-test') == TRUE)
		{
			$class_id = $this->input->post('class-id');
			$subject_id = $this->input->post('subject-id');
			$this->form_validation->set_rules('class-id', 'Class', 'required');
			$this->form_validation->set_rules('subject-id', 'Subject', 'required');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('error_msg', 'An error encountered. Check the notification and make appropriate correction(s)');
			}
			else
			{
				$subject_list = $this->action_model->get_subject_list($class_id)->subjectList; //get subjectList from db
				$subject_array = explode('-', $subject_list); // form array from the list
				if(!in_array($subject_id, $subject_array)) //if subject_id selected is not in the db subject list array
				{
					$class_name = $this->action_model->get_class_name($class_id)->className;
					$subject_name = $this->action_model->get_subject_name($subject_id)->subjectName;
					$this->session->set_userdata('error_msg', 'You have not assigned '.$subject_name.' to '.$class_name); //report error
				}
				else
				{
					redirect('uft/'.$class_id.'/'.$subject_id);
				}
			}
		}
		$this->load->view($view, $data);
	}
	
	public function update_second_test()
	{
		$this->func->check_login();
		$view = 'update-second-test';
		$data['title'] = $this->sch_abbr.' | Update Second Test';
		$data['classes'] = $this->action_model->get_classes();
		$data['subjects'] = $this->action_model->get_subjects();
		if($this->input->post('second-test') == TRUE)
		{
			$class_id = $this->input->post('class-id');
			$subject_id = $this->input->post('subject-id');
			$this->form_validation->set_rules('class-id', 'Class', 'required');
			$this->form_validation->set_rules('subject-id', 'Subject', 'required');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('error_msg', 'An error encountered. Check the notification and make appropriate correction(s)');
			}
			else
			{
				$subject_list = $this->action_model->get_subject_list($class_id)->subjectList; //get subjectList from db
				$subject_array = explode('-', $subject_list); // form array from the list
				if(!in_array($subject_id, $subject_array)) //if subject_id selected is not in the db subject list array
				{
					$class_name = $this->action_model->get_class_name($class_id)->className;
					$subject_name = $this->action_model->get_subject_name($subject_id)->subjectName;
					$this->session->set_userdata('error_msg', 'You have not assigned '.$subject_name.' to '.$class_name); //report error
				}
				else
				{
					redirect('ust/'.$class_id.'/'.$subject_id);
				}
			}
		}
		$this->load->view($view, $data);
	}
	
	public function update_third_test()
	{
		$this->func->check_login();
		$view = 'update-third-test';
		$data['title'] = $this->sch_abbr.' | Update Third Test';
		$data['classes'] = $this->action_model->get_classes();
		$data['subjects'] = $this->action_model->get_subjects();
		if($this->input->post('third-test') == TRUE)
		{
			$class_id = $this->input->post('class-id');
			$subject_id = $this->input->post('subject-id');
			$this->form_validation->set_rules('class-id', 'Class', 'required');
			$this->form_validation->set_rules('subject-id', 'Subject', 'required');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('error_msg', 'An error encountered. Check the notification and make appropriate correction(s)');
			}
			else
			{
				$subject_list = $this->action_model->get_subject_list($class_id)->subjectList; //get subjectList from db
				$subject_array = explode('-', $subject_list); // form array from the list
				if(!in_array($subject_id, $subject_array)) //if subject_id selected is not in the db subject list array
				{
					$class_name = $this->action_model->get_class_name($class_id)->className;
					$subject_name = $this->action_model->get_subject_name($subject_id)->subjectName;
					$this->session->set_userdata('error_msg', 'You have not assigned '.$subject_name.' to '.$class_name); //report error
				}
				else
				{
					redirect('utt/'.$class_id.'/'.$subject_id);
				}
			}
		}
		$this->load->view($view, $data);
	}
	
	public function uft($class_id, $subject_id)
	{
		$this->func->check_login();
		//Check to see if one inserted wrong class
		$view = 'uft';
		$data['title'] = $this->sch_abbr.' | Update First Test';
		$current_session_name = $this->action_model->get_current_session()->sessionName;
		$current_session_id = $this->action_model->get_current_session()->sessionID;
		$current_term_name = $this->action_model->get_current_term()->termName;
		$current_term_id = $this->action_model->get_current_term()->termID;
		if($this->input->post('uft') == TRUE)
		{
			$scores = $this->input->post('score');
			$offers = $this->input->post('offer');
			$lt = $this->action_model->get_settings()->maxTest1 + 1;
			$this->form_validation->set_rules('score[]','Scores','callback_check_score|less_than['.$lt.']|greater_than[-1]');
			if($this->form_validation->run() == FALSE)
			{
			}
			else
			{
				foreach($scores as $student_id => $score)
				{
					$ins = array(
							'classID' => $class_id,
							'studentID' => $student_id,
							'subjectID' => $subject_id,
							'test1' => $score,
							'termID' => $current_term_id,
							'sessionID' => $current_session_id
							
					);
					if($this->action_model->check_record($class_id, $student_id, $subject_id, $current_term_id, $current_session_id) > 0)
					{
						$where = array(
								'classID' => $class_id,
								'studentID' => $student_id,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
						);
						$this->gen_model->update('assessment', $ins, $where);
					}
					else
					{
						$this->gen_model->insert('assessment', $ins);
					}
					//////////////////////////////////////////////
					$this->func->update_test_total($class_id, $student_id, $subject_id, $current_term_id, $current_session_id);
					
					$subject_tot = $this->action_model->get_subject_total($class_id,$subject_id, $current_term_id, $current_session_id);
					$pos = 1;
					foreach($subject_tot as $tot)
					{
						$whr = array(
							'classID' => $class_id,
							'total'=>$tot->total,
							'subjectID'=>$subject_id,
							'termID'=>$current_term_id,
							'sessionID'=>$current_session_id
							);
						$this->gen_model->update('assessment',array('position'=>$pos), $whr);
						$j = $this->action_model->count_same_total($tot->total,$class_id, $subject_id, $current_term_id, $current_session_id);
						$seed = 0;
						while($seed < $j)
						{
							$pos++;
							$seed++;
						}
					}
					/////////////////////////////////////////////
					if($offers)
					{
						foreach($offers as $offer)
						{
							$del_where = array(
								'classID' => $class_id,
								'studentID' => $offer,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
							);
							$this->gen_model->delete('assessment', $del_where);
						}
					}
					$this->session->set_userdata('suc_msg', 'Records Updated Successfully');
				}
			}
		}
		$data['students_by_class'] = $this->action_model->get_students_by_class($class_id);
		$data['subject_name'] = $this->action_model->get_subject_name($subject_id)->subjectName;
		$data['class_id'] = $class_id;
		$data['subject_id'] = $subject_id;
		$data['term_id'] = $current_term_id;
		$data['session_id'] = $current_session_id;
		$this->load->view($view, $data);
	}
	////////////////////////////////////////////////
	public function check_score($str)
	{
		if(!is_numeric($str) && $str!='')
		{
			$this->form_validation->set_message('check_score', 'The %s field must be a numeric value');
			return FALSE;
		}
		return TRUE;
	}
	/////////////////////////////////////////////////
	public function ust($class_id, $subject_id)
	{
		$this->func->check_login();
		$view = 'ust';
		$data['title'] = $this->sch_abbr.' | Update Second Test';
		$current_session_name = $this->action_model->get_current_session()->sessionName;
		$current_session_id = $this->action_model->get_current_session()->sessionID;
		$current_term_name = $this->action_model->get_current_term()->termName;
		$current_term_id = $this->action_model->get_current_term()->termID;
		if($this->input->post('ust') == TRUE)
		{
			$scores = $this->input->post('score');
			$offers = $this->input->post('offer');
			$lt = $this->action_model->get_settings()->maxTest2 + 1;
			$this->form_validation->set_rules('score[]','Scores','callback_check_score|less_than['.$lt.']|greater_than[-1]');
			if($this->form_validation->run() == FALSE)
			{
			}
			else
			{
				foreach($scores as $student_id => $score)
				{
					$ins = array(
							'classID' => $class_id,
							'studentID' => $student_id,
							'subjectID' => $subject_id,
							'test2' => $score,
							'termID' => $current_term_id,
							'sessionID' => $current_session_id
							
					);
					if($this->action_model->check_record($class_id, $student_id, $subject_id, $current_term_id, $current_session_id) > 0)
					{
						$where = array(
								'classID' => $class_id,
								'studentID' => $student_id,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
						);
						$this->gen_model->update('assessment', $ins, $where);
					}
					else
					{
						$this->gen_model->insert('assessment', $ins);
					}
					//////////////////////////////////////////////
					$this->func->update_test_total($class_id, $student_id, $subject_id, $current_term_id, $current_session_id);

					$subject_tot = $this->action_model->get_subject_total($class_id,$subject_id, $current_term_id, $current_session_id); // Get Distinct total
					$pos = 1;
					foreach($subject_tot as $tot)
					{
						$whr = array(
							'classID' => $class_id,
							'total'=>$tot->total,
							'subjectID'=>$subject_id,
							'termID'=>$current_term_id,
							'sessionID'=>$current_session_id
							);
						$this->gen_model->update('assessment',array('position'=>$pos), $whr);
						$j = $this->action_model->count_same_total($tot->total,$class_id, $subject_id, $current_term_id, $current_session_id);
						$seed = 0;
						while($seed < $j)
						{
							$pos++;
							$seed++;
						}
					}
					/////////////////////////////////////////////
					if($offers)
					{
						foreach($offers as $offer)
						{
							$del_where = array(
								'classID' => $class_id,
								'studentID' => $offer,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
							);
							$this->gen_model->delete('assessment', $del_where);
						}
					}
					$this->session->set_userdata('suc_msg', 'Records Updated Successfully');
				}
			}
		}
		$data['students_by_class'] = $this->action_model->get_students_by_class($class_id);
		$data['subject_name'] = $this->action_model->get_subject_name($subject_id)->subjectName;
		$data['class_id'] = $class_id;
		$data['subject_id'] = $subject_id;
		$data['term_id'] = $current_term_id;
		$data['session_id'] = $current_session_id;
		$this->load->view($view, $data);
	}
	public function utt($class_id, $subject_id)
	{
		$this->func->check_login();
		$view = 'utt';
		$data['title'] = $this->sch_abbr.' | Update Third Test';
		$current_session_name = $this->action_model->get_current_session()->sessionName;
		$current_session_id = $this->action_model->get_current_session()->sessionID;
		$current_term_name = $this->action_model->get_current_term()->termName;
		$current_term_id = $this->action_model->get_current_term()->termID;
		if($this->input->post('utt') == TRUE)
		{
			$scores = $this->input->post('score');
			$offers = $this->input->post('offer');
			$lt = $this->action_model->get_settings()->maxTest3 + 1;
			$this->form_validation->set_rules('score[]','Scores','callback_check_score|less_than['.$lt.']|greater_than[-1]');
			if($this->form_validation->run() == FALSE)
			{
			}
			else
			{
				foreach($scores as $student_id => $score)
				{
					$ins = array(
							'classID' => $class_id,
							'studentID' => $student_id,
							'subjectID' => $subject_id,
							'test3' => $score,
							'termID' => $current_term_id,
							'sessionID' => $current_session_id
							
					);
					if($this->action_model->check_record($student_id, $subject_id, $current_term_id, $current_session_id) > 0)
					{
						$where = array(
								'classID' => $class_id,
								'studentID' => $student_id,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
						);
						$this->gen_model->update('assessment', $ins, $where);
					}
					else
					{
						$this->gen_model->insert('assessment', $ins);
					}
					//////////////////////////////////////////////
					$this->func->update_test_total($class_id, $student_id, $subject_id, $current_term_id, $current_session_id);

					$subject_tot = $this->action_model->get_subject_total($class_id,$subject_id, $current_term_id, $current_session_id); // Get Distinct total
					$pos = 1;
					foreach($subject_tot as $tot)
					{
						$whr = array(
							'classID' => $class_id,
							'total'=>$tot->total,
							'subjectID'=>$subject_id,
							'termID'=>$current_term_id,
							'sessionID'=>$current_session_id
							);
						$this->gen_model->update('assessment',array('position'=>$pos), $whr);
						$j = $this->action_model->count_same_total($tot->total,$class_id, $subject_id, $current_term_id, $current_session_id);
						$seed = 0;
						while($seed < $j)
						{
							$pos++;
							$seed++;
						}
					}
					/////////////////////////////////////////////
					if($offers)
					{
						foreach($offers as $offer)
						{
							$del_where = array(
								'classID' => $class_id,
								'studentID' => $offer,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
							);
							$this->gen_model->delete('assessment', $del_where);
						}
					}
					$this->session->set_userdata('suc_msg', 'Records Updated Successfully');
				}
			}
		}
		$data['students_by_class'] = $this->action_model->get_students_by_class($class_id);
		$data['subject_name'] = $this->action_model->get_subject_name($subject_id)->subjectName;
		$data['class_id'] = $class_id;
		$data['subject_id'] = $subject_id;
		$data['term_id'] = $current_term_id;
		$data['session_id'] = $current_session_id;
		$this->load->view($view, $data);
	}
	public function update_exam()
	{
		$this->func->check_login();
		$view = 'update-exam';
		$data['title'] = $this->sch_abbr.' | Update Exam';
		$data['classes'] = $this->action_model->get_classes();
		$data['subjects'] = $this->action_model->get_subjects();
		if($this->input->post('exam') == TRUE)
		{
			$class_id = $this->input->post('class-id');
			$subject_id = $this->input->post('subject-id');
			$this->form_validation->set_rules('class-id', 'Class', 'required');
			$this->form_validation->set_rules('subject-id', 'Subject', 'required');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_userdata('error_msg', 'An error encountered. Check the notification and make appropriate correction(s)');
			}
			else
			{
				$subject_list = $this->action_model->get_subject_list($class_id)->subjectList; //get subjectList from db
				$subject_array = explode('-', $subject_list); // form array from the list
				if(!in_array($subject_id, $subject_array)) //if subject_id selected is not in the db subject list array
				{
					$class_name = $this->action_model->get_class_name($class_id)->className;
					$subject_name = $this->action_model->get_subject_name($subject_id)->subjectName;
					$this->session->set_userdata('error_msg', 'You have not assigned '.$subject_name.' to '.$class_name); //report error
				}
				else
				{
					redirect('uex/'.$class_id.'/'.$subject_id);
				}
			}
		}
		$this->load->view($view, $data);
	}
	public function uex($class_id, $subject_id)
	{
		$this->func->check_login();
		$view = 'uex';
		$data['title'] = $this->sch_abbr.' | Update Exam';
		$current_session_name = $this->action_model->get_current_session()->sessionName;
		$current_session_id = $this->action_model->get_current_session()->sessionID;
		$current_term_name = $this->action_model->get_current_term()->termName;
		$current_term_id = $this->action_model->get_current_term()->termID;
		if($this->input->post('uex') == TRUE)
		{
			$scores = $this->input->post('score');
			$offers = $this->input->post('offer');
			$lt = $this->action_model->get_settings()->maxExam + 1;
			$this->form_validation->set_rules('score[]','Scores','callback_check_score|less_than['.$lt.']|greater_than[-1]');
			if($this->form_validation->run() == FALSE)
			{
			}
			else
			{
				foreach($scores as $student_id => $score)
				{
					$ins = array(
							'classID' => $class_id,
							'studentID' => $student_id,
							'subjectID' => $subject_id,
							'exam' => $score,
							'termID' => $current_term_id,
							'sessionID' => $current_session_id
							
					);
					if($this->action_model->check_record($class_id, $student_id, $subject_id, $current_term_id, $current_session_id) > 0)
					{
						$where = array(
								'classID' => $class_id,
								'studentID' => $student_id,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
						);
						$this->gen_model->update('assessment', $ins, $where);
					}
					else
					{
						$this->gen_model->insert('assessment', $ins);
					}
					//////////////////////////////////////////////
					$this->func->update_test_total($class_id, $student_id, $subject_id, $current_term_id, $current_session_id);

					$subject_tot = $this->action_model->get_subject_total($class_id,$subject_id, $current_term_id, $current_session_id); // Get Distinct total
					$pos = 1;
					foreach($subject_tot as $tot)
					{
						$whr = array(
							'classID' => $class_id,
							'total'=>$tot->total,
							'subjectID'=>$subject_id,
							'termID'=>$current_term_id,
							'sessionID'=>$current_session_id
							);
						$this->gen_model->update('assessment',array('position'=>$pos), $whr);
						$j = $this->action_model->count_same_total($tot->total,$class_id, $subject_id, $current_term_id, $current_session_id);
						$seed = 0;
						while($seed < $j)
						{
							$pos++;
							$seed++;
						}
					}
					/////////////////////////////////////////////
					if($offers)
					{
						foreach($offers as $offer)
						{
							$del_where = array(
								'classID' => $class_id,
								'studentID' => $offer,
								'subjectID' => $subject_id,
								'termID' => $current_term_id,
								'sessionID' => $current_session_id	
							);
							$this->gen_model->delete('assessment', $del_where);
						}
					}
					$this->session->set_userdata('suc_msg', 'Records Updated Successfully');
				}
			}
		}
		$data['students_by_class'] = $this->action_model->get_students_by_class($class_id);
		$data['subject_name'] = $this->action_model->get_subject_name($subject_id)->subjectName;
		$data['class_id'] = $class_id;
		$data['subject_id'] = $subject_id;
		$data['term_id'] = $current_term_id;
		$data['session_id'] = $current_session_id;
		$this->load->view($view, $data);
	}
	public function student_profile($class_id = 0)
	{
		$this->func->check_login();
		if($class_id == 0)
		{
			$data['students'] = $this->action_model->get_students();
		}
		else
		{
			$data['students'] = $this->action_model->get_students_by_class($class_id);
		}
		$view = 'student-profile';
		$data['title'] = $this->sch_abbr.' | Student\'s Profile';
		$current_session_id = $this->action_model->get_current_session()->sessionID;
		$current_term_id = $this->action_model->get_current_term()->termID;
		if($this->input->post('student-list'))
		{
			$c_id = $this->input->post('class-id');
			if($c_id == 0)
			{
				redirect('student-profile');
			}
			else
			{
				redirect('student-profile/'.$c_id);
			}
		}
		if($this->input->post('psychomotor'))
		{
			//Default incase nothing is selected
		  $psy1 = array(
		  'punctuality' => rand(1,5),
		  'neatness' => rand(1,5),
		  'politeness' => rand(1,5),
		  'honesty' => rand(1,5),
		  'cooperation' => rand(1,5),
		  'leadership' => rand(1,5),
		  'helping' => rand(1,5),
		  'emotional' => rand(1,5),
		  'health' => rand(1,5),
		  'schwork' => rand(1,5),
		  'attentiveness' => rand(1,5),
		  'persevere' => rand(1,5),
		  'fluency' => rand(1,5),
		  'handwriting' => rand(1,5),
		  'vfluency' => rand(1,5),
		  'aerobics' => rand(1,5),
		  'sports' => rand(1,5),
		  'handtool' => rand(1,5),
		  'drawing' => rand(1,5),
		  'musical' => rand(1,5)
		  );
			$id = $this->input->post('seed-id');
			$psy = $this->input->post('p'); //get posted array data psychomotor  and
			if(is_array($psy))
			{
				foreach($psy as $key=>$value) //loop through the array key & value
				{
					$psy1[$key] = (int)$value; //change the value of any present(set) key in $psy1
				}
				$chain = '';
				foreach($psy1 as $p)
				{
					if($chain == '')
					{
						$chain = $chain.$p;
					}
					else
					{
						$chain = $chain.'-'.$p;
					}
				}
				if($this->action_model->check_psycho($id, $current_term_id, $current_session_id) <= 0)
				{
					$this->gen_model->insert('psychomotor', array(
															'psyValues'=>$chain,
															'studentID'=>$id,
															'termID'=>$current_term_id,
															'sessionID'=>$current_session_id)
											);
					$this->session->set_userdata('suc_msg', 'Psychomotor added successfully');
				}
				else
				{
					$this->gen_model->update('psychomotor', array('psyValues'=>$chain),
															array('studentID'=>$id,
															'termID'=>$current_term_id,
															'sessionID'=>$current_session_id)
											);
					$this->session->set_userdata('suc_msg', 'Psychomotor Updated successfully');
				}
			}
			else
			{
				$this->session->set_userdata('err_msg', 'You didn\'t check any of the radio button');
			}
			//var_dump($psy1);
		}
		if($this->input->post('stfcomment') == TRUE)
		{
			$staff_comment = $this->input->post('staff-comment');
			$times_present = $this->input->post('times-present');
			$id = $this->input->post('seed-id');
			if($this->action_model->check_staffcomment($id, $current_term_id, $current_session_id) <= 0)
			{
				$this->gen_model->insert('staffcomment', array(
															'comment'=>$staff_comment,
															'timesPresent'=>$times_present,
															'studentID'=>$id,
															'termID'=>$current_term_id,
															'sessionID'=>$current_session_id)
											);
				$this->session->set_userdata('suc_msg', 'Comment added successfully');
			}
			else
			{
				$this->gen_model->update('staffcomment', array('comment'=>$staff_comment,'timesPresent'=>$times_present),
														 array('studentID'=>$id,
														 'termID'=>$current_term_id,
														 'sessionID'=>$current_session_id)
											);
				$this->session->set_userdata('suc_msg', 'Comment Updated successfully');
			}
		}
		$data['term'] = $current_term_id;
		$data['session'] = $current_session_id;
		$data['classes'] = $this->action_model->get_classes();
		$this->load->view($view, $data);
	}
	public function profile($student_id)
	{
		$this->func->check_login();
		$view = 'profile';
		$data['student'] = $this->action_model->get_student_by_id($student_id);
		$data['title'] = $this->sch_abbr.' | '.$data['student']->studentName;
		if($this->input->get('action') == TRUE && $this->input->get('action') == 'delete') //confirmed to delete
		{
			redirect('delete-profile/'.$student_id);
		}
		if($this->input->post('get-result') == TRUE)
		{
			$session_id = $this->input->post('session-id');
			$term_id = $this->input->post('term-id');
			redirect('result/'.$session_id.'/'.$term_id.'/'.$student_id);
		}
		if($this->input->post('edit-result') == TRUE)
		{
			$session_id = $this->input->post('session-id');
			$term_id = $this->input->post('term-id');
			redirect('edit-result/'.$session_id.'/'.$term_id.'/'.$student_id);
		}
		if($this->input->post('promote') == TRUE)
		{
			$class_id = $this->input->post('class-id');
			$class_name = $this->action_model->get_class_name($class_id)->className;
			$student_name = $this->action_model->get_student_name($student_id)->studentName;
			$this->gen_model->update('students', array('classID'=>$class_id), array('studentID'=>$student_id));
			$this->session->set_userdata('suc_msg', 'You have successfully promoted '.$student_name.' to '.$class_name);
			redirect('profile/'.$student_id);
		}
		$data['all_session'] = $this->action_model->get_all_session();
		$data['classes'] = $this->action_model->get_classes();
		$this->load->view($view, $data);
	}
	public function delete_profile($student_id)
	{
		$this->func->check_login();
		$view = 'delete-student';
		$data['student'] = $this->action_model->get_student_by_id($student_id);
		$data['title'] = $this->sch_abbr.' | '.$data['student']->studentName;
		//$this->gen_model->delete('students', array('studentID'=>$student_id));
		$this->load->view($view, $data);
	}
	public function set_aggregate()
	{
		$this->func->check_login();
		$view = 'position-students';
		$data['title'] = $this->sch_abbr.' | Position';
		$classes = $this->action_model->get_classes();
		$current_session_id = $this->action_model->get_current_session()->sessionID;
		$current_term_id = $this->action_model->get_current_term()->termID;
		foreach($classes as $class)
		{
			$students = $this->action_model->get_students_by_classid($class->classID);
			foreach($students as $student)
			{
				$pos = 1;
				$agg = $this->action_model->get_aggregate($class->classID, $student->studentID, $current_term_id, $current_session_id);
				if($agg->total != NULL)
				{
					$ins = array(
								'classID'=>$class->classID,
								'studentID'=>$student->studentID,
								'aggregate'=>$agg->total,
								'termID'=>$current_term_id,
								'sessionID'=>$current_session_id
						);
					if($this->action_model->check_aggregate($class->classID, $student->studentID, $current_term_id, $current_session_id) > 0)
					{
						$whr = array(
								'classID'=>$class->classID,
								'studentID'=>$student->studentID,
								'termID'=>$current_term_id,
								'sessionID'=>$current_session_id
						);
						$this->gen_model->update('aggregates', $ins, $whr);
					}
					else
					{
						$this->gen_model->insert('aggregates', $ins);
					}
				}
				///////////////////////////////////POSITIONING STARTS HERE
				$agg_tot = $this->action_model->get_distinct_aggregate($class->classID, $current_term_id, $current_session_id); // Get Distinct aggregate
					foreach($agg_tot as $tot)
					{
						$whr = array(
							'classID' => $class->classID,
							'aggregate'=>$tot->aggregate,
							'termID'=>$current_term_id,
							'sessionID'=>$current_session_id
							);
						$this->gen_model->update('aggregates',array('finalPosition'=>$pos), $whr);
						$j = $this->action_model->count_same_aggregate($tot->aggregate,$class->classID, $current_term_id, $current_session_id);
						$seed = 0;
						while($seed < $j)
						{
							$pos++;
							$seed++;
						}
					}
					/////////////////////////////////////////////
			}
		}
		$this->load->view($view, $data);
	}
	public function result_preview($class_id, $student_id, $term_id, $session_id)
	{
		$this->func->check_login();
		$view = 'result-preview';
		$data['title'] = $this->sch_abbr.' | Preview Result';
		$data['result'] = $this->action_model->get_result($class_id, $student_id, $term_id, $session_id);
		$data['s'] = $this->action_model->get_settings();
		$data['num_student'] = $this->action_model->total_in_class($class_id, $term_id, $session_id);
		$data['class_id'] = $class_id;
		$data['term_id'] = $term_id;
		$data['session_id'] = $session_id;
		$data['student_id'] = $student_id;
		$data['vrdate'] =  $this->action_model->get_vrdate($term_id, $session_id);
		//var_dump($data['result']);
		//var_dump($data['s']);
		$this->load->view($view, $data);
	}
	public function result_preview_all($class_id, $term_id, $session_id)
	{
		$this->func->check_login();
		$view = 'result-preview-all';
		$data['title'] = $this->sch_abbr.' | Preview All Result';
		$data['s'] = $this->action_model->get_settings();
		$data['students'] = $this->action_model->get_students_by_class($class_id);
		$data['class_id'] = $class_id;
		$data['term_id'] = $term_id;
		$data['session_id'] = $session_id;
		$data['num_student'] = $this->action_model->total_in_class($class_id, $term_id, $session_id);
		$data['vrdate'] =  $this->action_model->get_vrdate($term_id, $session_id);
		//var_dump($data['result']);
		//var_dump($data['s']);
		$this->load->view($view, $data);
	}
	public function generate_pdf($class_id, $term_id, $session_id)
	{
		$view = 'generate-pdf';
		$data['title'] = $this->sch_abbr.' | Generating PDF';
		$class_name = $this->action_model->get_class_name($class_id)->className;
		$c_name = explode(' ', $class_name);
		$class_name = implode('_', $c_name);
		$session_name = $this->action_model->get_session_name($session_id)->sessionName;
		$sess = explode('/',$session_name);
		$session_name = implode('-',$sess);
		$term_name = $this->action_model->get_term_name($term_id)->termName;
		$t_name = explode(' ', $term_name);
		$term_name = implode('_', $t_name);
		$sch_name = explode(' ', $this->sch_name);
		$sch_name = implode('_', $sch_name);
		$data['students'] = $this->action_model->get_students_by_class($class_id);
		$dir = 'C:\\'.$sch_name.'\\'.$class_name.'\\'.$session_name.'\\'.$term_name;
		$path = 'C:/'.$sch_name.'/'.$class_name.'/'.$session_name.'/'.$term_name;
		if(!file_exists($dir))
		{
			mkdir($dir, 0755, true);
		}
		foreach($data['students'] as $st)
		{
			$split = explode(' ', $st->studentName);
			$stName = implode('_', $split);
			echo shell_exec("C:/wkhtmltopdf/bin/wkhtmltopdf -O landscape ".base_url('result-preview/'.$class_id.'/'.$st->studentID.'/'.$term_id.'/'.$session_id.'/?v=true')." ".$path."/".$stName.".pdf");
		}
		$data['files'] = scandir($dir);
		$this->load->view($view, $data);
	}
	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->set_userdata('validation', FALSE);
		$this->session->set_userdata('msg', 'You are successfully logged out!');
		redirect();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */