<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:08 PM
 */


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;

switch($action){

    case 'Login/Sign Up Page':
        include_once("assets/LoginForm.php");
        break;

    case 'Search Page':
        include_once("assets/searchForm.php");
        break;
    case 'Search':
        break;

    case 'Main Page':
        include_once("assets/homePage.php");
        break;

    case 'Login':
        include_once("assets/ControlPanelForm.php");
        break;
    case 'Sign Up':
        include_once("assets/ControlPanelForm.php");
        break;
    case 'Logout':
        include_once("assets/homePage.php");
        break;

    case 'Edit Profile':
        include_once("assets/PublicEditForm.php");
        break;
    case 'Profile Edit Complete':
        include_once("assets/ControlPanelForm.php");
        break;
    case 'Public Profile':
        include_once("assets/PublicProfileForm.php");
        break;

    case 'Pending Requests':
        include_once("assets/requestReviewForm.php");
        break;
    case 'Request this user':
        include_once("assets/MakeRequestPage.php");
        break;

    case 'Report Issues':
        include_once("assets/reportMakerForm.php");
        break;
    case 'Back to User Page':
        include_once("assets/ControlPanelForm.php");
        break;

    default:
        include_once('assets/homePage.php');
        break;
}