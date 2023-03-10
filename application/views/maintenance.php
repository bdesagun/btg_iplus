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
            <div class="modal fade" id="modalChecklist" tabindex="-1" role="dialog" aria-labelledby="checklistLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="checklistLabel">Checklist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">Procedure:</label>
                                        <input class="form-control" id="checklistprocedure" type="text" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default" id="saveaccount" onclick="changePassword()">Save</button>
                            <button type="button" class="btn btn-outline-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="h2 d-inline-block mb-0">CHECKLIST</h6>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalChecklist" onclick="newChecklist()">ADD NEW CHECKLIST</button></h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_checklist_table"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="h2 d-inline-block mb-0">DROPDOWN</h6>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalDropdown" onclick="newChecklist()">ADD NEW DROPDOWN</button></h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_dropdown_table"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="h2 d-inline-block mb-0">IFRAME URL</h6>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalChecklist" onclick="newChecklist()">SAVE URL</button></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">URL for Dashboard:</label>
                                        <input class="form-control" id="checklistprocedure" type="text" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">URL for Workflow:</label>
                                        <input class="form-control" id="checklistprocedure" type="text" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "js.php"; ?>
</body>
<script>
    loadChecklist();
    function loadChecklist(){
        $("#div_checklist_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        $.post("select_checklist").done(function(data) {
            $("#div_checklist_table").html(data);
        });
    }
</script>
</html>