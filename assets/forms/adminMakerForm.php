<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 2/5/2018
 * Time: 7:20 PM
 */
?>

<form method = 'post' action = "#">
Admin Creation<br>
Email Address: <input type="text" name="newUserEmail" /><br>
Password: <input type="text" name="newUserPassword" /><br>
Password Verify: <input type="text" name="newUserPassword2" /><br>

User type:
Admin <input type="radio" name="userType" checked value = "Admin"><br><br>

<input type = "submit" name = "action" value = "Admin Signup" /><br><br>


<input type = "submit" name = "action" value = "Back to Admin Page" /><br>
<input type = "submit" name = "action" value = "Main Page" />
</form>