<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:21 PM
 */
?>

<h3>Public Profile (Editing)</h3>

<form method = 'post' action = "#">

    user_id: <input type="hidden" name="id" value="<?php echo $editUserID;?>"/> <br>
    Public Name: <input type="text" name="name" value="<?php echo $editUserName;?>"/> <br>
    Location: <input type="text" name="location" value="<?php echo $editLocation;?>" />
    Radius: <input type="text" name="radius" value="<?php echo $editRadius;?>"/><br>
    Type: <input type="text" name="genre" value="<?php echo $editGenre;?>"/> <br>
    Pay Rate: <input type="text" name="payRate" value="<?php echo $editPay;?>"/><br>
    Phone: <input type="text" name="phone" value="<?php echo $editPhone;?>"/><br>
    Availability: <input type="text" name="Availability" value="<?php echo $editAvailability;?>"/><br>

    Comments:<br> <textarea name="comments" rows="5" cols="40" value="<?php echo $editComments;?>"></textarea><br><br>

    Picture Upload here <br><br>
    Video Link: <input type="text" name="videoLink" value="<?php echo $editVideoLink;?>"/><br><br>

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