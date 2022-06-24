<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data UU</li>
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
                <form class="form-horizontal" method="post" action="<?php echo base_url('admin/uu/insertUu'); ?>" enctype="multipart/form-data">
                  <div class="card-body">
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <h4 class="card-title">Input Data UU Baru</h4>
                    <hr><br><br>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Peraturan</label>
                      <div class="col-sm-9">
                        <input type="text" name="peraturan" class="form-control" placeholder="Contoh : UU No 1 Tahun 2020" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tentang</label>
                      <div class="col-sm-9">
                        <input type="text" name="tentang" class="form-control" placeholder="Contoh : Pelayanan Publik" required>
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
