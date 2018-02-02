<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/17/2018
 * Time: 4:41 PM
 */
?>


<form method = 'get' action = "#">

    <label for="name">Name: <?php echo $editUserName?> </label> <br>
    <label for="location">Location: <?php echo $editLocation?>    </label>
    <label for="radius">Radius: <?php echo $editRadius?> </label><br>
    <label for="type">Music genre: <?php echo $editGenre?> </label><br>
    <label for="pay">Pay: <?php echo $editPay?> </label><br>
    <label for="comment">Comments: <?php echo $editComments?> </label><br>
    <label for="available">availability: <?php echo $editAvailability?> </label><br><br>

    Video Link: <br> <br>
    <input type = "submit" name = "action" value = "Request this user" /><br> <br>

    Ratings will go here, if there are any. Considering a collapseable area here.
    <br>

    <input type = "submit" name = "action" value = "Back to User Page" /><br>
    <input type = "submit" name = "action" value = "Logout" /><br>
    <input type = "submit" name = "action" value = "Main Page" />

</form>

<!--If the user type is a musician, the request button will not be hidden. Otherwise, it will be.