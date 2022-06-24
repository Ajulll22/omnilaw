<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Edit Data User</h4>
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
               <form class="form-horizontal" method="post" action="<?php echo base_url('admin/kelola/doEdit/'.$detailData->id_arsip); ?>" enctype="multipart/form-data">
                  <div class="card-body">
                   <?php echo $this->session->flashdata('msgbox') ?>
                    <h4 class="card-title">Input Data Arsip</h4>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Dokumen</label>
                      <div class="col-sm-9">
                        <input type="text" name="nama_dokumen" class="form-control" placeholder="Nama Dokumen" value="<?= $detailData->judul_arsip?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Unggah Dokumen</label>
                      <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" placeholder="Berkas" id="change" accept=".pdf">
                        <p id="move"><?= $detailData->file_arsip?></p>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Jenis Dokumen</label>
                      <div class="col-sm-9">
                        <input type="text" name="jenis_dokumen" class="form-control" placeholder="Jenis Dokumen" value="<?= $detailData->jenis_arsip?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Kategori</label>
                      <div class="col-sm-9">
                        <select name="kategori" class="form-control" value="<?= $detailData->nama_kategori?>" required>
                          <?php foreach($kategori as $value){?>
                            <option value="<?= $value->kategori_id?>" <?php if($value->kategori_id == $detailData->id_kategori){echo "selected";} ?> ><?= $value->nama_kategori?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-offset-2 col-sm-9">
                        <button type="submit" class="btn btn-default">Submit</button>
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
<script type="text/javascript">
    document.getElementById('change').change(function () {
    var test = document.getElementById('change').val();
    console.log(test);
    document.getElementById('move').innerHTML = "";
  })
</script>