<?php  $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
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
                        <li class="breadcrumb-item active" aria-current="page">Drafting UU</li>
                        <?php }else{?>
                        <li class="breadcrumb-item active" aria-current="page">Drafting UU</li>
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
                    <form method="get" action="<?php echo base_url('admin/drafting/hitungCousine'); ?>">       
                        <div class="form-group">
                            <label class=" form-control-label">Tema UU</label>
                            <div class="input-group col-md-12">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="search" rows="3" placeholder="Tulis tema yang ingin dicari disini!" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                        <br/>
                    </form>
                    <br>
                    <?php if(isset($kategori)){?>
                    <form method="get" action="<?php echo $actual_link; ?>">
                        <input type="hidden" name="search" value="<?= $_GET['search']?>">
                            <?php foreach($kategori as $key=>$value){?>
                            <input type="checkbox" name="kat[]" id="myCheck<?= $value->kategori_id?>" value="<?= $value->kategori_id?>" 
                            <?php if(isset($_GET['kat'])){
                                foreach ($_GET['kat'] as $key_kat => $value_kat) {
                                    if($value_kat == $value->kategori_id){
                                        echo "checked";
                                    }
                                }
                            }?>
                            >
                            <label><?= $value->nama_kategori?></label><br>
                        <?php }?>
                    <button type="submit" class="btn btn-success"><i class="fas fa-filter"></i> Filter</button>
                    <?php }?>
                    
                    </form>
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
                                    if(!empty($data)){
                                        foreach($data as $key=>$value){?>
                                            <tr>
                                                <td style="text-align: center"><?= $i++?></td>
                                                    <?php if(isset($_GET['ruu'])){
                                                        $href = removeQueryStringParameter3($actual_link, 'ruu').'&ruu='.$value['id_arsip'];
                                                            }else{
                                                                $href = $actual_link.'&ruu='.$value['id_arsip'];
                                                                }    
                                                                // echo removeQueryStringParameter($href, 'ruu').'<br>';
                                                                // echo $href.'<br>';
                                                    ?>
                                                <td style="text-align: center"><a href="<?= $href?>"><?= $value['judul_arsip']?></a></td>
                                                <td style="text-align: center"><?= $value['jenis_arsip']?></td>
                                                <td style="text-align: center"><?= $value['kategori']?></td>
                                                <td style="text-align: center"><!-- <?= $value['kataSama']?> -->(<?= number_format(100*$value['cosSim'],2)?>%)</td>
                                                                <!-- <td style="text-align: center"><?= $value->totalKata?></td> -->
                                                                <!-- <td style="text-align: center"><?= $value->cosSim?></td> -->
                                                </tr>
                                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <hr>
                        <br>
                    <div id="getText">
                    <?php if(isset($getArsip1)){?>
                        <div class="overflow-auto" id="forChange" style="text-align: center; ">
                            <p style="background-color: light; height: 1000px; overflow: scroll;"><?= $getArsip1?></p>
                        </div> <br><br>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
        if(isset($_GET['search'])){
        // print_r(json_encode($_GET['search']));
        $query1 = str_replace(array('\r','\n','/', '\\', '%', '&', '#', '@', '^', '*', ':', '+',';', ),'',json_encode($_GET['search']));
        $query1 = json_decode($query1);
        // $query1 = explode(" ", $query1);
        // print_r(json_encode($query1));
    } ?>

<?php function removeQueryStringParameter3($url, $varname)
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