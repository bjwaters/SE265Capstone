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
$profileID = filter_input(INPUT_POST, 'profileID', FILTER_SANITIZE_NUMBER_INT) ??
    filter_input(INPUT_GET, 'profileID', FILTER_SANITIZE_NUMBER_INT) ?? NULL;


switch($action){

    case 'logmeout':
        session_destroy();
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
    case "searchResultClick":
        $profileType = "Public";
        echo("profile id is " . $profileID . "<br>");
        grabProfile($db, $profileID, $profileType);
        break;

    case 'EditProfile':
        include_once('assets/forms/homepageLogged.php');
        if(isset($_SESSION['userID'])) {
            $editID = $_SESSION['userID'];
            $profileType = "Edit";
            grabProfile($db, $editID, $profileType);
        }
        else
            echo"No person logged in.";
        break;
    case 'Save Edit':
        editProfile($db);
        break;
    case 'Public Profile':
        if(isset($_SESSION['userID'])) {
            $editID = $_SESSION['userID'];
            $profileType = "Public";

            grabProfile($db, $editID, $profileType);
        }
        else
            echo"No person logged in.";
        break;

    case 'reportIssues':
        addReport($db);
        break;

    default:
        include_once('homepageLogged.php');
        break;
}