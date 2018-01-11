<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 05/01/2018
 * Time: 09:29 AM
 */
require_once('../classes/user.class.php');
$object  = new User();
if(isset($_POST['do']) && $_POST['do']=="createUser") {
echo $object->addUser($_POST['fullname'],$_POST['username'],$_POST['password'],$_POST['category']);exit;
}
if(!empty($_POST['eid'])) {
    echo $object->getStaffEmail($_POST['eid']);exit;
}
if(isset($_POST['usercat']) && isset($_POST['do']) && $_POST['do']=="Userlist"){
    echo $object->findUser($_POST['usercat']);exit;
}
if(isset($_POST['do']) && $_POST['do']=="updateUser" && isset($_POST['uid'])){
    echo $object->updateUser($_POST['user_cat'],$_POST['username'],$_POST['user_status'],$_POST['uid']);exit;
}
if(isset($_POST['do']) && $_POST['do']=="CreateUserCat" && isset($_POST['cat_name'])){

    echo $object->addUserCat( $_POST['cat_name'],$_POST['status']);exit;
}
if(isset($_POST['category_id']) && !empty($_POST['category_id']) && !isset($_POST['do'])){
    echo $object->fetchCatPrivs($_POST['category_id']);exit;
}
if(isset($_POST['do']) && $_POST['do']=="assignPrivs" && isset($_POST['user_cat']) ){
    if(isset($_POST['priv_check'])) {
        echo $object->saveAssignedLinks($_POST['user_cat'], $_POST['priv_check']);
        exit;
    }else{
        echo "unchecked";exit;
    }

}
