<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 2/23/2018
 * Time: 7:44 PM
 */

if(!isset($_SESSION)) {
    session_start();
}

require_once("assets/functions/dbconnect.php");
require_once("assets/functions/loginSignupCode.php");
require_once("assets/functions/searchCode.php");
require_once("assets/functions/profileCode.php");
require_once("assets/functions/reportCode.php");
require_once("assets/functions/homepageCode.php");

$db = dbConnect();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$profileID = filter_input(INPUT_POST, 'profileID', FILTER_SANITIZE_NUMBER_INT) ??
    filter_input(INPUT_GET, 'profileID', FILTER_SANITIZE_NUMBER_INT) ?? NULL;


switch($action){

    case 'logmein':

        $id = signinTest($db);
        $result = peekAtProfileStatus($db, $id);
        echo $result;

        if($id != "")
        {
            if($result == "Locked")
            {
                echo("LOCKOUT");
            }
            else
            {
                $type = grabUserType($db, $id);
                loginSession($id, $type);
                if ($_SESSION['userType'] == "Admin") {
                    echo("Administrator");
                } else {
                    echo("Normal User");
                }
            }
        }
        else
        {
            echo("Error. No such user and password combination stored.\nPlease try again.");
        }


        break;
    case 'signMeUp':
        $isfound = discoverUser($db);
        signUpTest($db, $isfound);
        break;

    case 'simpleSearch':
        $logged = false;
        $category = "location";
        searchLoc($db, $logged);
        break;
    case 'showAdvancedSearch':
        showAdvancedSearch();
        break;
    case 'advancedSearch':
        $back=false;
        searchAll($db, $back);
        break;
    case "searchResultClick":
        $profileType = "Public";
        echo("profile id is " . $profileID . "<br>");
        grabProfile($db, $profileID, $profileType);
        break;

    default:
        include_once('nav.php');
        echo getShuffledProfiles($db);
        break;
}