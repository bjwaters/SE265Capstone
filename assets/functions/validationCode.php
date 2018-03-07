<?php

//This function validates the profile form
function validateProfile(){
    $isValid = true;
    $errors = "";

    //Check if pay is a numeric value
    $pay = $_POST['pay'];
    if(!is_numeric($pay)){
        $isValid = false;
        $errors .= "Please enter pay rate as a numeric value." . PHP_EOL;
    }

    //Check for valid youtube url
    $videoLink = $_POST['videoLink'];
    $checkVideoLink = preg_match('/(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/', $videoLink);
    if ($checkVideoLink == 0) {
        $isValid = false;
        $errors .= "Please enter a valid youtube url. \n";
    }

    if(!$isValid){
        echo $errors;
    }

    return $isValid;

}

function validateEmail($email){
    $isValid = true;

    //Check for valid email format
    echo $email;
    $check = preg_match('/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/', $email);
    if ($check == 0) {
        $isValid = false;
    }

    return $isValid;

}
