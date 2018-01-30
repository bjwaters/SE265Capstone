<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/28/2018
 * Time: 12:50 PM
 */


//Adding a blank profile attached to a user ID at creation
function addProfile($db, $new_id)
{
    settype($new_id, 'integer');
    $userName = "Enter name here";
    $location = "Enter location here";
    $radius = 0;
    $genre = "Musical genre here";
    $pay = 0;
    $phone = "123-456-7890";
    $availability = "Enter availability here";
    $comments = "Enter comments here.";
    $picture = "Enter Picture here";
    $videoLink = "Enter Link here";
    $profileStatus = "True";

    try{
        $stmt = $db->prepare("INSERT INTO profiles VALUES (:new_id, :userName, :location,
        :radius, :genre, :pay, :phone, :availability, :comments, :picture, :videoLink, :profileStatus)");
        $stmt->bindParam(':new_id', $new_id);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':radius', $radius);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':pay', $pay);
        $stmt->bindParam(':phone', $phone );
        $stmt->bindParam(':availability', $availability);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':videoLink', $videoLink);
        $stmt->bindParam(':profileStatus', $profileStatus);
        $stmt->execute();
    }catch(PDOException $e)
    {
        $e->getMessage();
        echo "<br>" . $e;
        die("<br>Adding a user profile did not work.");
    }
}

function grabProfile($db, $neededID)
{
    try{
        $stmt = $db->prepare("SELECT * FROM profiles WHERE user_id =:neededID");
        $stmt->bindParam(':neededID', $neededID);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($profiles as $profile)
            {
                $editUserID = $profile['user_id'];
                $editUserName = $profile['userName'];
                $editLocation = $profile['location'];
                $editRadius = $profile['radius'];
                $editGenre = $profile['genre'];
                $editPay = $profile['pay'];
                $editPhone = $profile['phone'];
                $editAvailability = $profile['availability'];
                $editComments = $profile['comments'];
                $editPicture = $profile['picture'];
                $editVideoLink = $profile['videoLink'];
                $editProfileStatus = $profile['profileStatus'];
                include_once("assets/forms/PublicEditForm.php");
            }
        }
        else
        {
            echo "No profiles stored.";
        }
    }catch(PDOException $e)
    {
        die("Grabbing the profile list didn't work.");
    }
}

function editProfile($db, $editUserID, $editUserName, $editLocation, $editRadius, $editGenre, $editPay, $editPhone, $editAvailability, $editComments, $editPicture, $editVideoLink, $editProfileStatus)
{
    try{
        $stmt = $db->prepare("UPDATE profiles SET userName=:userName, location=:location, radius=:radius, genre=:genre, pay=:pay, phone=:phone,
                availability=:availability, comments=:comments, picture=:picture, videoLink=:videoLink, profileStatus=:profileStatus WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $editUserID);
        $stmt->bindParam(':userName', $editUserName);
        $stmt->bindParam(':location', $editLocation);
        $stmt->bindParam(':radius', $editRadius);
        $stmt->bindParam(':genre', $editGenre);
        $stmt->bindParam(':pay', $editPay);
        $stmt->bindParam(':phone', $editPhone );
        $stmt->bindParam(':availability', $editAvailability);
        $stmt->bindParam(':comments', $editComments);
        $stmt->bindParam(':picture', $editPicture);
        $stmt->bindParam(':videoLink', $editVideoLink);
        $stmt->bindParam(':profileStatus', $editProfileStatus);
        $stmt->execute();
    }catch(PDOException $e)
    {
        $e->getMessage();
        echo "<br>" . $e;
        die("<br>Adding a user profile did not work.");
    }
}