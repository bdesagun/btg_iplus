<div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
    <?php foreach ($filehistory as $row) { ?>
        <div class="timeline-block">
            <span class="timeline-step">
                <i class="ni ni-tag"></i>
            </span>
            <div class="timeline-content">
                <div class="d-flex justify-content-between pt-1">
                    <div>
                        <span class="text-muted text-sm font-weight-bold"><?php echo $row['filestatus']; ?></span>
                    </div>
                    <div class="text-right">
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i><?php echo $row['filedate']; ?></small>
                    </div>
                </div>
                <h6 class="text-sm mt-1 mb-0"><?php echo nl2br($row['remarks']); ?></h6>
            </div>
        </div>
    <?php } ?>
</div>