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
                                    <h3 class="mb-0"><button type="button" class="btn btn-outline-default">Upload</button></h3>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>JANUARY</option>
                                        <option>FEBRUARY</option>
                                        <option>MARCH</option>
                                        <option>APRIL</option>
                                        <option>MAY</option>
                                        <option>JUNE</option>
                                        <option>JULY</option>
                                        <option>AUGUST</option>
                                        <option>SEPTEMBER</option>
                                        <option>OCTOBER</option>
                                        <option>NOVEMBER</option>
                                        <option>DECEMBER</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                        <option>2022</option>
                                        <option>2023</option>
                                    </select>
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
    loadReferral();
    function loadReferral(){
        $("#div_filezone_table").html("Loading...");
        $.post("select_filezone").done(function(data) {
            $("#div_filezone_table").html(data);
        });
    }
</script>
</html>