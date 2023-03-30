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
                                    <div id='val_accountname'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Email:</label>
                                    <input class="form-control" id="email" type="text" autocomplete="off">
                                    <div id='val_email'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Position</label>
                                    <select class="form-control" id="position" onchange="showClient()">
                                        <option value="">Select Position</option>
                                        <option value="client">Client</option>
                                        <option value="staff">Staff</option>
                                        <option value="reviewer">Reviewer</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <div id='val_position'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="clientrow">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Client Name</label>
                                    <select class="form-control" id="clientname"></select>
                                    <div id='val_clientname'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Username:</label>
                                    <input class="form-control" id="username" type="text" autocomplete="off">
                                    <div id='val_username'></div>
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
                        <button type="button" class="btn btn-outline-default" id="saveaccount" onclick="testAccount()">Save</button>
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
        <div class="modal fade" id="modalAccess" tabindex="-1" role="dialog" aria-labelledby="accessLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accessLabel">Access List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" id="selectClientAccess" onchange="GetEntityAccess()"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" id="selectEntityAccess"><option value='ALL'>ALL</option></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" style="width:100%" class="btn btn-outline-default" onclick="addAccess()">Add Access</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="table-responsive py-4"  id="div_access_table"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal">Close</button>
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
    GetClientAccess();
    GetEntityAccess();
    function loadAccount(){
        $("#div_account_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        $.post("select_account_list").done(function(data) {
            $("#div_account_table").html(data);
        });
    }
    function loadAccess(id){
        $("#selectClientAccess").val('ALL');
        $("#selectEntityAccess").val('ALL');
        userid = id;
        var params;
        params = {
            username    : userid,
        };
        $("#div_access_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        $.post("select_access_list",params).done(function(data) {
            $("#div_access_table").html(data);
        });
    }
    function addAccess(){
        console.log(userid);
        var params;
        params = {
            clientid    : $("#selectClientAccess").val(),
            entity      : $("#selectEntityAccess").val(),
            username    : userid,
        };
        $.post("insert_access",params).done(function(data) {
            loadAccess(userid);
        });
    }
    function deleteAccess(userclient, userentity, useraccess){
        var params;
        params = {
            clientid    : userclient,
            entity      : userentity,
            username    : useraccess,
        };
        console.log(params);
        $.post("delete_access",params).done(function(data) {
            loadAccess(useraccess);
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
    function GetClientAccess(){
        $("#selectEntityAccess").val('ALL');
        $("#selectEntityAccess").prop('disabled', true);
        $("#selectClientAccess").prop('disabled', true);
        $('#selectClientAccess')
            .empty()
            .append('<option>LOADING...</option>');
        $.post("select_client_all").done(function(data) {
            $("#selectClientAccess").html(data);
            $("#selectClientAccess").prop('disabled', false);
        });
    }
    function GetEntityAccess(){
        if($('#selectClientAccess').val() == 'ALL' || $('#selectClientAccess').val() == 'LOADING...'){
            $("#selectEntityAccess").val('ALL');
            $("#selectEntityAccess").prop('disabled', true);
        }
        else{
            $("#selectEntityAccess").prop('disabled', true);
            $('#selectEntityAccess')
                .empty()
                .append('<option value="">LOADING...</option>');
            $.post("select_entity_all", { id: $('#selectClientAccess').val() }, function(data) {
                //console.log(data);
                $("#selectEntityAccess").html(data);
                $("#selectEntityAccess").prop('disabled', false);
            });
        }
    }
    function showClient(){
        $("#clientname").val("");
        if ($("#position").val() == "client") {
            $("#clientrow").show();
        }else{
            $("#clientrow").hide();
        }
    }
    function testAccount(){
        var numVal = 0;
        var saveStatus = document.getElementById('accountLabel').innerHTML;
        if($("#accountname").val() == ''){
            $("#val_accountname").empty().append("<label style='color:red; font-style:italic;'>Please input an account name</label>");
            numVal += 1;
        }
        if($("#email").val() == ''){
            $("#val_email").empty().append("<label style='color:red; font-style:italic;'>Please input an email</label>");
            numVal += 1;
        }
        if($("#position").val() == ''){
            $("#val_position").empty().append("<label style='color:red; font-style:italic;'>Please select a position</label>");
            numVal += 1;
        }
        if ($("#position").val() == 'client'){
            if($("#clientname").val() == ''){
                $("#val_clientname").empty().append("<label style='color:red; font-style:italic;'>Please select a client</label>");
                numVal += 1;
            }
        }
        if(saveStatus == 'New Account'){
            if($("#username").val() == ''){
                $("#val_username").empty().append("<label style='color:red; font-style:italic;'>Please input a username</label>");
                numVal += 1;
                return numVal;
            }else{
                if($("#username").val().length < 8){
                    $("#val_username").empty().append("<label style='color:red; font-style:italic;'>Username must be at least 8 characters.</label>");
                    numVal += 1;
                }
                var params;
                params = {
                    username    : $("#username").val(),
                };
                $.post("select_username", params).done(function(data) {
                    if (data == 'existing'){
                        $("#val_username").empty().append("<label style='color:red; font-style:italic;'>Username already exists.</label>");
                        numVal += 1;
                        saveAccount(numVal);
                    }else{
                        saveAccount(numVal);
                    }
                });
            }
        }else{
            saveAccount(numVal);
        }
    }
    $('#accountname').on('input', function() {
        $("#val_accountname").empty();
    });
    $('#email').on('input', function() {
        $("#val_email").empty();
    });
    $('#position').on('change', function() {
        $("#val_position").empty();
    });
    $('#clientname').on('change', function() {
        $("#val_clientname").empty();
    });
    $('#username').on('input', function() {
        $("#val_username").empty();
    });
    function saveAccount(numVal){
        if (numVal == 0){
            $("#saveaccount").prop('disabled', true);
            document.getElementById('saveaccount').innerHTML = 'Saving';
            var saveStatus = document.getElementById('accountLabel').innerHTML;
            var params;
            params = {
                username    : $("#username").val(),
                accountname : $("#accountname").val(),
                email       : $("#email").val(),
                position    : $("#position").val(),
                clientid    : $("#clientname").val(),
            };
            if(saveStatus == 'New Account'){
                $.post("insert_account",params).done(function(data) {
                    swal("Saved!", "Account successfully created!", "success");
                    $('#modalAccount').modal('toggle');
                    loadAccount();
                });
            }else{
                console.log($("#username").val());
                $.post("update_account",params).done(function(data) {
                    swal("Saved!", "Account successfully updated!", "success");
                    $('#modalAccount').modal('toggle');
                    loadAccount();
                });
            }
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
            if (useraccount.position == "client") {
                $("#clientrow").show();
            }else{
                $("#clientrow").hide();
            }
            $("#clientname").val(useraccount.clientid);
        });
    }
    function clearAccount(){
        document.getElementById('username').type = 'text';
        $("#position").val("");
        $("#accountname").val("");
        $("#email").val("");
        $("#username").val("");
        $("#clientname").val("");
        $("#username").prop('disabled', false);
        $("#saveaccount").prop('disabled', false);
        $("#clientrow").hide();
        document.getElementById('saveaccount').innerHTML = 'Save';
        $("#val_accountname").empty();
        $("#val_email").empty();
        $("#val_position").empty();
        $("#val_clientname").empty();
        $("#val_username").empty();
    }
</script>
</html>