<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <!-- <h4 class="page-title"><?= $judul ?></h4> -->
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <h5 class="card-title"><?= $judul ?></h5>
                    <hr><br>
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table id="zero_config" class="table table-striped table-bordered datatables">
                            <thead>
                                <tr>
                                    <th width="4%">No</th>
                                    <th width="15%">Peraturan</th>
                                    <th>Tentang</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Tindakan</th>
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
                                        <td><?php echo $value->uu ?></td>
                                        <td><?php echo $value->tentang ?></td>
                                        <?php if ($value->status == 1) { ?>
                                            <td>Menunggu Verifikasi</td>
                                        <?php } ?>
                                        <?php if ($value->status == 2) { ?>
                                            <td>Tidak Berlaku</td>
                                        <?php } ?>
                                        <?php if ($value->status == 3) { ?>
                                            <td>Berlaku</td>
                                        <?php } ?>
                                        <td>
                                            <!-- <a href="<?php echo base_url('uploads/' . $value->file_arsip); ?>" target=”_blank” class="btn btn-success mdi mdi-download" ></a> -->
                                            <?php if ($value->status == 1) { ?>
                                                <a href="<?php echo base_url('admin/status/verified/' . $value->id_tbl_uu); ?>" class="btn btn-primary mdi mdi-thumb-up"></a>
                                            <?php } ?>
                                            <?php if ($value->status == 2) { ?>
                                                <a href="<?php echo base_url('admin/status/rekomend/' . $value->id_tbl_uu); ?>" class="btn btn-primary">Berlakuan</a>
                                            <?php } ?>
                                            <?php if ($value->status == 3) { ?>
                                                <a href="<?php echo base_url('admin/rekomendasi/unrekomend/' . $value->id_tbl_uu); ?>" class="btn btn-danger">Cabut Status Berlaku</a>
                                            <?php } ?>
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