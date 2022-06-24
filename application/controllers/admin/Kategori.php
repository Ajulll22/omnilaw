<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Sastrawi\Stemmer\StemmerFactory;

class Kategori extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_kategori');
	}

	public function index(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_kategori->getKategori();
		$data['judul'] = 'Kelola Kategori';
		$data['v_content'] = "member/kategori/daftar";
		// echo "<pre>";print_r($data);die;
		$this->load->view("member/layout",$data);
	}


	public function add(){
		$data['v_content'] = "member/kategori/add";
		$this->load->view("member/layout" , $data);
	}
	
	public function doAdd(){

		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		
	    $insert = $this->db->insert('tbl_kategori', $post);
	    if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			echo "<script>window.location.href = '".base_url('admin/kategori')."';</script>";
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/kategori/add');
		}
	}

	public function edit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['detailData'] = $this->m_kategori->getKategoriDetail($id);
		$data['v_content'] = "member/kategori/edit";
		// echo"<pre>";print_r($data);die;
		$this->load->view("member/layout" , $data);
	}

	public function doEdit($id){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
    	$update = $this->db->update("tbl_kategori" , $post, ['kategori_id'=>$id]);

    	if($update){
			$this->m_umum->generatePesan("Berhasil mengubah data","berhasil");
			echo "<script>window.location.href = '".base_url('admin/kategori')."';</script>";
		}
		else{
			$this->m_umum->generatePesan("Gagal mengubah data","gagal");
			redirect('admin/kategori/add');	
		}
	}

	public function doDelete($id){
		$delete = $this->db->delete("tbl_kategori" , array('kategori_id' => $id ));
		if($delete){
			$this->m_umum->generatePesan("Berhasil menghapus data","berhasil");
			redirect('admin/kategori');
		
		}else{
			$this->m_umum->generatePesan("Gagal menghapus data","gagal");
			redirect('admin/kategori');
		}
	}
}
