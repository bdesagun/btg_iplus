<table class="table">
    <thead class="thead-light">
        <tr class="text-center">
            <th>Entity ID</th>
            <th>Entity Name</th>
            <?php if($typebas != 'Standalone BAS'){ ?>
                <th>Group</th>
            <?php } ?>
            <th>File Count</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entity as $row) { ?>
            <tr>
                <td class="text-center"><?php echo $row['entitycode']; ?></td>
                <td class="text-center">
                    <div class="onview<?php echo $row['entityid']; ?>">
                        <?php echo $row['entityname']; ?>
                    </div>
                    <div class="onedit<?php echo $row['entityid']; ?>">
                        <input class="form-control-sm" id="entity<?php echo $row['entityid']; ?>" type="text" autocomplete="off">
                    </div>
                </td>
                <?php if($typebas != 'Standalone BAS'){ ?>
                    <td class="text-center">
                        <div class="onview<?php echo $row['entityid']; ?>">
                            <?php echo $row['groupname']; ?>
                        </div>
                        <div class="onedit<?php echo $row['entityid']; ?>">
                            <select class="form-control-sm" id="selectGroup<?php echo $row['entityid']; ?>"></select>
                        </div>
                    </td>
                <?php } ?>
                <td class="text-center"><?php echo $row['filecount']; ?></td>
                <td>
                    <div class="onview<?php echo $row['entityid']; ?>">
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="setOnedit(<?php echo $row['entityid']; ?>,'<?php echo $row['entityname']; ?>','<?php echo $row['groupname']; ?>')">Edit</button>
                        <?php if($row['filecount'] == '0') { ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="deleteEntity(<?php echo $row['entityid']; ?>)">Delete</button>
                        <?php } ?>
                    </div>
                    <div class="onedit<?php echo $row['entityid']; ?>">
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="updateEntity(<?php echo $row['entityid']; ?>)">Save</button>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="setOnview(<?php echo $row['entityid']; ?>)">Cancel</button>
                    </div>
                </td>
            </tr>
            <script>
                setOnview(<?php echo $row['entityid']; ?>);
            </script>
        <?php } ?>
    </tbody>
</table>