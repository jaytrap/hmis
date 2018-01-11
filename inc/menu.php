<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 04/01/2018
 * Time: 04:25 PM
 */

if (isset($_SESSION['HMIS_UserGroup'])) {
    $colname_links = $_SESSION['HMIS_UserGroup'];
}
$menu = new MySQL();
$sql = sprintf("SELECT usr_links.link_id, usr_links.page_id,usr_links.page_id_sub, usr_links.link_url, usr_links.link_name, usr_links.link_target, usr_links.link_image, usr_links.link_parent FROM usr_cat_links INNER JOIN usr_links ON usr_cat_links.link_id = usr_links.link_id WHERE usr_cat_links.cat_id = %s ORDER BY usr_links.disp_order ASC", MySQL::SQLValue($colname_links, MySQL::SQLVALUE_NUMBER));
$links = $menu->QueryArray($sql, MYSQLI_ASSOC);
$menu_count = $menu->RowCount();
if($menu_count > 0) {
    $parents = array();
    $child = array();

    foreach ($links as $row_links) {
        if ($row_links['link_parent'] == 0) {
            $parents[] = $row_links;
        } else {
            $child[] = $row_links;
        }
    }

}

?>
<div class="sidebar sidebar-main sidebar-default">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#"><img src="../assets/images/placeholder.jpg" class="img-circle img-responsive" alt=""></a>
                    <h6><?php  echo $_SESSION['HMIS_username'];?></h6>
                    <!--<span class="text-size-small">Santa Ana, CA</span>-->
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                </div>
            </div>

            <div class="navigation-wrapper collapse" id="user-nav">
                <ul class="navigation">
                    <li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
                    <li><a href="../controller/logoutController.php"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="<?php if($page == "home"){echo "active";}?>"><a href="../inc/dashboard.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <?php
                    if($menu_count > 0){?>

                        <?php foreach($parents as $parent){ ?>

                            <li class="treeview <?php if($page==$parent['page_id']){echo "active";}?>" >
                                <a href="#" class="<?php if($page==$parent['page_id']){echo "has-ul legitRipple";}?>">
                                    <i class="<?php echo $parent['link_image'] ?>"></i><span> <?php echo $parent['link_name']; ?></span>
                                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php foreach($child as $sub){ if($parent['link_id']==$sub['link_parent']){ ?>
                                        <li class="treeview <?php if(isset($page_sub) && $page_sub==$sub['page_id_sub']){echo "active";}?>">
                                            <a href="<?php echo $sub['link_url'] ?>"><i style="color: #f39c12;" class="<?php echo $sub['link_image'] ?>"></i><?php echo $sub['link_name']; ?></a></li>
                                    <?php }}?>
                                </ul>
                            </li>
                        <?php }}?>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
