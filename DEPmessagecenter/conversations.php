<div>

    <form action="#" method="post">
        <h2>Conversations</h2>
        BookerID: <input type="text" name="bookerID" value=""/><br />
        MusicianID: <input type="text" name="musicianID" value=""/><br />
        <input type="submit" name="action" value="Submit IDs">
    </form>

</div>


<?php

    require_once("functions.php");
    require_once("messageFunctions.php");

    $db = dbConn(); //Connects to db

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    $booker_id = filter_input(INPUT_POST, 'bookerID', FILTER_SANITIZE_STRING) ?? NULL;
    $musician_id = filter_input(INPUT_POST, 'musicianID', FILTER_SANITIZE_STRING) ?? NULL;


    switch ($action) {
        default:
            break;
        case 'Submit IDs':
            echo getBookingsByIDs($db, $booker_id, $musician_id);
            echo getMessagesByIDs($db, $booker_id, $musician_id);
            break;
        case 'Passed':
            echo getBookingsByIDs($db, $_GET['bookerID'], $_GET['musicianID']);
            echo getMessagesByIDs($db, $_GET['bookerID'], $_GET['musicianID']);
            break;
    }


