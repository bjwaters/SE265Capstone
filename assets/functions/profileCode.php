<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/28/2018
 * Time: 12:50 PM
 */


//Adding a blank profile attached to a user ID at creation
function addProfile($db)
{
    try{
        $stmt = $db->prepare("INSERT INTO profiles VALUES (userID, :userName, :location, :radius, :userType,
                            :pay, :phone, :availability, :comments, :picture, :videoLink, :profileStatus");
        $stmt->bindParam(':userID', $_SESSION['userID']);
        $stmt->bindParam(':userName', "");
        $stmt->bindParam(':location', "");
        $stmt->bindParam(':radius', "");
        $stmt->bindParam(':userType', $_SESSION['userType']);
        $stmt->bindParam(':pay', "");
        $stmt->bindParam(':phone', "" );
        $stmt->bindParam(':availability', "");
        $stmt->bindParam(':comments', "Enter comments here.");
        $stmt->bindParam(':picture', "Picture");
        $stmt->bindParam(':videoLink', "");
        $stmt->bindParam(':profileStatus', True);
        $stmt->execute();
    }catch(PDOException $e)
    {
        die("<br>Adding a user did not work");
    }
}