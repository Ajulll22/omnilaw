<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
            <?php } else { ?>
                <h4 class="page-title">Arsip Dokumen</h4>
            <?php } ?>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
                            <li class="breadcrumb-item active" aria-current="page">Arsip UU</li>
                        <?php } else { ?>
                            <li class="breadcrumb-item active" aria-current="page">Arsip Dokumen</li>
                        <?php } ?>
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
                    <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
                        <h5 class="card-title">
                            Dokumen Arsip UU </h5>
                        <a href="<?php echo base_url('admin/kelola/tambah/') ?>" class="button-pull-right">
                            <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">
                                <i class="ace-icon fa fa-plus"></i>
                                Arsip Baru
                            </button>
                        </a>
                        <hr><br>
                        <!-- <select class="form-control col-md-3" id="kategori" onchange="changeData()">
                            <option value="">--Pilih Kategori</option>
                            <?php foreach ($kategori as $key => $value) { ?>
                                <option value="<?= $value->kategori_id ?>"><?= $value->nama_kategori ?></option>
                            <?php } ?>
                        </select> -->

                        <form action="<?= base_url('admin/kelola') ?>">
                            <?php foreach ($kategori as $key => $value) { ?>
                                <input type="checkbox" name="kat[]" id="myCheck<?= $value->kategori_id ?>" value="<?= $value->kategori_id ?>" <?php if ($_GET) {
                                                                                                                                                    foreach ($_GET['kat'] as $key_kat => $value_kat) {
                                                                                                                                                        if ($value_kat == $value->kategori_id) {
                                                                                                                                                            echo "checked";
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                } ?>>
                                <label><?= $value->nama_kategori ?></label><br>
                            <?php } ?>
                            <button type="submit" class="btn btn-success"><i class=" fa fa-filter">Filter</i></button>
                        </form>
                        </h5>
                    <?php } ?>
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table id="zero_config" class="table table-striped table-bordered datatables">
                            <thead>
                                <tr>
                                    <th width="2%">No</th>
                                    <th width="15%">Peraturan</th>
                                    <th>Tentang</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
                                        <th width="20%">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody id="getTable">
                                <?php
                                $no = 0;
                                foreach ($listData as $key => $value) {
                                    $no++;
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $value->uu ?></td>
                                        <td><?php echo $value->tentang ?></td>
                                        <td><?php echo $value->nama_kategori ?></td>
                                        <?php if ($value->status == 1) { ?>
                                            <td>Menunggu Verifikasi</td>
                                        <?php } ?>
                                        <?php if ($value->status == 2) { ?>
                                            <td>Tidak Berlaku</td>
                                        <?php } ?>
                                        <?php if ($value->status == 3) { ?>
                                            <td>Berlaku</td>
                                        <?php } ?>
                                        <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
                                            <td>
                                                <a href="<?php echo base_url('uploads/' . $value->file_arsip); ?>" target="_blank" class="btn btn-success mdi mdi-download"> Unduh</a>
                                                <a href="<?php echo base_url('admin/kelola/ubah/' . $value->id_tbl_uu); ?>" class="text-white btn btn-warning mdi mdi-table-edit "> Edit</a>
                                                <a href="<?php echo base_url('admin/kelola/hapus/' . $value->id_tbl_uu); ?>" class="btn btn-danger mdi mdi-delete" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')">
                                                    Hapus</a>
                                            </td>
                                        <?php } ?>
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
<script type="text/javascript">
    $(document).ready(function() {
        $("#test").CreateMultiCheckBox({
            width: '230px',
            defaultText: 'Select Below',
            height: '250px'
        });
    });
    // function checkKategori(id){
    //     var checkBox = document.getElementById('myCheck'+id);
    //     if (checkBox.checked == true){
    //         console.log(id);
    //     $.ajax({ 
    //         type: 'POST', 
    //         url: "<?= base_url('admin/kelola/getDataByKategori/') ?>"+id, 
    //         dataType: 'json',
    //         success: function (data) { 
    //             $('#getTable').empty();
    //             console.log(data);
    //             for(var i=0; i<data.length; i++){
    //                 $('#getTable').append('<tr><td>'+ no++ +'</td><td>'+data[i].judul_arsip+'</td><td>'+data[i].jenis_arsip+'</td><td>'+data[i].nama_kategori+'</td><?php if ($this->session->userdata["loginData"]["Level"] != "user") { ?><td><a href="<?php echo base_url(); ?>uploads/'+data[i].file_arsip+'"  class="btn btn-success mdi mdi-download" ></a><a href="<?php echo base_url(); ?>admin/kelola/edit/'+data[i].id_arsip+'"  class="btn btn-primary"  >Edit</a><a href="<?php echo base_url(); ?>admin/kelola/doDelete/'+data[i].id_arsip+'" class="btn btn-danger" onclick="return confirm(`Anda yakin ingin menghapus data ini ? `)">Hapus</a></td><?php } ?></td></tr> ');
    //             }
    //         }
    //     })
    //     }
    //     else{
    //         console.log(id);
    //     }

    // }
    // function changeData(){
    //     var no = 1;
    //     var id = $('#kategori').val();

    //     $.ajax({ 
    //         type: 'POST', 
    //         url: "<?= base_url('admin/kelola/getDataByKategori/') ?>"+id, 
    //         dataType: 'json',
    //         success: function (data) { 
    //             $('#getTable').empty();
    //             console.log(data);
    //             for(var i=0; i<data.length; i++){
    //                 $('#getTable').append('<tr><td>'+ no++ +'</td><td>'+data[i].judul_arsip+'</td><td>'+data[i].jenis_arsip+'</td><td>'+data[i].nama_kategori+'</td><?php if ($this->session->userdata["loginData"]["Level"] != "user") { ?><td><a href="<?php echo base_url(); ?>uploads/'+data[i].file_arsip+'"  class="btn btn-success mdi mdi-download" ></a><a href="<?php echo base_url(); ?>admin/kelola/edit/'+data[i].id_arsip+'"  class="btn btn-primary"  >Edit</a><a href="<?php echo base_url(); ?>admin/kelola/doDelete/'+data[i].id_arsip+'" class="btn btn-danger" onclick="return confirm(`Anda yakin ingin menghapus data ini ? `)">Hapus</a></td><?php } ?></td></tr> ');
    //             }
    //         }
    //     })


    // }
</script>