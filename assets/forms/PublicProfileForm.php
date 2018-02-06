<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/17/2018
 * Time: 4:41 PM
 */

//var_dump($_SESSION);
var_dump($editPicture);
?>


<form method = 'get' action = "#">

    Name: <?php echo $editUserName?> <br>
    Location: <?php echo $editLocation?> Radius: <?php echo $editRadius?><br>
    Music genre: <?php echo $editGenre?> <br>
    Pay: <?php echo $editPay?><br>
    Comments: <?php echo $editComments?><br>
    availability: <?php echo $editAvailability?><br><br>

    <img src = 'assets/Uploads/<?php echo $editPicture?>' width='150'</td>
    <br><br>

    Video Link: <?php echo $editVideoLink?> <br> <br>
    <input type = "submit" name = "action" value = "Request Booking" /><br>

    <input type = "submit" name = "action" value = "Message User" /><br>



    <?php if($_SESSION['userType'] == "Admin") echo "Profile status: Locked";; ?>
    <input type =
           <?php if($_SESSION['userType'] == "Admin"){ echo "radio"; } else echo "hidden"; ?>
           name='profileStatus' <?php if($editProfileStatus == "Locked") echo "checked" ?> value = "Locked") />

    <?php if($_SESSION['userType'] == "Admin") echo "Unlocked"; ?>
    <input type =
           <?php if($_SESSION['userType'] == "Admin"){ echo "radio"; } else echo "hidden"; ?>
           name='profileStatus' <?php if($editProfileStatus == "Unlocked") echo "checked" ?> value = "Unlocked" />

    <br><br>
    Ratings will go here, if there are any.
    <br>

    <input type = "submit" name = "action" value = "Back to User Page" /><br>
    <input type = "submit" name = "action" value = "Logout" /><br>
    <input type = "submit" name = "action" value = "Main Page" />

</form>

<!--If the user type is a musician, the request button will not be hidden. Otherwise, it will be.