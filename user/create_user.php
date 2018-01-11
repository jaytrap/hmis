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
$page = "user";
$page_sub = "create_user";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limitless - Create User</title>
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Management</span> - Create User</h4>
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
                        <li><a href="#"><i class="icon-user position-left"></i> User Management</a></li>
                        <li class="active">Create User</li>
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
                                <h6 class="panel-title">Create User</h6>
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
                                    <form id="form" method="post">
                                        <div class="box-body">

                                            <div align="center"><img src="../dist/img/spinner-grey.gif" alt="loading" id="wait" style="display: none; margin-top: -8px;"></div>
                                            <p id="ack" class="login-box-msg"></p>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 control-label">Name</label>

                                                        <div class="col-sm-10">
                                                            <select name="fullname" id="fullname"  data-placeholder="Select Staff..." class="select-size-lg">
                                                                <option></option>                                                                <?php $uname = new MySQL;  $uname->Query("SELECT * FROM staff ORDER BY firstname ASC");
                                                                while(!$uname->EndOfSeek()){$urow = $uname->Row(); ?>
                                                                    <option value="<?php echo $urow->id .":".$urow->surname.' '.$urow->firstname; ?>">
                                                                        <?php echo "$urow->firstname $urow->surname";?>
                                                                    </option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.col -->

                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description" class="col-sm-2 control-label">category</label>
                                                        <div class="col-sm-10">
                                                            <select name="category" id="category"  data-placeholder="Select Staff Category..." class="select-size-lg">
                                                                <option></option>
                                                                <?php $cat = new MySQL; $cat->MoveFirst(); $cat->Query("SELECT * FROM usr_cat ORDER BY cat_name ASC");
                                                                while(!$cat->EndOfSeek()){$row = $cat->Row(); ?>
                                                                    <option value="<?php echo $row->cat_id; ?>"><?php echo $row->cat_name ;?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">username</label>
                                                        <div class="col-sm-10">
                                                            <input  name="username" id="username" type="text" class="form-control" required readonly>
                                                            <span id="unerror" style="color: red;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">password</label>
                                                        <div class="col-sm-10">
                                                            <input name="password" id="password" type="password" class="form-control" required>
                                                            <span id="pwerror" style="color: red;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="box-footer " align="center">
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-info " id="add">Add User</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="do" value="createUser"/>
                                    </form>
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
        $(document).on('click','#add',function(e){
            e.preventDefault();
            var uname = $.trim($("#username").val());
            var pass = $.trim($("#password").val());
            if(uname.length == 0){

                $("#unerror").html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
                $("html, body").animate({ scrollTop: 0 }, "slow");

            }

            if(pass.length == 0){

                $("#pwerror").html('<p><small style="color:red;">field cannot be left empty.</small><p/>');
                $("html, body").animate({ scrollTop: 0 }, "slow");

            }

            if(uname.length != 0 && pass.length != 0) {

                $("#wait").css("display", "block");
                $("#add").attr("disabled", "disabled");
                $.ajax({
                    type: "POST",
                    url: "../controller/userController.php",
                    data: $("#form").serialize(),
                    success: function (e) {
                        console.log(e);

                        if (e == "fail") {
                            $("#wait").css("display", "none");
                            $("#add").removeAttr('disabled');

                            $('#username').val("");
                            $('#password').val("");

                            $('#ack').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> User Creation Failed</span></div>")
                            $("#ack").hide().fadeIn(2000).fadeOut(4000);

                        } else if (e == "ok") {

                            $("#wait").css("display", "none");
                            $("#add").removeAttr('disabled');

                            $('#username').val("");
                            $('#password').val("");
                            $('#ack').html("<div align='center'><span class='alert alert-success'><i class='icon icon-ok-sign'></i> User Created successfully</span></div>")
                            $("#ack").hide().fadeIn(2000).fadeOut(4000);

                        } else if (e == "incomplete") {

                            $("#wait").css("display", "none");
                            $("#add").removeAttr('disabled');

                            $('#username').val("");
                            $('#password').val("");
                            $('#ack').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> Complete all fields before submitting</span></div>");
                            $("#confirmation").hide().fadeIn(2000);

                        } else if (e == "exists") {

                            $("#wait").css("display", "none");
                            $("#add").removeAttr('disabled');

                            $('#username').val("");
                            $('#password').val("");
                            $('#ack').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> User already exists in the system</span></div>")
                            $("#confirmation").hide().fadeIn(2000);

                        }


                    }
                });
                return false;
            }

        });
        $(document).on("change","#fullname",function(){

            $("#eerror").empty();
            $("#email_wait").css("display", "block");
            var dropvalue = $("#fullname").prop("value");

            $.ajax({
                type: "POST",
                url: "../controller/userController.php",
                data: {eid : dropvalue},
                success:function(email) {

                    var fetched = email;

                    if(fetched == "empty") {

                        $("#eerror").html('<p><small style="color:red;">This staff has no email in the system</small><p/>');
                        $("#email_wait").css("display", "none");

                    }else{

                        $("#username").val(email);
                        $("#email_wait").css("display", "none");
                        $("#create").removeAttr('disabled');

                    }

                }

            });
        });
    </script>

</body>
</html>

