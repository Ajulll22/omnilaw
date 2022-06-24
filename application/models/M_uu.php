<?php
/**
 * 
 */
class M_uu extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getListUU(){
		$this->db->select('*');
		$this->db->from('tbl_uu');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

    public function getPasal(){
        #$sql = "SELECT tbl_uu_pasal.*,tbl_uu.* FROM tbl_uu_pasal INNER JOIN tbl_uu ON tbl_uu_pasal.id_tbl_uu=tbl_uu.id_tbl_uu WHERE uud_id REGEXP '\\bpasal\\b'";
        #echo $sql;
        // $sql = "SELECT tbl_uu_pasal.*,tbl_uu.* FROM tbl_uu_pasal INNER JOIN tbl_uu ON tbl_uu_pasal.id_tbl_uu=tbl_uu.id_tbl_uu WHERE uud_id REGEXP '\\bpasal\\b'";
		// $result=$this->db->query($sql);
        // print_r($result->result_array());
		// #$result = $result->get();getUndangUndangPasal
		// return $result->result_array();

        $this->db->select('*')->from('tbl_uu_pasal')->join('tbl_uu','tbl_uu_pasal.id_tbl_uu = tbl_uu.id_tbl_uu')->where('uud_id REGEXP',"\\bpasal\\b");
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

    public function getUu(){
		$this->db->select('*');
		$this->db->from('tbl_uu');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	function insertUu($data){        
		$result = $this->db->insert('tbl_uu', $data);
		return $result;
	}

    function insertPasal($data){        
		$result = $this->db->insert('tbl_uu_pasal', $data);
		return $result;
	}

    function isUniqueUu($uu){        
        $this->db->select('*');
		$this->db->from('tbl_uu');
		$this->db->where('uu',$uu);
		return $this->db->count_all_results();
	}
}

?>