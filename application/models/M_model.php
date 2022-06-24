<?php
/**
 * 
 */
class M_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getModel(){
		$this->db->select('*');
		$this->db->from('tbl_model');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getModelById($id){
		$this->db->select('*');
		$this->db->from('tbl_model');
		$this->db->where('model_id' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}

?>