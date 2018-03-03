<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 3/1/2018
 * Time: 12:14 PM
 */
?>

<form method = 'post' action = "#">

    New email: <input type="email" id="accountEmail" name="accountEmail" required /><br>
    New email Confirmation  : <input type="email" id="accountEmail2" name="AccountEmail2" required /> <br><br>

    New Password : <input type="text" id="newPassword" name="newPassword" required/> <br>
    Password Confirmation: <input type="text" id="newPassword2" name="newPassword2" required/> <br><br>

    <input type="button" value="Save Changes" onclick="accountSettingsSet()" />

</form>

