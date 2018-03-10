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
require_once("assets/functions/homepageCode.php");
require_once("assets/functions/messageCode.php");
require_once("assets/functions/bookingCode.php");
require_once("assets/functions/validationCode.php");


$db = dbConnect();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$profileID = filter_input(INPUT_POST, 'profileID', FILTER_SANITIZE_NUMBER_INT) ??
    filter_input(INPUT_GET, 'profileID', FILTER_SANITIZE_NUMBER_INT) ?? NULL;

switch($action){

    default:
        include_once('navLogged.php');

        if($_SESSION['userType'] == "Admin") {
            include_once('assets/forms/adminForm.php');
        }

        if($_SESSION['userType'] == "Booker") {
            $state = getUserState($db, $_SESSION['userID']); //This needs to be moved to userHomepage case??
            echo getProfilesByState($db, $state);
        }

        if($_SESSION['userType'] == "Musician") {
            echo "IMMA MUISICAN";
        }
        break;
    case 'logmeout':
        session_destroy();
        break;
    case 'simpleSearch':
        $logged = true;
        $category = "location";
        searchLoc($db, $logged);
        //echo($_SESSION['searchHistory']);
        break;
    case 'showAdvancedSearch':
        showAdvancedSearch();
        break;
    case 'advancedSearch':
        $back = false;
        searchAll($db, $back);
        break;
    case "searchResultClick":
        $profileType = "Public";
        grabProfile($db, $profileID, $profileType);
        $status = getLockedStatus($db, $profileID);
        if($_SESSION['userType'] == "Booker" && $status == 'Unlocked' ){
            include_once('assets/forms/profileTabs.php');
        } else {
            echo "This profile is locked.";
        }
        break;
    case 'Back to Search Page':
        if(isset($_SESSION['searchHistory']) && isset($_SESSION['searchType']))
        {
            if($_SESSION['searchType'] == "simple")
            {
                $_POST['term'] = $_SESSION['searchHistory'];
                showAdvancedSearch();
                $logged = true;
                searchLoc($db, $logged);
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
        include_once('navLogged.php');
        $editID = $_SESSION['userID'];
        $profileType = "Edit";
        grabProfile($db, $editID, $profileType);
        break;
    case 'Save Edit':
        //echo "TEST";
        include_once('navLogged.php');
        if(validateProfile()){
            editProfile($db);
        } else {
            $editID = $_SESSION['userID'];
            $profileType = "Edit";
            grabProfile($db, $editID, $profileType);
        }
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

    //Message Center Cases
    case 'myMessages':
        include_once("navLogged.php");
        echo getAllMessages($db, $_SESSION['userID']);
        break;
    case 'myBookings':
        include_once("navLogged.php");
        echo getAllBookings($db, $_SESSION['userID']);
        include_once('assets/forms/modalBookingUpdateForm.php');
        break;
    case 'Profile':
        include_once("navLogged.php");
        include_once('assets/forms/profileTabs.php');
        break;
    case 'getMessages':
        echo getMessagesByIDs($db, $_GET['bookerID'], $_GET['musicianID']);
        break;
    case 'getBookings':
        $booker_id = filter_input(INPUT_POST, 'bookerID', FILTER_SANITIZE_STRING) ?? NULL;
        echo $booker_id;
        echo getBookingsByIDs($db, $_GET['bookerID'], $_GET['musicianID']);
        break;
    case 'sendMessage':
        $text = $_POST['text'];
        echo "text on index: " . $text;
        echo newMessage($db, $_POST['bookerID'], $_POST['musicianID'], $_SESSION['userID'], $text, $seen=false);
        break;
    case 'requestBooking':
        // Convert booking date to format
        $bookingDate = $_POST['date'];
        $hours = $_POST['hours'];
        $pay = $_POST['pay'];
        $bookingText = $_POST['text'];

        $bTime = strtotime($bookingDate);
        $bDate = date("Y-m-d H:i", $bTime);

        echo newBooking($db, $_POST['bookerID'], $_POST['musicianID'], $bDate, $hours, $pay, $status='pending');

        if(strlen($bookingText) > 0){
            echo newMessage($db, $_POST['bookerID'], $_POST['musicianID'],  $_SESSION['userID'] , $bookingText);
        }
        break;
    case 'updateBooking' :
        // Convert booking date to format
        $bookingDate = $_POST['date'];
        $hours = $_POST['hours'];
        $pay = $_POST['pay'];
        $bookingText = $_POST['text'];

        $bTime = strtotime($bookingDate);
        $bDate = date("Y-m-d H:i", $bTime);

        echo updateBooking($db, $_POST['bookerID'], $_POST['musicianID'], $bDate, $hours, $pay, $status='pending');

        if(strlen($bookingText) > 0){
            echo newMessage($db, $_POST['bookerID'], $_POST['musicianID'],  $_SESSION['userID'] , $bookingText, $seen=false);
        }
    case 'acceptBooking' :
        include_once("navLogged.php");
        echo updateBookingStatus($db, $_GET['bookingID'], $status='accepted');
        echo getAllBookings($db, $_SESSION['userID']);
        break;
    case 'declineBooking' :
        include_once("navLogged.php");
        $bookingText = "User has declined your booking request.";
        echo newMessage($db, $_GET['bookerID'], $_GET['musicianID'], $_SESSION['userID'], $bookingText, $seen=false);
        echo deleteBooking($db, $_GET['bookingID']);
        echo getAllBookings($db, $_SESSION['userID']);
        break;
    case 'deleteBooking' :
        include_once("navLogged.php");
        echo deleteBooking($db, $_GET['bookingID']);
        echo getAllBookings($db, $_SESSION['userID']);
        break;
}