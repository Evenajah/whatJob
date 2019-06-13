<?php
function timestamp($dateTime){

//set time zone
    date_default_timezone_set('Asia/Bangkok');
    $datetime_compare = "$dateTime";
    $ts = strtotime($datetime_compare);
    $now = strtotime('now');
    if(!$ts || $ts > $now){exit;}

    $diff = $now - $ts;

    $second = 1;
    $minute = 60 * $second;
    $hour = 60 * $minute;
    $day = 24*$hour;
    $yesterday = 48 * $hour;
    $month = 30 * $day;
    $year = 365*$day;
    $ago ="";

//หาค่าวันเวลา
    if($diff >= $year){
        $ago = round($diff/$year)." year ago";
    }
    else if($diff >= $month){
        $ago = round($diff/$month)." month ago";
    }
    else if($diff > $yesterday){
        $ago = intval($diff/$day)."ํ days ago";
    }
    else if($diff <= $yesterday && $diff > $day){
        $ago = "Yesterday";
    }
    else if($diff >= $hour){
        $ago = intval($diff/$hour)." hours ago";
    }
    else if($diff >= $minute){
        $ago = intval($diff/$minute)." minute ago";
    }
    else if($diff >= 5*$second){
        $ago = intval($diff/$second)." second ago";
    }
    else{
        $ago = "a moment";
    }
    return $ago;
}