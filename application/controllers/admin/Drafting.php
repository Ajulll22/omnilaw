<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Sastrawi\Stemmer\StemmerFactory;

class Drafting extends CI_Controller {
   function __construct() {
        parent::__construct();
        $this->load->model('m_kelola');
        $this->load->model('m_kategori');
        $this->load->model('M_preprocessing');
        $this->load->model('casefolding_model');
        $this->load->model('tokenizing_model');
        $this->load->library('PDF2Text');
        
    }

	public function index()
	{
        $data['listData'] = $this->m_kelola->getArsip();
        $data['judul'] = 'Drafting UU';
		$data['v_content'] = "member/drafting/index";
		$this->load->view("member/layout",$data);
	}

	public function hitungCousine()
    {
       
        $dataQuery = strtolower($this->input->get('search'));
        
        $dataTF = $this->M_preprocessing->get_stemming();
        if($dataTF != NULL){
            $stemmerFactory = new StemmerFactory;
            $stemmer  = $stemmerFactory->createStemmer();

            $stemmingQuery   = $stemmer->stem($dataQuery);
            $query = explode(" ", $stemmingQuery);
            
            foreach ($dataTF as $key => $value) {
                $newTF[$key] = json_decode($value->array);
            }
            // echo "<pre>";print_r($query);die;
            

            
            //die;
            // echo"<pre>";print_r($newTF[1]);die;
            // echo"<pre>";print_r($newTF[5]);die;
            foreach ($dataTF as $key => $value) {
                foreach ($newTF[$key] as $key1 => $value) {
                    $dataTF[$key]->array = $newTF[$key];
                }
            }
            // echo"<pre>";print_r($dataTF[5]);die;
            //menghitung jumlah setiap kata
            $count = array(); 
            foreach ($dataTF as $kk => $value2) {
                $text = $value2->array;
                foreach ($text as $keykey => $value) {
                    if($text[$keykey] == "html"){
                        unset($text[$keykey]);
                    }
                }
                $count[$kk] = array_count_values($text);
            }
            
            $query1 = array_count_values($query);

            // echo "<pre>";print_r($query1);
            // echo "<pre>";print_r($count[3]);
            // die;
            
            foreach ($count as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    foreach ($query1 as $key2 => $value2) {
                        if($key1 == $key2){
                            $kataSama[$key][$key2] = $value[$key1];
                            $topCos[$key][$key2] = $value[$key1]*$query1[$key2];
                        }
                    }
                }
            }
            // echo "<pre>";print_r($kataSama[5]);die;

            //perhitungan cousine similarity
            if(!empty($kataSama) && !empty($topCos)){
            foreach ($kataSama as $key => $value) {
                if(!empty($kataSama[$key]) && !empty($topCos[$key])){
                    $newKataSama[$key] = array_sum($value);
                }
            }
            foreach ($topCos as $key => $value) {
                $newTopCos[$key] = array_sum($topCos[$key]);
            }

            // echo "<pre>";print_r($newTopCos[5]);die;
            foreach ($count as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $bottomCos[$key][$key1] = pow($value[$key1],2);
                }
            }
            foreach ($bottomCos as $key => $value) {
                $bottomCos[$key] = sqrt(array_sum($bottomCos[$key])); 
            }
            // echo"count<pre>";print_r($bottomCos[5]);
            foreach ($query1 as $key => $value) {
                $bottomQuery[$key] = pow($query1[$key],2);
            }
            $bottomQuery = sqrt(array_sum($bottomQuery));
            // echo"<pre>";print_r($bottomQuery);
            
            foreach ($bottomCos as $key => $value) {
                $fixBottomCos[$key] = $value*$bottomQuery;
            }
            // echo"<pre>";print_r($fixBottomCos);die;
            foreach ($newTopCos as $key => $value) {
                $cosSim[$key] = $newTopCos[$key]/$fixBottomCos[$key];
            }
            // echo"count<pre>";print_r($newTopCos);
            // echo"count<pre>";print_r($cosSim);die;
            
            
            $listData = $this->m_kelola->getArsip();
            foreach ($listData as $key => $value) {
                if(!empty($newKataSama[$key])){    
                    $data[$key]['id_arsip'] = $listData[$key]->id_arsip;
                    // $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                    $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                    $data[$key]['jenis_arsip'] = $listData[$key]->jenis_arsip;
                    $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                    $data[$key]['kataSama'] = $newKataSama[$key];
                    $data[$key]['cosSim'] = $cosSim[$key];
                }
                else{
                    $data[$key]['id_arsip'] = $listData[$key]->id_arsip;
                    // $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                    $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                    $data[$key]['jenis_arsip'] = $listData[$key]->jenis_arsip;
                    $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                    $data[$key]['kataSama'] = '0';
                    $data[$key]['cosSim'] = 0;
                }
            }
        }
        else{
         $listData = $this->m_kelola->getArsip();
            foreach ($listData as $key => $value) {
                $data[$key]['id_arsip'] = $listData[$key]->id_arsip;
                $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                $data[$key]['jenis_arsip'] = $listData[$key]->jenis_arsip;
                $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                $data[$key]['kataSama'] = 0;
                $data[$key]['cosSim'] = 0;
            }   
        }
        $sort = array();
            foreach ($data as $key => $row)
            {
                $sort[$key] = $row['cosSim'];
            }
            array_multisort($sort, SORT_DESC, $data);
            foreach ($data as $key => $value) {
                if($data[$key]['kataSama'] == 0){
                    unset($data[$key]);
                }
            }
            // echo "<pre>";print_r($data);die;

            
         if($this->input->get('ruu') != null){
                $id = $this->input->get('ruu');
                $arsip1 = $this->m_kelola->getArsipDetail($id);
                $arsip_html1 = $arsip1->arsip_html;        
                $queryPost2 = strtolower($this->input->get('search'));
                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );  
                // echo FCPATH.'uploads/pdftohtml/'.$arsip_html1;die;
                if(file_exists(FCPATH.'/uploads/pdftohtml/'.$arsip_html1)){
                    $newArsipPembanding1 = file_get_contents(base_url()."uploads/pdftohtml/".$arsip_html1, false, stream_context_create($arrContextOptions));
                    $newArsipPembanding2 = str_replace('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">','<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HTML>',' <HTML> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HEAD>',' <HEAD> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</HEAD>',' </HEAD> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<TITLE>',' <TITLE> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</TITLE>',' </TITLE> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<BODY>',' <BODY> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</BODY>',' </BODY> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<A name=1> ',' <A name=1> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</a>',' </a> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<br>',' <br> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<b>',' <b> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</b>',' </b> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<i>',' <i> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</i>',' </i> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<hr>',' <hr> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<IMG src="uploads/pdftohtml/'.$arsip_html1.'>',' <IMG src="uploads/pdftohtml/'.$arsip_html1.'> ',$newArsipPembanding1);
                    $stemminghtml = explode("\n", $newArsipPembanding1);
                    foreach ($stemminghtml as $key => $value) {
                        $stemminghtml[$key] = explode(" ", $value);
                    }
                    // $stemmer  = $stemmerFactory->createStemmer();
                    foreach ($stemminghtml as $key => $value) {
                        foreach ($value as $key1 => $value1) {
                            if(in_array($stemmer->stem(strtolower($stemminghtml[$key][$key1])), $query)){
                                $stemminghtml[$key][$key1] = '<span style="background-color: yellow;">'.$stemminghtml[$key][$key1].'</span>';
                            }
                        }
                    }
                    foreach ($stemminghtml as $key => $value) {
                        $stemminghtmlnew[$key] = implode(' ', $value);
                    }
                    $stemminghtmlnew = str_replace('<hr>','',$stemminghtmlnew);
                    $stemminghtmlnew = str_replace('src="','src="../',$stemminghtmlnew);
                    $stemminghtmlnew = implode("\n", $stemminghtmlnew);
                    
                    $a['judul'] = 'Drafting UU';
                    $a['data'] = $data;
                    $a['getArsip1'] = $stemminghtmlnew;
                    $a['v_content'] = "member/drafting/index";
                    $this->load->view("member/layout",$a);
                }
                else{
                    $newArsipPembanding1 = "File tidak ditemukan";
                    $a['judul'] = 'Drafting UU';
                    $a['data'] = $data;
                    $a['getArsip1'] = $stemminghtmlnew;
                    $a['v_content'] = "member/drafting/index";
                    $this->load->view("member/layout",$a);
                   
                }
            }
            else{
                $a['judul'] = 'Drafting UU';
                $a['data'] = $data;
                $a['v_content'] = "member/drafting/index";
                $this->load->view("member/layout",$a);
            
            }
        }
        else{
            redirect('admin/drafting');
        }
    }
}
