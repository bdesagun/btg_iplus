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
        <!-- Header -->
        <!-- Header -->
        <div class="header pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 d-inline-block mb-0">HOME</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->

        <div class="container-fluid mt--6">
            <!-- <div class="row justify-content-center">
                <div class="col-lg-8 card-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Change how you view indirect tax with i+.</h3>
                            <p class="card-text mb-2">This is the place to access all indirect tax data lodged to the
                                ATO,
                                create, view and amend dashboards that speak to your indirect tax history, and analyze
                                data
                                to
                                drive indirect tax decisions. <a href="#">Learn more about i+ and its functionality</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="row">
                                <label for="example-text-input" class="col-md-8 col-form-label form-control-label text-right">GST Filing Period:</label>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectMonth" onchange="loadHome()"></select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectYear" onchange="loadHome()"></select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_home_table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "js.php"; ?>
</body>

<script>
    GetMonth();
    GetYear();
    loadHome();
    function loadHome(){
        $("#div_home_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            filemonth   : $("#selectMonth").val(),
            fileyear    : $("#selectYear").val(),
        };
        $.post("select_bas_progress", params).done(function(data) {
            $("#div_home_table").html(data);
            $.post("select_due", params).done(function(data) {
                var due = JSON.parse(data);
                if (due){
                    $("#data_request").val(due.data_request);
                    $("#data_upload").val(due.data_upload);
                    $("#bas_preparation").val(due.bas_preparation);
                    $("#bas_review").val(due.bas_review);
                    $("#bas_sign_off").val(due.bas_sign_off);
                    $("#bas_lodgement").val(due.bas_lodgement);
                }
            });
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
    function saveDue(){
        var params;
        params = {
            filemonth       : $("#selectMonth").val(),
            fileyear        : $("#selectYear").val(),
            data_request    : $("#data_request").val(),
            data_upload     : $("#data_upload").val(),
            bas_preparation : $("#bas_preparation").val(),
            bas_review      : $("#bas_review").val(),
            bas_sign_off    : $("#bas_sign_off").val(),
            bas_lodgement   : $("#bas_lodgement").val(),
        };
        $.post("save_due",params).done(function(data) {
            loadHome();
        });
    }
</script>
</html>