<table class="table table-flush" id="table_filezone_info">
    <thead class="thead-light">
        <tr>
            <th>File Name</th>
            <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                <th>Client Name</th>
            <?php } ?>
            <th>Entity</th>
            <th>File Type</th>
            <th>Status</th>
            <th>Last Updated</th>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filezone as $row) { ?>
            <?php if(($_SESSION["position"] == "client") || ($_SESSION["position"] == "admin") || ($row['trailstatus'] != NULL && ($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer"))){ ?>
                <tr>
                    <td><a href="<?php echo base_url(); ?>assets/files/client_file/<?php echo $row['clientid']; ?>/<?php echo $row['fileentity']; ?>/<?php echo $row['month']; ?>/<?php echo $row['year']; ?>/<?php echo str_replace(' ','_',$row['filename']);?>" onclick="viewFile(<?php echo $row['fileid']; ?>)" download><?php echo $row['filename']; ?></a></td>
                    <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                        <td><?php echo $row['clientname']; ?></td>
                    <?php } ?>
                    <td><?php echo $row['fileentity']; ?></td>
                    <td><?php echo $row['filetypename']; ?></td>
                    <td><i class="ni ni-tag text-<?php echo $row['filecolor']; ?>"></i><?php echo " ".$row['filestatus']; ?>   </td>
                    <td><?php echo $row['filedate']; ?></td>
                    <td>
                        <?php if(($_SESSION["position"] == "client" || $_SESSION["position"] == "admin") && $row['trailstatus'] == null && $row['filestatus'] != "Returned"){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalFilezone" onclick="editFile(<?php echo $row['fileid']; ?>)">
                                Edit
                            </button>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="deleteFile(<?php echo $row['fileid']; ?>)">
                                Delete
                            </button>
                        <?php }if(($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") && ($row['filestatus'] == "Viewed")){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalApprove" onclick="getFileID(<?php echo $row['fileid']; ?>)">
                                Approve
                            </button>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalDeny" onclick="getFileID(<?php echo $row['fileid']; ?>)">
                                Return
                            </button>
                        <?php }if(($_SESSION["position"] == "client" || $_SESSION["position"] == "admin") && $row['filestatus'] == "Returned"){ ?>
                            <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalFilezone" onclick="editFile(<?php echo $row['fileid']; ?>)">
                                Edit
                            </button>
                        <?php }?>
                        <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalHistory" onclick="historyFile(<?php echo $row['fileid']; ?>)">
                            History
                        </button>
                    </td>
                </tr>
            <?php } ?>
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