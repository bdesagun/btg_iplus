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
                                    <label class="form-control-label" id="fileType">File Type</label>
                                    <select class="form-control" id="selectType"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label" id="fileMonth">Month</label>
                                    <select class="form-control" id="selectMonth2"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label" id="fileYear">Year</label>
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
                        <h5 class="modal-title" id="filezoneLabel">Upload File</h5>
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
                                <div class="col-8">
                                    <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalFilezone" onclick="newFile()">Upload</button></h3>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" id="selectMonth" onchange="loadFiles()"></select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" id="selectYear" onchange="loadFiles()"></select>
                                </div>
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
    GetFileType();
    loadFiles();
    function loadFiles(){
        $("#div_filezone_table").html("Loading...");
        params = {
            filemonth   : $("#selectMonth").val(),
            fileyear    : $("#selectYear").val()
        };
        $.post("select_filezone", params).done(function(data) {
            $("#div_filezone_table").html(data);
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
        });
    }
    function clearFile(){
        $("#selectType").val("0");
        $("#fileName").text("");
        $("#file_to_upload").val("");
    }
    function notifTest(){
        swal("Saved!", $("#file_to_upload").val(), "success");
        //showBasicMassage();
    }
    function saveFile(){
        var saveStatus = document.getElementById('filezoneLabel').innerHTML;
        var params;
        params = {
            fileid     : file_id,
            fileName    : $("#fileName").text(),
            fileType    : $("#selectType").val(),
            fileMonth   : $("#selectMonth2").val(),
            fileYear    : $("#selectYear2").val(),
        };
        if(saveStatus == 'Upload File'){
            $.post("insert_file",params).done(function(data) {
                swal("Saved!", "File successfully submitted!", "success");
                $('#modalFilezone').modal('toggle');
                if ($("#file_to_upload").val() != ""){
                    saveToFolder();
                }
                loadFiles();
            });
        }else{
            $.post("update_file",params).done(function(data) {
                swal("Saved!", "File successfully updated!", "success");
                $('#modalFilezone').modal('toggle');
                if ($("#file_to_upload").val() != ""){
                    saveToFolder();
                }
                loadFiles();
            });
        }
    }
    function saveToFolder(){
        var formEl = document.forms.form_upload;
        $.ajax({
            url:'<?php echo base_url(); ?>index.php/page/upload_file',
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
    });
</script>
</html>