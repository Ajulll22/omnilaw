<br>
<hr>
<br>
<table id="TableSortDrafting" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th width="5%" style="text-align:center">No</th>
            <th width="10%" style="text-align:center">Pasal</th>
            <th width="15%" style="text-align:center">UU</th>
            <th width="50%" style="text-align:center">Tentang</th>
            <th width="10%" style="text-align:center">Similaritas</th>
            <th width="10%" style="text-align:center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($hasil->values as $value) : ?>
            <tr>
                <td style="text-align: center"><?= $i++ ?></td>
                <td style="text-align: center"><?php echo $value->uud_id ?></td>
                <td style="text-align: center"><?php echo $value->uu ?></td>
                <td style="text-align: center">Tentang <?php echo ucwords(strtolower($value->tentang)) ?></td>
                <td style="text-align: center"><?php echo $value->presentase ?>%</td>
                <td style="text-align: center"><button onclick="content(event)" class="btn btn-md btn-primary" data-content="<?= $value->uud_content; ?>">Content</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<hr><br>

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
<script>
    function content(e) {
        const content = document.querySelector("#content");
        content.innerHTML = e.target.dataset.content;
    }
</script>