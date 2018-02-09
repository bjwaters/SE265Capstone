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
    $picture = "Blank.jpg";
    $videoLink = "http://google.com";
    $profileStatus = "Unlocked";

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


//Grabs a profile, output based on what called it
function grabProfile($db, $neededID, $type)
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
                $editAvailability = $profile['availability'];
                $editComments = $profile['comments'];
                $editPicture = $profile['picture'];
                $editVideoLink = $profile['videoLink'];
                $editProfileStatus = $profile['profileStatus'];
                if($type == "edit") {
                    include_once("assets/forms/EditProfileForm.php");
                }
                else
                    include_once("assets/forms/PublicProfileForm.php");
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

//This allows editing of the profile
function editProfile($db, $editUserID, $editUserName, $editLocation, $editRadius, $editPay, $editAvailability, $editComments, $editVideoLink, $editProfileStatus)
{

    //Picture file
    $name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];

    if(isset($name))
    {
        if(!empty($name))
        {
            $location = 'assets/Uploads/';
            move_uploaded_file($tmp_name, $location.$name);
        }
    }

    $sessionID = $_SESSION['userID'];

    //If there is no file loaded, use the old picture. Otherwise, use the loaded file
    if(!empty($name)) {
        $editPicture = $_FILES['file']['name'];
    }
    else {
        //Grab the user's existing picture from their profile
        try{
            $stmt = $db->prepare("SELECT * FROM profiles WHERE user_id =:thisid");
            $stmt->bindParam(':thisid', $sessionID);
            $stmt->execute();

            $picture = $stmt->fetch(PDO::FETCH_ASSOC);
            $checker = $picture['picture'];
        }catch(PDOException $e)
        {
            die("Experiment is bunk.");
        }
        $editPicture = $checker;
    }


    //Transferring data
    $editGenre = $_POST['genre_drop'];
    try {
        $stmt = $db->prepare("UPDATE profiles SET userName=:userName, location=:location, radius=:radius, genre=:genre, pay=:pay,
              availability=:availability, comments=:comments, picture=:picture, videoLink=:videoLink, profileStatus=:profileStatus WHERE user_id = :user_id");
        $stmt->bindParam(':userName', $editUserName);
        $stmt->bindParam(':location', $editLocation);
        $stmt->bindParam(':radius', $editRadius);
        $stmt->bindParam(':genre', $editGenre);
        $stmt->bindParam(':pay', $editPay);
        $stmt->bindParam(':availability', $editAvailability);
        $stmt->bindParam(':comments', $editComments);
        $stmt->bindParam(':picture', $editPicture);
        $stmt->bindParam(':videoLink', $editVideoLink);
        $stmt->bindParam(':profileStatus', $editProfileStatus);
        $stmt->bindParam(':user_id', $editUserID);
        $stmt->execute();

    } catch (PDOException $e) {
        $e->getMessage();
        echo "<br>" . $e;
        die("<br>Editing a user profile did not work.");
    }
}

function genreArray(){
    $genre = array("Rock", "Classical", "Alternative", "Dubstep", "Country", "Other");
    return $genre;
}