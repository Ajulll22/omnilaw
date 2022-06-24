<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Sastrawi\Stemmer\StemmerFactory;
use WpOrg\Requests\Requests;

class Pasal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('UU_model');
        $this->load->model('m_umum');
        $this->load->model('m_kelola');
        $this->load->model('m_kategori');
        $this->load->model('M_preprocessing');
    }

    public function index()
    {
        ini_set('memory_limit', '-1');
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['listData'] = $this->UU_model->getUU_Pasal();

        $data['userLogin'] = $this->session->userdata('loginData');
        $data['judul'] = 'Kelola Pasal';
        $data['v_content'] = "member/pasal/daftar";
        // echo "<pre>";print_r($data);die;
        $this->load->view("member/layout", $data);
    }

    public function tambah()
    {
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['v_content'] = "member/pasal/tambah";
        $this->load->view("member/layout", $data);
    }

    public function simpan()
    {
        $data['userLogin'] = $this->session->userdata('loginData');
        $post = $this->input->post();
        $dataArray = array(
            'id_tbl_uu' => $post['id_tbl_uu'],
            'uud_id' => $post['uud_id'],
            'uud_section' => $post['uud_section'],
            'uud_content' => $post['uud_content']
        );

        $insert = $this->db->insert("uu_pasal_html", $dataArray);
        if ($insert) {
            $id_uu_pasal = $this->db->insert_id();
            $prep = array(
                'id_uu_pasal' => $id_uu_pasal,
                'uud_content' => $post['uud_content']
            );
            $url = 'http://localhost:5000/undang/tambahPasal';
            $headers = array('Content-Type' => 'application/json');
            $response = Requests::post($url, $headers, json_encode($prep));
            $this->m_umum->generatePesan("Berhasil menambahkan data", "berhasil");
            echo "<script>window.location.href = '" . base_url('admin/pasal') . "';</script>";
        }
    }

    public function hapus($id)
    {
        $data['userLogin'] = $this->session->userdata('loginData');
        $delete = $this->db->delete("uu_pasal_html", array('id' => $id));
        if ($delete) {
            $this->m_umum->generatePesan("Berhasil menghapus data", "berhasil");
            redirect('admin/pasal');
        } else {
            $this->m_umum->generatePesan("Gagal menghapus data", "gagal");
            redirect('admin/pasal');
        }
    }

    public function ubah($id)
    {
        $data['userLogin'] = $this->session->userdata('loginData');
        $data['detailData'] = $this->UU_model->getPasalDetail($id);
        $data['listUU'] = $this->UU_model->getListUU();
        $data['v_content'] = "member/pasal/ubah";
        $this->load->view("member/layout", $data);
    }

    public function perbarui($id)
    {
        $data['userLogin'] = $this->session->userdata('loginData');
        $post = $this->input->post();
        $dataArray = array(
            'id_tbl_uu' => $post['id_tbl_uu'],
            'uud_id' => $post['uud_id'],
            'uud_section' => $post['uud_section'],
            'uud_content' => $post['uud_content']
        );

        $update = $this->db->update("uu_pasal_html", $dataArray, ['id' => $id]);
        if ($update) {
            $prep = array(
                'id_uu_pasal' => $id,
                'uud_content' => $post['uud_content']
            );
            $url = 'http://localhost:5000/undang/ubahPasal';
            $headers = array('Content-Type' => 'application/json');
            $response = Requests::post($url, $headers, json_encode($prep));
            $this->m_umum->generatePesan("Berhasil menambahkan data", "berhasil");
            echo "<script>window.location.href = '" . base_url('admin/pasal') . "';</script>";
        }
    }
}
