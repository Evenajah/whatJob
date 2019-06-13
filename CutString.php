<?php
function CutString($str,$start,$cut){                  
    if(strlen($str) > $cut){ //หาความยาวสตริง
        $CutString = substr($str,$start,$cut); //กำหนดขนาดสตริง
        $CutString .= "....";  
        return $CutString;
    }else{
        $CutString = $str;
        return $CutString;
    }
}   