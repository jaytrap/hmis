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
$page_sub2 = "view_personal";
$id = '';
if(isset($_GET['id'])){
    $id = base64_decode($_GET['id']);
    $object->Query("Select * from staff where staff_id = $id");
    $rows = $object->Row();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HMIS - View PERSONNEL</title>

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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Personnel Management</span> - View Personnel</h4>
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
                        <li class="active">View Personnel</li>
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
                                <h6 class="panel-title">View Personnel</h6>
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
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <div class="col-sm-9">
                                                    <div class="col-md-9 col-xs-12">
                                                        <div class="img-thumbnail img-responsive pull-left" id="preveiwimg" >
                                                            <?php if(isset($rows->picture)){?>
                                                                <img src="<?php echo $rows->picture;?>" width="290" height="290" class="img-thumbnail" alt="" id="user_image" ><?php } else{?>
                                                                <img src="../dist/img/property_placeholder.jpg" width="290" height="290" class="img-thumbnail" alt="" id="user_image" >
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title" class="col-sm-3 control-label">Title</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->title;?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Surname</label>

                                                    <div class="col-sm-9">
                                                        <?php echo $rows->surname;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->firstname;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="othername" class="col-sm-3 control-label">Othername</label>

                                                    <div class="col-sm-9">
                                                        <?php echo $rows->othername;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Gender</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->gender;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">DoB</label>

                                                    <div class="date col-sm-9">
                                                        <?php echo $rows->dob;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nationality</label>
                                                    <div class="col-sm-9">
                                                        <?php echo  $rows->nationality;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Marital Status</label>
                                                    <div class="col-sm-9">
                                                        <?php echo  $rows->marital_status_id;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Contact Info</h3>
                                        </div>
                                        <br>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->personal_address;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">SSNIT</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->ssnit_num; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Mobile phone</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->contact_num?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.col -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Office</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->office_num ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="p-email" class="col-sm-3 control-label">Personal Email </label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->personal_email;?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="p-email" class="col-sm-3 control-label">Corporate email </label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->corporate_email;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>


                                        <br>
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Employee details</h3>
                                        </div>


                                        <br>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="employeeID" class="col-sm-3 control-label">Employee ID</label>

                                                    <div class="col-sm-9">
                                                        <?php echo $rows->employee_id;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Region</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->reg_id;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.col -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Staff Category</label>
                                                    <div class="col-sm-9">
                                                        <?php
                                                        $security->Query("Select cat_id, name From staff_category WHERE cat_id = $rows->staff_cat_id ORDER BY name ASC");
                                                        $row = $security->Row();
                                                        echo $row->name;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="MMDA" class="col-sm-3 control-label">Home Town</label>
                                                    <div class="col-sm-9">

                                                        <?php
                                                        $security->Query("Select id, name From mmda_type WHERE id = $rows->mmda_id ORDER BY name ASC");

                                                        $row = $security->Row();
                                                        echo $row->name;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="position" class="col-sm-3 control-label">Position</label>

                                                    <div class="col-sm-9">
                                                        <?php echo $rows->position; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Supervisor</label>
                                                    <div class="col-sm-9">
                                                        <?php
                                                        $security->Query("Select staff_id, firstname,surname,othername From staff where staff_id = $rows->supervisor_id ");

                                                        $row = $security->Row();
                                                        echo $row->firstname." ".$row->othername." ".$row->surname;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.col -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Department</label>
                                                    <div class="col-sm-9">
                                                        <?php
                                                        $security->Query("Select id, name From department where id = $rows->department ");
                                                        $row = $security->Row();
                                                        echo $row->name;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>  <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Branch</label>
                                                    <div class="col-sm-9">
                                                        <?php
                                                        $security->Query("Select id, branch_name From branches WHERE  id = $rows->branch");
                                                        $row = $security->Row();
                                                        echo $row->branch_name;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Status</label>

                                                    <div class="col-sm-9">
                                                        <?php echo $rows->status;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <br>
                                        <br>
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Next of Kin Details</h3>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->nkfirstname;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Last Name</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->nklastname;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Relationship</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->nk_relation?>
                                                    </div>
                                                </div>
                                            </div><div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"> Date of Birth</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->nkdob?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /.col -->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Mobile Number</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->nk_phone;?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /.col -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->nk_email;?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /.col -->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $rows->nk_address;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                        </div>
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


</body>
</html>

