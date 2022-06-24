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
                            <li class="breadcrumb-item active" aria-current="page">Pasal UU</li>
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
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
                        <h5 class="card-title">Data Pasal UU</h5>
                        <a href="<?php echo base_url('admin/pasal/tambah/') ?>" class="button-pull-right">
                            <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">
                                <i class="ace-icon fa fa-plus"></i>
                                Tambah Pasal
                            </button>
                        </a>
                        <hr><br><br>
                    <?php } ?>
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table id="zero_config" class="table table-striped table-bordered datatables">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Bagian</th>
                                    <th>Peraturan</th>
                                    <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
                                        <th width="15%">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($listData as $key => $value) {
                                    $no++;
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $value->uud_id ?></td>
                                        <td><?php echo $value->uu ?></td>
                                        <?php if ($this->session->userdata['loginData']['Level'] != "user") { ?>
                                            <td>
                                                <a href="<?php echo base_url('admin/pasal/ubah/' . $value->id); ?>" class="text-white btn btn-warning mdi mdi-table-edit">Edit</a>
                                                <a href="<?php echo base_url('admin/pasal/hapus/' . $value->id); ?>" class="btn btn-danger mdi mdi-delete" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')">Hapus</a>
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