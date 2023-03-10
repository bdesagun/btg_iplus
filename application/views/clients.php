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
        <div class="modal fade" id="modalClient" tabindex="-1" role="dialog" aria-labelledby="clientLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientLabel">Create Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Client Name:</label>
                                    <input class="form-control" id="clientname" type="text" autocomplete="off">
                                    <div id='val_clientname'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Address:</label>
                                    <input class="form-control" id="address" type="text" autocomplete="off">
                                    <div id='val_address'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Industry:</label>
                                    <input class="form-control" id="industry" type="text" autocomplete="off">
                                    <div id='val_industry'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-default" onclick="saveClient()">Save</button>
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEntity" tabindex="-1" role="dialog" aria-labelledby="entityLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="entityLabel">Entity List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-9">
                                    <input class="form-control" id="entity" type="text" placeholder="Input Entity Name" autocomplete="off">
                            </div>
                            <div class="col-3 text-right">
                                <button type="button" class="btn btn-outline-default" onclick="addEntity()">Add</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="table-responsive py-4"  id="div_entity_table"></div>
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
                                            <button class="btn btn-outline-default" style="margin-top: 20px"onclick="activeClient()">Yes</button>
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
                                    <h3 class="mb-0"><button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modalClient" onclick="newClient()">ADD NEW CLIENT</button></h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive py-4"  id="div_client_table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "js.php"; ?>
</body>
<script>
    var activeState;
    var client_id;
    loadClient();
    function loadClient(){
        $("#div_client_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        $.post("select_client_list").done(function(data) {
            $("#div_client_table").html(data);
        });
    }
    function viewEntity(id){
        $("#entity").val("");
        $("#div_entity_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        client_id = id;
        var params;
        params = {
            clientid : id,
        };
        $.post("select_entity_list", params).done(function(data) {
            $("#div_entity_table").html(data);
        });
    }
    function addEntity(){
        if ($("#entity").val() != ''){
            var params;
            params = {
                clientid    : client_id,
                entity      : $("#entity").val(),
            };
            $.post("insert_entity",params).done(function(data) {
                viewEntity(client_id);
                $("#entity").val("");
            });
        }
    }
    function deleteEntity(value, subcategory){
        var params;
        params = {
            value          : value,
            subcategory    : subcategory
        };
        $.post("delete_entity",params).done(function(data) {
            viewEntity(client_id);
        });
    }
    function testClient(){
        var numVal = 0;
        if($("#clientname").val() == ''){
            $("#val_clientname").empty().append("<label style='color:red; font-style:italic;'>Please input a client name</label>");
            numVal += 1;
        }
        if($("#address").val() == ''){
            $("#val_address").empty().append("<label style='color:red; font-style:italic;'>Please input an address</label>");
            numVal += 1;
        }
        if($("#industry").val() == ''){
            $("#val_industry").empty().append("<label style='color:red; font-style:italic;'>Please input an industry</label>");
            numVal += 1;
        }
        return numVal;
    }
    $('#clientname').on('input', function() {
        $("#val_clientname").empty();
    });
    $('#address').on('input', function() {
        $("#val_address").empty();
    });
    $('#industry').on('input', function() {
        $("#val_industry").empty();
    });
    function saveClient(){
        if (testClient() == 0){
            var saveStatus = document.getElementById('clientLabel').innerHTML;
            var params;
            params = {
                clientid    : client_id,
                clientname  : $("#clientname").val(),
                address     : $("#address").val(),
                industry    : $("#industry").val(),
            };
            if(saveStatus == 'New Client'){
                $.post("insert_client",params).done(function(data) {
                    swal("Saved!", "Client successfully created!", "success");
                    $('#modalClient').modal('toggle');
                    loadClient();
                });
            }else{
                $.post("update_client",params).done(function(data) {
                    swal("Saved!", "Client successfully updated!", "success");
                    $('#modalClient').modal('toggle');
                    loadClient();
                });
            }
        }
    }
    function activeClient(){
        var newState = activeState == '0' ? '1' : '0';
        var params;
        params = {
            clientid : client_id,
            active   : newState
        };
        $.post("active_client",params).done(function(data) {
            if(activeState == '0'){
                swal("Saved!", "Client successfully Activated!", "success");
            }else{
                swal("Saved!", "Client successfully Deactivated!", "success");
            }
            $('#modalActivation').modal('toggle');
            loadClient();
        });
    }
    function viewActivationClient(state, id){
        if(state == '0'){
            document.getElementById('activeLabel').innerHTML = 'Activate Client';
            document.getElementById('activeMessage').innerHTML = 'Are you sure you want to activate this client?';
        }else{
            document.getElementById('activeLabel').innerHTML = 'Deactivate Client';
            document.getElementById('activeMessage').innerHTML = 'Are you sure you want to deactivate this client?';
        }
        activeState = state;
        client_id = id;
    }
    function newClient(){
        clearClient();
        document.getElementById('clientLabel').innerHTML = 'New Client';
    }
    function editClient(id){
        clearClient();
        document.getElementById('clientLabel').innerHTML = 'Modify Client';
        var params;
        params = {
            clientid : id
        };
        $.post("get_client",params).done(function(data) {
            var client = JSON.parse(data);
            client_id = client.clientid;
            $("#clientname").val(client.clientname);
            $("#address").val(client.address);
            $("#industry").val(client.industry);
        });
    }
    function clearClient(){
        $("#clientname").val("");
        $("#address").val("");
        $("#industry").val("");
        $("#val_clientname").empty();
        $("#val_address").empty();
        $("#val_industry").empty();
    }
</script>
</html>