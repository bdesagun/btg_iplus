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
                            <h6 class="h2 d-inline-block mb-0">BAS REPORTS</h6>
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
                                    <select class="form-control" id="selectEntity2" onchange="loadBashistory()"><option value='ALL'>ALL</option></select>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectMonth" onchange="loadBashistory()"></select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectYear" onchange="loadBashistory()"></select>
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
                        <div class="table-responsive py-4"  id="div_bashistory_table"></div>
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
    GetEntity2();
    loadBashistory();
    function loadBashistory(){
        $("#div_bashistory_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        params = {
            filemonth   : $("#selectMonth").val(),
            fileyear    : $("#selectYear").val(),
            entity      : $("#selectEntity2").val(),
        };
        $.post("select_filereview", params).done(function(data) {
            $("#div_bashistory_table").html(data);
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
</script>
</html>