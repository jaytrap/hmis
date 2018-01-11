<?php

/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 05/01/2018
 * Time: 01:56 AM
 */
class Util
{

   public function getTime(){
       $period = '';
       date_default_timezone_set('UTC');
       if(date("h:i:sa") < "12:00:00pm"){
           $period = "Morning";
       }
       elseif (date("h:i:sa") < "16:00:00pm") {
           $period = "Afternoon";
       }
       elseif (date("h:i:sa") < "19:00:00pm"){
           $period = "Evening";
       }elseif (date("h:i:sa") < "00:00:00am"){
           $period = "Night";
       }
       return $period;
   }
}