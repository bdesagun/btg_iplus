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
                                    <select class="form-control" id="selectMonth" onchange="loadFiles()"></select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="selectYear" onchange="loadFiles()"></select>
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
        // params = {
        //     filemonth   : $("#selectMonth").val(),
        //     fileyear    : $("#selectYear").val(),
        //     client      : $("#selectClient").val(),
        //     entity      : $("#selectEntity2").val(),
        // };
        $.post("select_home").done(function(data) {
            $("#div_home_table").html(data);
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
</script>
</html>