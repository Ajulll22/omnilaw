<?php

class UU_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getUU()
    {
        $this->db->select('*');
        $this->db->from('uu');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getId()
    {
        $this->db->select('id_tbl_uu');
        $this->db->from('uu');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getUUById($id)
    {
        $this->db->select('*');
        $this->db->from('uu');
        $this->db->where('id_tbl_uu', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getUUDetail($id)
    {
        $this->db->select('*');
        $this->db->from('uu');
        $this->db->join('tbl_kategori', 'id_kategori=kategori_id');
        $this->db->where('id_tbl_uu', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function getUU_Pasal()
    {
        $this->db->select('uu_pasal_html.*, uu.uu');
        $this->db->from('uu_pasal_html');
        $this->db->join('uu', 'uu_pasal_html.id_tbl_uu=uu.id_tbl_uu');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(100);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getPasalDetail($id)
    {
        $this->db->select('uu_pasal_html.*, uu.uu');
        $this->db->from('uu_pasal_html');
        $this->db->join('uu', 'uu_pasal_html.id_tbl_uu=uu.id_tbl_uu');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function getArsip($kat = '')
    {
        $this->db->select('id_tbl_uu, uu, tentang, status, file_arsip, tbl_kategori.nama_kategori');
        $this->db->from('uu');
        $this->db->join('tbl_kategori', 'id_kategori=kategori_id');
        if ($kat != null) {
            $this->db->where_in('id_kategori', $kat);
        }
        $this->db->order_by('id_tbl_uu', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }


    public function getListUU()
    {
        $this->db->select('id_tbl_uu, uu');
        $this->db->from('uu');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
}
