<table class="table table-flush" id="table_account_list">
    <thead class="thead-light">
        <tr>
            <th>Username</th>
            <th>Account Name</th>
            <th>Email</th>
            <th>Position</th>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($acclist as $row) { ?>
                <tr>
                    <td><?php echo $row['Username']; ?></td>
                    <td><?php echo $row['Account Name']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Position']; ?></td>
                    <td>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Edit</button>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Reset Password</button>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm">Deactivate</button>
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