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
                            <h6 class="h2 d-inline-block mb-0">MY PROFILE</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="modal fade" id="modelPassword" tabindex="-1" role="dialog" aria-labelledby="accountLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="accountLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3" id="validation_password"></div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">Current Password:</label>
                                        <input class="form-control" id="currentpassword" type="password" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">New Password:</label>
                                        <input class="form-control" id="newpassword" type="password" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">Confirm Password:</label>
                                        <input class="form-control" id="confirmpassword" type="password" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default" id="saveaccount" onclick="changePassword()">Change</button>
                            <button type="button" class="btn btn-outline-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header -->
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <!-- <div class="row">
                        <div class="col-lg-6">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total traffic</h5>
                                            <span class="h2 font-weight-bold mb-0">350,897</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                <i class="ni ni-active-40"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm">
                                        <span class="mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total traffic</h5>
                                            <span class="h2 font-weight-bold mb-0">350,897</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                <i class="ni ni-active-40"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm">
                                        <span class="mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="btn btn-outline-default btn-sm" onclick="saveProfile()">Save profile </h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="#!" class="btn btn-outline-default btn-sm" data-toggle="modal" data-target="#modelPassword" onclick="clearPassword()">Change Password</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <h6 class="heading-small text-muted mb-4">User Information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Account Name</label>
                                                <input type="email" id="accountname" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Email address</label>
                                                <input type="email" id="email" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Address</label>
                                            <input id="address" class="form-control" type="text">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Mobile Number</label>
                                                <input type="text" id="mobilenumber" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Telephone Number</label>
                                                <input type="text" id="telephonenumber" class="form-control">
                                            </div>
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
    <?php require "js.php"; ?>
</body>
<script>
    GetProfile();
    function changePassword(){
        if ($("#newpassword").val() == $("#confirmpassword").val()){
            var params;
            params = {
                currentpassword    : $("#currentpassword").val(),
                newpassword        : $("#newpassword").val(),
            };
            $.post("change_password",params).done(function(data) {
                if(data == 'accepted'){
                    swal("Saved!", "Password successfully changed!", "success");
                    $('#modalPassword').modal('toggle');
                }else{
                    $('#validation_password')
                        .empty()
                        .append("<div class='alert alert-danger alert-dismissible fade show' role='alert'><span class='alert-text'>Incorrect current password!</span></div>");
                }
            });
        }else{
            $('#validation_password')
                .empty()
                .append("<div class='alert alert-danger alert-dismissible fade show' role='alert'><span class='alert-text'>Password not match!</span></div>");
        }
    }
    function clearPassword(){
        $("#currentpassword").val("");
        $("#newpassword").val("");
        $("#confirmpassword").val("");
    }
    function GetProfile(){
        $.post("get_profile").done(function(data) {
            var useraccount = JSON.parse(data);
            $("#accountname").val(useraccount.accountname);
            $("#email").val(useraccount.email);
            $("#address").val(useraccount.address);
            $("#mobilenumber").val(useraccount.mobilenumber);
            $("#telephonenumber").val(useraccount.telephonenumber);
        });
    }

    function saveProfile(){
        var params;
        params = {
            address    : $("#address").val(),
            mobilenumber  : $("#mobilenumber").val(),
            telephonenumber  : $("#telephonenumber").val(),
        };
        $.post("update_profile",params).done(function(data) {
            swal("Saved!", "Profile successfully saved!", "success");
        });
    }
</script>
</html>