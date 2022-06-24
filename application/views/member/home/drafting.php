<?php include_once dirname(__FILE__).'/header.php';?>
<section class="info_service">
    <div class="container">
        <div class="row ">
            <h3>Drafting Undang-Undang</h3>
            <hr>
            <div class="col">

                <div class="box-shadow">
                    <form method="get" action="<?php echo base_url('home/drafting/tema'); ?>">
                        <div class="form-group">
                            <div class="col-md-8 mx-auto">
                                <div class="input-group">
                                    <input class="form-control border-end-0 border rounded-pill mt-5" name="search"
                                        type="search" id="example-search-input" minlength=2
                                        placeholder="Tulis tema UU yang ingin dicari disini!" required>&nbsp;
                                    <span class="input-group-append mt-5">
                                        <button type="submit" class="btn-primary rounded-pill"><i
                                                class="fas fa-search"></i> Cari</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br />
                    </form>
                    <br>
                    <?php if(isset($kategori)){?>
                    <form method="get" action="<?php echo $actual_link; ?>">
                        <input type="hidden" name="search" value="<?= $_GET['search']?>">
                        <?php foreach($kategori as $key=>$value){?>
                        <input type="checkbox" name="kat[]" id="myCheck<?= $value->kategori_id?>"
                            value="<?= $value->kategori_id?>" <?php if(isset($_GET['kat'])){
                            foreach ($_GET['kat'] as $key_kat => $value_kat) {
                                if($value_kat == $value->kategori_id){
                                    echo "checked";
                                }
                            }
                        }?>>
                        <label><?= $value->nama_kategori?></label><br>
                        <?php }?>
                        <button type="submit" class="btn btn-success"><i class="fas fa-filter"></i> Filter</button>
                        <?php }?>

                    </form>
                </div>
            </div>
        </div>
        <?php
            if(isset($_GET['search'])){
                echo "<h6 class='mt-4'>".$total_word[0]['total_word']." hasil pencarian untuk '".$_GET['search']."'</h6>";
                echo "<h6>terdapat dalam ".count($search_results)." Undang-Undang</h6>";
            }
            // else{
            //     echo "<h6 class='mt-4'>4.819 hasil pencarian untuk 'pajak'</h6>";
            // }
        ?>
        <!-- <h6 class="mt-4">4.819 hasil pencarian untuk "pajak"</h6> -->
        <?php
            foreach($search_results as $key=>$search_result){
                
            #print($key);
        ?>
        <div class="card mt-4 mb-4">
            <h5 class="card-header"><?php echo $search_result['uu'] ?></h5>
            <div class="card-body">
                <h5 class="card-title">Tentang
                    <?php echo ucwords(strtolower($search_result['tentang'])) ?></h5>
                <p class="card-text">Disebut <?php echo $word_tiap_pasal[$key]['total_kata_pasal'] ?> kali.</p>
                <a class="btn btn-primary text-white" href="<?= base_url().'home/show_detail_pasal?id='.$search_result['id_tbl_uu']?>&search=<?= $_GET['search'] ?>" target="_blank">Lihat</a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</section>
<br><br><br>
<?php include_once dirname(__FILE__).'/footer.php';?>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js">
</script>
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
    var objhtml = '<object class="pdfobject" width="100%" height="700px" data="' + datapdf +
        '" type="application/pdf">'
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