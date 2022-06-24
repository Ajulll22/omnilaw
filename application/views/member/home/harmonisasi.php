<?php include_once dirname(__FILE__) . '/header.php';
// echo $actual_link
?>


<div class="container">
    <div class="row">
        <h3>Harmonisasi Undang-undang</h3>
        <hr><br>
        <div class="col-sm-3 col-md-3 col-lg-3">

            <div class="box-shadow p-3">
                <form method="post" id="formupload" action="<?php echo base_url('home/harmonisasi'); ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class=" form-control-label">RUU (.pdf)</label>
                        <div class="input-group col-md-12">
                            <input type="file" name="pembanding" accept="application/pdf">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnupload"><i class="fas fa-search"></i> Cari</button>
                    <br />
                </form>
                <br>
            </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-9" id="isloading">
        </div>
    </div>
</div>
<?php include_once dirname(__FILE__) . '/footer.php'; ?>
<!--start footer-->

<script>
    $(document).ready(function() {
        $('#formupload').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url('home/harmonisasi'); ?>',
                type: "post",
                data: new FormData(this),
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $("#isloading").html('<div class="text-center"><img src = "<?php echo base_url('assets/loading.gif'); ?>"></div>');
                    $('#btnupload').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Uploading...</i>');
                },
                complete: function() {
                    $('#btnupload').removeAttr("disable", "disable");
                    $('#btnupload').html('<i class="fas fa-search"></i> Cari');
                },
                success: function(data) {
                    $("#isloading").html(data);
                    console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    });
</script>