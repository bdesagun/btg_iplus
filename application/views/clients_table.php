<table class="table table-flush" id="table_account_list">
    <thead class="thead-light">
        <tr>
            <th>CLient Name</th>
            <th>Address</th>
            <th>Industry</th>
            <th>Status</th>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $row) { ?>
                <tr>
                    <td><?php echo $row['clientname']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['industry']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalClient" onclick="editClient('<?php echo $row['clientid']; ?>')">Edit</button>

                        <?php if($row['active']=='1'){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalActivation" onclick="viewActivationClient('<?php echo $row['active']; ?>','<?php echo $row['clientid']; ?>')">Deactivate</button>
                        <?php }elseif($row['active']=='0'){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalActivation" onclick="viewActivationClient('<?php echo $row['active']; ?>','<?php echo $row['clientid']; ?>')">Activate</button>
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