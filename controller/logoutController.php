<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 04/01/2018
 * Time: 11:01 PM
 */
require_once('../classes/auth.class.php');
$logout = new Auth();
header($logout->userLogout());