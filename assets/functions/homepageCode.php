<?php
//Homepage functions

//Function to get all musician profiles and randomize the display
function getShuffledProfiles($db){
    try {
        $sql = $db->prepare("SELECT * FROM profiles WHERE genre <> 'Default'");
        $sql->execute();
        $profiles = $sql->fetchAll(PDO::FETCH_ASSOC);
        shuffle($profiles);;
        $intRow = 1;

        $table = "<div class='container' id='resultDiv' >";
        $table .= "<header id='homepageHeader'><h1>Solo</h1><h2>Find musicians in your area</h2><h3>Start browsing now...</h3><br></header>";
        $table .= "<div class='row'><table class='table' id='shuffledProfiles'>" . PHP_EOL;
        foreach ($profiles as $p) {
            $table .= "<td><div class='crop-container'><img src='assets/uploads/" . $p['picture'] . "' onclick='searchProfileClickNotLogged(" . $p['user_id'] . ")'></div>";
            $table .= "<br><span class='subheader sub-username'>" . $p['userName'] . "</span>";
            $table .= "<br><span class='subheader sub-location'> " . $p['city'] . ",   " .  $p['state'] ."</span></td>";
            if($intRow %3 == 0)
            {
                $table .= "</tr><tr>";
            }
            $intRow++;
        }
        $table .= "</tr></table></div></div>";
        return $table;
    }
    catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem getting the record.");
    }
}

//Function to get the state for one user based on userID
function getUserState($db, $user_id){
    try {
        $sql = $db->prepare("SELECT state FROM profiles WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->execute();
        $state = $sql->fetch(PDO::FETCH_ASSOC);
        return $state['state'];
    }
    catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem getting the record.");
    }
}

//Function to get get all of the musician profiles based on the logged in user's state and randomize the results
function getProfilesByState($db, $state){
    try {
        $sql = $db->prepare("SELECT * FROM profiles WHERE state = :state AND genre <> 'Default'");
        $sql->bindParam(':state', $state);
        $sql->execute();
        $profiles = $sql->fetchAll(PDO::FETCH_ASSOC);
        shuffle($profiles);
        $intRow = 1;

        $table = "<div class='container' id='resultDiv' ><div class='row'>";
        $table .= "<header id='homepageHeader'><h3>Find musicians in your area</h3><br></header>";
        $table .= "<table class='table' id='stateProfiles'>" . PHP_EOL;
        foreach ($profiles as $p) {
            $table .= "<td><div class='crop-container'><img src='assets/uploads/" . $p['picture'] . "' onclick='searchProfileClick(" . $p['user_id'] . ")'></div>";
            $table .= "<br><span class='subheader sub-username'>" . $p['userName'] . "</span>";
            $table .= "<br><span class='subheader sub-location'> " . $p['city'] . ",   " .  $p['state'] ."</span></td>";
            if($intRow %3 == 0)
            {
                $table .= "</tr><tr>";
            }
            $intRow++;
        }
        $table .= "</table></div></div>";
        return $table;
    }
    catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem getting the record.");
    }
}