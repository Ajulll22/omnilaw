<?php include_once dirname(__FILE__) . '/header.php'; ?>

<section class="info_service">

    <div class="container h-100">
        <div class="row mt-5">
            <div class="col">
                <a href="<?= base_url() ?>home/arsip">
                    <div class="bg-image d-flex justify-content-center align-items-center shadow-lg p-3 mb-5 bg-white rounded" style="
            background-image: url('<?= base_url() . "assets/images/homearsip.jpg" ?>');
            height: 40vh
            ">
                        <h1 class="text-white hover-shadow">Arsip UU</h1>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="<?= base_url() ?>home/cousine">
                    <div class="bg-image d-flex justify-content-center align-items-center shadow-lg p-3 mb-5 bg-white rounded" style="
            background-image: url('<?= base_url() . "assets/images/homedrafting.jpg" ?>');
            height: 40vh
            ">
                        <h1 class="text-white hover-shadow">Drafting UU</h1>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="<?= base_url() ?>home/similiarity">
                    <div class="bg-image d-flex justify-content-center align-items-center shadow-lg p-3 mb-5 bg-white rounded" style="
            background-image: url('<?= base_url() . "assets/images/homeharmoni.jpg" ?>');
            height: 40vh
            ">
                        <h1 class="text-white hover-shadow">Harmonisasi UU</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>
<!--start footer-->

<?php include_once dirname(__FILE__) . '/footer.php'; ?>