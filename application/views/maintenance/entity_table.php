<table class="table">
    <thead class="thead-light">
        <tr class="text-center">
            <th>Entity Name</th>
            <th>File Count</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entity as $row) { ?>
            <tr class="text-center">
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['filecount']; ?></td>
                <td>
                    <?php if($row['filecount'] == '0') { ?>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="deleteEntity('<?php echo $row['value']; ?>', '<?php echo $row['subcategory']; ?>')">Delete</button>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
</script>