<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:31 PM
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
        <form method = 'post' action = "#">

            Sign In: <br>

            Email Address: <input type="text" name="signInEmail" /> <br>
            Password: <input type="text" name="signInPassword" /><br>
            <input type = "submit" name = "action" value = "Forgot Password?" /><input type = "submit" name = "action" value = "Login" />

        </div>
        <div class="col-md-6">
            Sign Up! <br>
            Email Address: <input type="text" name="newUserEmail" /><br>
            Password: <input type="text" name="newUserPassword" /><br>
            Password Verify: <input type="text" name="newUserPassword2" /><br>

            User type: Booker
            <input type="radio" name="userType" value = "Booker">
            Musician <input type="radio" name="userType" value = "Musician"><br>

            <input type = "submit" name = "action" value = "Sign Up" /><br><br>
            <input type = "submit" name = "action" value = "Main Page" />
        </div>
        </form>
    </div>
</div>
