<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Sastrawi\Stemmer\StemmerFactory;

class Harmonisasi extends CI_Controller {
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
        $data['judul'] = 'Harmonisasi UU';
		$data['v_content'] = "member/harmonisasi/index";
		$this->load->view("member/layout",$data);
	}

    public function hitungSimiliarity()
    {
        if ($this->session->userdata('q')) {
            $this->session->unset_userdata('q');
        }
		// config untuk file pdf
		if (!empty($_FILES['file'])) {
            if ($this->session->userdata('id')) {
                
                $id_ar = $this->session->userdata('id');
                $doc = $this->m_kelola->getDokumenById($id_ar);
                foreach ($doc as $a) {
                    // echo "<pre>".print_r($a->file_arsip);die;
                    unlink("uploads/".$a->file_arsip);
                    unlink("uploads/pdftohtml/".$a->arsip_html);
                    $this->db->delete("tbl_dokumen" , array('id_arsip' => $id_ar ));
                }
            }
            // echo "<pre>".print_r($_FILES['file']);die;
            $post = $this->input->post();
            $dataArray = array(
                'judul_arsip' => $post['judul_dokumen'],
			 );
			$dir = "uploads";
			$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$nameFile = 'Arsip'.date("ymdhis").".".$ext;
			$config['upload_path']   = $dir;
			$config['allowed_types'] = '*';
			$config['file_name']     = $nameFile;

			$this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('file')){
	        	$error = array('error' => $this->upload->display_errors());
	        	debugCode($error);
	        }else{
	        	$dataArray['file_arsip'] = $nameFile;
	        }
	        $source_pdf="uploads/".$nameFile;
	        $dirHtml = "uploads/pdftohtml";
	        $htmlName = 'Arsip'.date("ymdhis");
	        $nameHtml = $htmlName.'html';
	        $NewDirPdftohtml = FCPATH."assets/pdftohtml";
	        $dirPdftohtml = base_url()."assets/pdftohtml";
	        $a= passthru("$NewDirPdftohtml/pdftohtml $source_pdf $dirHtml/$nameHtml",$b);
	        $dataArray['arsip_html'] = $nameHtml.'s.html';
            // $dataArray['arsip_html'] = 'Arsip210416045637htmls.html';
	        	$arrContextOptions=array(
			            "ssl"=>array(
			                "verify_peer"=>false,
			                "verify_peer_name"=>false,
			            ),
			        );  

		         $newArsipPembanding2 = file_get_contents(base_url()."uploads/pdftohtml/".$dataArray['arsip_html'], false, stream_context_create($arrContextOptions));
		         if ($newArsipPembanding2 == null) {
                    $this->session->set_flashdata('gagal','File mengandung unicode yang tidak bisa di convert');
					// echo "<script>window.location.href = '".base_url('home/similiarity')."';</script>";
					die;
			    }
			    // echo $newArsipPembanding2;die;
		        $newArsipPembanding2 = str_replace('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">','',$newArsipPembanding2);
		        $newArsipPembanding2 = str_replace('<HTML>','',$newArsipPembanding2);
		        $newArsipPembanding2 = str_replace('<HEAD>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</HEAD>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<TITLE>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</TITLE>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<BODY>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</BODY>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<A name=1>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</a>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<br>',' ',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<b>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</b>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<i>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</i>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<hr>','',$newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<IMG src="uploads/pdftohtml/'.$nameHtml.'>','',$newArsipPembanding2);

			    $dataArray['text'] = $newArsipPembanding2;
	    }
	    // if (unlink(FCPATH.$dirHtml.'/'.$htmlName.'html_ind.html') &&
	    // unlink(FCPATH.$dirHtml.'/'.$nameHtml.'.html')) {
        //     # code...
        // }else {
        //     redirect('admin/harmonisasi');
        // }
	        
	     //exit;  
	        // print_r($dataArray);die;
		$insert = $this->db->insert("tbl_dokumen" , $dataArray);
		if($insert){
			$insert_id = $this->db->insert_id();
			
		    $dataset = $this->m_kelola->getDokumenById($insert_id);
	        // echo"<pre>";print_r($dataset);die;
	        if($dataset == null) {
	            echo "Data masih kosong, silahkan tambahkan data training terlebih dahulu"; die();
	        }
	        // proses case folding
	        foreach ($dataset as $datas) {
	            $text = strtolower($datas->text);
	        }
	        // echo "<pre>";print_r($text);die;
	        //proses tokenizing
            $this->session->set_userdata('success','Dokumen sukses di set');
            // $this->session->set_userdata('q',$text);
            $texts = str_replace('</html>','',$text);
            $this->session->set_userdata('q',$texts);
            redirect('admin/harmonisasi');
            // echo"<pre>";print_r($query);die;
            // -------------------------------------
        }
    }

    public function hitungSimiliarityy()
    {
        if(isset($_POST['query'])){
            $newArray = $_POST['query'];
            $stemmerFactory = new StemmerFactory;
            $stemmer  = $stemmerFactory->createStemmer();

            $stemmingQuery   = $stemmer->stem($newArray);
            $query = explode(" ", $stemmingQuery);
        }
        if (!isset($_POST['query'])) {
            redirect('admin/harmonisasi');
        }
        $dataTF = $this->M_preprocessing->get_stemming();
        if($dataTF != NULL){          
            foreach ($dataTF as $key => $value) {
                $newTF[$key] = json_decode($value->array);
            }
            foreach ($dataTF as $key => $value) {
                foreach ($newTF[$key] as $key1 => $value) {
                    $dataTF[$key]->array = $newTF[$key];
                }
            }

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
            if(isset($_POST['kat'])){
                $listData = $this->m_kelola->getArsip($_POST['kat']);
            }else{
                $listData = $this->m_kelola->getArsip();
            }
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
                
                foreach ($listData as $key => $value) {
                    if(!empty($newKataSama[$key])){    
                        $data[$key]['id_arsip'] = $listData[$key]->id_arsip;
                        // $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                        $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;

                        $data[$key]['jenis_arsip'] = $listData[$key]->jenis_arsip;
                        $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                        $data[$key]['id_kategori'] = $listData[$key]->id_kategori;
                        $data[$key]['kataSama'] = $newKataSama[$key];
                        $data[$key]['cosSim'] = $cosSim[$key];
                    }
                    else{
                        $data[$key]['id_arsip'] = $listData[$key]->id_arsip;
                        // $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                        $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;

                        $data[$key]['jenis_arsip'] = $listData[$key]->jenis_arsip;
                        $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                        $data[$key]['id_kategori'] = $listData[$key]->id_kategori;
                        $data[$key]['kataSama'] = '0';
                        $data[$key]['cosSim'] = 0;
                    }
                }
            }
            else{
                foreach ($listData as $key => $value) {
                    $data[$key]['id_arsip'] = $listData[$key]->id_arsip;
                    $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;

                    $data[$key]['jenis_arsip'] = $listData[$key]->jenis_arsip;
                    $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                    $data[$key]['id_kategori'] = $listData[$key]->id_kategori;
                    $data[$key]['kataSama'] = 0;
                    $data[$key]['cosSim'] = 0;
                }   
            }
        $sort = array();
        $persen = 0;
        foreach ($data as $key => $row)
        {
            $sort[$key] = $row['cosSim'];
            $persen +=  number_format(100*$row['cosSim'],2);
        }
        array_multisort($sort, SORT_DESC, $data);
        foreach ($data as $key => $value) {
            if($data[$key]['kataSama'] == 0){
                unset($data[$key]);
            }
        }
        
        $kategori = $this->m_kategori->getKategori();
        $get_dokumen = $this->m_kelola->getDokumen();
        $table = array(
            'judul_dokumen' => $get_dokumen->judul_arsip,
            'banyak_kata'       => count($query),
            'persen'        => $persen,
            'tanggal'       => date('d/m/y')
        );

        // echo "<pre>".print_r($table);die;
                
        if(isset($_POST['ruu'])){
                $id = $_POST['ruu'];
                $arsip1 = $this->m_kelola->getArsipDetail($id);
                $arsip_html1 = $arsip1->arsip_html;        
                $queryPost2 = strtolower($this->input->get('search'));
                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );  
                if(file_exists(FCPATH.'/uploads/pdftohtml/'.$arsip_html1)){
                    $newArsipPembanding1 = file_get_contents(base_url()."uploads/pdftohtml/".$arsip_html1, false, stream_context_create($arrContextOptions));
                    $newArsipPembanding1 = str_replace('HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">','',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HTML>',' <HTML> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HEAD>',' <HEAD> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</HEAD>',' </HEAD> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<TITLE>',' <TITLE> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</TITLE>',' </TITLE> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<BODY>',' <BODY> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</BODY>',' </BODY> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<A name=1> ',' <A name=1> ',$newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('name=1> ','name=1>',$newArsipPembanding1);
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
                    $stopwords = $this->M_preprocessing->array_stopword();
                    foreach ($stemminghtml as $key => $value) {
                        foreach ($value as $key1 => $value1) {
                            if(in_array($stemmer->stem(strtolower($stemminghtml[$key][$key1])), $stopwords)){
                                $stemminghtml[$key][$key1] = '<span style="color: black;background-color: white; ">'.$stemminghtml[$key][$key1].'</span>';
                            }
                            if(in_array($stemmer->stem(strtolower($stemminghtml[$key][$key1])), $query)){
                                $stemminghtml[$key][$key1] = '<span style="color: black;background-color: yellow;">'.$stemminghtml[$key][$key1].'</span>';
                            }else{
                                $stemminghtml[$key][$key1] = '<span style="color: black;background-color: white; ">'.$stemminghtml[$key][$key1].'</span>';
                            }
                        }
                    }
                    foreach ($stemminghtml as $key => $value) {
                        $stemminghtmlnew[$key] = implode(' ', $value);
                    }
                    $stemminghtmlnew = str_replace('<hr>','',$stemminghtmlnew);
                    $stemminghtmlnew = str_replace('src="','src="../',$stemminghtmlnew);
                    $stemminghtmlnew = str_replace('name=1>','',$stemminghtmlnew);
                    $stemminghtmlnew = implode("\n", $stemminghtmlnew);
                    $a['judul'] = 'Harmonisasi UU';
                    $a['v_content'] = "member/harmonisasi/index";
                    $a['data'] = $data;
                    $a['getArsip1'] = $stemminghtmlnew;
                    $a['kategori'] = $kategori;
                    $a['table'] = $table;
                    $this->load->view("member/layout",$a);
                }
                else{
                    $newArsipPembanding1 = "File tidak ditemukan";
                    $a['judul'] = 'Harmonisasi UU';
                    $a['v_content'] = "member/harmonisasi/index";
                    $a['data'] = $data;
                    $a['notFound'] = 'Arsip Tidak ditemukan';
                    $a['kategori'] = $kategori;
                    $a['table'] = $table;
                    $this->load->view("member/layout",$a);
                }
            }
            else{
                // $this->load->view('member/home/similiarity', ['data'=>$data, 'kategori'=>$kategori,'table' => $table]);
                $a['judul'] = 'Harmonisasi UU';
                $a['v_content'] = "member/harmonisasi/index";
                $a['data'] = $data;
                $a['kategori'] = $kategori;
                $a['table'] = $table;
                $this->load->view("member/layout",$a);
            }
        }
        else{
            redirect('admin/harmonisasi');
        }
    }
}
