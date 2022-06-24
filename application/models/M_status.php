<?php

/**
 * 
 */
class M_status extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getArsip()
	{
		$id = array(1, 2);
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$this->db->where_in('status', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getUU()
	{
		$id = array(1, 2);
		$this->db->select('id_tbl_uu, uu, tentang, status');
		$this->db->from('uu');
		$this->db->where_in('status', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getRekomend()
	{
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$this->db->where('status', '3');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getUU_Rekomend()
	{
		$this->db->select('id_tbl_uu, uu, tentang, status');
		$this->db->from('uu');
		$this->db->where('status', '3');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	// public function getArsipDetail($id){
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_arsip');
	// 	$this->db->where('id_arsip' , $id);
	// 	$query = $this->db->get();
	// 	$result = $query->row();
	// 	return $result;
	// }
}
