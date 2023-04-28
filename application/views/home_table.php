<table class="table table-flush" id="table_home_info">
    <thead class="thead-light">
        <tr>
            <th>Entity</th>
            <th style="width: 12%">
                <div class="text-center">Data Request</div>
            </th>
            <th style="width: 12%">
                <div class="text-center">Data Upload</div>
            </th>
            <th style="width: 12%">
                <div class="text-center">BAS Preparation</div>
            </th>
            <th style="width: 12%">
                <div class="text-center">BAS Review</div>
            </th>
            <th style="width: 12%">
                <div class="text-center">BAS Sign off</div>
            </th>
            <th style="width: 12%">
                <div class="text-center">BAS Lodgment / Payment</div>
            </th>
        </tr>
        <tr>
            <th>DUE DATE</th>
            <th style="width: 12%">
                <div class="text-center" style=" font-weight: bold;">
                    <?php echo $filemonth; ?>
                    <select id="data_request" style="width: 50px" onchange="saveDue()" value="<?php echo $due['data_request'] ?>"><?php echo $fileday; ?></select>
                </div>
            </th>
            <th style="width: 12%">
                <div class="text-center" style=" font-weight: bold;">
                    <?php echo $filemonth; ?>
                    <select id="data_upload" style="width: 50px" onchange="saveDue()"><?php echo $fileday; ?></select>
                </div>
            </th>
            <th style="width: 12%">
                <div class="text-center" style=" font-weight: bold;">
                    <?php echo $filemonth; ?>
                    <select id="bas_preparation" style="width: 50px" onchange="saveDue()"><?php echo $fileday; ?></select>
                </div>
            </th>
            <th style="width: 12%">
                <div class="text-center" style=" font-weight: bold;">
                    <?php echo $filemonth; ?>
                    <select id="bas_review" style="width: 50px" onchange="saveDue()"><?php echo $fileday; ?></select>
                </div>
            </th>
            <th style="width: 12%">
                <div class="text-center" style=" font-weight: bold;">
                    <?php echo $filemonth; ?>
                    <select id="bas_sign_off" style="width: 50px" onchange="saveDue()"><?php echo $fileday; ?></select>
                </div>
            </th>
            <th style="width: 12%">
                <div class="text-center" style=" font-weight: bold;">
                    <?php echo $filemonth; ?>
                    <select id="bas_lodgement" style="width: 50px" onchange="saveDue()"><?php echo $fileday; ?></select>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($progress as $row) { ?>
            <tr>
                <td><?php echo $row['value']; ?></td>
                <td colspan="6">
                    <button class="btn btn-<?php echo $row['barcolor']; ?> btn-sm" style="width: <?php echo $row['progress'] ?>%;"></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
</script>