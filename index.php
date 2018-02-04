<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:08 PM
 */

session_start();

require_once("assets/dbconnect.php");
require_once("assets/functions.php");
require_once("assets/functions/profileCode.php");
require_once("assets/functions/reportCode.php");
require_once("assets/functions/searchCode.php");
require_once("assets/functions/loginSignupCode.php");
require_once("assets/functions/profileCode.php");
include_once("assets/header.php");

$db = dbConnect();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;


$editUserID =filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT)
    ?? filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);

$editUserName =filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'userName', FILTER_SANITIZE_STRING);

$editLocation =filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'location', FILTER_SANITIZE_STRING);

$editRadius =filter_input(INPUT_POST, 'radius', FILTER_SANITIZE_NUMBER_INT)
    ?? filter_input(INPUT_GET, 'radius', FILTER_SANITIZE_NUMBER_INT);

$editGenre =filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'genre', FILTER_SANITIZE_STRING);

$editPay =filter_input(INPUT_POST, 'pay', FILTER_SANITIZE_NUMBER_INT)
    ?? filter_input(INPUT_GET, 'pay', FILTER_SANITIZE_NUMBER_INT);

$editAvailability =filter_input(INPUT_POST, 'availability', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'availability', FILTER_SANITIZE_STRING);

$editComments =filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'comments', FILTER_SANITIZE_STRING);

$editVideoLink =filter_input(INPUT_POST, 'videoLink', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'videoLink', FILTER_SANITIZE_STRING);

$editPicture =filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'picture', FILTER_SANITIZE_STRING);

$editProfileStatus =filter_input(INPUT_POST, 'profileStatus', FILTER_SANITIZE_STRING)
    ?? filter_input(INPUT_GET, 'profileStatus', FILTER_SANITIZE_STRING);


switch($action){

    case 'Login/Sign Up Page':
        include_once("assets/forms/LoginForm.php");
        break;

    case 'Search Page':

        $category = "location";
        echo searchLoc($db, $category);
        //include_once("assets/forms/searchForm.php");
        break;
    case 'Search':
        include_once("assets/forms/searchForm.php");
        echo searchTable();
        break;

    case 'Main Page':
        include_once("assets/homePage.php");
        break;

    case 'Login':

        $validID = signinTest($db);  //This calls the login testing code

        //This is where the session will start,
        if($validID != "")
        {
            $userType = grabUserType($db, $validID); //This grabs the user type with their id
            loginSession($validID, $userType);                  //This starts a session varible with the user id and type stored
            include_once('assets/forms/ControlPanelForm.php');
        }
        else
        {
            include_once('assets/forms/LoginForm.php');
            echo("Error. No such user and password combination stored.\nPlease try again.");
        }

        break;
    case 'Sign Up':
        $user_found = discoverUser($db); //Test if the email exists in the database
        $newest_id = signupTest($db, $user_found); //If the email doesn't exist, validate and add the user and their profile. Also return their id

        //MAKE A SESSION, have edit page pop up
        break;
    case 'Logout':
        include_once("assets/homePage.php");
        break;

    case 'Edit Profile':
        grabProfileEdit($db, $_SESSION['userID']);  //Doesn't work Twice in a row?
        break;
    case 'Profile Edit Complete':
        editProfile($db, $editUserID, $editUserName, $editLocation, $editRadius, $editGenre, $editPay, $editAvailability,
            $editComments, $editPicture, $editVideoLink, $editProfileStatus );
        include_once("assets/forms/ControlPanelForm.php");
        break;
    case 'Public Profile':
        grabProfileLook($db, $_SESSION['userID']);
        include_once("assets/forms/PublicProfileForm.php");
        break;

    case 'Pending Requests':
        echo requestTable();
        include_once("assets/forms/PendingRequestForm.php");
        break;
    case 'Request Booking':
        include_once("assets/forms/MakeRequestForm.php");
        break;
    case 'Message User':
        break;
    case 'Make a Request':
        echo requestTable();
        include_once("assets/forms/PendingRequestForm.php");
        break;
    case 'Rate this User':
        include_once("assets/forms/RateUserForm.php");
        break;

    case 'Report Issues':
        include_once("assets/forms/reportMakerForm.php");
        break;
    case 'Report':
        addReport($db);
        include_once("assets/forms/ControlPanelForm.php");
        break;
    case 'Back to User Page':
        include_once("assets/forms/ControlPanelForm.php");
        break;

    default:
        include_once('assets/homePage.php');
        break;
}