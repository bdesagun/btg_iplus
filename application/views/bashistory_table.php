<table class="table table-flush" id="table_bashistory_info">
    <thead class="thead-light">
        <tr>
            <th>File Name</th>
            <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
                <th>Client Name</th>
            <?php } ?>
            <th>Entity</th>
            <th>Last Updated</th>
        </tr>
    </thead>
    <tbody
        <?php foreach ($filereview as $row) { ?>
            <?php if(($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin") || (($_SESSION["position"] == "client" || $_SESSION["position"] == "admin") && ($row['trailstatus'] == 'Reviewed' || $row['trailstatus'] == 'ConfirmedBAS'))){ ?>
                <tr>
                    <td><a href="<?php echo base_url(); ?>assets/files/<?php echo $row['clientid']; ?>/<?php echo $row['fileentity']; ?>/<?php echo str_replace(' ','_',$row['filename']);?>" download><?php echo $row['filename']; ?></a></td>
                    <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
                        <td><?php echo $row['clientname']; ?></td>
                    <?php } ?>
                    <td><?php echo $row['fileentity']; ?></td>
                    <td><?php echo $row['filedate']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#table_bashistory_info').DataTable({
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