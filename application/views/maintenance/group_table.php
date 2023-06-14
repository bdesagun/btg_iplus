<table class="table">
    <thead class="thead-light">
        <tr class="text-center">
            <th>Group Name</th>
            <th>Entity Count</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($group as $row) { ?>
            <tr>
                <td class="text-center">
                    <div class="onviewGroup<?php echo $row['groupid']; ?>">
                        <?php echo $row['groupname']; ?>
                    </div>
                    <div class="oneditGroup<?php echo $row['groupid']; ?>">
                        <input class="form-control-sm" id="group<?php echo $row['groupid']; ?>" type="text" autocomplete="off">
                    </div>
                </td>
                <td class="text-center"><?php echo $row['entitycount']; ?></td>
                <td>
                    <div class="onviewGroup<?php echo $row['groupid']; ?>">
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="setOneditGroup(<?php echo $row['groupid']; ?>,'<?php echo $row['groupname']; ?>')">Edit</button>
                        <?php if($row['entitycount'] == '0') { ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="deleteGroup(<?php echo $row['groupid']; ?>)">Delete</button>
                        <?php } ?>
                    </div>
                    <div class="oneditGroup<?php echo $row['groupid']; ?>">
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="updateGroup(<?php echo $row['groupid']; ?>)">Save</button>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="setOnviewGroup(<?php echo $row['groupid']; ?>)">Cancel</button>
                    </div>
                </td>
            </tr>
            <script>
                setOnviewGroup(<?php echo $row['groupid']; ?>);
            </script>
        <?php } ?>
    </tbody>
</table>