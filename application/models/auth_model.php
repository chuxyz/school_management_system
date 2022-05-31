<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function check_user($username, $password)
	{
		$this->db->select('*')
		->from('staff')
		->where(array('username'=>$username,'password'=>$password));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function check_admin_name($admin_name)
	{
		$this->db->select('*')
		->from('admin')
		->where(array('admin_name'=>$admin_name));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function check_settings()
	{
		$this->db->select('*')
		->from('settings')
		->where(array('ID'=>1));
		$query = $this->db->get();
		return $query->num_rows();
		
	}
	
}