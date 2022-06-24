<?php include_once dirname(__FILE__) . '/header.php'; ?>
<section class="info_service">
  <div class="container">
    <div class="row ">
      <h3>Arsip Undang-Undang</h3>
      <hr>
      <div class="col-md-12 col-sm-12 mt-0 pt-0">
        <table id="TableSortArsip" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="background-color:#FFFFFF;">
          <thead>
            <tr>
              <th style="text-align:center"><b>No</th>
              <th width="20%" style="text-align:center"><b>Peraturan</th>
              <th width="30%" style="text-align:center"><b>Tentang</th>
              <th width="15%" style="text-align:center"><b>Kategori</th>
              <th width="15%" style="text-align:center"><b>Status</th>
              <th width="15%" style="text-align:center"><b>Tindakan</th>
            </tr>
          </thead>
          <tbody> <?php $i = 1;
                  foreach ($listData as $key => $value) { ?> <tr>
                <td style="text-align:center"> <?= $i++ ?> </td>
                <td style="text-align:center"> <?= $value->uu ?> </td>
                <td style="text-align:left"> <?= ucwords(strtolower($value->tentang)) ?> </td>
                <td style="text-align:center"> <?= $value->nama_kategori ?> </td>
                <td style="text-align:center">
                  <!-- <a style="color:red"> -->
                  <?php if ($value->status == 3) {
                      echo '<a class="btn-sm btn-success text-white"</a>Berlaku';
                    } elseif ($value->status == 2) {
                      echo '<a class="btn-sm btn-danger text-white"</a>Tidak Berlaku';
                    } elseif ($value->status == 1) {
                      echo '<a class="btn-sm btn-warning text-white"</a>Belum Verifikasi';
                    }
                  ?>
                  <!-- </a> -->
                </td>
                <td style="text-align:center">
                  <a class="btn-sm btn-warning text-white" data-toggle="modal" data-target="#exampleModal" data-pdf="
									<?= base_url() . 'uploads/' . $value->file_arsip ?>">
                    <i class="fas fa-eye"> Lihat</i>
                  </a>
                  &nbsp;
                  <a class="btn-sm btn-primary text-white" href="
									<?= base_url() . 'uploads/' . $value->file_arsip ?>" target="_blank" download="
									<?= $value->uu ?>">
                    <i class="fas fa-download"> Unduh</i>
                  </a>
                </td>
              </tr> <?php } ?> </tbody>
        </table>
        <br>
        <br>
        <!-- Modal View PDF -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" width="90%" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="graph-outline"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal View PDF -->
      </div>
    </div>
  </div>
</section>
<br><br>
<?php include_once dirname(__FILE__) . '/footer.php'; ?>
<!-- JavaScript -->

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<!-- JavaScript -->
<script src="https://github.com/pipwerks/PDFObject/blob/master/pdfobject.min.js"></script>


<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="../assets/mdbootstrap/datatables.min.js"></script>
<script type="text/javascript">
  // Basic example
  $(document).ready(function() {
    $('#TableSortArsip').DataTable({
      "searching": true, // false to disable search (or any other option)
      "paging": true
    });
    $('.dataTables_length').addClass('bs-select');

  });

  $('#exampleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var datapdf = button.data('pdf') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var objhtml = '<object class="pdfobject" width="100%" height="700px" data="' + datapdf + '" type="application/pdf">'
    objhtml += '<embed class="pdfembed" src="' + datapdf + '" type="application/pdf" />'
    objhtml += '</object>'

    var modal = $(this)
    modal.find('.graph-outline').html(objhtml)
  })

  $('#exampleModal').on('hide.bs.modal', function(event) {

    var modal = $(this)
    var objpdf = modal.find('.graph-outline');
    objpdf.empty();


  })
</script>