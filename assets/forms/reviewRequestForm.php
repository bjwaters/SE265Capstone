<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/19/2018
 * Time: 7:24 PM
 */
?>

<form method = 'get' action = "#">

    Time: <input type="text" name="time" /><br>
    Location: <input type="text" name="location" /> <br>
    Comments:<br> <textarea name="comments" rows="5" cols="40"></textarea><br><br>



    Once a request is completed, it will be possible to rate their service.<br>
    Otherwise, the button will be hidden.<br><br>

    <input type = "submit" name = "action" value = "Rate User" /> <br>
    <input type = "submit" name = "action" value = "Back to User Page" />

</form>