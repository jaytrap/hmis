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
$page_sub="assign_privis";
$alluserlinks = new MySQL();

$psql = sprintf("SELECT * FROM usr_links WHERE status = 'Active' ORDER BY disp_order");

$all_links = $alluserlinks->QueryArray($psql, MYSQLI_ASSOC);

$main = array();
$children = array();
if(!empty($all_links)) {
    foreach ($all_links as $r_links) {
        if ($r_links['link_parent'] == 0) {
            $main[] = $r_links;
        } else {
            $children[] = $r_links;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HMIS -  Assign Privilege</title>
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Management</span> - Assign Privilege</h4>
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
                        <li class="active">Assign Privilege</li>
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
                                <h6 class="panel-title">Assign Privilege</h6>
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
                                    <div>
                                        <p align="center" style="display: none; color: limegreen;" id="wait"><i class="fa fa-spinner fa-spin"></i> saving privileges. Please wait....</p>
                                        <p align="center" style="display: none; color: limegreen;" id="wait_fetch"><i class="fa fa-spinner fa-spin"></i> Fetching privileges for selected category. Please wait....</p>
                                    </div>
                                    <div>

                                        <form method="POST" class="new_user_form" action="" id="laform">
                                            <table class="table table-responsive table-email table-bordered" align="center">
                                                <tr>
                                                    <td colspan="4"><p id="confirmation" style="text-align:center"></p></td>
                                                </tr>


                                                <tr>
                                                    <td><label>Category:</label></td>
                                                    <td><select name="user_cat" id="user_cat" style=" height:30px" class="select-size-lg" data-placeholder="SELECT CATEGORY...">
                                                            <option disabled selected></option>
                                                            <?php $cat = new MySQL; $cat->Query("SELECT * FROM usr_cat ORDER BY cat_name ASC");
                                                            while(!$cat->EndOfSeek()){$crow = $cat->Row(); ?>
                                                                <option value="<?php echo $crow->cat_id; ?>">
                                                                    <?php echo $crow->cat_name; ?>
                                                                </option>
                                                            <?php }?>
                                                        </select>
                                                    </td>
                                                    <td><div><input type="submit" id="assign" class="btn btn-primary rounded-4" value="Assign Privileges"></div></td>
                                                </tr>
                                            </table>
                                            <div id="listarea">
                                                <table class="table table-responsive table-bordered">
                                                    <?php foreach($main as $mainlink){ ?>
                                                        <tr>
                                                            <td colspan="2"><h5><strong><?php echo $mainlink['link_name']; ?></strong></h5></td>
                                                        </tr>
                                                        <?php foreach($children as $subs){ if($mainlink['link_id']==$subs['link_parent']){ ?>
                                                            <tr>
                                                                <td style="width: 60px;"><input type="checkbox" name="priv_check[]" id="priv_check" value="<?php echo $subs['link_id'];?>"></td>
                                                                <td><?php echo $subs['link_name'];?></td>
                                                            </tr>
                                                        <?php }} ?>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                            <input type="hidden" name="do" value="assignPrivs">
                                        </form>
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
        $(document).on("change","#user_cat",function(){
            var dropvalue = $("#user_cat").val();

            $("#wait_fetch").css("display", "block");

            $.ajax({
                type: "POST",
                url: "../controller/userController.php",
                data: {category_id : dropvalue
                },
                success:function(data) {


                    $('#listarea').html(data);
                    $("#assign").removeAttr('disabled');
                    $("#wait_fetch").css("display","none");


                }

            });
        });



        $("document").ready(function(){

            $("#assign").attr("disabled", true)

        });

        $(function () {

            var $btns = $("#assign");
            $btns.click(function (e) {
                e.preventDefault();

                $("#wait").css("display","block");
                $("#assign").attr("disabled", "disabled");

                $.ajax({
                    type: "POST",
                    url: "../controller/userController.php",
                    data: $('#laform').serialize(),
                    success: function(e) {


                        if(e=="d_fail"){
                            $("#wait").css("display","none");
                            $("#assign").removeAttr('disabled');


                            $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> User privilege assignment failed</span></div>");
                            $("#confirmation").hide().fadeIn(2000).fadeOut(4000);

                        }else if(e=="ok"){

                            $("#wait").css("display","none");
                            $("#assign").removeAttr('disabled');


                            $('#confirmation').html("<div align='center'><span class='alert alert-success'><i class='icon icon-ok-sign'></i> User privileges were assigned successfully</span></div>");
                            $("#confirmation").hide().fadeIn(2000).fadeOut(4000);

                        }else if(e=="unchecked"){

                            $("#wait").css("display","none");
                            $("#assign").removeAttr('disabled');


                            $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> Privilege assignment failed. No option was checked before assigning privileges</span></div>");
                            $("#confirmation").hide().fadeIn(2000);

                        }else if(e=="unselected"){

                            $("#wait").css("display","none");
                            $("#assign").removeAttr('disabled');


                            $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i>Privilege assignment failed. No user category was selected</span></div>");
                            $("#confirmation").hide().fadeIn(2000);

                        }


                    }
                });
                return false;

            });

        });
    </script>

</body>
</html>

