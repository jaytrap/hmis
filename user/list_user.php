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
$page_sub = "list_user";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limitless - List User</title>
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Management</span> - List User</h4>
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
                        <li class="active">List User</li>
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
                                <h6 class="panel-title">List User</h6>
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

                                            <div class="row" align="center">
                                                <div class="col-md-7">
                                                    <div class="form-group ">
                                                        <div class="col-sm-10 pull-right">
                                                            <select  name="usercat" id="usercat"  data-placeholder="FILTER BY USER CATEGORY" class="select-size-lg">
                                                                <option></option>
                                                                <?php $cat = new MySQL; $cat->MoveFirst(); $cat->Query("SELECT * FROM usr_cat ORDER BY cat_name ASC");
                                                                while(!$cat->EndOfSeek()){$row = $cat->Row(); ?>
                                                                    <option value="<?php echo $row->cat_id; ?>"><?php echo $row->cat_name ;?></option>
                                                                <?php }?>
                                                            </select>
                                                            <br><p id="uerror"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <button type="submit" class="btn btn-info pull-left" id="search">Search User</button>
                                                </div>
                                            </div>


                                            <input type="hidden" name="do" id="do" value="Userlist">
                                    </form>


                                    <div id="listarea" class="container-fluid">

                                    </div>

                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /latest posts -->

                    </div>
                <!-- /dashboard content -->
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
        $(function () {

            var $btns = $("#search");
            $btns.click(function (e) {

                e.preventDefault();

                $('#listarea').empty();
                $('#uerror').empty();

                var usr = $("#usercat").val();
                var action = $("#do").val();
                if(  usr === null){


                    $("#uerror").html('<p><small style="color:red;">select a user category.</small><p/>');
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                }

                if(usr.length != 0){

                    $("#wait").css("display","block");
                    $("#search").attr("disabled", "disabled");
                    var form  = $('#usform').serialize();
                    $.ajax({
                        type: "POST",
                        url: "../controller/userController.php",
                        data: {usercat:usr,do:action},
                        success: function(e) {
                            console.log(e);


                            if(e=="zero"){

                                $("#wait").css("display","none");

                                $("#listarea").html("<br><div align='center'><span class='alert alert-danger' style='text-align: center'> No results found for this search.</span></div>");
                                $("#listarea").hide().fadeIn(2000);
                                $("#search").removeAttr('disabled')

                            }else{

                                $("#wait").css("display","none");
                                $('#listarea').html(e);
                                $("#search").removeAttr('disabled');

                            }



                        }
                    });
                    return false;
                }

            });

        });

    </script>

</body>
</html>

