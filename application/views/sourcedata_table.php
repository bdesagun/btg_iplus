<table class="table table-flush" id="table_sourcedata_info">
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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filezone as $row) { ?>
            <?php if(($_SESSION["position"] == "client") || ($_SESSION["position"] == "admin") || ($row['trailstatus'] != NULL && ($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer"))){ ?>
                <tr>
                    <td><a href="<?php echo base_url(); ?>assets/files/<?php echo $row['username']; ?>/<?php echo $row['fileentity']; ?>/<?php echo str_replace(' ','_',$row['filename']);?>" onclick="viewFile(<?php echo $row['fileid']; ?>)" download><?php echo $row['filename']; ?></a></td>
                    <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                        <td><?php echo $row['clientname']; ?></td>
                    <?php } ?>
                    <td><?php echo $row['fileentity']; ?></td>
                    <td><?php echo $row['filetype']; ?></td>
                    <td><i class="ni ni-tag text-<?php echo $row['filecolor']; ?>"></i><?php echo " ".$row['filestatus']; ?>   </td>
                    <td><?php echo $row['filedate']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#table_sourcedata_info').DataTable({
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