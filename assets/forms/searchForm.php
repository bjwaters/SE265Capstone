<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:38 PM
 */
?>

This is a very basic idea. Need to work on details for location, radius, and genre (dropdown?). <br>

<form method = 'post' action = "#">

    <br>
    Public Name: <input type="text" name="searchName" /> <br>
    Location: <input type="text" name="searchLocation" />
    Radius: <input type="text" name="searchRadius" /><br>
    Type: <input type="text" name="searchGenre" /> <br>
    Rates: <input type="text" name="searchPayRate1" /> to <input type="text" name="searchPayRate2" /><br><br>
    Availability: <input type="text" name="searchAvailability" /><br>
    <input type = "submit" name = "action" value = "Search" /><br><br>

    <input type = "submit" name = "action" value = "Main Page" />


</form>

<!--This will be searching the musicians, not the bookers.
Using a radius might not be possible, based on future complications.
The result of the search will be displayed on the same page, beneath this information.
Ideally, it will be a list of links to click, possibly with the musicians's picture also
on the page-->

<!--Need to discuss rates: one number or a range?
 Need to discuss availability: new table or another system?-->