<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tokenizing_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	
	public function get_all($limit_offset = array()){
		$this->db->select("*");
		$this->db->from("tbl_tokenizing");/* 
		//$this->db->where("jenis_user",2); */
		// $this->db->order_by("id_data","desc");
		// $this->db->join("tbl_data","tbl_data.data_id = tbl_tokenizing.id_data");
		if(!empty($limit_offset) && $limit_offset){
			$this->db->limit($limit_offset['limit'],$limit_offset['offset']);
		}
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function count_total(){
		$this->db->select("*");
		$this->db->from("tbl_tokenizing");
		//$this->db->where("jenis_user",2);
		$query  = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}
	
	public function get_all_array($filter){
		if($filter){
			$query = $this->db->order_by("token_id", "desc")->get_where("tbl_tokenizing",$filter);
		}else{
			$query = $this->db->order_by("token_id", "desc")->get("tbl_tokenizing");
		}
		return $query->result_array();
	}
	
	public function get_last_id(){
		$this->db->order_by('token_id', 'DESC');
		$query = $this->db->get("tbl_tokenizing",1,0);
		return $query->result();
	}
	
	public function insert($data){
		$this->db->insert('tbl_tokenizing', $data);
		return $this->db->insert_id();
	}
	
	public function update($id,$data){
		$this->db->where('token_id', $id);
		$this->db->update('tbl_tokenizing', $data);
	}
	
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('tbl_tokenizing',array('token_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->row_array();
		}
		return $response;
	}
	
	public function delete($id){
		$this->db->delete('tbl_tokenizing', array('token_id' => $id));
	}
	
	public function truncate()
	{
        $this->db->truncate('tbl_tokenizing');
	}	
	
}