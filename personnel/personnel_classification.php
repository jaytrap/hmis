<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 04/01/2018
 * Time: 04:25 PM
 */
session_start();
require_once('../classes/mysql.class.php');
require_once('../classes/util.class.php');
$object = new MySQL();
$util = new Util();
$object->checkLogin();
$page = "hrm";
$page_sub = "personnel";
$page_sub2 = "personnel_Classification";
$object->Query("Select * from staff where status = 'Active'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HMIS - PERSONNEL Classification</title>

</head>
<!-- Global stylesheets -->
<?php require'../inc/header.php';?>
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <?php require'../inc/menu.php';?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Personnel Management</span> -  Personnel Classification</h4>
                    </div>

                    <div class="heading-elements">
                        <div class="heading-btn-group">
                            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                            <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                        </div>
                    </div>
                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="icon-user position-left"></i> Personnel Management</a></li>
                        <li class="active">Personnel Classification</li>
                    </ul>

                    <ul class="breadcrumb-elements">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-gear position-left"></i>
                                Settings
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                                <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <!-- Dashboard content -->
                <div class="row">
                    <div class="col-lg-12">


                        <!-- Latest posts -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Personnel Classification</h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                             <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">Add Personnel Classification</button>
                                            <br/><br/><br/><br/>

                                            <div class="modal fade" id="modal-default">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Add Personnel Classification</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="description" class="col-sm-2 control-label">Description</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea rows="3" class="form-control" name="description" id="description" placeholder="Description"></textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div>

                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Tax</td>
                                                    <td>Pay your tax</td>

                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-success">Edit</button>
                                                        <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                                    </td>

                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /latest posts -->

                    </div>
                <!-- /dashboard content -->
                </div>
            </div>

                <!-- Footer -->

                <?php require'../inc/footer.php';?>

                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
    <script>
        $(document).on("click","#add",function (e) {
            e.preventDefault();
            $("#firstnameerror").empty();
            $("#surnameerror").empty();
            $("#hometownerror").empty();
            $("#regionerror").empty();
            $("#positionerror").empty();
            $("#emailerror").empty();
            $("#employeeiderror").empty();
            $("#idnoerror").empty();
            $("#idtypeerror").empty();
            $("#mobileerror").empty();
            $("#addresserror").empty();
            $("#residentialaddresserror").empty();
            $("#nkfirstnameerror").empty();
            $("#nklastnameerror").empty();
            $("#nkmobileerror").empty();
            $("#nkemailerror").empty();
            $("#relationshiperror").empty();
            $("#pictureerror").empty();
            $("#nk_addresserror").empty();
            var employeeid = $.trim($("#employeeid").val());
            var nkaddress = $.trim($("#nk_address").val())
            var position = $.trim($("#position").val());
            var relationship = $.trim($("#relationship").val());
            var email = $.trim($("#email").val());
            var occupation = $.trim($("#occupation").val());
            var region = $.trim($("#region_id").val());
            var hometown = $.trim($("#hometown").val());
            var town = $.trim($("#town_id").val());
            var sur_name = $.trim($("#surname").val());
            var firstname = $.trim($("#firstname").val());
            var idno = $.trim($("#id_no").val());
            var id_type = $.trim($("#id_type").val());
            var mob = $.trim($("#mobile").val());
            var nkfirstname = $.trim($("#nkfirstname").val());
            var nklastname = $.trim($("#nklastname").val());
            var nkmobile = $.trim($("#nk_mobile").val());
            var nkemail = $.trim($("#nk_email").val());
            var residential_address = $.trim($("#residential_address").val());
            var address = $.trim($("#address").val());
            var file = $.trim($("#file").val());
            if (relationship.length == 0) {
                $("#relationshiperror").html('<p><small style="color:red;">field cannot be left empty</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            } if (nkaddress.length == 0) {
                $("#nk_addresserror").html('<p><small style="color:red;">field cannot be left empty</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            } if (employeeid.length == 0) {
                $("#employeeiderror").html('<p><small style="color:red;">field cannot be left empty</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }if (position.length == 0) {
                $("#positionerror").html('<p><small style="color:red;">field cannot be left empty</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }if (nkfirstname.length == 0) {

                $("#nkfirstnameerror").html('<p><small style="color:red;">field cannot be left empty</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }
            if (nklastname.length == 0) {
                $("#nklastnameerror").html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            } if (sur_name.length == 0) {

                $("#surnameerror").html('<p><small style="color:red;">field cannot be left empty</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }
            if (region.length == 0) {

                $("#regionerror").html('<p><small style="color:red;">select option.</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }
            if (validateEmail(email) === false) {

                $("#emailerror").html('<p><small style="color:red;">Please enter a valid email.</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }if (validateEmail(nkemail) === false) {

                $("#nkemailerror").html('<p><small style="color:red;">Please enter a valid email.</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }
            if (firstname.length == 0) {
                alert("hi5");
                $("#firstnameerror").html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }
            if (mob.length == 0) {

                $("#mobileerror").html('<p><small style="color:red;">field cannot be left empty..</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }  if (nkmobile.length == 0) {

                $("#nkmobileerror").html('<p><small style="color:red;">field cannot be left empty..</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            } if (address.length == 0) {

                $("#addresserror").html('<p><small style="color:red;">field cannot be left empty..</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");

            }
            if(file.length == 0) {
                $("#pictureerror").html('<p><small style="color:red;">please upload an image.</small><p/>');
                $("html, body").animate({scrollTop: 0}, "slow");
            }
            else if (firstname.length != 0 && sur_name.length != 0 && region.length != 0  && email.length != 0 && mob.length != 0 && nkfirstname.length != 0) {
                var image = '';

                var formData = new FormData();
                formData.append('file', $('#file')[0].files[0]);
                formData.append('name',$('#surname').val());
                formData.append('mobile',$('#mobile').val());
                $.ajax({
                    url: 'img_uploader.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data) {
                        if (data == "error1") {
                            $("#response").html('<p class="alert alert-danger" align="center"> Sorry the image your trying to upload already exist.</p>');
                            $("#wait").css("display", "none");
                            $('#add').removeAttr("disabled", "disabled");
                            $("html, body").animate({scrollTop:0},"slow");
                        }
                        else if (data == "error2") {
                            $("#wait").css("display", "none");
                            $('#add').removeAttr("disabled", "disabled");
                            $('#response').html('<p class="alert alert-danger"> Sorry the image your trying to upload already exist.</p>')
                        }
                        else if (data == "error3") {
                            $("#response").html('<p class="alert alert-danger" align="center"> Invalid file Size or Type</p>');
                            $("#wait").css("display", "none");
                            $('#add').removeAttr("disabled", "disabled");
                            $("html, body").animate({scrollTop:0},"slow");
                        }
                        else if (data == "error4") {
                            $("#response").html('<p class="alert alert-danger" align="center"> Sorry no file was uploadedss.</p>');
                            $("#wait").css("display", "none");
                            $('#add').removeAttr("disabled", "disabled");
                            $("html, body").animate({scrollTop:0},"slow");
                        }
                        else {
                            image = data;
                            $('#picture').val(data);
                            $("#add").attr("disabled","disabled");
                            $("#wait").css("display","block");
                            var form = $("#form").serialize();
                            $.ajax({
                                type:"POST",
                                url:"process_staff.php",
                                data:form,
                                success:function(data){
                                    console.log(data);
                                    $("#add").removeAttr("disabled","disabled");
                                    $("#wait").css("display","none");
                                    if(data === "success"){
                                        $("#response").html('<p class="alert alert-success" align="center"> Staff record created successfully.</p>');
                                        $("form")[0].reset();
                                        $("html, body").animate({scrollTop:0},"slow");
                                    }
                                    else if(data  === "error"){
                                        $("#response").html('<p class="alert alert-danger" align="center"> Sorry something went wrong,Please make sure all fields are completed properly</p>');
                                        $("html, body").animate({scrollTop:0},"slow");
                                    }
                                }
                            })
                        }
                    }
                });
            }
        });

        function validateEmail(sEmail) {
            var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            if (filter.test(sEmail)) {
                return true;
            }
            else {
                return false;
            }
        }
    </script>

</body>
</html>

