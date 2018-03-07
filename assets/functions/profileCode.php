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
    $city = "Enter city here";
    $state = "RI";

    if($_SESSION['userTYpe'] == "Musician") {
        $genre = "Musical genre here";
        $pay = 0;
        $availability = "Enter availability here";
    }
    else
    {
        $genre = "Default";
        $pay = 3.14;
        $availability = "Default";
    }

    $comments = "Enter comments here.";
    $picture = "Blank.jpg";
    $videoLink = "http://google.com";
    $profileStatus = "Unlocked";

    try{
        $stmt = $db->prepare("INSERT INTO profiles VALUES (:new_id, :userName, :city,
        :state, :genre, :pay, :availability, :comments, :picture, :videoLink, :profileStatus)");
        $stmt->bindParam(':new_id', $new_id);
        $stmt->bindParam(':userName', $userName);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':pay', $pay);
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
    try {
        $stmt = $db->prepare("SELECT * FROM profiles WHERE user_id =:neededID");
        $stmt->bindParam(':neededID', $neededID);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($profiles as $profile) {
                $editUserID = $profile['user_id'];
                $editUserName = $profile['userName'];
                $editCity = $profile['city'];
                $editState = $profile['state'];
                $editGenre = $profile['genre'];
                $editPay = $profile['pay'];
                $editAvailability = $profile['availability'];
                $editComments = $profile['comments'];
                $editPicture = $profile['picture'];
                $editVideoLink = $profile['videoLink'];
                $editProfileStatus = $profile['profileStatus'];

                if($editGenre == 'Default') {
                    var_dump($_SESSION['userType']);
                    $hidden = 'hidden';
                }else {
                    $hidden = '';
                }


                if ($type == "Edit") {
                    include_once("assets/forms/EditProfileForm.php");
                } else if ($type == "Public")
                    include_once("assets/forms/PublicProfileForm.html");

            }
        } else {
            echo "No profiles stored.";
        }
    } catch (PDOException $e) {
        die("Grabbing the profile list didn't work.");
    }

}

//This allows editing of the profile
function editProfile($db)
{
    $name = $_POST['userName'];
    //var_dump($_POST);


    $editUserID = $_POST['user_id'];
    $editUserName = $_POST['userName'];
    $editCity = $_POST['city'];
    $editState = $_POST['state_drop'];
    $editPay = $_POST['pay'];
    $editAvailability = $_POST['availability'];
    $editComments = $_POST['comments'];
    $editGenre = $_POST['genre_drop'];

    if($editGenre == "null")
    {
        $editGenre = "Other";
    }
    if($editState == "null")
    {
        $editState = "RI";
    }

    $editVideoLink = $_POST['videoLink'];


    //Genre and picture further below
    $editProfileStatus = "Testing";

    //Picture file
    $name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];

    if(isset($name))
    {
        if(!empty($name))
        {
            $location = 'assets/uploads/';
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
    try {
        $stmt = $db->prepare("UPDATE profiles SET userName=:userName, city=:city, state=:state, genre=:genre, pay=:pay,
              availability=:availability, comments=:comments, picture=:picture, videoLink=:videoLink, profileStatus=:profileStatus WHERE user_id = :user_id");
        $stmt->bindParam(':userName', $editUserName);
        $stmt->bindParam(':city', $editCity);
        $stmt->bindParam(':state', $editState);
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

function saveStatus($db)
{
    $setID = $_POST['user_id'];
    $setProfileStatus = $_POST['profileStatus'];
    //echo "In savestatus: ID is  " .  $setID . " status: " . $setProfileStatus;

    try {
        $stmt = $db->prepare("UPDATE profiles SET  profileStatus=:profileStatus WHERE user_id = :user_id");
        $stmt->bindParam(':profileStatus', $setProfileStatus);
        $stmt->bindParam(':user_id', $setID);
        $stmt->execute();
        echo("Successful");

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

function stateArray()
{
    $states = array("AL", "AK", "AZ", "AR","CA", "CO", "CT", "DE", "FL","GA",
	    "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI",
	    "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND",
	    "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA",
	    "WA", "WV", "WI", "WY");
    return $states;
}

function getProfilePicture($db, $user_id){
    try {
        $sql = $db->prepare("SELECT picture FROM profiles WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->execute();
        $picture = $sql->fetch(PDO::FETCH_ASSOC);
        return $picture['picture'];
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}