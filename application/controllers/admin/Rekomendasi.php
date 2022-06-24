<?php

/**
 * 
 */
class Rekomendasi extends CI_Controller
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
		$data['listData'] = $this->m_status->getUU_Rekomend();
		$data['v_content'] = "member/status/daftar";
		$data['judul'] = "Rekomendasi Dokumen";
		$this->load->view("member/layout", $data);
	}

	public function unrekomend($id)
	{
		$update = $query = $this->db->where('id_tbl_uu', $id)
			->update('uu', ['status' => '2']);
		if ($update) {
			$this->m_umum->generatePesan("Berhasil membatalkan rekomendasi arsip", "berhasil");
			redirect('admin/rekomendasi');
		} else {
			$this->m_umum->generatePesan("Gagal memverifikasi arsip", "gagal");
			redirect('admin/rekomendasi');
		}
	}
}
