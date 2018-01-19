<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/17/2018
 * Time: 4:41 PM
 */
?>


<form method = 'get' action = "#">

    <label for="name">Name here</label><br>
    <label for="location">Location here   </label>
    <label for="radius">Radius here</label><br>
    <label for="type">Music type here</label><br>
    <label for="pay">Pay Here</label><br>
    <label for="comment">Comment here</label><br>
    <label for="phone">phone here</label><br>
    <label for="available">availability here</label><br><br>

    <input type = "submit" name = "action" value = "Request this user" /><br> <br>

    Ratings will go here, if there are any. Considering a collapseable area here.
    <br>

    <input type = "submit" name = "action" value = "Back to User Page" /><br>
    <input type = "submit" name = "action" value = "Logout" /><br>
    <input type = "submit" name = "action" value = "Main Page" />

</form>

<!--If the user type is a musician, the request button will not be hidden. Otherwise, it will be.