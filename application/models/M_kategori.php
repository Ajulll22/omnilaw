<?php
/**
 * 
 */
class M_kategori extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getKategori(){
		$this->db->select('*');
		$this->db->from('tbl_kategori');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getKategoriDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_kategori');
		$this->db->where('kategori_id' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}

?>