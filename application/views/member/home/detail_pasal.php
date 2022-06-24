<?php include_once dirname(__FILE__).'/header.php';?>
<style> 
#main {
  display: flex;
  justify-content: right;
}
</style>
<section class="info_service">
    <div class="container">
        <div class="row ">
            <center>
                <h3><?= ($detail_uu[0]['uu'])?></h3>
                <h4>Tentang <?= ucwords(strtolower($detail_uu[0]['tentang']))?></h4>
            </center>
            <hr>
            <div class="col-4" cols="100%">
                <form action="<?= base_url() ?>Toword/ekstrak_selected" method="POST">
                <input type="hidden" name="uu_judul" value="<?= ($detail_uu[0]['uu'])?>">
                <input type="hidden" name="uu_tentang" value="Tentang <?= ucwords(strtolower($detail_uu[0]['tentang']))?>">
                <input type="hidden" name="id_tbl_uu" value="<?=$_GET['id']?>">
                <div class="row">
                <!-- <a href="<?= base_url() ?>Toword/ekstrak" class="submit btn-sm btn-success text-white label-pasal text-center"><i class="fas fa-download" aria-hidden="true"></i> Ekstrak Pasal</a> -->
                <input type="submit" value="Ekstrak Pasal Terpilih" class="submit btn-sm btn-success text-white label-pasal text-center">
                    <!-- <button class="submit btn-sm btn-success text-white label-pasal"><i class="fas fa-download" aria-hidden="true"></i> Ekstrak Pasal</button> -->
                </div>
                <div class="row">
                <?php 
                    $pacount = 0;
                    foreach($pasal_array as $pa):
                ?>  
                    <div class="col-3 mt-2">
                        <input type="checkbox" id="pasal-download" name="pasal-download[]" value="<?=$pa?>"><br>
                            <a onclick="getUUPasal('<?=$pa?>')"  class="btn-sm btn-outline-primary text-white label-pasal <?=$pa?>"><?=$pa?></a>
                    </div>
                    
                <?php
                    if($pacount == 5):
                        $pacount = 0;
                        echo "<br>";
                    endif; 
                    endforeach;
                ?>

                </div>
                </form>
            </div>
            <div class="col-8"> 
                <div class="row">
                <div class="col-6">
                <h5 id="title_pasal_content"></h6>
                </div>
                <div class="col-6 " id="main">
                    <!-- <a href="<?= base_url() ?>Tesword/test" class="submit btn-sm btn-outline-success display: flex; justify-content: right;"><i class="fas fa-download" aria-hidden="true"></i> Ekstrak Pasal</a> -->
                <!-- <button class="submit btn-sm btn-outline-success display: flex; justify-content: right;"><i class="fas fa-download" aria-hidden="true"></i> Ekstrak Pasal</button> -->
                </div>
                </div>
                <p style="text-align: justify;" id="show_pasal_content"></p>
            </div>
            
        </div>
    </div>
</section>
<br><br><br>
<?php include_once dirname(__FILE__).'/footer.php';?>
<!-- JavaScript -->
<script>
    function getUUPasal(pasal){
        $('.label-pasal').removeClass('btn-primary');
        $('#title_pasal_content').html(pasal);
        $.ajax({
        type : "GET",
        url  : "<?php echo base_url('home/get_pasal?pasal=')?>"+pasal+"&id="+"<?=$_GET['id']?>",
        success: function(data){
            $('#show_pasal_content').html(data);
            let searched = "<?=$_GET['search']?>"; 
            if (searched !== "") {
                let text = document.getElementById("show_pasal_content").innerHTML;
                let re = new RegExp(searched,"gi"); // search for all instances
                    let newText = text.replace(re, `<mark style="background-color: yellow;">${searched}</mark>`);
                    document.getElementById("show_pasal_content").innerHTML = newText;
            }
            }
        });
    }
    
    function search(e) {
	
    }
</script>
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