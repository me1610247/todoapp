<?php

function sanitizeInput($input){
    return htmlentities((trim(stripcslashes($input))));
}
function requiredVal($input){
    if(empty($input)){
        return false;
    }
    return true;
}
function validMail($input){
    if(filter_var($input,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}
function minValue($input,$length){
    if(strlen($input)<$length){
        return false;
    }
    return true;
}
function maxValue($input,$length){
    if(strlen($input)>$length){
        return false;
    }
    return true;
}
