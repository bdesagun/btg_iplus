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
                        <h5 class="modal-title" id="filezoneLabel">Upload File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `    <div class="modal-body">
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
                        <button type="button" class="btn btn-outline-default" onclick="saveFile()">Save</button>
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
                                    <select class="form-control" id="selectEntity3" onchange="loadFilesList()"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Files:</label>
                                    <div class="table-responsive py-4"  id="div_filelist_table"></div>
                                    <div id='val_selectEntity3'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Confirm</button>
                                    <button class="btn btn-outline-default" style="margin-top: 20px" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
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
                        <div class="card-header">
                            <div class="row">
                                <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-1">
                                        <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalFilezone" onclick="newFile()">Upload</button></h3>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin"){ ?>
                                    <label for="example-text-input" class="col-md-1 col-form-label form-control-label">Client:</label>
                                    <div class="col-md-2">
                                        <select class="form-control" id="selectClient" onchange="loadFiles(), GetEntity2()"></select>
                                    </div>
                                    <label for="example-text-input" class="col-md-1 col-form-label form-control-label">Entity:</label>
                                    <div class="col-md-2">
                                        <select class="form-control" id="selectEntity2" onchange="loadFiles()"><option value='ALL'>ALL</option></select>
                                    </div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "staff" && $_SESSION["position"] != "admin"){ ?>
                                    <div class="col-md-2"></div>
                                <?php } ?>
                                <?php if($_SESSION["position"] == "client" && $_SESSION["position"] != "admin"){ ?>
                                    <div class="col-md-5"></div>
                                <?php } ?>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectMonth" onchange="loadFiles()"></select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectYear" onchange="loadFiles()"></select>
                                </div>
                                <?php if($_SESSION["position"] == "client" || $_SESSION["position"] == "admin"){ ?>
                                    <div class="col-md-2 text-right">
                                        <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalConfirm" onclick="GetEntity3()">Confirm File</button></h3>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_filezone_table"></div>
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
    GetClient();
    GetFileType();
    loadFiles();
    function loadFiles(){
        $("#div_filezone_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            filemonth   : $("#selectMonth").val(),
            fileyear    : $("#selectYear").val(),
            client      : $("#selectClient").val(),
            entity      : $("#selectEntity2").val(),
        };
        $.post("select_filezone", params).done(function(data) {
            $("#div_filezone_table").html(data);
        });
    }
    function loadFilesList(){
        $("#div_filelist_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            filemonth   : $("#selectMonth").val(),
            fileyear    : $("#selectYear").val(),
            entity      : $("#selectEntity3").val(),
        };
        $.post("select_filelist", params).done(function(data) {
            $("#div_filelist_table").html(data);
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
            .append('<option value="a">LOADING...</option>');
        $.post("select_entity", { id: $('#selectClient').val() }, function(data) {
            $("#selectEntity").html(data);
            $("#selectEntity").prop('disabled', false);
        });
    }
    function GetEntity3(){
        $("#selectEntity3").prop('disabled', true);
        $('#selectEntity3')
            .empty()
            .append('<option value="a">LOADING...</option>');
        $.post("select_entity", { id: $('#selectClient').val() }, function(data) {
            $("#selectEntity3").html(data);
            $("#selectEntity3").prop('disabled', false);
        });
        $("#div_filelist_table").empty();
    }
    function GetEntity2(){
        if($('#selectClient').val() == 'ALL' || $('#selectClient').val() == 'LOADING...'){
            $("#selectEntity2").val('ALL');
            $("#selectEntity2").prop('disabled', true);
        }
        else{
            $("#selectEntity2").prop('disabled', true);
            $('#selectEntity2')
                .empty()
                .append('<option value="a">LOADING...</option>');
            $.post("select_entity", { id: $('#selectClient').val() }, function(data) {
                console.log(data);
                $("#selectEntity2").html(data);
                $("#selectEntity2").prop('disabled', false);
            });
        }
    }
    function GetClient(){
        $("#selectEntity2").val('ALL');
        $("#selectEntity2").prop('disabled', true);
        $("#selectClient").prop('disabled', true);
        $('#selectClient')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_client").done(function(data) {
            $("#selectClient").html(data);
            $("#selectClient").prop('disabled', false);
        });
    }
    function newFile(){
        clearFile();
        GetMonth2();
        GetYear2();
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
    function deleteFile(id){
        let text = "Are you sure you want to delete this file? File cannot be recovered.";
        if (confirm(text) == true) {
            params = {
                fileid : id
            };
            $.post("delete_file",params).done(function(data) {
                swal("Deleted!", "File successfully deleted!");
                loadFiles();
            });
        }
        // params = {
        //     fileid : id
        // };
        // swal({
        //     title: "Are you sure you want to delete this file?",
        //     text: "You will not be able to recover this file!",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#DD6B55",
        //     confirmButtonText: "Yes",
        //     cancelButtonText: "No"
        // }, function (isConfirm) {
        //     alert("dumaan");
        //     if (isConfirm) {
        //         $.post("delete_file",params).done(function(data) {
        //             swal("Deleted!", "Your file has been deleted.", "success");
        //             loadFiles();
        //         });
        //     }
        // });
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
    function saveFile(){
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
                        saveToFolder($("#selectEntity").val());
                    }
                    loadFiles();
                });
            }else{
                $.post("update_file",params).done(function(data) {
                    swal("Saved!", "File successfully updated!", "success");
                    $('#modalFilezone').modal('toggle');
                    if ($("#file_to_upload").val() != ""){
                        saveToFolder($("#selectEntity").val());
                    }
                    loadFiles();
                });
            }
        }
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
    function saveToFolder(entity){
        var formEl = document.forms.form_upload;
        $.ajax({
            url:'<?php echo base_url(); ?>index.php/page/upload_file?entity=' + entity,
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
        $("#val_fileName").empty();
    });
</script>
</html>