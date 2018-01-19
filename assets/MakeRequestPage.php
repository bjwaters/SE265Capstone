<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/17/2018
 * Time: 4:56 PM
 */
?>


<form method = 'get' action = "#">

    Time: <input type="text" name="time" /><br>
    Location: <input type="text" name="location" /> <br>
    Comments:<br> <textarea name="comments" rows="5" cols="40"></textarea><br><br>

    <input type = "submit" name = "action" value = "Make a Request" /><br>
    <input type = "submit" name = "action" value = "Back to User Page" /><br><br>

    <input type = "submit" name = "action" value = "Main Page" />

</form>

<!-- If the person is not logged in, the make a request will prompt them to.
 If they are logged in, a request will be sent to the musician to see
  Their id will be automatically be supplied, as will their email

-->