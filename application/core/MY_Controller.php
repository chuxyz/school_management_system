<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	public $sch_name;
	public $sch_abbr;
	public $logo_url;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('action_model');
		$this->sch_name = $this->action_model->get_install()->schName;
		$this->sch_abbr = $this->action_model->get_install()->schAbbr;
		$this->logo_url = $this->action_model->get_install()->logoUrl;
	}
	
}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */