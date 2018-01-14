<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:45 PM
 */
?>

<form method = 'get' action = "#">

    This is the page that appears at a successful login or signup.<br><br>
    <input type = "submit" name = "action" value = "Edit Profile" /><br>
    <input type = "submit" name = "action" value = "Pending Requests"/><br>
    <input type = "submit" name = "action" value = "Report Issues" /><br><br>

    <input type = "submit" name = "action" value = "Logout" /><br>
    <input type = "submit" name = "action" value = "Main Page" />

</form>

<!-- This can only be reached if the password/email is correct. Otherwise, an error
 message will be displayed, with the typed email. This is gonna have to be in a session.
 The session will store the user name (id?) and their type-->