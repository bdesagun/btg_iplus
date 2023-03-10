<table class="table table-flush" id="table_account_list">
    <thead class="thead-light">
        <tr>
            <th>Account Name</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Status</th>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($acclist as $row) { ?>
                <tr>
                    <td><?php echo $row['Account Name']; ?></td>
                    <td><?php echo $row['Client Name']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo ucfirst($row['Position']); ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td>
                        <?php if($row['username'] != "admin"){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalAccount" onclick="editAccount('<?php echo $row['username']; ?>')">Edit</button>
                            <?php if($row['active']!='2'){ ?>
                                <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalReset" onclick="viewResetAccount('<?php echo $row['username']; ?>','<?php echo $row['Email']; ?>')">Reset Password</button>
                            <?php } ?>
                        <?php } ?>
                        <?php if($row['Position'] != "admin"){ ?>
                            <?php if($row['active']=='1'){ ?>
                                <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalActivation" onclick="viewActivationAccount('<?php echo $row['active']; ?>','<?php echo $row['username']; ?>')">Deactivate</button>
                            <?php }elseif($row['active']=='0'){ ?>
                                <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalActivation" onclick="viewActivationAccount('<?php echo $row['active']; ?>','<?php echo $row['username']; ?>')">Activate</button>
                            <?php } ?>
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