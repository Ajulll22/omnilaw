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
                <form class="form-horizontal" method="post" action="<?php echo base_url('admin/kelola/doAdd'); ?>" enctype="multipart/form-data">
                  <div class="card-body">
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <h4 class="card-title">Form Input Data Arsip UU</h4>
                    <hr>
                    <br><br>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Jenis Regulasi</label>
                      <div class="col-sm-9">
                        <input type="text" name="nama_dokumen" class="form-control" placeholder="Jenis Regulasi" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Unggah Dokumen</label>
                      <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" placeholder="Berkas" required accept=".pdf">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tentang</label>
                      <div class="col-sm-9">
                        <input type="text" name="jenis_dokumen" class="form-control" placeholder="Tentang Dokumen UU" required>
                      </div>
                    </div>
                     <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kategori</label>
                      <div class="col-sm-9">
                        <select name="kategori" class="form-control" required>
                          <option value="">--Pilih--</option>
                          <?php foreach($kategori as $value){?>
                            <option value="<?= $value->kategori_id?>" ><?= $value->nama_kategori?></option>
                          <?php }?>
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