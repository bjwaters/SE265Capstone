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

    Public Name: <input type="text" name="name" /> <br>
    Email: <input type="text" name="email" />Phone: <input type="text" name="phone" /><br>
    Location: <input type="text" name="location" />
    Radius: <input type="text" name="radius" /><br>
    Type: <input type="text" name="musicType" /> <br>
    Rates: <input type="text" name="payRate" /><br>
    Time Needed: <input type="text" name="Availability" /><br>

    Comments:<br> <textarea name="comments" rows="5" cols="40"></textarea><br><br>
    Picture Upload here <br><br>


    Profile status: Locked
    <input type="radio" name="profileStatus" value = "Locked">
    Unlocked <input type="radio" name="profileStatus" value = "Unlocked"><br>

    <input type = "submit" name = "action" value = "Main Page" />
    <input type = "submit" name = "action" value = "Profile Edit Complete" />
</form>

<!--
 The locked/unlocked options will be invisible to all but admins.
  When locked, the profile will be unsearchable or unchangeable

 Going to have to check the user type before getting to this page -->

<!--Need to discuss rates: one number or a range?
 Need to discuss availability: dropdowns per day? Another method?-->