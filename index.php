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
        include_once("assets/searchPage.php");
        break;
    case 'Search':
        break;

    case 'Main Page':
        include_once("assets/homePage.php");
        break;

    case 'Login':
        include_once("assets/goodLoginPageForm.php");
        break;
    case 'Sign Up':
        include_once("assets/goodLoginPageForm.php");
        break;
    case 'Logout':
        include_once("assets/homePage.php");

    case 'Edit Profile':
        include_once("assets/PublicEditForm.php");
        break;
    case 'Profile Edit Complete':
        include_once("assets/goodLoginPageForm.php");
        break;

    case 'Pending Requests':
        include_once("assets/requestPage.php");
        break;

    case 'Report Issues':
        include_once("assets/reportMakerForm.php");
        break;
    case 'Back to User Page':
        include_once("assets/goodLoginPageForm.php");
        break;

    default:
        include_once('assets/homePage.php');
        break;
}