<!-- For Client Confirmation of Client File -->
<?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
    <?php if($filecategory == 'clientfile'){ ?>
        <table class="table table-flush">
            <thead class="thead-light">
                <tr>
                    <th>File Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filezone as $row) { ?>
                    <tr>
                        <td><?php echo $row['filename'];?></td>
                        <td><i class="ni ni-tag text-<?php echo $row['filecolor']; ?>"></i><?php echo " ".$row['filestatus'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if(isset($fileaudit["trailstatus"])){ ?>
            <i style="color: red">This entity already confirmed.</i>
        <?php } ?>
        <script>
            <?php if(!isset($fileaudit["trailstatus"])){ ?>
                $("#confirmButton").prop('disabled', false);
            <?php }else{ ?>
                $("#confirmButton").prop('disabled', true);
            <?php } ?>
        </script>
    <?php }else{ ?>
        <?php if(isset($fileaudit["trailstatus"]) && ($fileaudit["trailstatus"] == 'Reviewed' || $fileaudit["trailstatus"] == 'ConfirmedBAS')){ ?>
            <table class="table table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>File Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($filezone as $row) { ?>
                            <tr>
                                <td><?php echo $row['filename'];?></td>
                                <td><i class="ni ni-tag text-<?php echo $row['filecolor']; ?>"></i><?php echo " ".$row['filestatus'];?></td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            <i style="color: red">This entity not yet reach to reviewer or approved by the reviewer</i>
        <?php } ?>
        <?php if(isset($fileaudit["trailstatus"])){ ?>
            <?php if($fileaudit["trailstatus"] == 'ConfirmedBAS'){ ?>
                <i style="color: red">This entity already confirmed BAS.</i>
            <?php } ?>
        <?php } ?>
        <script>
            <?php if(isset($fileaudit["trailstatus"])){ ?>
                <?php if($fileaudit["trailstatus"] == 'Reviewed'){ ?>
                    $("#confirmButtonBas").prop('disabled', false);
                <?php }else{ ?>
                    $("#confirmButtonBas").prop('disabled', true);
                <?php } ?>
            <?php }else{ ?>
                $("#confirmButtonBas").prop('disabled', true);
            <?php } ?>
        </script>
    <?php } ?>
<?php } ?>

<!-- For Staff Approval of Client File-->
<?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
    <?php if(isset($fileaudit["trailstatus"])){ ?>
        <table class="table table-flush">
            <thead class="thead-light">
                <tr>
                    <th>File Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filezone as $row) { ?>
                    <tr>
                        <td><?php echo $row['filename'];?></td>
                        <td><i class="ni ni-tag text-<?php echo $row['filecolor']; ?>"></i><?php echo " ".$row['filestatus'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?>
        <i style="color: red">This entity not yet confirmed</i>
    <?php } ?>
    <?php if(isset($fileaudit["trailstatus"])){ ?>
        <?php if($fileaudit["trailstatus"] == 'Approved' || $fileaudit["trailstatus"] == 'Reviewed' || $fileaudit["trailstatus"] == 'ConfirmedBAS'){ ?>
            <i style="color: red">This entity already Confirmed.</i>
        <?php } ?>
    <?php } ?>
    <script>
    <?php if(isset($fileaudit["trailstatus"])){ ?>
        <?php if($fileaudit["trailstatus"] == 'Confirmed'){ ?>
            $("#confirmButton").prop('disabled', false);
        <?php }else{ ?>
            $("#confirmButton").prop('disabled', true);
        <?php } ?>
    <?php }else{ ?>
        $("#confirmButton").prop('disabled', true);
    <?php } ?>
    </script>
<?php } ?>


<!-- For Reviewer Approval of BAS File-->
<?php if($_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
    <?php if(isset($fileaudit["trailstatus"]) && ($fileaudit["trailstatus"] == 'Approved' || $fileaudit["trailstatus"] == 'Reviewed' || $fileaudit["trailstatus"] == 'ConfirmedBAS')){ ?>
        <table class="table table-flush">
            <thead class="thead-light">
                <tr>
                    <th>File Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filezone as $row) { ?>
                    <tr>
                        <td><?php echo $row['filename'];?></td>
                        <td><i class="ni ni-tag text-<?php echo $row['filecolor']; ?>"></i><?php echo " ".$row['filestatus'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?>
        <i style="color: red">This entity not yet confirmed files by the client or approved files by the BTG Preperer</i>
    <?php } ?>
    <?php if(isset($fileaudit["trailstatus"])){ ?>
        <?php if($fileaudit["trailstatus"] == 'Reviewed' || $fileaudit["trailstatus"] == 'ConfirmedBAS'){ ?>
            <i style="color: red">This entity already approved.</i>
        <?php } ?>
    <?php } ?>
    <script>
        <?php if(isset($fileaudit["trailstatus"])){ ?>
            <?php if($fileaudit["trailstatus"] == 'Approved'){ ?>
                $("#confirmButton").prop('disabled', false);
            <?php }else{ ?>
                $("#confirmButton").prop('disabled', true);
            <?php } ?>
        <?php }else{ ?>
            $("#confirmButton").prop('disabled', true);
        <?php } ?>
    </script>
<?php } ?>

