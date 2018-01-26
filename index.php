<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:08 PM
 */

require_once("assets/dbconnect.php");
require_once("assets/functions.php");
require_once("assets/loginCode.php");
include_once("assets/header.php");

$db = dbConnect();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;

switch($action){

    case 'Login/Sign Up Page':
        include_once("assets/forms/LoginForm.php");
        break;

    case 'Search Page':
        include_once("assets/forms/searchForm.php");
        break;
    case 'Search':
        include_once("assets/forms/searchForm.php");
        echo searchTable();
        break;

    case 'Main Page':
        include_once("assets/homePage.php");
        break;

    case 'Login':
        $valid = signinTest($db);
        //This is where the session will start, when I write the code. Note: add session here.
        if($valid != "")
        {
            include_once('assets/forms/ControlPanelForm.php');
            echo("Login successful!");
        }
        else
        {
            include_once('assets/forms/LoginForm.php');
            echo("Error. No such user and password combination stored.\nPlease try again.");
        }

        break;
    case 'Sign Up':
        //Test if the email exists in the database
        $user_found = discoverUser($db);

        //If the email doesn't exist, validate and add
        signupTest($db, $user_found);
        break;
    case 'Logout':
        include_once("assets/homePage.php");
        break;

    case 'Edit Profile':
        include_once("assets/forms/PublicEditForm.php");
        break;
    case 'Profile Edit Complete':
        include_once("assets/forms/ControlPanelForm.php");
        break;
    case 'Public Profile':
        include_once("assets/forms/PublicProfileForm.php");
        break;

    case 'Pending Requests':
        echo requestTable();
        include_once("assets/forms/PendingRequestForm.php");
        break;
    case 'Request this user':
        include_once("assets/forms/MakeRequestForm.php");
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
        include_once("assets/forms/ControlPanelForm.php");
        break;
    case 'Back to User Page':
        include_once("assets/forms/ControlPanelForm.php");
        break;

    default:
        include_once('assets/homePage.php');
        break;
}