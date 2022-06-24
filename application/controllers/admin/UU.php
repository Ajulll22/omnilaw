<?php

/**
 * 
 */
class UU extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_umum');
		$this->load->model('m_kelola');
		$this->load->model('m_kategori');
		$this->load->model('m_uu');
		$this->load->library('PDF2Text');
		$this->load->model('M_preprocessing');
	}

	public function insertPasal(){
        $post = $this->input->post();
        $data = array(
            'id_tbl_uu' => $post['peraturan'],
            'uud_id' => $post['pasal'],
            'uud_section' => $post['turunan'],
            'uud_content' => $post['isi']
        );
        $result = $this->m_uu->insertPasal($data);
		if($result){
			$this->m_umum->generatePesan("Berhasil menambah data","berhasil");
			redirect('admin/UU/pasal');
		}else{
			$this->m_umum->generatePesan("Gagal menambah data","gagal");
			redirect('admin/UU/pasal/addPasal');
		}
	}

	public function DeletePasal($id){
		$delete = $this->db->delete("tbl_uu_pasal" , array('id' => $id ));
		if($delete){
			$this->m_umum->generatePesan("Berhasil menghapus data","berhasil");
			redirect('admin/UU/pasal');
		}else{
			$this->m_umum->generatePesan("Gagal menghapus data","gagal");
			redirect('admin/UU');
		}
	}

    public function insertUu(){
        $post = $this->input->post();
        $data = array(
            'uu' => $post['peraturan'],
            'tentang' => $post['tentang']
        );

		if($this->m_uu->isUniqueUu($post['peraturan']) > 0){
			$this->m_umum->generatePesan("Data sudah ada","gagal");
			redirect('admin/UU/addUu');
			return 0;
		}

        $result = $this->m_uu->insertUu($data);
		if($result){
			$this->m_umum->generatePesan("Berhasil menambah data","berhasil");
			redirect('admin/UU/uu');
		}else{
			$this->m_umum->generatePesan("Gagal menambah data","gagal");
			redirect('admin/UU/addUu');
		}
	}

	public function DeleteUU($id){
		$delete = $this->db->delete("tbl_uu" , array('id_tbl_uu' => $id ));
		if($delete){
			$this->m_umum->generatePesan("Berhasil menghapus data","berhasil");
			redirect('admin/UU/uu');
		}else{
			$this->m_umum->generatePesan("Gagal menghapus data","gagal");
			redirect('admin/user');
		}
	}

    public function addPasal(){
		$data['dropdown_uu'] = $this->m_uu->getListUU();
		$data['v_content'] = "member/admin/uu";
		$data['judul'] = "Data Peraturan";

		$data['v_content'] = "member/uu/isi_pasal/add";
		$this->load->view("member/layout" , $data);
	}

    public function addUu(){
		$data['v_content'] = "member/uu/add";
		$this->load->view("member/layout" , $data);
	}

    public function uu(){
		
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_uu->getUu();
		$data['v_content'] = "member/admin/uu";
		$data['judul'] = "Data Peraturan";
		// echo "<pre>";print_r($data);die;
		// $this->load->view("admin/UU/uu");

		$data['v_content'] = "member/uu/daftar";
		$this->load->view("member/layout" , $data);
	}
	
	public function pasal(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['listData'] = $this->m_uu->getPasal();
		$data['v_content'] = "member/admin/uu/pasal";
		$data['judul'] = "Detail Peraturan";
		// echo "<pre>";print_r($data);die;
		// $this->load->view("admin/UU/uu");
		$data['v_content'] = "member/uu/isi_pasal/daftar";
		$this->load->view("member/layout" , $data);
	}

	public function form_AddJudulPasal(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$dataArray = array(
			'peraturan' => $post['uu'],
			'tentang' => $post['tentang'],
			'status' =>'1'
			 );
	}

	public function form_AddPasal(){
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$dataArray = array(
			'peraturan' => $post['uu_id'],
			'bagian' => $post['uud_section'],
			'isi' => $post['uud_content'],
			'status' =>'1'
			 );
	}
}
