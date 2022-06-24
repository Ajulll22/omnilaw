<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor\autoload.php';

use PhpOffice\PhpWord\PhpWord;

class Toword extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("m_kelola");
      }

      public function ekstrak(){
        try {
           $phpWord = new \PhpOffice\PhpWord\PhpWord();
           $section = $phpWord->addSection();
           #$section->addText('UU No 28 Tahun 2009<w:br/><w:br/>Tentang Pajak Daerah Dan Retribusi Daerah<w:br/><w:br/>pasal~2 Jenis pajak provinsi terdiri atas: pajak Kendaraan Bermotor; Bea Balik Nama Kendaraan Bermotor; pajak Bahan Bakar Kendaraan Bermotor; pajak Air Permukaan; dan pajak Rokok. Jenis pajak kabupaten/kota terdiri atas: pajak Hotel; pajak Restoran; pajak Hiburan; pajak Reklame; pajak Penerangan Jalan; pajak Mineral Bukan Logam dan Batuan; pajak Parkir; pajak Air Tanah; pajak Sarang Burung Walet; pajak Bumi dan Bangunan Perdesaan dan Perkotaan; dan Bea Perolehan Hak atas Tanah dan Bangunan. Daerah dilarang memungut pajak selain jenis pajak sebagaimana dimaksud pada ayat (1) dan ayat (2). Jenis pajak sebagaimana dimaksud pada ayat (1) dan ayat (2) dapat tidak dipungut apabila potensinya kurang memadai dan/atau disesuaikan dengan kebijakan Daerah yang ditetapkan dengan Peraturan Daerah. Khusus untuk Daerah yang setingkat dengan daerah provinsi, tetapi tidak terbagi dalam daerah kabupaten/kota otonom, seperti Daerah Khusus Ibukota Jakarta, jenis pajak yang dapat dipungut merupakan gabungan dari pajak untuk daerah provinsi dan pajak untuk daerah kabupaten/kota. Cukup jelas.<w:br/><w:br/>pasal~3 Objek pajak Kendaraan Bermotor adalah kepemilikan dan/atau penguasaan Kendaraan Bermotor. Termasuk dalam pengertian Kendaraan Bermotor sebagaimana dimaksud pada ayat (1) adalah kendaraan bermotor beroda beserta gandengannya, yang dioperasikan di semua jenis jalan darat dan kendaraan bermotor yang dioperasikan di air dengan ukuran isi kotor GT 5 (lima Gross Tonnage) sampai dengan GT 7 (tujuh Gross Tonnage). Dikecualikan dari pengertian Kendaraan Bermotor sebagaimana dimaksud pada ayat (2) adalah: kereta api; Kendaraan Bermotor yang semata-mata digunakan untuk keperluan pertahanan dan keamanan negara; Kendaraan Bermotor yang dimiliki dan/atau dikuasai kedutaan, konsulat, perwakilan negara asing dengan asas timbal balik dan lembaga-lembaga internasional yang memperoleh fasilitas pembebasan pajak dari Pemerintah; dan objek pajak lainnya yang ditetapkan dalam Peraturan Daerah. Cukup jelas.
           #');

           $text = 'pasal~11Dana Transfer Umum sebagaimana dimaksud dalamPasal 10huruf a diperkirakan sebesar Rp493.959.535.082.000,00 (empat ratus sembilan puluh tiga triliun sembilan ratus lima puluh sembilan miliar lima ratus tiga puluh lima juta delapan puluh dua ribu rupiah), yang terdiri atas:" DBH dan DAU. DBH sebagaimana dimaksud pada ayat (1) huruf a diperkirakan sebesar Rp95.377.220.334.000,00 (sembilan puluh lima triliun tiga ratus tujuh puluh tujuh miliar dua ratus dua puluh juta tiga ratus tiga puluh empat ribu rupiah), yang terdiri atas: DBH Pajak sebesar Rp58.091.244.137.000,00 (lima puluh delapan triliun sembilan puluh satu miliar dua ratus empat puluh empat juta seratus tiga puluh tujuh ribu rupiah), dengan rincian: 1) DBH Pajak tahun anggaran berjalan sebesar Rp51.003.606.587.000,00 (lima puluh satu triliun tiga miliar enam ratus enam juta lima ratus delapan puluh tujuh ribu rupiah) dan 2) Kurang Bayar DBH Pajak sebesar Rp7.087.637.550.000,00 (tujuh triliun delapan puluh tujuh miliar enam ratus tiga puluh tujuh juta lima ratus lima puluh ribu rupiah). DBH SDA sebesar Rp37.285.976.197.000,00 (tiga puluh tujuh triliun dua ratus delapan puluh lima miliar sembilan ratus tujuh puluh enam juta seratus sembilan puluh tujuh ribu rupiah), dengan rincian: 1) DBH SDA tahun anggaran berjalan sebesar Rp30.522.435.128.000,00 (tiga puluh triliun lima ratus dua puluh dua miliar empat ratus tiga puluh lima juta seratus dua puluh delapan ribu rupiah) dan 2) Kurang Bayar DBH SDA sebesar Rp6.763.541.069.000,00 (enam triliun tujuh ratus enam puluh tiga miliar lima ratus empat puluh satu juta enam puluh sembilan ribu rupiah). DBH Pajak sebagaimana dimaksud pada ayat (2) huruf a terdiri atas: Pajak Bumi dan Bangunan (PBB) Pajak Penghasilan (PPh) Pasal 21,Pasal 25danPasal 29Wajib Pajak Orang Pribadi Dalam Negeri (WPOPDN) Cukai Hasil Tembakau (CHT). DBH SDA sebagaimana dimaksud pada ayat (2) huruf b, yang terdiri atas: Minyak Bumi dan Gas Bumi Mineral dan Batubara Kehutanan Perikanan dan Panas Bumi. (4A) Penyaluran DBH sebagaimana dimaksud pada ayat (2) huruf a angka 1) dan huruf b angka 1) untuk triwulan IV diprioritaskan untuk penyelesaian Kurang Bayar DBH Tahun Anggaran 2016 dan/atau DBH tahun berjalan. (4B) Penyaluran DBH triwulan IV untuk penyelesaian kurang bayar DBH Tahun Anggaran 2016 sebagaimana dimaksud pada ayat (4A), dilaksanakan dengan memperhatikan prognosis realisasi DBH Tahun Anggaran 2017 dan/atau kebijakan pengendalian pelaksanaan APBN Tahun Anggaran 2017. (4C) Ketentuan lebih lanjut mengenai tata cara penyelesaian Kurang Bayar DBH Tahun Anggaran 2016 sebagaimana dimaksud pada ayat (4A) diatur dengan Peraturan Menteri Keuangan. DBH Kehutanan sebagaimana dimaksud pada ayat (4) huruf c, khusus Dana Reboisasi yang sebelumnya disalurkan ke kabupaten/kota penghasil, mulai Tahun Anggaran 2017 disalurkan ke provinsi penghasil dan digunakan untuk membiayai kegiatan rehabilitasi hutan dan lahan yang meliputi: Perencanaan Pelaksanaan Monitoring Evaluasi dan Kegiatan pendukungnya. (5A) Kegiatan pendukung rehabilitasi hutan dan lahan sebagaimana dimaksud pada ayat (5) meliputi: Perencanaan Pelaksanaan Monitoring Evaluasi dan Kegiatan pendukungnya. (5A) Kegiatan pendukung rehabilitasi hutan dan lahan sebagaimana dimaksud pada ayat (5) meliputi: a. Perlindungan dan pengamanan hutan b. Teknologi rehabilitasi hutan dan lahan c. Pencegahan dan penanggulangan kebakaran hutan dan lahan d. Penataan batas kawasan e. Pengembangan perbenihan Penelitian dan pengembangan, pendidikan dan pelatihan, penyuluhan serta pemberdayaan masyarakat setempat dalam kegiatan reboisasi hutan Pembinaan dan/atau Pengawasan dan pengendalian. Penggunaan DBH CHT sebagaimana dimaksud pada ayat (3) huruf c, DBH Minyak Bumi dan Gas Bumi sebagaimana dimaksud pada ayat (4) huruf a dan DBH Kehutanan sebagaimana dimaksud pada ayat (4) huruf c, diatur sebagai berikut: Penerimaan DBH CHT, baik bagian provinsi maupun bagian kabupaten/kota, dialokasikan dengan ketentuan: Paling sedikit 50% (lima puluh persen) untuk mendanai peningkatan kualitas bahanbaku,pembinaan industri, pembinaan lingkungan sosial, sosialisasi ketentuan di bidang cukai, dan/atau pemberantasan barang kena cukai ilegal dan Paling banyak 50% (lima puluh persen) untuk mendanai kegiatan sesuai dengan kebutuhan dan prioritas daerah. Penerimaan DBH Minyak Bumi dan Gas Bumi, baik bagian provinsi maupun bagian kabupaten/kota digunakan sesuai kebutuhan dan prioritas daerah, kecuali tambahan DBH Minyak Bumi dan Gas Bumi untuk Provinsi Papua Barat dan Provinsi Aceh digunakan sesuai dengan ketentuan peraturan perundang-undangan. DBH Kehutanan dari Dana Reboisasi yang merupakan bagian kabupaten/kota, baik yang disalurkan pada tahun 2016 maupun tahun-tahun sebelumnya yang masih terdapat di kas daerah dapat digunakan oleh organisasi perangkat daerah yang ditunjuk oleh bupati/wali kota untuk: Pengelolaan taman hutan raya (tahura) Pencegahan dan penanggulangan kebakaran hutan Penataan batas kawasan Pengawasan dan perlindungan Penanaman pohon pada daerah aliran sungai (DAS) kritis, penanaman bambu pada kanan kiri sungai (kakisu), dan pengadaan bangunan konservasi tanah dan air Pengembangan perbenihan dan/atau Penelitian dan pengembangan. Dihapus. DAU sebagaimana dimaksud pada ayat (1) huruf b diperkirakan sebesar Rp398.582.314.748.000,00 (tiga ratus sembilan puluh delapan triliun lima ratus delapan puluh dua miliar tiga ratus empat belas juta tujuh ratus empat puluh delapan ribu rupiah), yang terdiri atas: DAU murni yang dialokasikan berdasarkan formula sebesar Rp375.276.936.242.000,00 (tiga ratus tujuh puluh lima triliun dua ratus tujuh puluh enam miliar sembilan ratus tiga puluh enam juta dua ratus empat puluh dua ribu rupiah) atau setara dengan 28,7% (dua puluh delapan koma tujuh persen) dari PDN Neto Tambahan DAU untuk provinsi sebagai akibat dari pengalihan kewenangan dari kabupaten/kota ke provinsi sebesar Rp18.468.933.728.000,00 (delapan belas triliun empat ratus enam puluh delapan miliar sembilan ratus tiga puluh tiga juta tujuh ratus dua puluh delapan ribu rupiah) dan Tambahan DAU untuk menghindari terjadinya penurunan alokasi DAU untuk kabupaten/kota sebesar Rp4.836.444.778.000,00 (empat triliun delapan ratus tiga puluh enam miliar empat ratus empat puluh empat juta tujuh ratus tujuh puluh delapan ribu rupiah). PDN neto dihitung berdasarkan penjumlahan antara Penerimaan Perpajakan dan PNBP, dikurangi dengan Penerimaan Negara yang Dibagihasilkan kepada Daerah. Pagu DAU nasional dalam APBN tidak bersifat final atau dapat diubah sesuai perubahan PDN neto dalam Perubahan APBN. Dalam hal terjadi perubahan PDN neto yang mengakibatkan penurunan pagu DAU Nasional dan alokasi DAU per daerah, perlu perlakuan (perhatian) khusus terhadap daerah-daerah yang mempunyai kapasitas dan ruang fiskal yang sangat terbatas agar pagu alokasi daerah yang bersangkutan tetap, sehingga mampu membiayai belanja pegawai dan kebutuhan operasionalnya (tidak mengalami penurunan). Pengalokasian DAU untuk provinsi memperhatikan adanya beban anggaran akibat pengalihan urusan/kewenangan dari kabupaten/kota ke provinsi sesuai dengan peraturan perundang-undangan yang berlaku. (12A) Terhadap provinsi yang belum melakukan pengalihan urusan/kewenangan dari kabupaten/kota ke provinsi sebagaimana dimaksud pada ayat (12), alokasi DAU untuk pengalihan urusan/kewenangan bagi provinsi yang bersangkutan, dialihkan kepada kabupaten/kota. (12B) Ketentuan lebih lanjut mengenai pengalihan alokasi DAU sebagaimana dimaksud pada ayat (12A) dan tata cara penyalurannya diatur dengan Peraturan Menteri Keuangan. Dihapus.#NL#(13A) Pengalokasian DAU untuk kabupaten/kota dilakukan penyesuaian dengan memperhatikan: kabupaten/kota dengan ruang fiskal sangat terbatas kabupaten/kota yang mengalami penurunan DBH yang sangat besar dan batas penurunan alokasi DAU kabupaten/kota yang disepakati antara Pemerintah Pusat dan Dewan Perwakilan Rakyat Republik Indonesia. (13B) Kabupaten/kota yang memenuhi kriteria ruang fiskal sangat terbatas dan penurunan DBH yang sangat besar sebagaimana dimaksud pada ayat (13A) huruf a dan huruf b, besaran alokasi DAU kabupaten/kota ditetapkan sama dengan besaran alokasi DAU kabupaten/kota dalam APBN Tahun Anggaran 2017. (13C) Batas penurunan alokasi DAU kabupaten/kota sebagaimana dimaksud pada ayat (13A) huruf c ditetapkan antara 0,8% (nol koma delapan persen) sampai dengan 1,8% (satu koma delapan persen) dibanding dengan besaran alokasi DAU kabupaten/kota dalam APBN Tahun Anggaran 2017. Alokasi Dana Transfer Umum sebagaimana dimaksud pada ayat (1) digunakan sesuai dengan kebutuhan dan prioritas daerah. Dana Transfer Umum diarahkan penggunaannya, yaitu sekurang-kurangnya 25% (dua puluh lima persen) untuk belanja infrastruktur daerah yang langsung terkait dengan percepatan pembangunan fasilitas pelayanan publik dan ekonomi dalam rangkameningkatkankesempatankerja, mengurangikemiskinan,danmengurangi kesenjangan penyediaan layanan publik antardaerah. [10. Ketentuan ayat (1) dan ayat (3)Pasal 12diubah, di antara ayat (6) dan ayat (7)Pasal 12disisipkan 3 (tiga) ayat yakni ayat (6A), ayat (6B), dan ayat (6C), sehinggaPasal 12berbunyi sebagai berikut:]"';
           $section->addText($text);
           $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
            header("Content-Disposition: attachment; filename=UU No 28 Tahun 2009.docx");
            $objWriter->save('php://output');
        } catch (Exception $e) {
           echo $e->getMessage();
        }
    }

    private function get_pasal($pasal,$id_tbl_uu){
        $pasal_data = $this->m_kelola->getUUPasal($pasal,$id_tbl_uu);
        $pasalstring = "";

        foreach($pasal_data as $pd):
            $pasalstring.=$pd->uud_content." ";
        endforeach;
        return $pasalstring;
        #echo json_encode($pasalstring);
    }

    private function xmlEntities($str)
    {
        $xml = array('&#34;','&#38;','&#38;','&#60;','&#62;','&#160;','&#161;','&#162;','&#163;','&#164;','&#165;','&#166;','&#167;','&#168;','&#169;','&#170;','&#171;','&#172;','&#173;','&#174;','&#175;','&#176;','&#177;','&#178;','&#179;','&#180;','&#181;','&#182;','&#183;','&#184;','&#185;','&#186;','&#187;','&#188;','&#189;','&#190;','&#191;','&#192;','&#193;','&#194;','&#195;','&#196;','&#197;','&#198;','&#199;','&#200;','&#201;','&#202;','&#203;','&#204;','&#205;','&#206;','&#207;','&#208;','&#209;','&#210;','&#211;','&#212;','&#213;','&#214;','&#215;','&#216;','&#217;','&#218;','&#219;','&#220;','&#221;','&#222;','&#223;','&#224;','&#225;','&#226;','&#227;','&#228;','&#229;','&#230;','&#231;','&#232;','&#233;','&#234;','&#235;','&#236;','&#237;','&#238;','&#239;','&#240;','&#241;','&#242;','&#243;','&#244;','&#245;','&#246;','&#247;','&#248;','&#249;','&#250;','&#251;','&#252;','&#253;','&#254;','&#255;');
        $html = array('&quot;','&amp;','&amp;','&lt;','&gt;','&nbsp;','&iexcl;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;','&laquo;','&not;','&shy;','&reg;','&macr;','&deg;','&plusmn;','&sup2;','&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;');
        $str = str_replace($html,$xml,$str);
        $str = str_ireplace($html,$xml,$str);
        return $str;
    }

    public function ekstrak_selected(){
        $post = $this->input->post();
        $pasal_array = $post['pasal-download'];
        $id_tbl_uu = $post['id_tbl_uu'];
        try {
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $section = $phpWord->addSection();
            $section->addText($post['uu_judul'],['bold'=>true]);
            $section->addTextBreak();
            $section->addText($post['uu_tentang']);
            $section->addTextBreak();
            foreach($pasal_array as $pa):
                $section->addText($pa);
                $section->addTextBreak();
                $pasal_content = $this->get_pasal($pa,$id_tbl_uu);
                $section->addText($pasal_content);
                $section->addTextBreak();
            endforeach;
        // echo $wordstring;
        // exit;
        // var_dump($wordstring);
        // exit;
        #$wordstring = mb_convert_encoding($wordstring, "UTF-8");
        
            
            #$section->addText($wordstring);
            \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
            $filename = $post['uu_judul'].".docx";
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
            header("Content-Disposition: attachment; filename=".$filename);
            #ob_clean();
            $objWriter->save('php://output');
            #exit;
         } catch (Exception $e) {
            echo $e->getMessage();
         }
    }
}