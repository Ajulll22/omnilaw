<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Sastrawi\Stemmer\StemmerFactory;
use WpOrg\Requests\Requests;

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UU_model');
        $this->load->model('m_kelola');
        $this->load->model('m_kategori');
        $this->load->model('M_preprocessing');
        $this->load->model('casefolding_model');
        $this->load->model('tokenizing_model');
        $this->load->library('PDF2Text');
        $this->load->helper(array('form', 'url'));
    }

    public function hayu()
    {
        // $res = array(
        //     array(
        //         "test" => "test",
        //         "abc" => "abs"
        //     ),
        //     array(
        //         "test" => "aaaa",
        //         "abc" => "abb"
        //     )
        // );
        $res = [];
        $array1 = [];
        $array1['id_uu_pasal'] = 1293;
        $array1['uud_content'] = "apakah kita anak dajjal";
        array_push($res, $array1);

        $array = [];
        $array['id_uu_pasal'] = 1294;
        $array['uud_content'] = "apakah kita januari anak setan";
        array_push($res, $array);

        $url = 'http://localhost:8080/v1/preprocessing_bulk';
        $headers = array('Content-Type' => 'application/json');
        $response = Requests::post($url, $headers, json_encode(['data' => $res]));

        var_dump($res);
    }

    public function coba()
    {
        $kalimat = $this->input->post('kalimat');
        $kategori = $this->input->post('kategori');
        $url = 'http://localhost:5000/wordvecPasal';
        $headers = array('Content-Type' => 'application/json');
        $search = array(
            'kalimat' => $kalimat,
            'kategori' => $kategori
        );
        $response = Requests::post($url, $headers, json_encode($search));
        $hasil = json_decode($response->body);
        $data['hasil'] = $hasil;
        $view = $this->load->view('member/home/tabel', $data);
        echo json_encode($view);
    }

    public function pasalDrafting()
    {
        $data['kategori'] = $this->m_kategori->getKategori();
        $this->load->view('member/home/test', $data);
    }

    public function harmonisasiPasal($rank)
    {
        $rank = (int)$rank - 1;
        $data['hasil'] = json_decode(file_get_contents('http://localhost:5000/harmonisasi/detail/' . $rank));
        $this->load->view('member/home/hasil_pasal', $data);
    }

    public function harmonisasi()
    {
        if ($this->input->method() === 'post') {
            $file_name = "pembanding";
            $config['upload_path']          = FCPATH . '/uploads/hitung/';
            $config['allowed_types']        = 'pdf';
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;
            $config['max_size']             = 20048; // 20MB

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('pembanding')) {
                $error = $this->upload->display_errors();
                echo $error;
            } else {
                $uploaded_data = $this->upload->data();
                $data['hasil'] = json_decode(file_get_contents('http://localhost:5000/harmonisasi/wordvec/' . $file_name));
                $view = $this->load->view('member/home/hasil', $data);
                echo json_encode($view);
                // echo"<pre>";print_r($data);die;
            }
        } else {
            $data['listData'] = $this->m_kelola->getArsip();
            // echo"<pre>";print_r($data);die;
            $this->load->view('member/home/harmonisasi', $data);
        }
    }

    public function wordvec()
    {
        $data['hasil'] = json_decode(file_get_contents('http://localhost:5000/drafting/pajak'));
        $this->load->view('member/home/wordvec', $data);
    }

    public function show_detail_pasal()
    {
        $uu_id = $this->input->get();

        $data['uu_id'] = $uu_id['id'];
        $word_search = $uu_id['search'];
        $data['detail_uu'] = $this->m_kelola->getUndangUndangDetail($uu_id['id']);

        $uud_pasal_raw = $this->m_kelola->getUndangUndangPasal($word_search, $uu_id['id']);
        if (count($uud_pasal_raw) == 0) {
            echo "data not found";
            return;
        }
        foreach ($uud_pasal_raw as $upr) :
            $tmp = explode(" ", $upr->uud_id);
            for ($i = 0; $i < count($tmp); $i++) :
                $startString = "pasal~";
                $string = $tmp[$i];
                $len = strlen($startString);
                if (substr($string, 0, $len) === $startString) :
                    $tmp_array[$string] = "";
                #echo $string;
                endif;
            endfor;

        endforeach;
        #echo print_r(array_keys($tmp_array));
        $pasal_array = array_keys($tmp_array);
        // foreach($pasal_array as $pa):
        //     echo $pa."<br>";
        // endforeach;
        $data['pasal_array'] = $pasal_array;
        $this->load->view('member/home/detail_pasal', $data);
    }

    public function get_pasal()
    {
        $pasal = $this->input->get('pasal');
        $id_tbl_uu = $this->input->get('id');
        $pasal_data = $this->m_kelola->getUUPasal($pasal, $id_tbl_uu);
        $pasalstring = "";

        foreach ($pasal_data as $pd) :
            $pasalstring .= $pd->uud_content . " ";
        endforeach;
        echo $pasalstring;
        #echo json_encode($pasalstring);
    }


    public function drafting()
    {
        $search_keyword = $this->input->get();
        if ($search_keyword != Null) {
            $data['search_results'] = $this->m_kelola->getDrafting($search_keyword['search']);
            $data['total_word'] = $this->m_kelola->countTotalWord($search_keyword['search']);
            $data['word_tiap_pasal'] = $this->m_kelola->countWordPasal($search_keyword['search']);

            #var_dump($data['total_word']);
        } else {
            $data['search_results'] = $this->m_kelola->getDrafting();
        }

        #echo "<pre>";print_r($search_results);die;

        // foreach($search_results as $sr){
        //     print_r($sr['uu']);
        // }
        //print($search_results);
        $this->load->view('member/home/drafting', $data);

        // $this->load->view('member/home/drafting');
    }




    // public function error()
    // {
    //     // $data['heading'] = "Page Not Found";
    //     // $data['message'] = "404 Halaman tidak ditemukan";
    //     // echo "<script>alert('Halaman tidak ditemukan');window.location=".base_url('home')."</script>";
    //     redirect("home");
    // }

    public function index()
    {
        // $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        // $stemmer  = $stemmerFactory->createStemmer();

        // // stem
        // $sentence = 'Perekonomian Indonesia sedang dalam pertumbuhan yang membanggakan';
        // $output   = $stemmer->stem($sentence);

        // echo $output . "\n";
        $this->load->view('member/home/dashboard');
    }
    public function profil()
    {
        $this->load->view('member/home/profile');
    }
    public function arsip()
    {
        $data['listData'] = $this->UU_model->getArsip();
        // echo "<pre>";print_r($data);die;
        $this->load->view('member/home/arsip', $data);
    }
    public function informasi()
    {
        $this->load->view('member/home/informasi');
    }
    public function cousine()
    {
        $data['listData'] = $this->m_kelola->getArsip();
        // echo"<pre>";print_r($data);die;
        $this->load->view('member/home/cousine', $data);
    }

    public function hitungCousine()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        $dataQuery = strtolower($this->input->get('search'));

        $dataTF = $this->M_preprocessing->get_stemming();
        if ($dataTF != NULL) {
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
                    if ($text[$keykey] == "html") {
                        unset($text[$keykey]);
                    }
                }
                $count[$kk] = array_count_values($text);
            }

            $query1 = array_count_values($query);

            // echo "<pre>";print_r($query1);die;;
            // echo "<pre>";print_r($count);
            // die;

            foreach ($count as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    foreach ($query1 as $key2 => $value2) {
                        if ($key1 == $key2) {
                            $kataSama[$key][$key2] = $value[$key1];
                            $topCos[$key][$key2] = $value[$key1] * $query1[$key2];
                        }
                    }
                }
            }
            // echo "<pre>";print_r($kataSama[5]);die;

            //perhitungan cousine similarity
            if (!empty($kataSama) && !empty($topCos)) {
                foreach ($kataSama as $key => $value) {
                    if (!empty($kataSama[$key]) && !empty($topCos[$key])) {
                        $newKataSama[$key] = array_sum($value);
                    }
                }
                foreach ($topCos as $key => $value) {
                    $newTopCos[$key] = array_sum($topCos[$key]);
                }

                // echo "<pre>";print_r($newTopCos[5]);die;
                foreach ($count as $key => $value) {
                    foreach ($value as $key1 => $value1) {
                        $bottomCos[$key][$key1] = pow($value[$key1], 2);
                    }
                }
                foreach ($bottomCos as $key => $value) {
                    $bottomCos[$key] = sqrt(array_sum($bottomCos[$key]));
                }
                // echo"count<pre>";print_r($bottomCos[5]);
                foreach ($query1 as $key => $value) {
                    $bottomQuery[$key] = pow($query1[$key], 2);
                }
                $bottomQuery = sqrt(array_sum($bottomQuery));
                // echo"<pre>";print_r($bottomQuery);

                foreach ($bottomCos as $key => $value) {
                    $fixBottomCos[$key] = $value * $bottomQuery;
                }
                // echo"<pre>";print_r($fixBottomCos);die;
                foreach ($newTopCos as $key => $value) {
                    $cosSim[$key] = $newTopCos[$key] / $fixBottomCos[$key];
                }
                // echo"count<pre>";print_r($newTopCos);
                // echo"count<pre>";print_r($cosSim);die;


                $listData = $this->m_kelola->getArsipNow();
                foreach ($listData as $key => $value) {
                    if (!empty($newKataSama[$key])) {
                        $data[$key]['id_tbl_uu'] = $listData[$key]->id_tbl_uu;
                        // $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                        $data[$key]['uu'] = $listData[$key]->uu;
                        $data[$key]['tentang'] = $listData[$key]->tentang;
                        $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                        $data[$key]['kataSama'] = $newKataSama[$key];
                        $data[$key]['cosSim'] = $cosSim[$key];
                    } else {
                        $data[$key]['id_tbl_uu'] = $listData[$key]->id_tbl_uu;
                        // $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                        $data[$key]['uu'] = $listData[$key]->uu;
                        $data[$key]['tentang'] = $listData[$key]->tentang;
                        $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                        $data[$key]['kataSama'] = '0';
                        $data[$key]['cosSim'] = 0;
                    }
                }
            } else {
                $listData = $this->m_kelola->getArsipNow();
                foreach ($listData as $key => $value) {
                    $data[$key]['id_tbl_uu'] = $listData[$key]->id_tbl_uu;
                    $data[$key]['uu'] = $listData[$key]->uu;
                    $data[$key]['tentang'] = $listData[$key]->tentang;
                    $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                    $data[$key]['kataSama'] = 0;
                    $data[$key]['cosSim'] = 0;
                }
            }
            $sort = array();
            foreach ($data as $key => $row) {
                $sort[$key] = $row['cosSim'];
            }
            array_multisort($sort, SORT_DESC, $data);
            foreach ($data as $key => $value) {
                if ($data[$key]['kataSama'] == 0) {
                    unset($data[$key]);
                }
            }
            // echo "<pre>";print_r($data);die;


            if ($this->input->get('ruu') != null) {
                $id = $this->input->get('ruu');
                $arsip1 = $this->m_kelola->getArsipDetail($id);
                $arsip_html1 = $arsip1->arsip_html;
                $queryPost2 = strtolower($this->input->get('search'));
                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );
                // echo FCPATH.'uploads/pdftohtml/'.$arsip_html1;die;
                if (file_exists(FCPATH . '/uploads/pdftohtml/' . $arsip_html1)) {
                    $newArsipPembanding1 = file_get_contents(base_url() . "uploads/pdftohtml/" . $arsip_html1, false, stream_context_create($arrContextOptions));
                    $newArsipPembanding2 = str_replace('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HTML>', ' <HTML> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HEAD>', ' <HEAD> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</HEAD>', ' </HEAD> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<TITLE>', ' <TITLE> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</TITLE>', ' </TITLE> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<BODY>', ' <BODY> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</BODY>', ' </BODY> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<A name=1> ', ' <A name=1> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</a>', ' </a> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<br>', ' <br> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<b>', ' <b> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</b>', ' </b> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<i>', ' <i> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</i>', ' </i> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<hr>', ' <hr> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<IMG src="uploads/pdftohtml/' . $arsip_html1 . '>', ' <IMG src="uploads/pdftohtml/' . $arsip_html1 . '> ', $newArsipPembanding1);
                    $stemminghtml = explode("\n", $newArsipPembanding1);
                    foreach ($stemminghtml as $key => $value) {
                        $stemminghtml[$key] = explode(" ", $value);
                    }
                    // $stemmer  = $stemmerFactory->createStemmer();
                    foreach ($stemminghtml as $key => $value) {
                        foreach ($value as $key1 => $value1) {
                            if (in_array($stemmer->stem(strtolower($stemminghtml[$key][$key1])), $query)) {
                                $stemminghtml[$key][$key1] = '<span style="background-color: yellow;">' . $stemminghtml[$key][$key1] . '</span>';
                            }
                        }
                    }
                    foreach ($stemminghtml as $key => $value) {
                        $stemminghtmlnew[$key] = implode(' ', $value);
                    }
                    $stemminghtmlnew = str_replace('<hr>', '', $stemminghtmlnew);
                    $stemminghtmlnew = str_replace('src="', 'src="../', $stemminghtmlnew);
                    $stemminghtmlnew = implode("\n", $stemminghtmlnew);

                    $this->load->view('member/home/cousine', ['data' => $data, 'getArsip1' => $stemminghtmlnew]);
                } else {
                    $newArsipPembanding1 = "File tidak ditemukan";
                    $this->load->view('member/home/cousine', ['data' => $data, 'getArsip1' => $stemminghtmlnew]);
                }
            } else {
                $this->load->view('member/home/cousine', ['data' => $data]);
            }
        } else {
            redirect('home/cousine');
        }
    }

    public function similiarity()
    {
        $this->load->view('member/home/similiarity');
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
                    unlink("uploads/" . $a->file_arsip);
                    unlink("uploads/pdftohtml/" . $a->arsip_html);
                    $this->db->delete("tbl_dokumen", array('id_arsip' => $id_ar));
                }
            }

            $post = $this->input->post();
            $dataArray = array(
                'judul_arsip' => $post['judul_dokumen'],
            );
            $dir = "uploads";
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $nameFile = 'Arsip' . date("ymdhis") . "." . $ext;
            $config['upload_path']   = $dir;
            $config['allowed_types'] = '*';
            $config['file_name']     = $nameFile;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                debugCode($error);
            } else {
                $dataArray['file_arsip'] = $nameFile;
            }
            $source_pdf = "uploads/" . $nameFile;
            $dirHtml = "uploads/pdftohtml";
            $htmlName = 'Arsip' . date("ymdhis");
            $nameHtml = $htmlName . 'html';
            $NewDirPdftohtml = FCPATH . "assets/pdftohtml";
            $dirPdftohtml = base_url() . "assets/pdftohtml";
            $a = passthru("$NewDirPdftohtml/pdftohtml $source_pdf $dirHtml/$nameHtml", $b);
            $dataArray['arsip_html'] = $nameHtml . 's.html';
            // $dataArray['arsip_html'] = 'Arsip210419100538htmls.html';
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            // echo "<pre>".print_r($_FILES['file']);die;
            $newArsipPembanding2 = file_get_contents(base_url() . "uploads/pdftohtml/" . $dataArray['arsip_html'], false, stream_context_create($arrContextOptions));
            if ($newArsipPembanding2 == null) {
                $this->session->set_flashdata('gagal', 'File mengandung unicode yang tidak bisa di convert');
                // echo "<script>window.location.href = '".base_url('home/similiarity')."';</script>";
                die;
            }
            // echo $newArsipPembanding2;die;
            $newArsipPembanding2 = str_replace('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<HTML>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<HEAD>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('</HEAD>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<TITLE>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('</TITLE>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<BODY>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('</BODY>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<A name=1>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('</a>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<br>', ' ', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<b>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('</b>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<i>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('</i>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<hr>', '', $newArsipPembanding2);
            $newArsipPembanding2 = str_replace('<IMG src="uploads/pdftohtml/' . $nameHtml . '>', '', $newArsipPembanding2);

            $dataArray['text'] = $newArsipPembanding2;
        }
        // if (unlink(FCPATH.$dirHtml.'/'.$htmlName.'html_ind.html') &&
        // unlink(FCPATH.$dirHtml.'/'.$nameHtml.'.html')) {
        //     # code...
        // }else {
        //     redirect('home/similiarity');
        // }

        //exit;  
        // print_r($dataArray);die;
        $insert = $this->db->insert("tbl_dokumen", $dataArray);
        if ($insert) {
            $insert_id = $this->db->insert_id();

            $dataset = $this->m_kelola->getDokumenById($insert_id);
            // echo"<pre>";print_r($dataset);die;
            if ($dataset == null) {
                echo "Data masih kosong, silahkan tambahkan data training terlebih dahulu";
                die();
            }
            // proses case folding
            foreach ($dataset as $datas) {
                $text = strtolower($datas->text);
            }
            // echo "<pre>";print_r($text);die;
            //proses tokenizing
            $this->session->set_userdata('success', 'Dokumen sukses di set');
            // $this->session->set_userdata('q',$text);
            $texts = str_replace('</html>', '', $text);
            $this->session->set_userdata('q', $texts);
            redirect('home/similiarity');
            // echo"<pre>";print_r($query);die;
            // -------------------------------------
        }
    }

    public function hitungSimiliarityy()
    {
        if (isset($_POST['query'])) {
            $newArray = $_POST['query'];
            $stemmerFactory = new StemmerFactory;
            $stemmer  = $stemmerFactory->createStemmer();

            $stemmingQuery   = $stemmer->stem($newArray);
            $query = explode(" ", $stemmingQuery);
        }
        if (!isset($_POST['query'])) {
            redirect('home/similiarity');
        }
        $dataTF = $this->M_preprocessing->get_stemming();
        if ($dataTF != NULL) {
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
                    if ($text[$keykey] == "html") {
                        unset($text[$keykey]);
                    }
                }
                $count[$kk] = array_count_values($text);
            }

            $query1 = array_count_values($query);

            foreach ($count as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    foreach ($query1 as $key2 => $value2) {
                        if ($key1 == $key2) {
                            $kataSama[$key][$key2] = $value[$key1];
                            $topCos[$key][$key2] = $value[$key1] * $query1[$key2];
                        }
                    }
                }
            }
            // echo "<pre>";print_r($kataSama[5]);die;

            //perhitungan cousine similarity
            if (isset($_POST['kat'])) {
                $listData = $this->m_kelola->getArsip($_POST['kat']);
            } else {
                $listData = $this->m_kelola->getArsip();
            }
            if (!empty($kataSama) && !empty($topCos)) {
                foreach ($kataSama as $key => $value) {
                    if (!empty($kataSama[$key]) && !empty($topCos[$key])) {
                        $newKataSama[$key] = array_sum($value);
                    }
                }
                foreach ($topCos as $key => $value) {
                    $newTopCos[$key] = array_sum($topCos[$key]);
                }

                // echo "<pre>";print_r($newTopCos[5]);die;
                foreach ($count as $key => $value) {
                    foreach ($value as $key1 => $value1) {
                        $bottomCos[$key][$key1] = pow($value[$key1], 2);
                    }
                }
                foreach ($bottomCos as $key => $value) {
                    $bottomCos[$key] = sqrt(array_sum($bottomCos[$key]));
                }
                // echo"count<pre>";print_r($bottomCos[5]);
                foreach ($query1 as $key => $value) {
                    $bottomQuery[$key] = pow($query1[$key], 2);
                }
                $bottomQuery = sqrt(array_sum($bottomQuery));
                // echo"<pre>";print_r($bottomQuery);

                foreach ($bottomCos as $key => $value) {
                    $fixBottomCos[$key] = $value * $bottomQuery;
                }
                // echo"<pre>";print_r($fixBottomCos);die;
                foreach ($newTopCos as $key => $value) {
                    $cosSim[$key] = $newTopCos[$key] / $fixBottomCos[$key];
                }

                foreach ($listData as $key => $value) {
                    if (!empty($newKataSama[$key])) {
                        $data[$key]['id_arsip'] = $listData[$key]->id_arsip;
                        // $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;
                        $data[$key]['judul_arsip'] = $listData[$key]->judul_arsip;

                        $data[$key]['jenis_arsip'] = $listData[$key]->jenis_arsip;
                        $data[$key]['kategori'] = $listData[$key]->nama_kategori;
                        $data[$key]['id_kategori'] = $listData[$key]->id_kategori;
                        $data[$key]['kataSama'] = $newKataSama[$key];
                        $data[$key]['cosSim'] = $cosSim[$key];
                    } else {
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
            } else {
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
            foreach ($data as $key => $row) {
                $sort[$key] = $row['cosSim'];
                $persen +=  number_format(100 * $row['cosSim'], 2);
            }
            array_multisort($sort, SORT_DESC, $data);
            foreach ($data as $key => $value) {
                if ($data[$key]['kataSama'] == 0) {
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

            if (isset($_POST['ruu'])) {
                $id = $_POST['ruu'];
                $arsip1 = $this->m_kelola->getArsipDetail($id);
                $arsip_html1 = $arsip1->arsip_html;
                $queryPost2 = strtolower($this->input->get('search'));
                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );
                if (file_exists(FCPATH . '/uploads/pdftohtml/' . $arsip_html1)) {
                    $newArsipPembanding1 = file_get_contents(base_url() . "uploads/pdftohtml/" . $arsip_html1, false, stream_context_create($arrContextOptions));
                    $newArsipPembanding1 = str_replace('HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">', '', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HTML>', ' <HTML> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<HEAD>', ' <HEAD> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</HEAD>', ' </HEAD> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<TITLE>', ' <TITLE> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</TITLE>', ' </TITLE> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<BODY>', ' <BODY> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</BODY>', ' </BODY> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<A name=1> ', ' <A name=1> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('name=1> ', 'name=1>', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</a>', ' </a> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<br>', ' <br> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<b>', ' <b> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</b>', ' </b> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<i>', ' <i> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('</i>', ' </i> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<hr>', ' <hr> ', $newArsipPembanding1);
                    $newArsipPembanding1 = str_replace('<IMG src="uploads/pdftohtml/' . $arsip_html1 . '>', ' <IMG src="uploads/pdftohtml/' . $arsip_html1 . '> ', $newArsipPembanding1);
                    $stemminghtml = explode("\n", $newArsipPembanding1);
                    foreach ($stemminghtml as $key => $value) {
                        $stemminghtml[$key] = explode(" ", $value);
                    }
                    $stopwords = $this->M_preprocessing->array_stopword();
                    foreach ($stemminghtml as $key => $value) {
                        foreach ($value as $key1 => $value1) {
                            if (in_array($stemmer->stem(strtolower($stemminghtml[$key][$key1])), $stopwords)) {
                                $stemminghtml[$key][$key1] = '<span style="color: black;background-color: white; ">' . $stemminghtml[$key][$key1] . '</span>';
                            }
                            if (in_array($stemmer->stem(strtolower($stemminghtml[$key][$key1])), $query)) {
                                $stemminghtml[$key][$key1] = '<span style="color: black;background-color: yellow;">' . $stemminghtml[$key][$key1] . '</span>';
                            } else {
                                $stemminghtml[$key][$key1] = '<span style="color: black;background-color: white; ">' . $stemminghtml[$key][$key1] . '</span>';
                            }
                        }
                    }
                    foreach ($stemminghtml as $key => $value) {
                        $stemminghtmlnew[$key] = implode(' ', $value);
                    }
                    $stemminghtmlnew = str_replace('<hr>', '', $stemminghtmlnew);
                    $stemminghtmlnew = str_replace('src="', 'src="../', $stemminghtmlnew);
                    $stemminghtmlnew = str_replace('name=1>', '', $stemminghtmlnew);
                    $stemminghtmlnew = implode("\n", $stemminghtmlnew);
                    $this->load->view('member/home/similiarity', ['data' => $data, 'getArsip1' => $stemminghtmlnew, 'kategori' => $kategori, 'table' => $table]);
                } else {
                    $newArsipPembanding1 = "File tidak ditemukan";
                    $this->load->view('member/home/similiarity', ['data' => $data, 'notFound' => 'Arsip Tidak ditemukan', 'kategori' => $kategori, 'table' => $table]);
                }
            } else {
                $this->load->view('member/home/similiarity', ['data' => $data, 'kategori' => $kategori, 'table' => $table]);
            }
        } else {
            redirect('home/similiarity');
        }
    }
}
