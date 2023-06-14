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
                            <h6 class="h2 d-inline-block mb-0">CLIENT MANAGEMENT</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalClient" tabindex="-1" role="dialog" aria-labelledby="clientLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                                    <label class="form-control-label">Client ID:</label>
                                    <input class="form-control" id="clientcode" type="text" autocomplete="off">
                                    <div id='val_address'></div>
                                </div>
                            </div>
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
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Industry:</label>
                                    <input class="form-control" id="industry" type="text" autocomplete="off">
                                    <div id='val_industry'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">ABN Details:</label>
                                    <input class="form-control" id="abndetails" type="text" oninput="limitInput()" autocomplete="off" maxlength="14">
                                    <div id='val_abndetails'></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">GST Registration Details:</label>
                                    <input class="form-control" id="gstdetails" type="text" autocomplete="off">
                                    <div id='val_gstdetails'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Reporting Type:</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="typebas" class="custom-control-input" id="option1" type="radio" checked>
                                                <label class="custom-control-label" for="option1">Group BAS</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="typebas" class="custom-control-input" id="option2" type="radio">
                                                <label class="custom-control-label" for="option2">Standalone BAS</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="typebas" class="custom-control-input" id="option3" type="radio">
                                                <label class="custom-control-label" for="option3">Mixed</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='val_typebas'></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Other Registration:</label>
                                    <input class="form-control" id="otherreg" type="text" autocomplete="off">
                                    <div id='val_otherreg'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">File Type:</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" name="filetype" id="check1" type="checkbox">
                                                <label class="custom-control-label" for="check1">Activity Statement</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" name="filetype" id="check2" type="checkbox">
                                                <label class="custom-control-label" for="check2">General Ledger</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" name="filetype" id="check3" type="checkbox">
                                                <label class="custom-control-label" for="check3">Transaction Listings</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" name="filetype" id="check4" type="checkbox">
                                                <label class="custom-control-label" for="check4">Trial Balance</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" name="filetype" id="check5" type="checkbox" onchange="var input = document.getElementById('fileother'); input.disabled = (input.disabled === false ? true : false);">
                                                <label class="custom-control-label" for="check5">Others</label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" id="fileother" type="text" placeholder="Other File type" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div id='val_filetype'></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Reporting Frequency:</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="frequency" class="custom-control-input" id="monthly" type="radio" checked>
                                                <label class="custom-control-label" for="monthly">Monthly</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="frequency" class="custom-control-input" id="quarterly" type="radio">
                                                <label class="custom-control-label" for="quarterly">Quarterly</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='val_frequency'></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Website:</label>
                                    <input class="form-control" id="website" type="text" autocomplete="off">
                                    <div id='val_website'></div>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="entityLabel">Entity List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-5">
                                <input class="form-control" id="entity" type="text" placeholder="Input Entity Name" autocomplete="off">
                            </div>
                            <div class="col-5">
                                <select class="form-control" id="selectGroup"></select>
                            </div>
                            <div class="col-2 text-right">
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
        <div class="modal fade" id="modalGroup" tabindex="-1" role="dialog" aria-labelledby="groupLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="groupLabel">Group List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-9">
                                <input class="form-control" id="group" type="text" placeholder="Input Group Name" autocomplete="off">
                            </div>
                            <div class="col-3 text-right">
                                <button type="button" class="btn btn-outline-default" onclick="addGroup()">Add</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="table-responsive py-4"  id="div_group_table"></div>
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
    var type_bas;
    loadClient();
    function loadClient(){
        $("#div_client_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        $.post("select_client_list").done(function(data) {
            $("#div_client_table").html(data);
        });
    }
    function GetGroup(id,typebas){
        $("#selectGroup").prop('disabled', true);
        $('#selectGroup')
            .empty()
            .append('<option value="">LOADING...</option>');
        $.post("select_group", { clientid : id, typebas : typebas }, function(data) {
            $("#selectGroup").html(data);
            $("#selectGroup").prop('disabled', false);
        });
    }
    function viewEntity(id,typebas){
        GetGroup(id,typebas);
        if(typebas == 'Standalone BAS'){
            $("#selectGroup").hide();
        }else{
            $("#selectGroup").show();
        }
        $("#entity").val("");
        $("#div_entity_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        client_id = id;
        type_bas = typebas;
        var params;
        params = {
            clientid : id,
            typebas  : typebas,
        };
        $.post("select_entity_list", params).done(function(data) {
            $("#div_entity_table").html(data);
        });
    }
    function viewGroup(id){
        $("#group").val("");
        $("#div_group_table").html("<img src='<?php echo base_url(); ?>assets/img/brand/loading.gif'>");
        client_id = id;
        var params;
        params = {
            clientid : id,
        };
        $.post("select_group_list", params).done(function(data) {
            $("#div_group_table").html(data);
        });
    }
    function addEntity(){
        if ($("#entity").val() != ''){
            var params;
            params = {
                clientid    : client_id,
                entity      : $("#entity").val(),
                group       : $("#selectGroup").val(),
            };
            console.log(params);
            $.post("insert_entity",params).done(function(data) {
                viewEntity(client_id, type_bas);
                GetGroup(id,type_bas)
                $("#entity").val("");
            });
        }
    }
    function deleteEntity(id){
        var params;
        params = {
            entityid    : id,
        };
        $.post("delete_entity",params).done(function(data) {
            viewEntity(client_id);
        });
    }
    function updateEntity(id){
        var params;
        params = {
            entityid    : id,
            entityname  : $("#entity" + id).val(),
            groupid     : $("#selectGroup" + id).val(),
        };
        $.post("update_entity",params).done(function(data) {
            viewEntity(client_id, type_bas);
            //setOnView(id);
        });
    }
    function addGroup(){
        if ($("#group").val() != ''){
            var params;
            params = {
                clientid    : client_id,
                group       : $("#group").val(),
            };
            $.post("insert_group",params).done(function(data) {
                viewGroup(client_id);
                $("#group").val("");
            });
        }
    }
    function deleteGroup(id){
        var params;
        params = {
            groupid    : id,
        };
        $.post("delete_group",params).done(function(data) {
            viewGroup(client_id);
        });
    }
    function updateGroup(id){
        var params;
        params = {
            groupid    : id,
            groupname  : $("#group" + id).val(),
        };
        $.post("update_group",params).done(function(data) {
            viewGroup(client_id);
            //setOnView(id);
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
            var selectedtypebas;
            var selectedfiletype = "";
            var selectedfrequency;
            var params;
            var options = document.getElementsByName('typebas');
            for (var i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    selectedtypebas = document.querySelector('label[for="' + options[i].id + '"]').innerText;
                    break;
                }
            }
            options = document.getElementsByName('filetype');
            for (var i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    if(selectedfiletype == ""){
                        selectedfiletype = selectedfiletype + (i + 1);
                    }else{
                        selectedfiletype = selectedfiletype + "," + (i + 1);
                    }
                }
            }
            options = document.getElementsByName('frequency');
            for (var i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    selectedfrequency = document.querySelector('label[for="' + options[i].id + '"]').innerText;
                    break;
                }
            }
            params = {
                clientid    : client_id,
                clientname  : $("#clientname").val(),
                address     : $("#address").val(),
                industry    : $("#industry").val(),
                clientcode  : $("#clientcode").val(),
                abndetails  : $("#abndetails").val(),
                gstdetails  : $("#gstdetails").val(),
                website     : $("#website").val(),
                typebas     : selectedtypebas,
                filetype    : selectedfiletype,
                frequency   : selectedfrequency,
                otherreg    : $("#otherreg").val(),
                fileother   : $("#fileother").val(),
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
            $("#clientcode").val(client.clientcode);
            $("#abndetails").val(client.abndetails);
            $("#gstdetails").val(client.gstdetails);
            $("#website").val(client.website);
            $("#otherreg").val(client.otherreg);
            $("#fileother").val(client.fileother);
            var options = document.getElementsByName('typebas');
            for (var i = 0; i < options.length; i++) {
                if (client.typebas == document.querySelector('label[for="' + options[i].id + '"]').innerText){
                    document.getElementById(options[i].id).checked = true;
                    break;
                }
            }
            options = document.getElementsByName('filetype');
            for (var i = 0; i < options.length; i++) {
                if(client.filetype.includes(i + 1)){
                    document.getElementById(options[i].id).checked = true;
                    if(i == 4){
                        var input = document.getElementById('fileother');
                        input.disabled = false;
                    }
                }else{
                    document.getElementById(options[i].id).checked = false;
                }
            }

            options = document.getElementsByName('frequency');
            for (var i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    selectedfrequency = document.querySelector('label[for="' + options[i].id + '"]').innerText;
                    break;
                }
            }
        });
    }
    function GetGroupList(id, group){
        $("#selectGroup" + id).prop('disabled', true);
        $('#selectGroup' + id)
            .empty()
            .append('<option value="">LOADING...</option>');
        $.post("select_group", { clientid : client_id }, function(data) {
            //console.log(data);
            $("#selectGroup" + id).html(data);
            $("#selectGroup" + id).prop('disabled', false);
            if(group != ''){
                $("#selectGroup" + id + " option:contains(" + group + ")").prop("selected", true);
            }
        });
    }
    function setOnedit(id, name, group){
        $(".onview" + id).hide();
        $(".onedit" + id).show();
        $("#entity" + id).val(name);
        GetGroupList(id, group)
    }
    function setOnview(id){
        $(".onview" + id).show();
        $(".onedit" + id).hide();
    }
    function setOneditGroup(id, name){
        $(".onviewGroup" + id).hide();
        $(".oneditGroup" + id).show();
        $("#group" + id).val(name);
    }
    function setOnviewGroup(id){
        $(".onviewGroup" + id).show();
        $(".oneditGroup" + id).hide();
    }
    function clearClient(){
        $("#clientname").val("");
        $("#address").val("");
        $("#industry").val("");
        $("#clientcode").val("");
        $("#abndetails").val("");
        $("#gstdetails").val("");
        $("#website").val("");
        $("#otherreg").val("");
        $("#fileother").val("");
        document.getElementById('option1').checked = true;
        document.getElementById('monthly').checked = true;
        document.getElementById('check1').checked = false;
        document.getElementById('check2').checked = false;
        document.getElementById('check3').checked = false;
        document.getElementById('check4').checked = false;
        document.getElementById('check5').checked = false;
        var input = document.getElementById('fileother');
        input.disabled = true;
        $("#val_clientname").empty();
        $("#val_address").empty();
        $("#val_industry").empty();
    }
    function limitInput() {
      var input = document.getElementById("abndetails");
      var maxLength = input.getAttribute("maxlength");
      var currentLength = input.value.length;

      if (currentLength >= maxLength) {
        input.value = input.value.slice(0, maxLength);
      }
    }
    $("#abndetails").on("input", function() {
        var value = $(this).val();
        value = value.replace(/\D/g, ""); // Remove non-numeric characters
        value = value.slice(0, 2) + "-" + value.slice(2, 5) + "-" + value.slice(5, 8) + "-" + value.slice(8, 11); // Add hyphens
        value = value.slice(0, 14); // Limit length to 9 characters
        $(this).val(value);
    });
</script>
</html>