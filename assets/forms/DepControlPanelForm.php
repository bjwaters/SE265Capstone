<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:45 PM
 */
?>

<div class="container">
    <div class="row">
        <form method = 'get' action = "#">

        Your personal control panel.<br><br>
        <input type = "submit" name = "action" value = "Edit Profile" onclick="editProfile()"/>
            <input type = "submit" name = "action" value = "Public Profile" onclick="publicProfile()"/><br>
        <input type = "submit" name = "action" value = "Pending Requests"/><br>
        <input type = "submit" name = "action" value = "Account Settings"/><br>
        <input type = "submit" name = "action" value = "Report Issues" /><br><br>

        <input type = "submit" name = "action" value = "Logout" /><br>
        <input type = "submit" name = "action" value = "Main Page" />

    </form>
    </div>
</div>
