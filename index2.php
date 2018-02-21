<?php
/**
 * Created by PhpStorm.
 * User: Littleuser314
 * Date: 2/11/2018
 * Time: 5:20 PM
 */


session_start();

require_once("assets/functions/dbconnect.php");
require_once("assets/functions/loginSignupCode.php");
require_once("assets/functions/searchCode.php");
require_once("assets/functions/profileCode.php");
require_once("assets/functions/reportCode.php");

$db = dbConnect();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$editUserID = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_NUMBER_INT) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_NUMBER_INT) ?? NULL;
$editUserName = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$editLocation= filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$editRadius = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_NUMBER_INT) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_NUMBER_INT) ?? NULL;
$editPay = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_NUMBER_FLOAT) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_NUMBER_FLOAT) ?? NULL;
$editAvailability = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$editComments = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$editProfileStatus = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$editVideoLink = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_URL) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL) ?? NULL;
$editGenre= filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;

//echo($action);

switch($action){

    case 'logmein':

        $id = signinTest($db);
        if($id != "") {
            $type = grabUserType($db, $id);
            loginSession($id, $type);
            if($_SESSION['userType'] == "Admin")
            {
                echo("Administrator");
            }
            else
            {
                echo("Normal User");
            }
        }
        else
        {
            echo("Error. No such user and password combination stored.\nPlease try again.");
        }

        break;
    case 'logmeout':
        session_destroy();
        echo("Logged out.");
        break;
    case 'signMeUp':

        //echo ". In signmeup";
        $isfound = discoverUser($db);
        //echo("Is found: " . $isfound);
        signUpTest($db, $isfound);
        break;

    case 'simpleSearch':
        $category = "location";
        searchLoc($db);
        break;
    case 'showAdvancedSearch':
        showAdvancedSearch();
        break;
    case 'advancedSearch':
        searchAll($db);
        break;

    case 'EditProfile':
        $editID = $_SESSION['userID'];
        $profileType = "Edit";
        grabProfile($db, $editID, $profileType);
        //echo"Edit";
        break;
    case 'Save Edit':
        editProfile($db, $editUserID, $editUserName, $editLocation, $editRadius,
            $editPay, $editAvailability, $editComments, $editProfileStatus, $editGenre, $editVideoLink);
        break;
    case 'Public Profile':
        $editID = $_SESSION['userID'];
        $profileType = "Public";

        grabProfile($db, $editID, $profileType);
        //echo"Public";
        break;

    case 'reportIssues':
        addReport($db);
        break;

    case "test":
        echo("In test");
        break;

    default:
        include_once('homePage.html');
        break;
}