<table class="table table-flush" id="table_filezone_info">
    <thead class="thead-light">
        <tr>
            <th>File Name</th>
            <th>File Type</th>
            <th>Status</th>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filezone as $row) { ?>
                <tr>
                    <td><?php echo $row['filename']; ?></td>
                    <td><?php echo $row['filetype']; ?></td>
                    <td><?php //echo $row['status']; ?></td>
                    <td>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Edit</button>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Delete</button>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">History</button>
                    </td>
                </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#table_filezone_info').DataTable({
            "language": {
                "paginate": {
                "next": ">",
                "previous": "<"
                }
            }
        } );
    });
</script>