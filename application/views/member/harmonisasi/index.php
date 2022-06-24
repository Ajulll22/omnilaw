
<?php
$actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $actual_link?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
          <?php if($this->session->userdata['loginData']['Level'] !="user"){?>
            <?php }else{?>
                <h4 class="page-title">Harmonisasi UU</h4>
            <?php }?>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <?php if($this->session->userdata['loginData']['Level'] !="user"){?>
                        <li class="breadcrumb-item active" aria-current="page">Harmonisasi UU</li>
                        <?php }else{?>
                        <li class="breadcrumb-item active" aria-current="page">Harmonisasi UU</li>
                        <?php }?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php 
                        if($this->session->flashdata('gagal')){ ?>
                        <div class="alert alert-block alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                            </button>
                            <?=$this->session->flashdata('gagal')?>
                        </div>
                    <?php        
                        }
                    ?>
                    <?php 
                        if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-block alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                            </button>
                            <?=$this->session->flashdata('success')?>
                        </div>
                    <?php        
                        }
                    ?>

                    <form method="post" action="<?php echo base_url('admin/harmonisasi/hitungSimiliarity'); ?>" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label class=" form-control-label">Jenis Regulasi</label>
                                <div class="input-group col-12">
                                    <input type="text" name="judul_dokumen" class="form-control" placeholder="UU No Tahun" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Unggah File (.pdf)</label>
                                <div class="input-group col-12">
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                                <br>
                            </div>
                            <button type="submit" class="btn btn-primary">Cek Kesamaan</button>
                        </div>
                    </form>
                    
                    <?php 
                        if($this->session->userdata('q')){ 
                        ?>
                    <div style="float: right;">
                    
                    <form action="<?php echo base_url('admin/harmonisasi/hitungSimiliarityy'); ?>" method="post">
                        <textarea name="query" style="display: none;" cols="1000" rows="1000"><?= $this->session->userdata('q')?></textarea>
                        <button type="submit" class="btn btn-success clik">Lihat Hasil</button>
                    </form>
                    </div>
                    <br><br>
                                    
                    <?php        }
                    ?>
                    <?php
                        if(isset($table)){?>
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th>Nama Peraturan</th>
                                        <th>Banyaknya Kata</th>
                                        <th>Kesamaan</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=$table['judul_dokumen']?></td>
                                        <td><?=$table['banyak_kata']?></td>
                                        <td><?=$table['persen']?>%</td>
                                        <td><?=$table['tanggal']?></td>
                                    </tr>
                                </tbody>
                            </table>
                                        
                    <a href="<?php echo base_url()?>/uploads" download="Arsip202003243.docx" class="btn btn-success"><i class="fas fa-print"></i> Cetak</a>
                    <br><br>  
                        </div>
                    <?php
                        }
                    ?>
                    <?php if(isset($kategori)){?>
                        <form method="post" action="<?php echo base_url('home/hitungsimiliarityy'); ?>">
                        <textarea name="query" style="display: none;" cols="1000" rows="1000"><?= $this->session->userdata('q')?></textarea>
                            <?php foreach($kategori as $key=>$value){?>
                            <input type="checkbox" name="kat[]" id="myCheck<?= $value->kategori_id?>" value="<?= $value->kategori_id?>" 
                            <?php if(isset($_POST['kat'])){
                                foreach ($_POST['kat'] as $key_kat => $value_kat) {
                                    if($value_kat == $value->kategori_id){
                                        echo "checked";
                                    }
                                }
                            }?>
                            >
                            <label><?= $value->nama_kategori?></label><br>
                        <?php }?>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-filter"></i>Filter</button>
                    <?php }?>
                    </form>

                    <br>    
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered datatables">
                            <thead>
                                <tr>
                                    <th width="5%" style="text-align:center" >No</th>
                                    <th width="10%" style="text-align:center">Peraturan</th>
                                    <th width="50%" style="text-align:center">Tentang</th>
                                    <th  width="15%" style="text-align:center">Kategori</th>
                                    <th  width="20%" style="text-align:center">Similaritas</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=1;
                                if(!empty($data)){ ?>
                                <style>
                                    #text {
                                        display: none;
                                    }
                                </style>
                                <?php
                                    foreach($data as $key=>$value){?>
                                            <tr>
                                                <td style="text-align: center"><?= $i++?></td>
                                                <?php if(isset($_GET['ruu'])){
                                                    $href = removeQueryStringParameter2($actual_link, 'ruu').'&ruu='.$value['id_arsip'];
                                                }else{
                                                    $href = $actual_link.'&ruu='.$value['id_arsip'];
                                                }    
                                                ?>
                                                <td style="text-align: center">
                                                    <form action="<?=$actual_link?>" method="post">
                                                        <input type="hidden" name="ruu" value="<?=$value['id_arsip']?>">
                                                        <textarea name="query" style="display: none;" cols="5" rows="5"><?= $this->session->userdata('q')?></textarea>
                                                        <button class="btn btn-link"><?= $value['judul_arsip']?></button>
                                                    </form>
                                                </td>
                                                
                                                <td style="text-align: left"><?= $value['jenis_arsip']?></td>
                                                <td style="text-align: center"><?= $value['kategori']?></td>
                                                <td style="text-align: center"><?= $value['kataSama']?>(<?= number_format(100*$value['cosSim'],2)?>%)</td>
                                            </tr>
                                <?php }}?>
                            </tbody>
                        </table><br>
                    </div>
                    <hr>
                    <br>
                    <!-- View PDF -->
                    <div id="getText">
                    <?php if(isset($getArsip1)){?>
                        <div class="overflow-auto" id="forChange" style="text-align: center; ">
                            <p style="background-color: light; height: 1000px; overflow: scroll;"><?= $getArsip1?></p>
                        </div> <br><br>
                    <?php }?>
                        <!-- Akhir View PDF -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
        if(isset($_POST['search'])){
        // print_r(json_encode($_GET['search']));
        $query1 = str_replace(array('\r','\n','/', '\\', '%', '&', '#', '@', '^', '*', ':', '+',';', ),'',json_encode($_POST['search']));
        $query1 = json_decode($query1);
        // $query1 = explode(" ", $query1);
        // print_r(json_encode($query1));
    }
    ?>

<?php function removeQueryStringParameter2($url, $varname)
{
    $parsedUrl = parse_url($url);
    $query = array();

    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $query);
        unset($query[$varname]);
    }

    $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
    $query = !empty($query) ? '?'. http_build_query($query) : '';

    return $parsedUrl['scheme']. '://'. $parsedUrl['host']. $path. $query;
}
?>

<script>
    $(document).ready(function(){
        $('#ruuget').on('click',function(){
            $.ajax({
                url: (this).attr('href'),
            })
        })
    })
</script>