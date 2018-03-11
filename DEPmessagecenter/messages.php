<?php

    require_once("messageFunctions.php");
    require_once("functions.php");
    include_once("testheader.php");

?>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="messages-tab">
                <form action="#" method="post">
                    <h2>Messages</h2>
                    UserID: <input type="text" name="userID" value=""/><br />
                    <input type="submit" name="action" value="Submit UID">
                </form>
        </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>





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
            <h3>All Messages</h3>
            <?php

            echo getAllMessages($db, $user_id);

    ?>






        <?php
    }