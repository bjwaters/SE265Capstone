<?php

require_once("functions/dbConnect.php.php");
include_once("testheader.php");

?>
    <div>

        <form action="#" method="post">
            <h2>Bookings</h2>
            UserID: <input type="text" name="userID" value=""/><br />
            <input type="submit" name="action" value="Submit UID">
        </form>

    </div>


<?php

    $db = dbConn(); //Connects to db

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
        filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    $user_id = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING) ?? NULL;


    $_SESSION['userType'] = 'Booker';

?>

<?php if($action == 'Submit UID') {



    ?>

    <div style="float:left">
        <h3>All Bookings</h3>
        <?php

        echo getAllBookings($db, $user_id);


        ?>

    </div>


    <?php
}