<?php

/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 05/01/2018
 * Time: 09:29 AM
 */
require_once('mysql.class.php');
class User extends MySQL
{
    function __construct(){
        session_start();
        parent::__construct();
    }


    function updateUser($usercat,$username,$user_status,$usid){

        $valuesArray['user_cat'] = MySQL::SQLValue($usercat);
        $valuesArray['username'] = MySQL::SQLValue($username);
        $valuesArray['user_status'] = MySQL::SQLValue($user_status);

        $whereArray['user_id'] = $usid;
        $tableName = 'usr_users';

        $sql = MySQL::BuildSQLUpdate($tableName,$valuesArray,$whereArray);
        $result = $this->Query($sql);

        if($result){

            return "ok";

        }else{

            return "fail";
        }

    }



    function addUserCat($cname,$status){

        $this->Query("SELECT * FROM user_cat WHERE cat_name = '$cname'");
        $rec_count = $this->RowCount();

        if ($rec_count == 1) {

            return "exists";

        } else {
            $valuesArray['cat_name'] = MySQL::SQLValue($cname);
            $valuesArray['status'] = MySQL::SQLValue($status);

            $tableName = 'usr_cat';

            $sql = MySQL::BuildSQLInsert($tableName, $valuesArray);
            $result = $this->Query($sql);

            if ($result) {

                $this->Query("SELECT * FROM usr_cat");
                $uclist = "";
                $uclist .= " <table class='table table-striped table-hover table-email table-bordered' style='width: 400px;' align='center'>
                        <thead>
                        <tr>
                            <th><strong>Category Name</strong></th>
                            <th><strong>Status</strong></th>
                        </tr>
                        </thead>
                        <tbody>";
                while (!$this->EndOfSeek()) {
                    $row = $this->Row();
                    $uclist .= "<tr><td>" . $row->cat_name . "</td><td>".$row->status."</td></tr>";
                }
                $uclist .= "</tbody></table>";

                return $uclist;

            } else {

                return "error";
            }


        }

    }

    function addUser($fullname,$username,$password,$category){



        $name_sid = explode(':', $fullname);
        $login = trim($username);
        $password = sha1(trim($password));
        $usercat = $category;
        $status = 1;

        $sid = $name_sid[0];
        $name = $name_sid[1];

        $this->Query("SELECT * FROM usr_users WHERE username= '$login'");
        $check_result = $this->RowCount();

        if($check_result > 0){

            return "exists";

        }else{


            $valuesArray['username'] = MySQL::SQLValue($login);
            $valuesArray['password'] = MySQL::SQLValue($password);
            $valuesArray['user_cat'] = MySQL::SQLValue($usercat);
            $valuesArray['sid'] = MySQL::SQLValue($sid);
            $valuesArray['user_fullname'] = MySQL::SQLValue($name);
            $valuesArray['user_status'] = MySQL::SQLValue($status);
            $valuesArray['created_by'] = $_SESSION['HMIS_user']['sid'];

            $sql = MySQL::BuildSQLInsert("usr_users", $valuesArray);
            $result = $this->Query($sql);

            if($result){
                return "ok";

            }else{

                return "fail";

            }

        }




    }
    public function getStaffEmail($id_fullname){

            $name_sid = explode(':', $id_fullname);
        $gtemail = '';
            $sid = $name_sid[0];
            $name = $name_sid[1];
            $this->Query("SELECT corporate_email,personal_email FROM staff WHERE id = $sid");
            $row = $this->Row();
            if($row->corporate_email) {
                $gtemail = trim($row->corporate_email);
            }
            elseif($row->personal_email){
                $gtemail = trim($row->personal_email);
            }
            if($gtemail){

                echo $gtemail;exit;

            }else{


                echo "empty";exit;
            }

    }
    function findUser($uid){


            $sql = "SELECT * FROM usr_users WHERE user_cat = $uid";

            $this->Query($sql);
            $counting = $this->RowCount();


            if($counting == 0){

                return "zero";

            }

            if($counting > 0){

                $ulist = "";
                $ulist .= "<br/><hr/><table  id='example1' class='table table-bordered table-striped'><thead>
            <tr>
            <th>Fullname</th>
            <th>Email</th>
            <th>Creation Date</th>
            <th colspan='2'>&nbsp;</th>

            </tr>
            </thead><tbody>";
                while(!$this->EndOfSeek()){ $row = $this->Row();
                    $ulist .= "<tr><td>".$row->user_fullname."</td><td>".$row->username."</td><td>".$row->user_date.'</td><td><a href="#viewuserinfo" data-toggle="modal" id="userdetail" name='.$row->user_id.'>View</a></td><td><a href="edit_user.php?id='.base64_encode($row->user_id).'" data-toggle="modal" id="euserdetail" name='.$row->user_id.'>Edit</a></td>';

                }
                $ulist .="</tbody></table>";
                return $ulist;

            }else{

                return "zero";

            }




    }

