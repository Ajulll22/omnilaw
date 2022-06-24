<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Arsip UU</li>
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
                <form class="form-horizontal" method="post" action="<?php echo base_url('admin/kelola/doUbah/' . $detailData->id_tbl_uu); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php echo $this->session->flashdata('msgbox') ?>
                        <h4 class="card-title">Form Input Data Arsip UU</h4>
                        <hr>
                        <br><br>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama UU</label>
                            <div class="col-sm-9">
                                <input type="text" name="uu" class="form-control" placeholder="Nama UU" value="<?= $detailData->uu ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Unggah Dokumen</label>
                            <div class="col-sm-9">
                                <input type="file" name="file_arsip" class="form-control" placeholder="Berkas" accept=".pdf">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tentang</label>
                            <div class="col-sm-9">
                                <input type="text" name="tentang" class="form-control" placeholder="Tentang Dokumen UU" value="<?= $detailData->tentang ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select name="kategori" class="form-control" value="<?= $detailData->nama_kategori ?>" required>
                                    <?php foreach ($kategori as $value) { ?>
                                        <option value="<?= $value->kategori_id ?>" <?php if ($value->kategori_id == $detailData->id_kategori) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $value->nama_kategori ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 text-right control-label col-form-label">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->