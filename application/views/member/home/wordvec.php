<div class="modal fade" id="openDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header text-center">
    <h4 class="modal-title w-100 uu" id="uu"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-header text-center">
        <h4 class="modal-title w-100 tentang" id="tentang"></h4>

    </div>
    <div class="modal-body">
        
        <h5 class="uud_id"></h5>
        <h5 class="uud_detail"></h5>

        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
    </div>
</div>
</div>

<?php foreach($hasil->values as $value): ?>
<div class="card mb-2">
    <h3 class="card-header text-center"><?php echo $value->uu ?></h3>
    <div class="card-body">
        <h5 class="text-capitalize font-weight-bold">Tentang <?php echo ucwords(strtolower($value->tentang)) ?></h5>
        <div class="row" >
        <?php foreach($value->pasal as $pasal): ?>
        <div class="col-4">
            <h6 class="mt-2"><a class="openDetail" data-toggle="modal" data-target="#openDetail" href="#" data-uu="<?php echo $value->uu ?>" data-id="<?php echo $pasal->id ?>" data-tentang="<?php echo ucwords(strtolower($value->tentang)) ?>" data-uud_id="<?php echo $pasal->uud_id ?>" data-uud_detail="<?php echo $pasal->uud_detail ?>" ><?php echo $pasal->uud_id ?></a></h6>
            <h6>Similaritas <?php echo $pasal->presentase ?>%</h6>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<br>
<br>

<script>
    $(document).ready(function(){
 
        // get Edit Product
        $('.openDetail').on('click',function(){
            // get data from button edit
            const uud_id = $(this).data('uud_id');
            const uu = $(this).data('uu');
            const tentang = "Tentang " + $(this).data('tentang');
            const uud_detail = $(this).data('uud_detail');
            // Set data to Form Edit
            $('.uu').html(uu);
            $('.tentang').html(tentang);
            $('.uud_id').html(uud_id);
            $('.uud_detail').html(uud_detail);
            // Call Modal Edit
        });
         
    });
</script>