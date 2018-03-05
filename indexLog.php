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


$db = dbConnect();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$profileID = filter_input(INPUT_POST, 'profileID', FILTER_SANITIZE_NUMBER_INT) ??
    filter_input(INPUT_GET, 'profileID', FILTER_SANITIZE_NUMBER_INT) ?? NULL;

$text = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING) ?? NULL;
$booker_id = filter_input(INPUT_POST, 'bookerID', FILTER_SANITIZE_STRING) ?? NULL;
$musician_id = filter_input(INPUT_POST, 'musicianID', FILTER_SANITIZE_STRING) ?? NULL;
//$sender_id = filter_input(INPUT_POST, 'senderID', FILTER_SANITIZE_STRING) ?? NULL;

$bookingDate = filter_input(INPUT_POST, 'bookingDate', FILTER_SANITIZE_STRING) ?? NULL;
$hours = filter_input(INPUT_POST, 'hours', FILTER_SANITIZE_STRING) ?? NULL;
$pay = filter_input(INPUT_POST, 'pay', FILTER_SANITIZE_STRING) ?? NULL;
$bookingText = filter_input(INPUT_POST, 'bookingText', FILTER_SANITIZE_STRING) ?? NULL;

switch($action){

    default:
        //include_once('homepageLogged.php');
        include_once('navLogged.php');

        if($_SESSION['userType'] == "Admin") {
            include_once('assets/forms/adminForm.php');
        }

        if($_SESSION['userType'] == "Booker") {
            $state = getUserState($db, $_SESSION['userID']); //This needs to be moved to userHomepage case??
            //echo getProfilesByState($db, $state);
        }

        if($_SESSION['userType'] == "Musician") {
            echo "IMMA MUISICAN";
        }
        break;
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
        include_once('assets/forms/profileTabs.php');
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
        include_once('navLogged.php');
        $editID = $_SESSION['userID'];
        $profileType = "Edit";
        grabProfile($db, $editID, $profileType);
        break;

    case 'Save Edit':
        editProfile($db);
        include_once('navLogged.php');
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
        //echo getAllBookings($db, $_SESSION['userID']);
        echo getPendingBookings($db, $_SESSION['userID']);
        echo getAcceptedBookings($db, $_SESSION['userID']);
        echo getCompletedBookings($db, $_SESSION['userID']);
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
}