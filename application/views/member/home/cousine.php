<?php include_once dirname(__FILE__) . '/header.php';
$actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// echo $actual_link
?>

<div class="container">
    <div class="row">
        <h3>Drafting Undang-undang</h3>
        <hr><br>
        <div class="col-sm-4 col-md-4 col-lg-4">

            <div class="box-shadow p-3">
                <form method="get" action="<?php echo base_url('home/hitungCousine'); ?>">

                    <div class="form-group">
                        <label class=" form-control-label">Tema UU</label>
                        <div class="input-group col-md-12">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="search" rows="3" placeholder="Tulis kata yang ingin dicari disini!" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    <br />
                </form>
                <br>
                <?php if (isset($kategori)) { ?>
                    <form method="get" action="<?php echo $actual_link; ?>">
                        <input type="hidden" name="search" value="<?= $_GET['search'] ?>">
                        <?php foreach ($kategori as $key => $value) { ?>
                            <input type="checkbox" name="kat[]" id="myCheck<?= $value->kategori_id ?>" value="<?= $value->kategori_id ?>" <?php if (isset($_GET['kat'])) {
                                                                                                                                                foreach ($_GET['kat'] as $key_kat => $value_kat) {
                                                                                                                                                    if ($value_kat == $value->kategori_id) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            } ?>>
                            <label><?= $value->nama_kategori ?></label><br>
                        <?php } ?>
                        <button type="submit" class="btn btn-success"><i class="fas fa-filter"></i> Filter</button>
                    <?php } ?>

                    </form>
            </div>
        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">
            <table id="TableSortDrafting" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center">No</th>
                        <th width="10%" style="text-align:center">Peraturan</th>
                        <th width="50%" style="text-align:center">Tentang</th>
                        <th width="15%" style="text-align:center">Kategori</th>
                        <th width="20%" style="text-align:center">Similaritas</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    if (!empty($data)) {
                        foreach ($data as $key => $value) { ?>
                            <tr>
                                <td style="text-align: center"><?= $i++ ?></td>
                                <?php if (isset($_GET['ruu'])) {
                                    $href = removeQueryStringParameter($actual_link, 'ruu') . '&ruu=' . $value['id_tbl_uu'];
                                } else {
                                    $href = $actual_link . '&ruu=' . $value['id_tbl_uu'];
                                }
                                // echo removeQueryStringParameter($href, 'ruu').'<br>';
                                // echo $href.'<br>';
                                ?>
                                <td style="text-align: center"><a href="<?= $href ?>"><?= $value['uu'] ?></a></td>
                                <td style="text-align: center"><?= $value['tentang'] ?></td>
                                <td style="text-align: center"><?= $value['kategori'] ?></td>
                                <td style="text-align: center">
                                    <!-- <?= $value['kataSama'] ?> -->(<?= number_format(100 * $value['cosSim'], 2) ?>%)
                                </td>
                                <!-- <td style="text-align: center"><?= $value->totalKata ?></td> -->
                                <!-- <td style="text-align: center"><?= $value->cosSim ?></td> -->
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <br>
            <hr>
            <br>
            <div id="getText">
                <?php if (isset($getArsip1)) { ?>
                    <div class="overflow-auto" id="forChange" style="text-align: center; ">
                        <p style="background-color: light; height: 1000px; overflow: scroll;"><?= $getArsip1 ?></p>
                    </div> <br><br>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include_once dirname(__FILE__) . '/footer.php'; ?>
<!--start footer-->

<?php
if (isset($_GET['search'])) {
    // print_r(json_encode($_GET['search']));
    $query1 = str_replace(array('\r', '\n', '/', '\\', '%', '&', '#', '@', '^', '*', ':', '+', ';',), '', json_encode($_GET['search']));
    $query1 = json_decode($query1);
    // $query1 = explode(" ", $query1);
    // print_r(json_encode($query1));
} ?>

<?php function removeQueryStringParameter($url, $varname)
{
    $parsedUrl = parse_url($url);
    $query = array();

    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $query);
        unset($query[$varname]);
    }

    $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
    $query = !empty($query) ? '?' . http_build_query($query) : '';

    return $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $path . $query;
}
?>

<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="../assets/mdbootstrap/datatables.min.js"></script>
<script type="text/javascript">
    // Basic example
    $(document).ready(function() {
        $('#TableSortDrafting').DataTable({
            "searching": true, // false to disable search (or any other option)
            "paging": true
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>