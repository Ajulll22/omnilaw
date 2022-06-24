<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
    }

    public function index()
    {
        if (!empty($this->session->userdata('loginData'))) {
            redirect('admin/kelola/');
        }

        $data['project_name'] = "Putra Arsip";
        $data['established'] = "2020";
        $this->load->view('member/Login', $data);
    }

    public function doLogin()
    {
        $dataPost = $this->input->post();
        $login = $this->m_login->checkLogin($dataPost['username'], md5($dataPost['password']));
        if ($login) {
            if ($this->session->userdata['loginData']['Level'] == "verifikator") {
                redirect('admin/pasal/');
            }
        } else {
            $this->session->set_flashdata('GagalLogin', 'Ya');
            redirect('/');
        }
    }



    function log()
    {
        $this->session->unset_userdata('loginData');
        redirect('/');
    }
}
