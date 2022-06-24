<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Sastrawi\Stemmer\StemmerFactory;
use WpOrg\Requests\Requests;

class Kelola extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('UU_model');
		$this->load->model('m_umum');
		$this->load->model('m_kelola');
		$this->load->model('m_kategori');
		$this->load->library('PDF2Text');
		$this->load->model('M_preprocessing');
	}

	public function coba()
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');


		$dataset = $this->UU_model->getUU();

		if ($dataset == null) {
			echo "Data masih kosong, silahkan tambahkan data training terlebih dahulu";
			die();
		}
		// proses case folding
		foreach ($dataset as $data) {
			$text = strtolower($data->text);
			$text = str_replace(
				array(
					'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
					'(', ')', ',', '.', '=', ';', '!', '?', '"', '$',
					'/', '\\', '%', '&', '#', '@', '^', '*', ':', '+', ';'
				),
				'',
				$text
			);
			$text = str_replace('-', ' ', $text);

			$caseFolding[] = array(
				"text" => $text,
			);
		}
		// echo "<pre>";print_r($caseFolding);die;
		//proses tokenizing
		foreach ($caseFolding as $fold) {
			$array = explode(" ", $fold['text']);
			foreach ($array as $key => $value) {
				if ($value == "") {
					unset($array[$key]);
				}
			}

			$coba = array_map('utf8_encode', $array);
			$inputText = str_replace(
				array('\r', '\n', '\f', 'u201d', 'u201c', 'u2026'),
				' ',
				json_encode(array_values($coba))
			);
			$inputText = str_replace(array(',""', '\\'), '', $inputText);

			$tokenizing[] = $inputText;
		}

		$stopword = $this->M_preprocessing->array_stopword();

		$filtering = array();
		foreach ($tokenizing as $token) {
			$newArray = array();
			$oldArray[] = json_decode($token);
		}

		foreach ($oldArray as $old_key => $word) {
			foreach ($word as $key_w => $value_w) {
				if (!in_array($value_w, $stopword)) {
					$filtering[$old_key][] = $value_w;
				}
			}
		}
		$stemmerFactory = new StemmerFactory;
		$stemmer  = $stemmerFactory->createStemmer();

		foreach ($tokenizing as $key => $filter) {
			$kata = json_decode($filter);
			$sentence = implode(" ", $kata);
			$stemming   = $stemmer->stem($sentence);
			$newArray = explode(" ", $stemming);
			$insertStemming = array(
				"array" => json_encode(array_values($newArray)),
				"id_tbl_uu" => $dataset[$key]->id_tbl_uu
			);
			$this->db->insert('stemming', $insertStemming);
		}

		echo "done";
	}

	public function get()
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');
		$UU = $this->UU_model->getUU();
		foreach ($UU as $data) {
			$kalimat = $data->text;
			$url = 'http://localhost:5000/undang';
			$headers = array('Content-Type' => 'application/json');
			$search = array('kalimat' => $kalimat);
			$response = Requests::post($url, $headers, json_encode($search));
			$ekstrak = json_decode($response->body);
			foreach ($ekstrak->values as $hasil) {
				$store = array(
					"id_tbl_uu" => $data->id_tbl_uu,
					"text" => $hasil->content
				);
				$this->db->insert("preprocessing", $store);
			}
		}
	}

	public function hapus($id)
	{
		$uu = $this->UU_model->getUUDetail($id);
		$file_arsip = $uu->file_arsip;
		$delete = $this->db->delete("uu", array('id_tbl_uu' => $id));
		if ($delete) {
			if (file_exists("uploads/" . $file_arsip)) {
				unlink("uploads/" . $file_arsip);
			}
			$this->m_umum->generatePesan("Berhasil menghapus data", "berhasil");
			redirect('admin/kelola');
		} else {
			$this->m_umum->generatePesan("Gagal menghapus data", "gagal");
			redirect('admin/kelola');
		}
	}

	public function ubah($id)
	{
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['kategori'] = $this->m_kategori->getKategori();
		$data['detailData'] = $this->UU_model->getUUDetail($id);
		$data['v_content'] = "member/kelola/ubah";
		// echo"<pre>";print_r($data);die;
		$this->load->view("member/layout", $data);
	}

	public function doUbah($id)
	{
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$dataArray = array(
			'uu' => $post['uu'],
			'tentang' => $post['tentang'],
			'id_kategori' => $post['kategori'],
			'status' => '1'
		);
		// print_r($_FILES['file']['name']);die;
		if ($_FILES['file_arsip']['name'] != null) {

			$dir = "uploads";
			$ext = pathinfo($_FILES['file_arsip']['name'], PATHINFO_EXTENSION);
			$nameFile = 'NewArsip' . date("ymdhis") . "." . $ext;
			$config['upload_path']   = $dir;
			$config['allowed_types'] = 'pdf';
			$config['file_name']     = $nameFile;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_arsip')) {
				$error = array('error' => $this->upload->display_errors());
				debugCode($error);
			} else {
				$dataArray['file_arsip'] = $nameFile;
				$url = 'http://localhost:5000/undang/ubahUU';
				$headers = array('Content-Type' => 'application/json');
				$prep = array(
					'id_tbl_uu' => $id,
					'file' => $nameFile
				);
				$response = Requests::post($url, $headers, json_encode($prep));
				$ekstrak = json_decode($response->body);
				foreach ($ekstrak->values as $hasil) {
					$dataArray['text'] = $hasil->text;
					$this->db->update("uu", $dataArray, ['id_tbl_uu' => $id]);
				}
				$dataset = $this->UU_model->getUUByID($id);

				if ($dataset == null) {
					echo "Data masih kosong, silahkan tambahkan data training terlebih dahulu";
					die();
				}
				// proses case folding
				foreach ($dataset as $data) {
					$text = strtolower($data->text);
					$text = str_replace(
						array(
							'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
							'(', ')', ',', '.', '=', ';', '!', '?', '"', '$',
							'/', '\\', '%', '&', '#', '@', '^', '*', ':', '+', ';'
						),
						'',
						$text
					);
					$text = str_replace('-', ' ', $text);

					$caseFolding[] = array(
						"text" => $text,
					);
				}
				// echo "<pre>";print_r($caseFolding);die;
				//proses tokenizing
				foreach ($caseFolding as $fold) {
					$array = explode(" ", $fold['text']);
					foreach ($array as $key => $value) {
						if ($value == "") {
							unset($array[$key]);
						}
					}

					$coba = array_map('utf8_encode', $array);
					$inputText = str_replace(
						array('\r', '\n', '\f', 'u201d', 'u201c', 'u2026'),
						'',
						json_encode(array_values($coba))
					);
					$inputText = str_replace(array(',""', '\\'), '', $inputText);

					$tokenizing[] = $inputText;
				}

				$stopword = $this->M_preprocessing->array_stopword();

				$filtering = array();
				foreach ($tokenizing as $token) {
					$newArray = array();
					$oldArray[] = json_decode($token);
				}

				foreach ($oldArray as $old_key => $word) {
					foreach ($word as $key_w => $value_w) {
						if (!in_array($value_w, $stopword)) {
							$filtering[$old_key][] = $value_w;
						}
					}
				}
				$stemmerFactory = new StemmerFactory;
				$stemmer  = $stemmerFactory->createStemmer();

				foreach ($tokenizing as $key => $filter) {
					$kata = json_decode($filter);
					$sentence = implode(" ", $kata);
					$stemming   = $stemmer->stem($sentence);
					$newArray = explode(" ", $stemming);
					$insertStemming = array(
						"array" => json_encode(array_values($newArray)),
						"id_tbl_uu" => $dataset[$key]->id_tbl_uu
					);
					$updateStemming = $this->db->update("stemming", $insertStemming, ['id_tbl_uu' => $id]);
					$this->m_umum->generatePesan("Berhasil menambahkan data", "berhasil");
					echo "<script>window.location.href = '" . base_url('admin/kelola') . "';</script>";
				}
			}
		} else {
			$insert = $this->db->update("uu", $dataArray, ['id_tbl_uu' => $id]);
		}


		$this->m_umum->generatePesan("Berhasil menambahkan data", "berhasil");
		echo "<script>window.location.href = '" . base_url('admin/kelola') . "';</script>";
	}

	public function tambah()
	{
		$data['v_content'] = "member/kelola/tambah";
		$data['kategori'] = $this->m_kategori->getKategori();
		$this->load->view("member/layout", $data);
	}

	public function simpan()
	{

		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$dataArray = array(
			'uu' => $post['uu'],
			'tentang' => $post['tentang'],
			'id_kategori' => $post['kategori'],
			'status' => '1'
		);

		if (!empty($_FILES['file_arsip'])) {
			$dir = "uploads";
			$ext = pathinfo($_FILES['file_arsip']['name'], PATHINFO_EXTENSION);
			$nameFile = 'NewArsip' . date("ymdhis") . "." . $ext;
			$config['upload_path']   = $dir;
			$config['allowed_types'] = 'pdf';
			$config['file_name']     = $nameFile;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_arsip')) {
				$error = array('error' => $this->upload->display_errors());
				debugCode($error);
			} else {
				$dataArray['file_arsip'] = $nameFile;
				$insert = $this->db->insert("uu", $dataArray);
				if ($insert) {
					$id_tbl_uu = $this->db->insert_id();
					$url = 'http://localhost:5000/undang/tambahUU';
					$headers = array('Content-Type' => 'application/json');
					$prep = array(
						'id_tbl_uu' => $id_tbl_uu,
						'file' => $nameFile
					);
					$response = Requests::post($url, $headers, json_encode($prep));
					$ekstrak = json_decode($response->body);
					foreach ($ekstrak->values as $hasil) {
						$store = array(
							"text" => $hasil->text
						);
						$this->db->update("uu", $store, ['id_tbl_uu' => $id_tbl_uu]);
					}

					$dataset = $this->UU_model->getUUByID($id_tbl_uu);

					if ($dataset == null) {
						echo "Data masih kosong, silahkan tambahkan data training terlebih dahulu";
						die();
					}
					// proses case folding
					foreach ($dataset as $data) {
						$text = strtolower($data->text);
						$text = str_replace(
							array(
								'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
								'(', ')', ',', '.', '=', ';', '!', '?', '"', '$',
								'/', '\\', '%', '&', '#', '@', '^', '*', ':', '+', ';'
							),
							'',
							$text
						);
						$text = str_replace('-', ' ', $text);

						$caseFolding[] = array(
							"text" => $text,
						);
					}
					// echo "<pre>";print_r($caseFolding);die;
					//proses tokenizing
					foreach ($caseFolding as $fold) {
						$array = explode(" ", $fold['text']);
						foreach ($array as $key => $value) {
							if ($value == "") {
								unset($array[$key]);
							}
						}

						$coba = array_map('utf8_encode', $array);
						$inputText = str_replace(
							array('\r', '\n', '\f', 'u201d', 'u201c', 'u2026'),
							' ',
							json_encode(array_values($coba))
						);
						$inputText = str_replace(array(',""', '\\'), ' ', $inputText);

						$tokenizing[] = $inputText;
					}

					$stopword = $this->M_preprocessing->array_stopword();

					$filtering = array();
					foreach ($tokenizing as $token) {
						$newArray = array();
						$oldArray[] = json_decode($token);
					}

					foreach ($oldArray as $old_key => $word) {
						foreach ($word as $key_w => $value_w) {
							if (!in_array($value_w, $stopword)) {
								$filtering[$old_key][] = $value_w;
							}
						}
					}
					$stemmerFactory = new StemmerFactory;
					$stemmer  = $stemmerFactory->createStemmer();

					foreach ($tokenizing as $key => $filter) {
						$kata = json_decode($filter);
						$sentence = implode(" ", $kata);
						$stemming   = $stemmer->stem($sentence);
						$newArray = explode(" ", $stemming);
						$insertStemming = array(
							"array" => json_encode(array_values($newArray)),
							"id_tbl_uu" => $dataset[$key]->id_tbl_uu
						);
						$this->db->insert('stemming', $insertStemming);
						$this->m_umum->generatePesan("Berhasil menambahkan data", "berhasil");
						echo "<script>window.location.href = '" . base_url('admin/kelola') . "';</script>";
					}
				} else {
					$this->m_umum->generatePesan("Gagal menambahkan data", "gagal");
					redirect('admin/kelola/add');
				}
			}
		} else {
			echo "gagal upload";
		}
	}



	public function index()
	{
		if ($_GET) {
			$get = $this->input->get();
			// print_r($get['kat']);
			$data['listData'] = $this->UU_model->getArsip($get['kat']);
		} else {
			$data['listData'] = $this->UU_model->getArsip();
		}
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['kategori'] = $this->m_kategori->getKategori();
		$data['judul'] = 'Kelola Dokumen';
		$data['v_content'] = "member/kelola/daftar";
		// echo "<pre>";print_r($data);die;
		$this->load->view("member/layout", $data);
	}

	public function getPdf()
	{
		// $data['listData'] = $this->m_kelola->getArsip();
		$data = $this->m_kelola->getArsipDetail(2);
		$string = "";
		$content = file_get_contents(base_url() . 'uploads/' . $data->file_arsip);
		/*print_r(base64_decode($content));


		echo "<pre>";print_r($string);
		die;*/
		$this->load->view("member/layout", $data);
	}

	public function add()
	{
		$data['v_content'] = "member/kelola/add";
		$data['kategori'] = $this->m_kategori->getKategori();
		$this->load->view("member/layout", $data);
	}

	public function doAdd()
	{

		// $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
		// $stemmer  = $stemmerFactory->createStemmer();

		// // stem
		// $sentence = 'Perekonomian Indonesia sedang dalam pertumbuhan yang membanggakan';
		// $output   = $stemmer->stem($sentence);

		// echo $output . "\n";die;

		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$dataArray = array(
			'judul_arsip' => $post['nama_dokumen'],
			'jenis_arsip' => $post['jenis_dokumen'],
			'id_kategori' => $post['kategori'],
			'status' => '1'
		);
		// config untuk file pdf
		if (!empty($_FILES['file'])) {
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
			// $dataArray['arsip_html'] = 'Arsip210405093703htmls.html';
			$arrContextOptions = array(
				"ssl" => array(
					"verify_peer" => false,
					"verify_peer_name" => false,
				),
			);

			$newArsipPembanding2 = file_get_contents(base_url() . "uploads/pdftohtml/" . $dataArray['arsip_html'], false, stream_context_create($arrContextOptions));
			if ($newArsipPembanding2 == null) {
				$this->m_umum->generatePesan("File mengandung unicode yang tidak bisa di convert", "gagal");
				echo "<script>window.location.href = '" . base_url('admin/kelola/add') . "';</script>";
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
		unlink(FCPATH . $dirHtml . '/' . $htmlName . 'html_ind.html');
		unlink(FCPATH . $dirHtml . '/' . $nameHtml . '.html');

		//exit;  
		// print_r($dataArray);die;
		$insert = $this->db->insert("tbl_arsip", $dataArray);
		if ($insert) {
			$insert_id = $this->db->insert_id();

			$dataset = $this->m_kelola->getArsipByID($insert_id);
			// echo"<pre>";print_r($dataset);die;
			if ($dataset == null) {
				echo "Data masih kosong, silahkan tambahkan data training terlebih dahulu";
				die();
			}
			// proses case folding
			foreach ($dataset as $data) {
				$text = strtolower($data->text);
				$text = str_replace(
					array(
						'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
						'(', ')', ',', '.', '=', ';', '!', '?', '"', '$',
						'/', '\\', '%', '&', '#', '@', '^', '*', ':', '+', ';'
					),
					'',
					$text
				);
				$text = str_replace('-', ' ', $text);

				$caseFolding[] = array(
					"text" => $text,
				);
			}
			// echo "<pre>";print_r($caseFolding);die;
			//proses tokenizing
			foreach ($caseFolding as $fold) {
				$array = explode(" ", $fold['text']);
				foreach ($array as $key => $value) {
					if ($value == "") {
						unset($array[$key]);
					}
				}


				$inputText = str_replace(
					array('\r', '\n', '\f', 'u201d', 'u201c', 'u2026'),
					'',
					json_encode(array_values($array))
				);
				$inputText = str_replace(array(',""', '\\'), '', $inputText);

				$tokenizing[] = $inputText;
			}

			$stopword = $this->M_preprocessing->array_stopword();

			$filtering = array();
			foreach ($tokenizing as $token) {
				$newArray = array();
				$oldArray[] = json_decode($token);
			}

			foreach ($oldArray as $old_key => $word) {
				foreach ($word as $key_w => $value_w) {
					if (!in_array($value_w, $stopword)) {
						$filtering[$old_key][] = $value_w;
					}
				}
			}
			$stemmerFactory = new StemmerFactory;
			$stemmer  = $stemmerFactory->createStemmer();

			foreach ($tokenizing as $key => $filter) {
				$kata = json_decode($filter);
				$sentence = implode(" ", $kata);
				$stemming   = $stemmer->stem($sentence);
				$newArray = explode(" ", $stemming);
				$insertStemming = array(
					"array" => json_encode(array_values($newArray)),
					"id_arsip" => $dataset[$key]->id_arsip
				);
				$this->M_preprocessing->insertStemming($insertStemming);
			}


			$this->m_umum->generatePesan("Berhasil menambahkan data", "berhasil");
			echo "<script>window.location.href = '" . base_url('admin/kelola') . "';</script>";
		} else {
			$this->m_umum->generatePesan("Gagal menambahkan data", "gagal");
			redirect('admin/kelola/add');
		}
	}

	public function edit($id)
	{
		$data['userLogin'] = $this->session->userdata('loginData');
		$data['kategori'] = $this->m_kategori->getKategori();
		$data['detailData'] = $this->m_kelola->getArsipDetail($id);
		$data['v_content'] = "member/kelola/edit";
		// echo"<pre>";print_r($data);die;
		$this->load->view("member/layout", $data);
	}

	public function doEdit($id)
	{
		$data['userLogin'] = $this->session->userdata('loginData');
		$post = $this->input->post();
		$dataArray = array(
			'judul_arsip' => $post['nama_dokumen'],
			'jenis_arsip' => $post['jenis_dokumen'],
			'id_kategori' => $post['kategori'],
			'status' => '1'
		);
		// print_r($_FILES['file']['name']);die;
		if ($_FILES['file']['name'] != null) {

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

				//     	$pdf = new PDF2Text;
				//   $pdf->setFilename('uploads/'.$dataArray['file_arsip']);
				//   $pdf->decodePDF();
				//   if($pdf->output() == null){
				//   	unlink(FCPATH.$dir.'/'.$nameFile);
				// $this->session->set_flashdata("error_convert", '<div class="alert alert-block alert-danger">
				//                    <button type="button" class="close" data-dismiss="alert">
				//                            <i class="ace-icon fa fa-times"></i>
				//                    </button>

				//                    <!--<i class="ace-icon fa fa-check green"></i>-->
				//                    File mengandung content yang tidak bisa di export.
				//                </div> 
				//      ');			    	
				//      // $this->m_umum->generatePesan("File mengandung content yang tidak bisa di export","gagal");
				// echo "<script>window.location.href = '".base_url('admin/kelola/edit/'.$id)."';</script>";
				// die();
				//   }

				// echo json_encode($pdf->output();die;
				// $dataArray['text'] = $pdf->output();
				$source_pdf = "uploads/" . $nameFile;
				$dirHtml = "uploads/pdftohtml";
				$htmlName = 'Arsip' . date("ymdhis");
				$nameHtml = $htmlName . 'html';
				$NewDirPdftohtml = APPPATH . "/libraries/pdftohtml";
				// $dirPdftohtml = base_url()."libraries/pdftohtml";
				$a = passthru("$NewDirPdftohtml $source_pdf $dirHtml/$nameHtml", $b);
				$dataArray['arsip_html'] = $nameHtml . 's.html';

				$arrContextOptions = array(
					"ssl" => array(
						"verify_peer" => false,
						"verify_peer_name" => false,
					),
				);

				$newArsipPembanding2 = file_get_contents(base_url() . "uploads/pdftohtml/" . $dataArray['arsip_html'], false, stream_context_create($arrContextOptions));
				if ($newArsipPembanding2 == null) {
					$this->m_umum->generatePesan("File mengandung unicode yang tidak bisa di convert", "gagal");
					echo "<script>window.location.href = '" . base_url('admin/kelola/edit/' . $id) . "';</script>";
					die;
				}
				$newArsipPembanding2 = str_replace('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<HTML>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<HEAD>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</HEAD>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<TITLE>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</TITLE>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<BODY>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</BODY>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<A name=', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</a>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<br>', ' ', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<b>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</b>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<i>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('</i>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<hr>', '', $newArsipPembanding2);
				$newArsipPembanding2 = str_replace('<IMG src="uploads/pdftohtml/' . $nameHtml . '>', '', $newArsipPembanding2);
			}
			$forDelete = $this->m_kelola->getArsipDetail($id);
			$hapusArsip = $forDelete->file_arsip;
			$hapusHtml = $forDelete->arsip_html;
			if (file_exists("uploads/" . $hapusArsip)) {
				unlink("uploads/" . $hapusArsip);
			}
			if (file_exists("uploads/pdftohtml/" . $hapusHtml)) {
				unlink("uploads/pdftohtml/" . $hapusHtml);
			}
			unlink(APPPATH . '/../' . $dirHtml . '/' . $htmlName . 'html_ind.html');
			unlink(APPPATH . '/../' . $dirHtml . '/' . $nameHtml . '.html');
			$dataArray['text'] = $newArsipPembanding2;
			// echo"<pre>";print_r($dataArray);die;
			$insert = $this->db->update("tbl_arsip", $dataArray, ['id_arsip' => $id]);
			$dataset = $this->m_kelola->getArsipByID($id);
			// echo"<pre>";print_r($dataset);die;
			if ($dataset == null) {
				echo "Data masih kosong, silahkan tambahkan data training terlebih dahulu";
				die();
			}
			// proses case folding
			foreach ($dataset as $key => $data) {
				$text = strtolower($data->text);
				$text = str_replace(
					array(
						'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
						'(', ')', ',', '.', '=', ';', '!', '?', '"', '$',
						'/', '\\', '%', '&', '#', '@', '^', '*', ':', '+', ';', '>', '<'
					),
					'',
					$text
				);
				$text = str_replace('-', ' ', $text);

				$caseFolding[$key] = array(
					"text" => $text,
				);
			}
			foreach ($caseFolding as $fold) {
				$array = explode(" ", $fold['text']);
				foreach ($array as $key => $value) {
					if ($value == "") {
						unset($array[$key]);
					}
				}

				$inputText = str_replace(
					array('\r', '\n', '\f', 'u201d', 'u201c', 'u2026'),
					'',
					json_encode(array_values($array))
				);
				$inputText = str_replace(array(',""', '\\'), '', $inputText);

				$tokenizing[] = $inputText;
			}
			$stopword = $this->M_preprocessing->array_stopword();
			$stemmerFactory = new StemmerFactory;
			$stemmer  = $stemmerFactory->createStemmer();

			foreach ($tokenizing as $key => $filter) {
				$kata = json_decode($filter);
				$sentence = implode(" ", $kata);
				$stemming   = $stemmer->stem($sentence);
				$newArray = explode(" ", $stemming);
				$insertStemming = array(
					"array" => json_encode(array_values($newArray)),
					"id_arsip" => $dataset[$key]->id_arsip
				);
				// print_r($insertStemming);die;
				$updateStemming = $this->db->update("tbl_stemming", $insertStemming, ['id_arsip' => $id]);
			}
		} else {
			$insert = $this->db->update("tbl_arsip", $dataArray, ['id_arsip' => $id]);
		}


		$this->m_umum->generatePesan("Berhasil menambahkan data", "berhasil");
		echo "<script>window.location.href = '" . base_url('admin/kelola') . "';</script>";
		// }
		// else{
		// 	$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
		// 	redirect('admin/kelola/add');

		// }
	}

	public function doDelete($id)
	{
		$forDelete = $this->m_kelola->getArsipDetail($id);
		$hapusArsip = $forDelete->file_arsip;
		$hapusHtml = $forDelete->arsip_html;
		// print_r($hapusHtml.'<br>');print_r($hapusArsip);die;
		$deleteArsip = $this->db->delete("tbl_arsip", array('id_arsip' => $id));
		$deleteStemming = $this->db->delete("tbl_stemming", array('id_arsip' => $id));
		if ($deleteArsip && $deleteStemming) {
			if (file_exists("uploads/" . $hapusArsip)) {
				unlink("uploads/" . $hapusArsip);
			}
			if (file_exists("uploads/pdftohtml/" . $hapusHtml)) {
				unlink("uploads/pdftohtml/" . $hapusHtml);
			}
			$this->m_umum->generatePesan("Berhasil menghapus data", "berhasil");
			redirect('admin/kelola');
		} else {
			$this->m_umum->generatePesan("Gagal menghapus data", "gagal");
			redirect('admin/kelola');
		}
	}

	public function getDataByKategori($id)
	{
		$data = $this->m_kelola->getArsipKategori($id);
		header('Content-Type: application/json;charset=utf-8');
		echo json_encode($data);
	}
}
