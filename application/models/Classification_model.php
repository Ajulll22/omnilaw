<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classification_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	
	public function get_all($limit_offset = array()){
		$this->db->select("*");
		$this->db->from("tbl_hitung");
		//$this->db->where("jenis_user",2);
		$this->db->order_by("kata","asc");
		if(!empty($limit_offset) && $limit_offset){
			$this->db->limit($limit_offset['limit'],$limit_offset['offset']);
		}
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function count_total($klasifikasi = null){
		$this->db->select("*");
        $this->db->from("tbl_hitung");
        if($klasifikasi !== null) {
            $this->db->where("klasifikasi", $klasifikasi);
        }
		$query  = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}
	
	public function get_all_array($filter){
		if($filter){
			$query = $this->db->order_by("hitung_id", "desc")->get_where("tbl_hitung",$filter);
		}else{
			$query = $this->db->order_by("hitung_id", "desc")->get("tbl_hitung");
		}
		return $query->result_array();
	}
	
	public function get_last_id(){
		$this->db->order_by('hitung_id', 'DESC');
		$query = $this->db->get("tbl_hitung",1,0);
		return $query->result();
	}
	
	public function insert($data){
		$this->db->insert('tbl_hitung', $data);
		return $this->db->insert_id();
	}
	
	public function update($id,$data){
		$this->db->where('hitung_id', $id);
		$this->db->update('tbl_hitung', $data);
	}
	
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('tbl_hitung',array('hitung_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->row_array();
		}
		return $response;
	}
	
	public function get_by_word($kata){
		$response = false;
		$query = $this->db->get_where('tbl_hitung',array('kata' => $kata));
		if($query && $query->num_rows()){
			$response = $query->row_array();
		}
		return $response;
	}
	
	public function delete($id){
		$this->db->delete('tbl_hitung', array('hitung_id' => $id));
    }
    
	public function truncate()
	{
        $this->db->truncate('tbl_filtering');
    }	
	
	
	
}