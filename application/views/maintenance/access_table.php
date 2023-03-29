<table class="table">
    <thead class="thead-light">
        <tr class="text-center">
            <th>Entity Name</th>
            <th>File Count</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($access as $row) { ?>
            <tr class="text-center">
                <td><?php echo $row['clientname']; ?></td>
                <td><?php echo $row['entity']; ?></td>
                <td>
                    <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="deleteAccess('<?php echo $row['clientid']; ?>','<?php echo $row['entity']; ?>','<?php echo $row['username']; ?>')">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
</script>