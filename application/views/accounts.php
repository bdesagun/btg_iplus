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
        <div class="header pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 d-inline-block mb-0">ACCOUNT MANAGEMENT</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalAccount" tabindex="-1" role="dialog" aria-labelledby="accountLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountLabel">Create Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Account Name:</label>
                                    <input class="form-control" id="accountname" type="text" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Email:</label>
                                    <input class="form-control" id="email" type="text" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Position</label>
                                    <select class="form-control" id="position" onchange="showClient()">
                                        <option value="client">Client</option>
                                        <option value="staff">Staff</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="clientrow">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Client Name</label>
                                    <select class="form-control" id="clientname"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Username:</label>
                                    <input class="form-control" id="username" type="text" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5><i>Note: Username cannot be change after creating.</i></h5>
                            </div>
                        </div>
                    </div>`
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-default" id="saveaccount" onclick="saveAccount()">Save</button>
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalActivation" tabindex="-1" role="dialog" aria-labelledby="activeLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="activeLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h4 id="activeMessage"></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <button class="btn btn-outline-default" style="margin-top: 20px"onclick="activeAccount()">Yes</button>
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
        <div class="modal fade" id="modalReset" tabindex="-1" role="dialog" aria-labelledby="activeLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h4>Are you sure you want to reset this user's password?</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <button class="btn btn-outline-default" style="margin-top: 20px" id="resetButton" onclick="resetAccount()">Reset</button>
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
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalAccount" onclick="newAccount()">ADD NEW ACCOUNT</button></h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_account_table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "js.php"; ?>
</body>
<script>
    var activeState;
    var userid;
    var useremail;
    loadAccount();
    GetClient();
    function loadAccount(){
        $("#div_account_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        $.post("select_account_list").done(function(data) {
            $("#div_account_table").html(data);
        });
    }
    function GetClient(){
        $("#clientname").prop('disabled', true);
        $('#clientname')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_clientname").done(function(data) {
            $("#clientname").html(data);
            $("#clientname").prop('disabled', false);
        });
    }
    function showClient(){
        $("#clientname").val("");
        if ($("#position").val() == "client") {
            $("#clientrow").show();
        }else{
            $("#clientrow").hide();
        }
    }
    function saveAccount(){
        $("#saveaccount").prop('disabled', true);
        document.getElementById('saveaccount').innerHTML = 'Saving';
        var saveStatus = document.getElementById('accountLabel').innerHTML;
        var params;
        params = {
            username    : $("#username").val(),
            accountname : $("#accountname").val(),
            email       : $("#email").val(),
            position    : $("#position").val(),
            clientname  : $("#clientname").val(),
        };
        if(saveStatus == 'New Account'){
            $.post("insert_account",params).done(function(data) {
                swal("Saved!", "Account successfully created!", "success");
                $('#modalAccount').modal('toggle');
                loadAccount();
            });
        }else{
            $.post("update_account",params).done(function(data) {
                swal("Saved!", "Account successfully updated!", "success");
                $('#modalAccount').modal('toggle');
                loadAccount();
            });
        }
    }
    function activeAccount(){
        var newState = activeState == '0' ? '1' : '0';
        var params;
        params = {
            username : userid,
            active   : newState
        };
        $.post("active_account",params).done(function(data) {
            if(activeState == '0'){
                swal("Saved!", "Account successfully Activated!", "success");
            }else{
                swal("Saved!", "Account successfully Deactivated!", "success");
            }
            $('#modalActivation').modal('toggle');
            loadAccount();
        });
    }
    function resetAccount(){
        $("#resetButton").prop('disabled', true);
        document.getElementById('resetButton').innerHTML = 'Resetting';
        var params;
        params = {
            username : userid,
            email : useremail
        };
        $.post("reset_account",params).done(function(data) {
            swal("Saved!", "Account's password successfully reset!", "success");
            $('#modalReset').modal('toggle');
            loadAccount();
        });
    }
    function viewActivationAccount(state, id){
        if(state == '0'){
            document.getElementById('activeLabel').innerHTML = 'Activate Account';
            document.getElementById('activeMessage').innerHTML = 'Are you sure you want to activate this account?';
        }else{
            document.getElementById('activeLabel').innerHTML = 'Deactivate Account';
            document.getElementById('activeMessage').innerHTML = 'Are you sure you want to deactivate this account?';
        }
        activeState = state;
        userid = id;
    }
    function viewResetAccount(id, email){
        $("#resetButton").prop('disabled', false);
        document.getElementById('resetButton').innerHTML = 'Reset';
        userid = id;
        useremail = email;
    }
    function newAccount(){
        clearAccount();
        document.getElementById('accountLabel').innerHTML = 'New Account';
    }
    function editAccount(id){
        clearAccount();
        document.getElementById('username').type = 'password';
        document.getElementById('accountLabel').innerHTML = 'Modify Account';
        $("#username").prop('disabled', true);
        $("#username").val(id);
        var params;
        params = {
            username : id
        };
        $.post("get_account",params).done(function(data) {
            var useraccount = JSON.parse(data);
            $("#accountname").val(useraccount.accountname);
            $("#email").val(useraccount.email);
            $("#position").val(useraccount.position);
            $("#clientname").val(useraccount.clientname);
            if (useraccount.position == "client") {
                $("#clientrow").show();
            }else{
                $("#clientrow").hide();
            }
        });
    }
    function clearAccount(){
        document.getElementById('username').type = 'text';
        $("#position").val("client");
        $("#accountname").val("");
        $("#email").val("");
        $("#username").val("");
        $("#clientname").val("");
        $("#username").prop('disabled', false);
        $("#saveaccount").prop('disabled', false);
        document.getElementById('saveaccount').innerHTML = 'Save';
    }
</script>
</html>