    function fetchCatPrivs($cid){

        $sql = sprintf("SELECT usr_links.link_id, usr_links.page_id,usr_links.page_id_sub, usr_links.link_url, usr_links.link_name, usr_links.link_target, usr_links.link_image, usr_links.link_parent FROM usr_cat_links INNER JOIN usr_links ON usr_cat_links.link_id = usr_links.link_id WHERE usr_cat_links.cat_id = %s", MySQL::SQLValue($cid, MySQL::SQLVALUE_NUMBER));
        $links = $this->QueryArray($sql, MYSQLI_ASSOC);
        $child = array();

        if(!empty($links)){

            foreach($links as $row_links){

                if($row_links['link_parent'] > 0){

                    $child[] = $row_links;

                }
            }

        }


        $myprivssql = "SELECT link_id FROM usr_cat_links WHERE cat_id = $cid";

        $this->Query($myprivssql);

        $mylinks = array();

        while(!$this->EndOfSeek()){

            $num = $this->Row();
            $mylinks[] = $num->link_id;

        }


        $psql = sprintf("SELECT * FROM usr_links WHERE status = 'Active' ORDER BY disp_order");

        $all_links = $this->QueryArray($psql, MYSQLI_ASSOC);

        $main = array();
        $children = array();

        foreach($all_links as $r_links){

            if($r_links['link_parent']==0){
                $main[] = $r_links;
            }else{
                $children[] = $r_links;
            }
        }

        $privlist = "";

        $privlist .= "<table class='table table-responsive table-bordered'>";
        foreach($main as $mainlink){
            $privlist .= "<tr>
                <td colspan='2'><h5><strong>".$mainlink['link_name']."</strong></h5></td>
            </tr>";
            foreach($children as $subs){ if($mainlink['link_id']==$subs['link_parent']){

                $privlist .="<tr>
                    <td style=\"width: 60px;\"><input type=\"checkbox\" name=\"priv_check[]\" id=\"priv_check\" value=\"".$subs['link_id']."\" "; if(in_array($subs['link_id'],$mylinks)){ $privlist .="checked";}
                $privlist .="></td>
                    <td>". $subs['link_name']."</td>
                </tr>";
            }
            }
        }
        $privlist .="</table>";

        return $privlist;



    }

    function saveAssignedLinks($usercategory,$prev_check){

        if(isset($prev_check)){

            if(sizeof($prev_check)!=0) {

                if(isset($usercategory) && !empty($usercategory)) {

                    $this->Query("Select * from usr_cat_links WHERE cat_id = $usercategory");
                    if ($this->RowCount() > 0){
                        $del_result = $this->Query("DELETE FROM usr_cat_links WHERE cat_id = $usercategory");
                    if ($del_result) {

                        $wucl = "";

                        for ($r = 0; $r < sizeof($prev_check); $r++) {

                            $link_id = $prev_check[$r];

                            $valuesArray['link_id'] = MySQL::SQLValue($link_id);
                            $valuesArray['cat_id'] = MySQL::SQLValue($usercategory);

                            $sql = MySQL::BuildSQLInsert("usr_cat_links", $valuesArray);

                            if ($r == 0) {

                                $wucl = $sql;

                            } else {

                                $wucl .= ',' . substr($sql, 56);


                            }


                        }


                        $cresponse = $this->Query($wucl);


                        $this->Query("SELECT DISTINCT(usr_links.link_parent) FROM usr_links
                        JOIN usr_cat_links ON usr_links.link_id = usr_cat_links.link_id
                        WHERE usr_cat_links.cat_id = $usercategory");

                        $pwucl = "";
                        $pcnt = 0;

                        while (!$this->EndOfSeek()) {

                            $mprow = $this->Row();
                            $mpval = $mprow->link_parent;

                            $valuesArray['link_id'] = MySQL::SQLValue($mpval);
                            $valuesArray['cat_id'] = MySQL::SQLValue($usercategory);

                            $sql_parent = MySQL::BuildSQLInsert("usr_cat_links", $valuesArray);

                            if ($pcnt == 0) {

                                $pwucl = $sql_parent;
                                $pcnt++;

                            } else {

                                $pwucl .= ',' . substr($sql_parent, 56);
                                $pcnt++;


                            }

                        }
                        $presponse = $this->Query($pwucl);
                        if ($presponse == true && $cresponse == true) {

                            return "ok";

                        } else {

                            return "fail";

                        }


                    } else {

                        return "d_fail";

                    }
                }
                else{
                        print_r($prev_check);
                        $wucl = "";
                        for ($r = 0; $r < sizeof($prev_check); $r++) {

                            $link_id = $prev_check[$r];

                            $valuesArray['link_id'] = MySQL::SQLValue($link_id);
                            $valuesArray['cat_id'] = MySQL::SQLValue($usercategory);

                            $sql = MySQL::BuildSQLInsert("usr_cat_links", $valuesArray);
                            if ($r == 0) {

                                $wucl = $sql;

                            } else {

                                $wucl .= ',' . substr($sql, 56);


                            }


                        }

                        echo $wucl;
                        $cresponse = $this->Query($wucl);

                        print_r($cresponse);
                        $this->Query("SELECT DISTINCT(usr_links.link_parent) FROM usr_links
                        JOIN usr_cat_links ON usr_links.link_id = usr_cat_links.link_id
                        WHERE usr_cat_links.cat_id = $usercategory");

                        $pwucl = "";
                        $pcnt = 0;

                        while (!$this->EndOfSeek()) {

                            $mprow = $this->Row();
                            $mpval = $mprow->link_parent;

                            $valuesArray['link_id'] = MySQL::SQLValue($mpval);
                            $valuesArray['cat_id'] = MySQL::SQLValue($usercategory);

                            $sql_parent = MySQL::BuildSQLInsert("usr_cat_links", $valuesArray);

                            if ($pcnt == 0) {

                                $pwucl = $sql_parent;
                                $pcnt++;

                            } else {

                                $pwucl .= ',' . substr($sql_parent, 58);
                                $pcnt++;


                            }

                        }
                        //echo $pwucl;
                        $presponse = $this->Query($pwucl);
                        print_r($presponse);
                        if ($presponse == true && $cresponse == true) {

                            return "ok";

                        } else {

                            return "fail";

                        }
                    }


                }else{

                    return "unselected";
                }
            }else{

                return "unchecked";

            }

        }else{

            return "unchecked";

        }

    }
}