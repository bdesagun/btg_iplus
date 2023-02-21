<table class="table table-flush" id="table_filezone_info">
    <thead class="thead-light">
        <tr>
            <th>File Name</th>
            <th>Entity</th>
            <th>File Type</th>
            <th>Status</th>
            <th>Last Updated</th>
            <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                <th>File Owner</th>
            <?php } ?>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filezone as $row) { ?>
                <tr>
                    <td><a href="<?php echo base_url(); ?>assets/files/<?php echo $row['username']; ?>/<?php echo $row['fileentity']; ?>/<?php echo $row['filename'];?>" onclick="viewFile(<?php echo $row['fileid']; ?>)"><?php echo $row['filename']; ?></a></td>
                    <td><?php echo $row['fileentity']; ?></td>
                    <td><?php echo $row['filetype']; ?></td>
                    <td><i class="ni ni-tag"></i><?php echo " ".$row['filestatus']; ?>   </td>
                    <td><?php echo $row['filedate']; ?></td>
                    <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                        <td><?php echo $row['accountname']; ?></td>
                    <?php } ?>
                    <td>
                        <?php if(($_SESSION["position"] == "client" || $_SESSION["position"] == "admin") && $row['filestatus'] == "Submitted"){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalFilezone" onclick="editFile(<?php echo $row['fileid']; ?>)">Edit</button>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="deleteFile(<?php echo $row['fileid']; ?>)">Delete</button>
                        <?php }if(($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") && ($row['filestatus'] == "Viewed" ||  $row['filestatus'] == "Updated")){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalApprove" onclick="getFileID(<?php echo $row['fileid']; ?>)">Approve</button>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalDeny" onclick="getFileID(<?php echo $row['fileid']; ?>)">Return</button>
                        <?php }if(($_SESSION["position"] == "client" || $_SESSION["position"] == "admin") && $row['filestatus'] == "Returned"){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalFilezone" onclick="editFile(<?php echo $row['fileid']; ?>)">Edit</button>
                        <?php }?>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalHistory" onclick="historyFile(<?php echo $row['fileid']; ?>)">History</button>
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
            },
            "searching": true,
            "aaSorting": [],
            "ordering": false
        } );
    });
</script>