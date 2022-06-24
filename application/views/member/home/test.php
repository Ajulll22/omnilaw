<?php include_once dirname(__FILE__) . '/header.php';
$actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// echo $actual_link
?>

<div class="container">
    <div class="row">
        <h3>Harmonisasi Undang-undang</h3>
        <hr><br>
        <div class="col-sm-4 col-md-4 col-lg-6">

            <div class="box-shadow p-3">
                <form method="post" id="formupload" action="<?php echo base_url('home/coba'); ?>">

                    <div class="form-group">
                        <label class=" form-control-label">Bunyi Pasal UU</label>
                        <div class="input-group col-md-12 mb-2">
                            <textarea class="form-control" id="kalimat" name="kalimat" rows="6" placeholder="Tulis kata yang ingin dicari disini!" required></textarea>
                        </div>
                        <div class="input-group col-md-12">
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">--Pilih Kategori--</option>
                                <?php foreach ($kategori as $value) { ?>
                                    <option value="<?= $value->kategori_id ?>"><?= $value->nama_kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    <br />
            </div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-6">

            <div class="box-shadow overflow-auto p-3 h-100">
                <p id="content"></p>
                <br />
            </div>
        </div>
    </div>
    <div class="row" id="isLoading">

    </div>
    <br>
    <hr><br>
</div>
<?php include_once dirname(__FILE__) . '/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#formupload').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url('home/coba'); ?>',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $("#isLoading").html('<div class="text-center"><br><br><img src = "<?php echo base_url('assets/loading.gif'); ?>"></div>');
                },
                complete: function() {},
                success: function(data) {
                    $("#isLoading").html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    });
</script>
<!--start footer-->