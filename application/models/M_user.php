<?php
/**
 * 
 */
class M_user extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getUser(){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}

?>