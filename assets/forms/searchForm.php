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
    Public Name: <input type="text" name="name" /> <br>
    Email: <input type="text" name="email" />Phone: <input type="text" name="phone" /><br>
    Location: <input type="text" name="location" />
    Radius: <input type="text" name="radius" /><br>
    Type: <input type="text" name="musicType" /> <br>
    Rates: <input type="text" name="payRate" /><br>
    Time Needed: <input type="text" name="Availability" /><br>
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