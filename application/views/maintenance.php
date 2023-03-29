<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title><?php echo $_SESSION["systemname"]; ?></title>
    <?php require "css.php"; ?>
</head>

<body>
    <?php require "side.php"; ?>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <?php require "header.php"; ?>
        <!-- Header -   ->
        <!-- Header -->
        <div class="header pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 d-inline-block mb-0">MAINTENANCE</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="h2 d-inline-block mb-0">IFRAME URL</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php foreach ($iframe as $row) { ?>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label class="col-form-label form-control-label">URL for <?php echo $row["pagename"]; ?>:</label>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input class="form-control" id="pageurl" type="text" autocomplete="off" value="<?php echo $row['pageurl']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-outline-default" style="width:100%" onclick="saveURL('<?php echo $row['pagename']; ?>')">SAVE URL</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "js.php"; ?>
</body>
<script>
    // loadChecklist();
    // function loadChecklist(){
    //     $("#div_checklist_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
    //     $.post("select_checklist").done(function(data) {
    //         $("#div_checklist_table").html(data);
    //     });
    // }

    function saveURL(name){
        params = {
            pagename  : name,
            pageurl   : $("#pageurl").val(),
        };
        console.log(params);
        $.post("update_iframe", params).done(function(data) {
            swal("Saved!", "URL successfully updated!", "success");
        });
    }
</script>
</html>