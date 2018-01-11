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
    <title>HMIS - ADD PERSONNEL</title>
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Personnel Management</span> - Add Personnel</h4>
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
                        <li class="active">Add Personnel</li>
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
                                            <div>
                                                <p align="center" style="display: none; color: limegreen;" id="wait"><img src="../dist/img/spinner-grey.gif" > Please wait....</p>
                                                <div id="response" align="center"></div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title" class="col-sm-3 control-label">Title</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="title" id="title">
                                                                <option value="Mr">Mr</option>
                                                                <option value="Mrs">Mrs</option>
                                                                <option value="Miss">Miss</option>
                                                                <option value="Dr">Dr</option>
                                                                <option value="Prof">Prof</option>
                                                                <option value="Rev">Rev</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Surname</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname">
                                                            <span id="surnameerror" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname">
                                                            <span id="firstnameerror" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="othername" class="col-sm-3 control-label">Othername</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="othername" id="othername" placeholder="Othername">

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->
                                            </div>

                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Gender</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="gender" id="gender">
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Date of Birth</label>

                                                        <div class="date col-sm-2">
                                                            <select class="form-control" name="day" id="day">

                                                                <?php for($i=1; $i<=31; $i++){?>
                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php }?>
                                                            </select>
                                                            <span id="dayerror" style="color: red"></span>
                                                            </select>
                                                        </div>

                                                        <div class="date col-sm-4">
                                                            <select class="form-control" name="month" id="month">

                                                                <?php for($m=1; $m<=12; $m++){ $month = date('M',mktime(0,0,0,$m))?>
                                                                    <option value="<?php echo $m; ?>" ><?php echo $month; ?></option>
                                                                <?php }?>
                                                            </select>
                                                            <span id="montherror" ></span>
                                                            </select>
                                                        </div>

                                                        <div class="date col-sm-3">
                                                            <select class="form-control" name="year" id="year">
                                                                <?php for($i=date('Y'); $i>=(date('Y')-100); $i--){?>
                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php }?>
                                                            </select>
                                                            <span id="yearerror" style="color: red"></span>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                            </div>

                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Nationality</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="nationality" id="nationality">
                                                                <?php $object->Query("Select * from nationalities ORDER  BY  nationality ASC");
                                                                while (!$object->EndOfSeek()){
                                                                    $row = $object->Row();
                                                                    ?>
                                                                    <option value="<?php echo $row->nationality?>"><?php echo $row->nationality?></option>
                                                                    <?php

                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Marital Status</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="marital_status" id="marital_status">

                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Divorced">Divorced</option>
                                                                <option value="Seperated">Seperated</option>
                                                                <option value="Widowed">Widowed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="HomeTown" class="col-sm-3 control-label">Home Town</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="hometown" id="hometown" placeholder="Home Town">
                                                            <span id="hometownerror"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Region</label>
                                                        <div class="col-sm-9">
                                                            <select name="region" id="region_id" class="form-control select1">
                                                                <option  value="">Select Region</option>
                                                                <?php
                                                                $object->Query("Select id, region_name From regions ORDER BY region_name ASC");
                                                                while (!$object->EndOfSeek()){
                                                                    $row = $object->Row();
                                                                    ?>
                                                                    <option value="<?php echo $row->region_name?>"><?php echo $row->region_name;?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id="regionerror" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <br>
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
                                                            <input type="text" class="form-control" name="employeeid" id="employeeid" placeholder="Employee  ID">
                                                            <span id="employeeiderror"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="position" class="col-sm-3 control-label">Position</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="position" id="position" placeholder="Position">
                                                            <span id="positionerror"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div><!-- /.col -->
                                            <br>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Staff Category</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="staff_cat_id" id="staff_cat_id">
                                                                <option value="Single">Select Category</option>
                                                                <option value="Married">Executive</option>
                                                                <option value="Divorced">Senior Manager</option>
                                                                <option value="Seperated">Manager</option>
                                                                <option value="Widowed">Officer</option>
                                                                <option value="Widowed">Field Agent</option>
                                                            </select>
                                                            <span id="staffcaterror" style="color: red"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Supervisor</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="supervisor_id" id="supervisor_id">
                                                                <?php
                                                                $object->Query("Select staff_id, firstname,surname,othername From staff where status = 'active' ORDER BY firstname ASC");
                                                                while (!$object->EndOfSeek()){
                                                                    $row = $object->Row();
                                                                    ?>
                                                                    <option value="<?php echo $row->staff_id?>"><?php echo $row->firstname." ".$row->othername." ".$row->surname;?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.col -->

                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Department</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="department" id="department">
                                                                <?php
                                                                $object->Query("Select id, name From bus_class where status = 'active' ORDER BY name ASC");
                                                                while (!$object->EndOfSeek()){
                                                                    $row = $object->Row();
                                                                    ?>
                                                                    <option value="<?php echo $row->id?>"><?php echo $row->name;?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Branch</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="branch" id="branch">
                                                                <?php
                                                                $object->Query("Select id, branch_name From branches  ORDER BY branch_name ASC");
                                                                while (!$object->EndOfSeek()){
                                                                    $row = $object->Row();
                                                                    ?>
                                                                    <option value="<?php echo $row->id?>"><?php echo $row->branch_name;?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   <br>



                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">SSNIT</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="ssnit_number" name="ssnit_number" placeholder="SSNIT number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Status</label>

                                                        <div class="col-sm-9">
                                                            <select class="form-control select2" name="status" id="status" style="width: 100px;">
                                                                <option value="Active">Active</option>
                                                                <option value="Inactive">Inactive</option>
                                                                <option value="Inactive">Suspended</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <br>
                                            <br>
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Contact Info</h3>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Mobile Phone</label>
                                                        <div class="col-sm-9">
                                                            <input type="tel" class="form-control" name="contact_number" id="mobile" placeholder="Personal Contact">
                                                            <span id="mobileerror"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.col -->

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Official Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control" name="office_number" id="office_number" placeholder="Office number">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <br>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="p-email" class="col-sm-3 control-label">Personal Email </label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Personal email">
                                                            <span id="emailerror"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="p-email" class="col-sm-3 control-label">Corporate email </label>
                                                        <div class="col-sm-9">
                                                            <input type="email" class="form-control"  name="corporate_email" id="corporate_email" placeholder="Corporate Email">
                                                            <span id="cemailerror"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Residential Address</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter Residential Address of Employee"></textarea>
                                                            <span id="addresserror"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="exampleInputFile"  class="col-sm-3 control-label">Picture</label>
                                                        <div class="col-sm-9">
                                                            <div class="col-md-9 col-xs-12">
                                                                <div class="img-thumbnail img-responsive pull-left" style="width: 290px; height: 220px;" id="preveiwimg" >
                                                                    <img src="../dist/img/property_placeholder.jpg" width="290" height="250" class="img-thumbnail" alt="" id="user_image" >
                                                                </div>
                                                                <span class="btn btn-success fileinput-button pull-right" style="margin-top:4%; ">
								<i class="fa fa-plus"></i>
								<span>
								Add Image... </span>
											<input type="file" name="file" id="file" accept="image/*" capture  style="width: 140px;" onchange="handleFiles(this.files)" >
											<p style="display: none; color: limegreen;" id="wait1"><img src="../dist/img/spinner-grey.gif" > Please wait....</p>
											</span>
                                                                <span id="pictureerror"></span>
                                                            </div>

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
                                                            <input type="text" class="form-control" name="nkfirstname" id="nkfirstname" placeholder="Next of Kin's Fristname">
                                                            <span id="nkfirstnameerror" style="color: red;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Last Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nklastname" id="nklastname" placeholder="Next of Kin's Lastname">
                                                            <span id="nklastnameerror" style="color: red;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Relationship</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="relationship" id="relationship" placeholder="Relationship">
                                                            <span id="relationshiperror"></span>
                                                        </div>
                                                    </div>
                                                </div><div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"> Date of Birth</label>
                                                        <div class="col-sm-9">
                                                            <div class="date col-sm-3">
                                                                <select class="form-control" name="r_day" id="r_day">

                                                                    <?php for($i=1; $i<=31; $i++){?>
                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                    <?php }?>
                                                                </select>
                                                                <span id="rdayerror" style="color: red"></span>
                                                                </select>
                                                            </div>

                                                            <div class="date col-sm-4">
                                                                <select class="form-control" name="r_month" id="r_month">

                                                                    <?php for($m=1; $m<=12; $m++){ $month = date('M',mktime(0,0,0,$m))?>
                                                                        <option value="<?php echo $m; ?>" ><?php echo $month; ?></option>
                                                                    <?php }?>
                                                                </select>
                                                                <span id="rmontherror" ></span>
                                                                </select>
                                                            </div>

                                                            <div class="date col-sm-4">
                                                                <select class="form-control" name="r_year" id="r_year">

                                                                    <?php for($i=date('Y'); $i>=(date('Y')-100); $i--){?>
                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                    <?php }?>
                                                                </select>
                                                                <span id="ryearerror" style="color: red"></span>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Mobile Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nk_mobile" id="nk_mobile" placeholder="Mobile Number">
                                                            <span id="nkmobileerror" ></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nk_email" id="nk_email">
                                                            <span id=""></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- /.col -->
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Residential Address</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" name="nk_address" id="nk_address" rows="3" placeholder="Enter Residential Address of Next of Kin"></textarea>
                                                            <span id="nk_addrerror"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-default">Cancel</button>
                                                <button type="submit" id="add" class="btn btn-info pull-right">Add</button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="picture" name="picture">
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

