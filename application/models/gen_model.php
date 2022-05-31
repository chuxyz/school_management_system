<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gen_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function insert($table, $assoc_array)
	{
		$this->db->insert($table, $assoc_array); 
	}
	public function update($table, $assoc_array, $where)
	{
		$this->db->update($table, $assoc_array, $where);
	}
	public function delete($table, $where)
	{
		$this->db->delete($table, $where);
	}
	public function get_insert_id()
	{
		return $this->db->insert_id();
	}
}