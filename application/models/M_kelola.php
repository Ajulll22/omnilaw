<?php
/**
 * 
 */
class M_kelola extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function countWordPasal($keyword=''){
		// $sql = "select id_tbl_uu,count(*) as total_kata_pasal from tbl_uu_pasal WHERE uud_content LIKE '%".$keyword."%' AND (uud_section='pasal' OR uud_section='ayat'  OR uud_section='angka' OR uud_section='huruf') GROUP BY id_tbl_uu ORDER BY total_kata_pasal DESC";
		$sql = "select id_tbl_uu,count(*) as total_kata_pasal from tbl_uu_pasal WHERE uud_content REGEXP '\\\b".$keyword."\\\b' AND uud_id REGEXP '\\\bpasal~\\\b' GROUP BY id_tbl_uu ORDER BY total_kata_pasal DESC";
		$result=$this->db->query($sql);
		return $result->result_array();
	}

	public function countTotalWord($keyword=''){
		// $sql = "select count(*) as total_word from tbl_uu_pasal WHERE uud_content LIKE '%".$keyword."%' AND (uud_section='pasal' OR uud_section='ayat'  OR uud_section='angka' OR uud_section='huruf')";
		$sql = "select count(*) as total_word from tbl_uu_pasal WHERE uud_content LIKE '%".$keyword."%'AND uud_id LIKE '%pasal~%'";
		$result=$this->db->query($sql);
		return $result->result_array();
	}

	public function getDrafting($keyword=''){
		if($keyword == ''){
			$sql = "SELECT tbl_uu_pasal.*,tbl_uu.*,count(*) as total_kata_pasal FROM tbl_uu_pasal INNER JOIN tbl_uu ON tbl_uu_pasal.id_tbl_uu=tbl_uu.id_tbl_uu  WHERE tbl_uu_pasal.uud_content LIKE '".$keyword."' GROUP BY tbl_uu_pasal.id_tbl_uu ORDER BY total_kata_pasal DESC";
		}else{
			// $sql = "SELECT tbl_uu_pasal.*,tbl_uu.*,count(*) as total_kata_pasal FROM tbl_uu_pasal INNER JOIN tbl_uu ON tbl_uu_pasal.id_tbl_uu=tbl_uu.id_tbl_uu  WHERE tbl_uu_pasal.uud_content LIKE '%".$keyword."%' GROUP BY tbl_uu_pasal.id_tbl_uu ORDER BY total_kata_pasal DESC";
			$sql = "SELECT tbl_uu_pasal.*,tbl_uu.*,count(*) as total_kata_pasal FROM tbl_uu_pasal INNER JOIN tbl_uu ON tbl_uu_pasal.id_tbl_uu=tbl_uu.id_tbl_uu  WHERE tbl_uu_pasal.uud_content REGEXP '\\\b".$keyword."\\\b' AND tbl_uu_pasal.uud_id LIKE '%pasal~%' GROUP BY tbl_uu_pasal.id_tbl_uu ORDER BY total_kata_pasal DESC";
		}
		
		#echo $sql;
		$result=$this->db->query($sql);
		#$result = $result->get();
		return $result->result_array();
	}

	public function getUndangUndangDetail($id = 1){
		$sql = "SELECT * FROM `tbl_uu` WHERE id_tbl_uu = ".$id;
		$result=$this->db->query($sql);
		return $result->result_array();

	}

	public function getUndangUndangPasal($word_search,$uu_id){
		$this->db->select('*')->from('tbl_uu_pasal')->where('uud_content REGEXP',"\\b$word_search\\b")->where('id_tbl_uu',$uu_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getUUPasal($pasal,$id_tbl_uu){
		$this->db->select('*')->from('tbl_uu_pasal')->where('uud_id REGEXP',"\\b$pasal\\b")->where('id_tbl_uu',$id_tbl_uu);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getArsip($kat=''){
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$this->db->join('tbl_kategori', 'id_kategori=kategori_id');
		if($kat !=null){
			$this->db->where_in('id_kategori', $kat);	
		}
		$this->db->order_by('id_arsip','ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getArsipNow($kat=''){
		$this->db->select('*');
		$this->db->from('uu');
		$this->db->join('tbl_kategori', 'id_kategori=kategori_id');
		if($kat !=null){
			$this->db->where_in('id_kategori', $kat);	
		}
		$this->db->order_by('id_tbl_uu','ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getArsip2($kat='', $ids){
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$this->db->join('tbl_kategori', 'id_kategori=kategori_id');
		$this->db->where_in('tbl_arsip.id_arsip', $ids);
		if($kat !=null){
			die("OWO");
			$this->db->where_in('id_kategori', $kat);	
		}
		$this->db->order_by('tbl_arsip.id_arsip','ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getArsipSteming($kat=''){
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$this->db->join('tbl_kategori', 'id_kategori=kategori_id');
		$this->db->join('tbl_stemming', 'tbl_stemming.id_arsip = tbl_arsip.id_arsip');
		if($kat !=null){
			$this->db->where_in('id_kategori', $kat);	
		}
		$this->db->order_by('tbl_arsip.id_arsip','ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getArsipPembanding(){
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getArsipDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$this->db->join('tbl_kategori', 'id_kategori=kategori_id');
		$this->db->where('id_arsip' , $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function getArsipKategori($id){
		$this->db->select('id_arsip, judul_arsip, jenis_arsip, file_arsip, status, arsip_html, id_kategori, nama_kategori');
		$this->db->from('tbl_arsip');
		$this->db->join('tbl_kategori', 'id_kategori=kategori_id');
		$this->db->where('id_kategori' , $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function arsipCosine($id){
		$this->db->select('id_arsip, judul_arsip, jenis_arsip, file_arsip, status');
		$this->db->from('tbl_arsip');
		$this->db->where('id_arsip !=', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function totalKata(){
		$this->db->select('array');
		$this->db->from('tbl_stemming');
		// $this->db->where('id_arsip !=', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getArsipById($id){
		$this->db->select('*');
		$this->db->from('tbl_arsip');
		$this->db->where('id_arsip' , $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function getDokumenById($id){
		$this->db->select('*');
		$this->db->from('tbl_dokumen');
		$this->db->where('id_arsip' , $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getDokumen(){
		$this->db->select('*');
		$this->db->from('tbl_dokumen');
		$this->db->order_by('id_arsip','DESC');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}
