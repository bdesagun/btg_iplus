<table class="table table-flush" id="table_audittrail_info">
    <thead class="thead-light">
        <tr>
            <th style="width:60%">Activity</th>
            <th>Update By</th>
            <th>Updated Date</th>
        </tr>
    </thead>
    <tbody
        <?php foreach ($audit as $row) { ?>
            <tr>
                <td><?php echo $row['activity']; ?></td>
                <td><?php echo $row['updatedby']; ?></td>
                <td><?php echo $row['updateddate']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#table_audittrail_info').DataTable({
            "language": {
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            },
            "searching": true,
            "aaSorting": [],
            "ordering": false
        } );
    });
</script>