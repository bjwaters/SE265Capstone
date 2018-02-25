<?php
if(!isset($_SESSION))session_start();

    require_once("functions/dbConnect.php");
    require_once("functions/messageFunctions.php");
    require_once("functions/bookingFunctions.php");


    $db = dbConn(); //Connects to db
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
    $text = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING) ?? NULL;
    $booker_id = filter_input(INPUT_POST, 'bookerID', FILTER_SANITIZE_STRING) ?? NULL;
    $musician_id = filter_input(INPUT_POST, 'musicianID', FILTER_SANITIZE_STRING) ?? NULL;
    //$sender_id = filter_input(INPUT_POST, 'senderID', FILTER_SANITIZE_STRING) ?? NULL;

    $bookingDate = filter_input(INPUT_POST, 'bookingDate', FILTER_SANITIZE_STRING) ?? NULL;
    $hours = filter_input(INPUT_POST, 'hours', FILTER_SANITIZE_STRING) ?? NULL;
    $pay = filter_input(INPUT_POST, 'pay', FILTER_SANITIZE_STRING) ?? NULL;
    $bookingText = filter_input(INPUT_POST, 'bookingText', FILTER_SANITIZE_STRING) ?? NULL;

    $_SESSION['userID'] = '1';
    $_SESSION['userType'] = 'Booker';




    switch ($action) {
        default:
            include_once("testheader.php");
            break;
        case 'myMessages':
            include_once("testheader.php");
            echo getAllMessages($db, $_SESSION['userID']);
            break;
        case 'myBookings':
            include_once("testheader.php");
            echo getAllBookings($db, $_SESSION['userID']);
            break;
        case 'Profile':
            include_once("testheader.php");
            include_once('forms/profileTabs.php');
            break;
        case 'getMessages':
            echo getMessagesByIDs($db, $_GET['bookerID'], $_GET['musicianID']);
            break;
        case 'getBookings':
            echo getBookingsByIDs($db, $_GET['bookerID'], $_GET['musicianID']);
            break;
        case 'sendMessage':
            $text = $_POST['text'];
            echo "text on index: " . $text;
            echo newMessage($db, $_POST['bookerID'], $_POST['musicianID'], $_SESSION['userID'], $text);
            break;
        case 'Request Booking':
            // Convert booking date to format
            $bTime = strtotime($bookingDate);
            $bDate = date("Y-m-d H:i", $bTime);

            echo newBooking($db, $booker_id, $musician_id, $bDate, $hours, $pay, $status='pending');

            if(strlen($bookingText) > 0){
                echo newMessage($db, $booker_id, $musician_id,  $_SESSION['userID'] , $bookingText);
            }
            break;
    }


