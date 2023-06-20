<table class="table table-flush" id="table_filereview_info">
    <thead class="thead-light">
        <tr>
            <th>File Name</th>
            <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
                <th>Client Name</th>
            <?php } ?>
            <th>Entity</th>
            <th>Last Updated</th>
            <th style="width:20%">Action</th>
        </tr>
    </thead>
    <tbody
        <?php foreach ($filereview as $row) { ?>
            <?php if(($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin") || (($_SESSION["position"] == "client" || $_SESSION["position"] == "admin") && ($row['trailstatus'] == 'Reviewed' || $row['trailstatus'] == 'ConfirmedBAS'))){ ?>
                <tr>
                    <td><a href="<?php echo base_url(); ?>assets/files/btg_file/<?php echo $row['clientid']; ?>/<?php echo $row['fileentity']; ?>/<?php echo $row['month']; ?>/<?php echo $row['year']; ?>/<?php echo str_replace(' ','_',$row['filename']);?>" download><?php echo $row['filename']; ?></a></td>
                    <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
                        <td><?php echo $row['clientname']; ?></td>
                    <?php } ?>
                    <td><?php echo $row['entityname']; ?></td>
                    <td><?php echo $row['filedate']; ?></td>
                    <td>
                        <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                            <?php if($row['trailstatus'] == 'Confirmed'){ ?>
                                <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modalFilereview" onclick="editFileReview(<?php echo $row['fileid']; ?>)">
                                    Edit
                                </button>
                                <button type="button" style="padding:1px 15px" class="btn btn-outline-default btn-sm" onclick="deleteFile(<?php echo $row['fileid']; ?>)">
                                    Delete
                                </button>
                            <?php } ?>
                        <?php } ?>
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
        $('#table_filereview_info').DataTable({
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