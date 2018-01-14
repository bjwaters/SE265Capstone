<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:21 PM
 */
?>

<h3>Public Profile (Editing)</h3>

<form method = 'get' action = "#">

    Public Name: <input type="text" name="MusicName" /> <br>
    Email: <input type="text" name="MusicEmail" /><br>
    Location: <input type="text" name="MusicLocation" />
    Radius: <input type="text" name="MusicRadius" /><br>
    Type: <input type="text" name="MusicType" /> <br>
    Rates: <input type="text" name="MusicRates" /><br>
    Time Needed: <input type="text" name="MusicAvailability" /><br>

    Comments:<br> <textarea name="comments" rows="5" cols="40"></textarea><br><br>
    Picture Upload here <br><br>

    <input type = "submit" name = "action" value = "Main Page" />
    <input type = "submit" name = "action" value = "Profile Edit Complete" />
</form>

<!-- Considering adding more buttons and hiding them. Certain buttons will be visible for
certain users. A musician will not need the same fields as a booker, and an admin will need
to be able to do things like locking profiles. Going to have to check the user type before getting to this page -->