<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 04/01/2018
 * Time: 10:39 PM
 */
require_once('../classes/auth.class.php');


/*
* Login Controller
*


if(isset($_POST['username']) && isset($_POST['password'])  && isset($_POST['action']) && ($_POST['action']==='login')){
*/
$newUser = new Auth();
if(!isset($_POST['username']) && !isset($_POST['password'])){

    header('Location:../index.php');

}


if(empty($_POST)=== false){



    $username = $_POST['username'];
    $password = $_POST['password'];




    if(empty($username)=== true || empty($password)=== true){

        $emptyUserPass = "enter username or password";
        $newUser->getError($emptyUserPass);


    }elseif($newUser->user_exists($username)=== false){

        $noUser = "Username Does not Exist";
        $newUser->getError($noUser);


    }elseif($newUser->user_active($username)=== false){

        $notAcive = "Your Account is Inactive. Please Contact Administrator";
        $newUser->getError($notAcive);


    }else{

        $login = $newUser->login($username,$password);

        if(strlen($password )> 30){

            $passlen = "Password too long";
            $newUser->getError($passlen);

        }

        if($login=== false){

            $combination = "This Username and Password combination is incorrect";
            $newUser->getError($combination);

        }else{

            $sess_row = $newUser->getRecord($username);

            $_SESSION['HMIS_username'] = $sess_row['user_fullname'];
            $_SESSION['HMIS_UserGroup'] = $sess_row['user_cat'];
            $_SESSION['HMIS_user'] = $sess_row;


            $logintime = date("Y-m-d H:i:s");
            $stampid = $_SESSION['HMIS_user']['user_id'];

            $userid = $_SESSION['HMIS_user']['user_id'];
            $ipaddress = "";
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            $login_date =  date("Y-m-d h:i:s");
            $date = date("Y-m-d");
            $valuesArray['user_id'] = MySQL::SQLValue($userid);
            $valuesArray['login_ip'] = MySQL::SQLValue($ipaddress);
            $valuesArray['login_date']= MySQL::SQLValue($login_date);
            $valuesArray['date'] = MySQL::SQLValue($date);
            $table = "usr_user_log";

            $sql = MySQL::BuildSQLInsert($table,$valuesArray);
            $newUser->Query($sql);
            $last_id = $newUser->GetLastInsertID();
            $_SESSION['HMIS_login'] =  $last_id;

            echo "ok";exit;


        }
    }


    echo $newUser->DisplayError();

}
//}


?>