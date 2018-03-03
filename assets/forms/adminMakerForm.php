<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 2/5/2018
 * Time: 7:20 PM
 */
?>

<div class="container">
    <div class="row">

    <form method = 'post' action = "#">
    Admin Creation<br>
    Email Address: <input type="text" id= "newAdminEmail" name="newAdminEmail" /><br>
    Password: <input type="text" id = "newAdminPassword" name="newAdminPassword" /><br>
    Password Verify: <input type="text" id = "newAdminPassword2" name="newAdminPassword2" /><br>

    User type:
    Admin <input type="radio" name="userType" checked value = "Admin"><br><br>

    <input type = "button"  value = "Admin Signup" onclick="adminEntry()"/><br><br>
    </form>
    </div>
</div>