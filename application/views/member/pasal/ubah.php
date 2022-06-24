<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
                <form class="form-horizontal" method="post" action="<?php echo base_url('admin/pasal/perbarui/' . $detailData->id); ?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php echo $this->session->flashdata('msgbox') ?>
                        <h4 class="card-title">Form Input Pasal UU</h4>
                        <hr>
                        <br><br>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama UU</label>
                            <div class="col-sm-9">
                                <select name="id_tbl_uu" class="form-control" value="<?= $detailData->uu ?>" required>
                                    <?php foreach ($listUU as $value) { ?>
                                        <option value="<?= $value->id_tbl_uu ?>" <?php if ($value->id_tbl_uu == $detailData->id_tbl_uu) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $value->uu ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Bagian</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?= $detailData->uud_id ?>" name="uud_id" class="form-control" placeholder="Contoh : pasal~1 ayat~1" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Jenis Bagian</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?= $detailData->uud_section ?>" name="uud_section" class="form-control" placeholder="Contoh : ayat" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Bunyi</label>
                            <div class="col-sm-9">
                                <textarea id="summernote" rows="6" type="text" name="uud_content" required><?= $detailData->uud_content ?></textarea>
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