<table class="table table-flush" id="table_account_list">
    <thead class="thead-light">
        <tr>
            <th>Procedures</th>
            <th>Status</th>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($checklist as $row) { ?>
                <tr>
                    <td><?php echo $row['checklistprocedure']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Edit</button>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Delete</button>
                        <?php if($row['active']=='1'){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Deactivate</button>
                        <?php }elseif($row['active']=='0'){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Activate</button>
                        <?php } ?>
                    </td>
                </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#table_account_list').DataTable({
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