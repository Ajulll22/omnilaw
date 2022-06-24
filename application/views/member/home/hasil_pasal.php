<?php include_once dirname(__FILE__) . '/header.php';
?>

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

<div class="container mt-5 mb-5">
    <center>
        <h3><?php echo $hasil->values->uu ?></h3>
        <h4>Tentang <?php echo ucwords(strtolower($hasil->values->tentang)) ?></h4>
    </center>
    <hr>
    <div class="row">
        <?php foreach ($hasil->values->pasal as $value) : ?>
            <div class="col-xl-6 col-sm-6 col-12">
                <div class="card mb-2" style="height: 7rem;">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h5 class="warning"><?php echo $value->hasil ?> %</h5>
                                    <span><?php echo $value->uud_id ?>
                                    </span>
                                </div>
                                <div class="align-self-center">
                                    <a class="openDetail" data-toggle="modal" data-target="#openDetail" href="#" data-uu="<?php echo $hasil->values->uu ?>" data-id="<?php echo $value->id ?>" data-tentang="<?php echo ucwords(strtolower($hasil->values->tentang)) ?>" data-uud_id="<?php echo $value->uud_id ?>" data-uud_detail="<?php echo $value->uud_detail ?>"><i class="fas">Lihat</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
</div>

<?php include_once dirname(__FILE__) . '/footer.php'; ?>

<script>
    $(document).ready(function() {

        // get Edit Product
        $('.openDetail').on('click', function() {
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