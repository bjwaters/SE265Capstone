<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:31 PM
 */
?>


<form method = 'get' action = "#">

    Sign In: <br>

    Email Address: <input type="text" name="EmailLogin" /> <br>
    Password: <input type="text" name="Password" /><br>
    <input type = "submit" name = "action" value = "Forgot Password?" /><input type = "submit" name = "action" value = "Login" />
    <br><br>

    Sign Up! <br>
    Name: <input type="text" name="newUserName" /><br>
    Email Address: <input type="text" name="newUserEmail" /><br>
    Password: <input type="text" name="newUserPassword" /><br>
    Password Verify: <input type="text" name="newUserPassword2" /><br>

    User type: Booker
    <input type="radio" name="userType" value = "Booker">
    Musician <input type="radio" name="userType" value = "Musician"><br>


    <input type = "submit" name = "action" value = "Sign Up" /><br><br>
    <input type = "submit" name = "action" value = "Main Page" />

    <!-- All types of users will be checked from the same table.
     Doesn't matter if they're musicians, bookers, or admin.
     There will need to be a value in this table that tells what type of user they are
     The table will need a user name, id(?), email, password, user type
     passwords will be hashed, and no duplicate emails or user names will be allowed-->
    <!--Going to need a new area to make admin accounts -->
    <!-- The forgot password might work if we can go to external emails, otherwise, might not want to -->
</form>