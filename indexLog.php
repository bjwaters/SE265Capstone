<?php
/**
 * Created by PhpStorm.
 * User: Littleuser314
 * Date: 2/11/2018
 * Time: 5:20 PM
 */

if(!isset($_SESSION)) {
    session_start();
}
if($_SESSION['userID'] == NULL || !isset($_SESSION['userID']))
{
    header('Location: indexNotLog.php');
}

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
        //echo($_SESSION['searchHistory']);
        break;
    case 'showAdvancedSearch':
        showAdvancedSearch();
        break;
    case 'advancedSearch':
        $back = false;
        searchAll($db, $back);
        //echo($_SESSION['searchHistory']);
        break;
    case "searchResultClick":
        $profileType = "Public";
        grabProfile($db, $profileID, $profileType);
        break;

    case 'Back to Search Page':
        if(isset($_SESSION['searchHistory']) && isset($_SESSION['searchType']))
        {
            if($_SESSION['searchType'] == "simple")
            {
                $_POST['term'] = $_SESSION['searchHistory'];
                showAdvancedSearch();
                searchLoc($db);
            }
            else
            {
                $back = true;
                showAdvancedSearch();
                searchAll($db, $back);
            }
        }

        break;

    case 'createAdmin':
        echo ("In create admin php");
        include_once("assets/forms/adminMakerForm.php");
        break;
    case 'adminEntry':
        $email = $_POST['adminEmail'];
        $pass = $_POST['adminPass1'];
        $pass2 = $_POST['adminPass2'];

        adminSignup($db, $email, $pass, $pass2);
        break;

    case 'EditProfile':
        include_once('homepageLogged.php');
        $editID = $_SESSION['userID'];
        $profileType = "Edit";
        grabProfile($db, $editID, $profileType);
        break;

    case 'Save Edit':
        editProfile($db);
        include_once('homepageLogged.php');
        break;
    case 'saveStatus':
        saveStatus($db);
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

    case 'reportForm':
        include_once('assets/forms/ReportMakerForm.html');
        break;
    case 'reportIssues':
        addReport($db);
        break;
    case 'checkReports':
        grabReports($db);
        break;
    case 'changeReportStatus':
        deleteReport($db);
        break;

    case 'accountSettingsForm':
        include_once('assets/forms/AccountSettingForm.php');
        break;
    case 'accountSettingsSet':
        accountSettingcode($db);
        break;

    default:
        include_once('homepageLogged.php');
        if($_SESSION['userType'] == "Admin") {
            include_once('assets/forms/adminForm.php');
        }
        break;
}