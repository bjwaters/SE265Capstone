<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/19/2018
 * Time: 8:26 PM
 */

?>

<form method = 'get' action = "#">

    Rating:  <input type="text" name="ratingNumber" /> <br>
    Comment:<br> <textarea name="comments" rows="5" cols="40"></textarea><br><br>

    Here, the person being rated will have this rating viewable on their profile page.<br>

    <input type = "submit" name = "action" value = "Submit Rating" />
    <input type = "submit" name = "action" value = "Back to User Page" />

</form>