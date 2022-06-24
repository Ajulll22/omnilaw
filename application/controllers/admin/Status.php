<?php

/**
 * 
 */
class Status extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_status');
	}

	public function index()
	{
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_status->getUU();
		$data['v_content'] = "member/status/daftar";
		$data['judul'] = "Status Dokumen";
		$this->load->view("member/layout", $data);
	}

	public function verified($id)
	{
		$update = $query = $this->db->where('id_tbl_uu', $id)
			->update('uu', ['status' => '2']);
		if ($update) {
			$this->m_umum->generatePesan("Berhasil memverifikasi arsip", "berhasil");
			redirect('admin/status');
		} else {
			$this->m_umum->generatePesan("Gagal memverifikasi arsip", "gagal");
			redirect('admin/status');
		}
	}
	public function rekomend($id)
	{
		$update = $query = $this->db->where('id_tbl_uu', $id)
			->update('uu', ['status' => '3']);
		if ($update) {
			$this->m_umum->generatePesan("Berhasil merekomendasikan arsip", "berhasil");
			redirect('admin/status');
		} else {
			$this->m_umum->generatePesan("Gagal merekomendasikan arsip", "gagal");
			redirect('admin/status');
		}
	}
}
