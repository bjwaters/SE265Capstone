<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:38 PM
 */
?>

This will be a proper search page in the future.

<form method = 'get' action = "#">

    <br>
    Public Name: <input type="text" name="MusicName" /> <br>
    Email: <input type="text" name="MusicEmail" /><br>
    Location: <input type="text" name="MusicLocation" />
    Radius: <input type="text" name="MusicRadius" /><br>
    Type: <input type="text" name="MusicType" /> <br>
    Rates: <input type="text" name="MusicRates" /><br>
    Availability: <input type="text" name="MusicAvailability" /><br>
    <input type = "submit" name = "action" value = "Search" /><br><br>

    <input type = "submit" name = "action" value = "Main Page" />


</form>

<!--This will be searching the musicians, not the bookers.
Using a radius might not be possible, based on future complications.
The result of the search will be displayed on the same page, beneath this information.
Ideally, it will be a list of links to click, possibly with the musicians's picture also
on the page-->