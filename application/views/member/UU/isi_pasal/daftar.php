<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Peraturan</li>
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
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <h5 class="card-title">Detail Peraturan</h5>
                    
                    <a href="<?php echo base_url('admin/uu/addPasal/') ?>" class="button-pull-right" >
                        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" >
                            <i class="ace-icon fa fa-plus"></i>
                            Detail Peraturan
                        </button>
                    </a> 
                    <hr>
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table id="zero_config" class="table table-striped table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Peraturan</th>
                                    <th>Tentang</th>
                                    <th>Pasal</th>
                                    <th>Isi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 0;
                                foreach ($listData as $key => $value){
                                    $no++;
                                    $tmp = explode(" ",$value->uud_id);
                                    for($i=0;$i<count($tmp);$i++):
                                        $startString = "pasal~";
                                        $string = $tmp[$i];
                                        $len = strlen($startString);
                                        if(substr($string, 0, $len) === $startString):
                                            $tmp_array[$string] = "";
                                            #echo $string;
                                        endif;
                                    endfor;
                                    
                                    $pasal_array = array_keys($tmp_array);
                                    #print_r($string);
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $value->uu?></td>
                                    <td><?php echo $value->tentang ?></td>
                                    <td><?php echo $string?></td>
                                    <td><?php echo $value->uud_content?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/UU/pasal/edit'.$value->id); ?>"  class="text-white btn btn-warning mdi mdi-table-edit"> Edit</a>
                                        <a href="<?php echo base_url('admin/UU/pasal/DeletePasal/'.$value->id); ?>" class="btn btn-danger mdi mdi-delete"" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')"> Hapus</a>
                                    </td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
