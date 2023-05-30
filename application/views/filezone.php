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
        <!-- Modal -->
        <div class="modal fade" id="modalFilezone" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filezoneLabel">Upload Client File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-control-label">File Name:</label>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label class="form-control-label" id="fileName"></label>
                                    <div id='val_fileName'></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalFile">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">File Type</label>
                                    <select class="form-control" id="selectType"></select>
                                    <div id='val_selectType'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Entity</label>
                                    <select class="form-control" id="selectEntity"></select>
                                    <div id='val_selectEntity'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Month</label>
                                    <select class="form-control" id="selectMonth2"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Year</label>
                                    <select class="form-control" id="selectYear2"></select>
                                </div>
                            </div>
                        </div>
                    </div>`
                    <div class="modal-footer">
                        <button id="savefilezone" type="button" class="btn btn-outline-default" onclick="saveFile()">Save</button>
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalFilereview" tabindex="-1" role="dialog" aria-labelledby="filereviewLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filereviewLabel">Upload BTG File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-control-label">File Name:</label>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label class="form-control-label" id="fileNameReview"></label>
                                    <div id='val_fileNameReview'></div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalFileR">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Entity</label>
                                    <select class="form-control" id="selectEntityReview"></select>
                                    <div id='val_selectEntityReview'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Month</label>
                                    <select class="form-control" id="selectMonthReview"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Year</label>
                                    <select class="form-control" id="selectYearReview"></select>
                                </div>
                            </div>
                        </div>
                    </div>`
                    <div class="modal-footer">
                        <button id="savefilereview" type="button" class="btn btn-outline-default" onclick="saveFileReview()">Save</button>
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalFile" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filezoneLabel">Choose File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <form id="form_upload" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="file" id="file_to_upload" name="file_to_upload" class="form-control" required accept=".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <button class="btn btn-outline-default" id="upload_btn" data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <h5><i>Note: Only xlsx, xls and cvs files are allowed.</i></h5>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalFileR" tabindex="-1" role="dialog" aria-labelledby="fileRLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fileRLabel">Choose File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <form id="form_upload_review" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="file" id="file_to_upload_review" name="file_to_upload_review" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <button class="btn btn-outline-default" id="upload_btn" data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <h5><i>Note: Only xlsx, xls and cvs files are allowed.</i></h5>
                                            </div>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalHistory" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filezoneLabel">File History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <form id="form_upload" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div id="div_history_file"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
            <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filezoneLabel">File Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">This is to confirm that your uploaded files are complete and ready.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control" id="selectEntity3" onchange="loadFilesList('clientfile')"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="table-responsive py-4"  id="div_filelist_table"></div>
                                        <div id='val_selectEntity3'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal" id="confirmButton" onclick="auditFile('Confirmed')">Confirm</button>
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalConfirmBAS" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filezoneLabel">BAS File Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">This is to confirm that the uploaded BAS files are all correct.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control" id="selectEntityBas" onchange="loadFilesListFinal('btgfile')"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="table-responsive py-4"  id="div_filebas_table"></div>
                                        <div id='val_selectEntity3'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal" id="confirmButtonBas" onclick="auditFile('ConfirmedBAS')">Confirm</button>
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if($_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
            <div class="modal fade" id="modalForReview" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filezoneLabel">File Approval</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">This is to approve that the BAS files are all reviewed.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control" id="selectEntity3" onchange="loadFilesList('btgfile')"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="table-responsive py-4"  id="div_filelist_table"></div>
                                        <div id='val_selectEntity3'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal" id="confirmButton" onclick="auditFile('Reviewed')">Approve</button>
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
            <div class="modal fade" id="modalForApprove" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filezoneLabel">BAS File Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">This is to confirm that the BAS files are all uploaded and ready for review.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control" id="selectEntity3" onchange="loadFilesList('btgfile')"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="table-responsive py-4"  id="div_filelist_table"></div>
                                        <div id='val_selectEntity3'></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal" id="confirmButton" onclick="auditFile('Approved')">Confirm</button>
                                        <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filezoneLabel">Approval</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h4>Are you sure you want to approve this file?</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal" onclick="approveFile()">Approve</button>
                                                <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalDeny" tabindex="-1" role="dialog" aria-labelledby="filezoneLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filezoneLabel">Return File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h4>Are you sure you want to return this file?</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="form-control-label">Reason:</label>
                                                <textarea class="form-control" id="fileReason" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal" onclick="denyFile()">Return</button>
                                                <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Header -->
        <div class="header pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 d-inline-block mb-0">FILE ZONE</h6>
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
                        <div class="card-body">
                            <div class="row">
                                <label for="example-text-input" class="col-md-1 col-form-label form-control-label">Entity:</label>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectEntity2" onchange="loadFiles()"><option value='ALL'>ALL</option></select>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectMonth" onchange="loadFiles()"></select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectYear" onchange="loadFiles()"></select>
                                </div>
                            </div>
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
                                    <h3 class="mb-0">Client Files</h3>
                                </div>
                                <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-2 text-right">
                                        <h3 class="mb-0"><button type="button" style="width:100%" class="btn btn-outline-default" data-toggle="modal" data-target="#modalFilezone" onclick="newFile()">Upload</button></h3>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-2 text-right">
                                        <h3 class="mb-0"><button type="button" style="width:100%" class="btn btn-outline-default" data-toggle="modal" data-target="#modalConfirm" onclick="GetEntity3()">Confirm Files</button></h3>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-12">
                                        <p style="font-size: 14px; margin-top: 10px; margin-bottom: 0;">
                                            <b>Upload your files using "Upload" button then confirm using "Confirm Files" button if you files are complete and ready for BAS Preperation.</b>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-12">
                                        <p style="font-size: 14px; margin-top: 10px; margin-bottom: 0;">
                                            <b>Download Files by clicking the name of the file then "Approve" or "Return" the file individually base on your assessment</b>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-12">
                                        <p style="font-size: 14px; margin-top: 10px; margin-bottom: 0;">
                                            <b>Download Files by clicking the name of the file</b>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_filezone_table"></div>
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
                                    <h3 class="mb-0">BTG Staff Files</h3>
                                </div>
                                <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-2 text-right">
                                        <h3 class="mb-0"><button type="button" style="width:100%" class="btn btn-outline-default" data-toggle="modal" data-target="#modalFilereview" onclick="GetEntityReview('', 'Confirmed'), newFileReview()">Upload BAS Files</button></h3>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <h3 class="mb-0"><button type="button" style="width:100%" class="btn btn-outline-default" data-toggle="modal" data-target="#modalForApprove" onclick="GetEntity4('Confirmed')">Confirm BAS Files</button></h3>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-2 text-right"></div>
                                    <div class="col-md-2 text-right">
                                        <h3 class="mb-0"><button type="button" style="width:100%" class="btn btn-outline-default" data-toggle="modal" data-target="#modalForReview" onclick="GetEntity4('Approved')">Approve BAS Files</button></h3>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-2 text-right"></div>
                                    <div class="col-md-2 text-right">
                                        <h3 class="mb-0"><button type="button" style="width:100%" class="btn btn-outline-default" data-toggle="modal" data-target="#modalConfirmBAS" onclick="GetEntityBas()">Confirm BAS Files</button></h3>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-12">
                                        <p style="font-size: 14px; margin-top: 10px; margin-bottom: 0;">
                                            <b>Download BAS Files by clicking the name of the file then confirm by using "Confirm BAS Files" button if the BAS files are ready for lodge.</b>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-12">
                                        <p style="font-size: 14px; margin-top: 10px; margin-bottom: 0;">
                                            <b>Upload your files using "Upload BAS Files" button then confirm using "Confirm BAS Files" button if you files are complete and ready for BAS Reviewer.</b>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "reviewer" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-12">
                                        <p style="font-size: 14px; margin-top: 10px; margin-bottom: 0;">
                                            <b>Download BAS Files by clicking the name of the file then approve by using "Approve BAS Files" button to return to the client for confirmation.</b>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_filereview_table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "js.php"; ?>
</body>
<script>
    var file_id;
    GetMonth();
    GetYear();
    GetMonth2();
    GetYear2();
    GetMonthReview();
    GetYearReview();
    GetFileType();
    GetEntity();
    GetEntity2();
    GetEntityReview('','');
    loadFiles();
    function loadFiles(){
        $("#div_filezone_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            filemonth   : $("#selectMonth").val(),
            fileyear    : $("#selectYear").val(),
            entity      : $("#selectEntity2").val(),
        };
        $.post("select_filezone", params).done(function(data) {
            $("#div_filezone_table").html(data);
        });
        $.post("select_filereview", params).done(function(data) {
            $("#div_filereview_table").html(data);
        });
    }
    function loadFilesList(filecateg){
        $("#div_filelist_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            filemonth       : $("#selectMonth").val(),
            fileyear        : $("#selectYear").val(),
            entity          : $("#selectEntity3").val(),
            filecategory    : filecateg,
        };
        $.post("select_filelist", params).done(function(data) {
            $("#div_filelist_table").html(data);
        });
    }
    function loadFilesListFinal(filecateg){
        $("#div_filebas_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            filemonth       : $("#selectMonth").val(),
            fileyear        : $("#selectYear").val(),
            entity          : $("#selectEntityBas").val(),
            filecategory    : filecateg,
        };
        $.post("select_filelist", params).done(function(data) {
            $("#div_filebas_table").html(data);
        });
    }
    function GetMonth(){
        $("#selectMonth").prop('disabled', true);
        $('#selectMonth')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_month").done(function(data) {
            $("#selectMonth").html(data);
            $("#selectMonth").prop('disabled', false);
        });
    }
    function GetYear(){
        $("#selectYear").prop('disabled', true);
        $('#selectYear')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_year").done(function(data) {
            $("#selectYear").html(data);
            $("#selectYear").prop('disabled', false);
        });
    }
    function GetMonth2(){
        $("#selectMonth2").prop('disabled', true);
        $('#selectMonth2')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_month").done(function(data) {
            $("#selectMonth2").html(data);
            $("#selectMonth2").prop('disabled', false);
        });
    }
    function GetYear2(){
        $("#selectYear2").prop('disabled', true);
        $('#selectYear2')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_year").done(function(data) {
            $("#selectYear2").html(data);
            $("#selectYear2").prop('disabled', false);
        });
    }
    function GetMonthReview(){
        $("#selectMonthReview").prop('disabled', true);
        $('#selectMonthReview')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_month").done(function(data) {
            $("#selectMonthReview").html(data);
            $("#selectMonthReview").prop('disabled', false);
        });
    }
    function GetYearReview(){
        $("#selectYearReview").prop('disabled', true);
        $('#selectYearReview')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_year").done(function(data) {
            $("#selectYearReview").html(data);
            $("#selectYearReview").prop('disabled', false);
        });
    }
    function GetFileType(){
        $("#selectType").prop('disabled', true);
        $('#selectType')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_filetype").done(function(data) {
            $("#selectType").html(data);
            $("#selectType").prop('disabled', false);
        });
    }
    function GetEntity(){
        $("#selectEntity").prop('disabled', true);
        $('#selectEntity')
            .empty()
            .append('<option value="">LOADING...</option>');
        $.post("select_entity", { }, function(data) {
            //console.log(data);
            $("#selectEntity").html(data);
            $("#selectEntity").prop('disabled', false);
        });
    }
    function GetEntity3(){
        $("#confirmButton").prop('disabled', true);
        $("#selectEntity3").prop('disabled', true);
        $('#selectEntity3')
            .empty()
            .append('<option value="">LOADING...</option>');
        $.post("select_entity", { }, function(data) {
            $("#selectEntity3").html(data);
            $("#selectEntity3").prop('disabled', false);
        });
        $("#div_filelist_table").empty();
    }
    function GetEntityBas(){
        $("#confirmButtonBas").prop('disabled', true);
        $("#selectEntityBas").prop('disabled', true);
        $('#selectEntityBas')
            .empty()
            .append('<option value="">LOADING...</option>');
        $.post("select_entity", { }, function(data) {
            $("#selectEntityBas").html(data);
            $("#selectEntityBas").prop('disabled', false);
        });
        $("#div_filebas_table").empty();
    }
    function GetEntity4(tstatus){
        $("#confirmButton").prop('disabled', true);
        $("#selectEntity3").prop('disabled', true);
        $('#selectEntity3')
            .empty()
            .append('<option value="">LOADING...</option>');
        var params;
        params = {
            fileMonth   : $("#selectMonth").val(),
            fileYear    : $("#selectYear").val(),
            trailstatus : tstatus,
        };
        $.post("select_entity_staff", params , function(data) {
            $("#selectEntity3").html(data);
            $("#selectEntity3").prop('disabled', false);
        });
        $("#div_filelist_table").empty();
    }
    function GetEntityReview(entityName, tstatus){
        $("#selectEntityReview").prop('disabled', true);
        $('#selectEntityReview')
            .empty()
            .append('<option value="">LOADING...</option>');
        var params;
        params = {
            fileMonth   : $("#selectMonthReview").val(),
            fileYear    : $("#selectYearReview").val(),
            trailstatus : tstatus,
        };
        $.post("select_entity_staff", params , function(data) {
            $("#selectEntityReview").html(data);
            $("#selectEntityReview").prop('disabled', false);
            if(entityName != ""){
                $("#selectEntityReview").val(entityName);
            }
        });
    }
    function GetEntity2(){
        $("#selectEntity2").prop('disabled', true);
        $('#selectEntity2')
            .empty()
            .append('<option value="">LOADING...</option>');
        $.post("select_entity", { }, function(data) {
            //console.log(data);
            $("#selectEntity2").html(data);
            $("#selectEntity2").prop('disabled', false);
        });
    }
    function newFile(){
        clearFile();
        document.getElementById('filezoneLabel').innerHTML = 'Upload File';
    }
    function editFile(id){
        clearFile();
        document.getElementById('filezoneLabel').innerHTML = 'Modify Uploaded File';
        params = {
            fileid : id
        };
        $.post("get_filezone",params).done(function(data) {
            var filezone = JSON.parse(data);
            file_id = filezone.fileid;
            $("#fileName").text(filezone.filename);
            $("#selectType").val(filezone.filetype);
            $("#selectMonth2").val(filezone.month);
            $("#selectYear2").val(filezone.year);
            $("#selectEntity").val(filezone.fileentity);
        });
    }
    function newFileReview(){
        clearFileReview();
        document.getElementById('filereviewLabel').innerHTML = 'Upload BTG File';
    }
    function editFileReview(id){
        clearFileReview();
        document.getElementById('filereviewLabel').innerHTML = 'Modify Uploaded BTG File';
        params = {
            fileid : id
        };
        $.post("get_filezone",params).done(function(data) {
            var filezone = JSON.parse(data);
            file_id = filezone.fileid;
            $("#fileNameReview").text(filezone.filename);
            $("#selectMonthReview").val(filezone.month);
            $("#selectYearReview").val(filezone.year);
            GetEntityReview(filezone.fileentity,'Confirmed');
        });
    }
    function deleteFile(id){
        swal({
            title: "Are you sure you want to delete this file?",
            text: "File cannot be recovered.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!"
        })
        .then((willDelete) => {
            if(willDelete.value){
                params = {
                    fileid : id
                };
                $.post("delete_file",params).done(function(data) {
                    swal("Deleted!", "File successfully deleted!");
                    loadFiles();
                });
            }
        });
    }
    function historyFile(id){
        $("#div_history_file").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            fileid   : id
        };
        $.post("select_filehistory", params).done(function(data) {
            $("#div_history_file").html(data);
        });
    }
    function viewFile(id){
        params = {
            fileid   : id
        };
        $.post("view_filehistory", params).done(function(data) {
            loadFiles();
        });
    }
    function clearFile(){
        $("#selectType").val("");
        $("#fileName").text("");
        $("#file_to_upload").val("");
        $("#selectEntity").val("");
        $("#val_selectType").empty();
        $("#val_selectEntity").empty();
        $("#val_fileName").empty();
    }
    function clearFileReview(){
        $("#fileNameReview").text("");
        $("#file_to_upload_review").val("");
        $("#selectEntityReview").val("");
        $("#val_selectEntityReview").empty();
        $("#val_fileNameReview").empty();
    }
    function notifTest(){
        swal("Saved!", $("#file_to_upload").val(), "success");
        //showBasicMassage();
    }
    function testFile(){
        var numVal = 0;
        if($("#selectType").val() == ''){
            $("#val_selectType").empty().append("<label style='color:red; font-style:italic;'>Please select a file type</label>");
            numVal += 1;
        }
        if($("#selectEntity").val() == ''){
            $("#val_selectEntity").empty().append("<label style='color:red; font-style:italic;'>Please select an entity</label>");
            numVal += 1;
        }
        if($("#fileName").text() == ''){
            $("#val_fileName").empty().append("<label style='color:red; font-style:italic;'>Please choose a file</label>");
            numVal += 1;
        }
        return numVal;
    }
    $('#selectType').on('change', function() {
        $("#val_selectType").empty();
    });
    $('#selectEntity').on('change', function() {
        $("#val_selectEntity").empty();
    });
    function testFileReview(){
        var numVal = 0;
        if($("#selectEntityReview").val() == ''){
            $("#val_selectEntityReview").empty().append("<label style='color:red; font-style:italic;'>Please select an entity</label>");
            numVal += 1;
        }
        if($("#fileNameReview").text() == ''){
            $("#val_fileNameReview").empty().append("<label style='color:red; font-style:italic;'>Please choose a file</label>");
            numVal += 1;
        }
        return numVal;
    }
    $('#selectEntityReview').on('change', function() {
        $("#val_selectEntityReview").empty();
    });
    function saveFile(){
        $("#savefilezone").prop('disabled', true);
        document.getElementById('savefilezone').innerHTML = 'Uploading';
        if (testFile() == 0){
            var saveStatus = document.getElementById('filezoneLabel').innerHTML;
            var params;
            params = {
                fileid     : file_id,
                fileName    : $("#fileName").text(),
                fileType    : $("#selectType").val(),
                fileMonth   : $("#selectMonth2").val(),
                fileYear    : $("#selectYear2").val(),
                fileEntity  : $("#selectEntity").val(),
            };
            if(saveStatus == 'Upload File'){
                $.post("insert_file",params).done(function(data) {
                    swal("Saved!", "File successfully submitted!", "success");
                    $('#modalFilezone').modal('toggle');
                    if ($("#file_to_upload").val() != ""){
                        saveToFolder($("#selectEntity").val(),$("#selectMonth2").val(),$("#selectYear2").val());
                    }
                    loadFiles();
                });
            }else{
                $.post("update_file",params).done(function(data) {
                    swal("Saved!", "File successfully updated!", "success");
                    $('#modalFilezone').modal('toggle');
                    if ($("#file_to_upload").val() != ""){
                        saveToFolder($("#selectEntity").val(),$("#selectMonth2").val(),$("#selectYear2").val());
                    }
                    loadFiles();
                });
            }
        }
        $("#savefilezone").prop('disabled', false);
        document.getElementById('savefilezone').innerHTML = 'Save';
    }
    function saveFileReview(){
        $("#savefilereview").prop('disabled', true);
        document.getElementById('savefilereview').innerHTML = 'Uploading';
        if (testFileReview() == 0){
            var saveStatus = document.getElementById('filereviewLabel').innerHTML;
            var params;
            params = {
                fileid     : file_id,
                fileName    : $("#fileNameReview").text(),
                fileMonth   : $("#selectMonthReview").val(),
                fileYear    : $("#selectYearReview").val(),
                fileEntity  : $("#selectEntityReview").val(),
            };
            if(saveStatus == 'Upload BTG File'){
                $.post("insert_filereview",params).done(function(data) {
                    swal("Saved!", "BTG File successfully submitted!", "success");
                    $('#modalFilereview').modal('toggle');
                    if ($("#file_to_upload_review").val() != ""){
                        saveToFolderReview($("#selectEntityReview").val(),$("#selectMonthReview").val(),$("#selectYearReview").val());
                    }
                    loadFiles();
                });
            }else{
                $.post("update_filereview",params).done(function(data) {
                    swal("Saved!", "BTG File successfully updated!", "success");
                    $('#modalFilereview').modal('toggle');
                    if ($("#file_to_upload_review").val() != ""){
                        saveToFolderReview($("#selectEntityReview").val(),$("#selectMonthReview").val(),$("#selectYearReview").val());
                    }
                    loadFiles();
                });
            }
        }
        $("#savefilereview").prop('disabled', false);
        document.getElementById('savefilereview').innerHTML = 'Save';
    }
    function auditFile(status){
        var filentitybas;
        if(status != 'ConfirmedBAS'){
            filentitybas = $("#selectEntity3").val();
        }else{
            filentitybas = $("#selectEntityBas").val();
        }
        var params;
        params = {
            fileMonth   : $("#selectMonth").val(),
            fileYear    : $("#selectYear").val(),
            fileEntity  : filentitybas,
            trailstatus : status,
        };
        $.post("insert_fileaudittrail",params).done(function(data) {
            swal("Saved!", "File successfully " + status + "!", "success");
            // if(status != 'ConfirmedBAS'){
            //     $('#modalConfirm').modal('toggle');
            // }else{
            //     $('#modalConfirmBAS').modal('toggle');
            // }
            loadFiles();
        });
    }
    function getFileID(id){
        $("#fileReason").val("");
        file_id = id;
    }
    function approveFile(){
        params = {
            fileid   : file_id
        };
        $.post("approve_file", params).done(function(data) {
            loadFiles();
        });
    }
    function denyFile(){
        params = {
            fileid   : file_id,
            filereason  : $("#fileReason").val()
        };
        $.post("deny_file", params).done(function(data) {
            loadFiles();
        });
    }
    function saveToFolder(entity, month, year){
        var formEl = document.forms.form_upload;
        $.ajax({
            url:'<?php echo base_url(); ?>index.php/page/upload_file?entity=' + entity + '&month=' + month + '&year=' + year,
            type:"post",
            data:new FormData(formEl),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            beforeSend: function() {},
            success: function(response) {
            // Handle the success response from the server
            },
            error: function() {
            // Handle errors, if any
            },
            complete: function() {
                $("#savefilezone").prop('disabled', false);
                document.getElementById('savefilezone').innerHTML = 'Save';
            }
        });
    }
    function saveToFolderReview(entity, month, year){
        var formEl = document.forms.form_upload_review;
        $.ajax({
            url:'<?php echo base_url(); ?>index.php/page/upload_file_review?entity=' + entity + '&month=' + month + '&year=' + year,
            type:"post",
            data:new FormData(formEl),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                console.log("Upload Image Successful.");
        }
        });
    }
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $("#fileName").text(fileName);
        $("#fileNameReview").text(fileName);
        $("#val_fileName").empty();
        $("#val_fileNameReview").empty();
    });
</script>
</html>