<?php


//Function to get all of the messages based on a set of two user ids
function getShuffledProfiles($db){
    try {
        $sql = $db->prepare("SELECT * FROM profiles WHERE genre <> 'Default'");
        $sql->execute();
        $profiles = $sql->fetchAll(PDO::FETCH_ASSOC);
        shuffle($profiles);;
        $intRow = 1;

        $table = "<div class='container' id='resultDiv' ><div class='row'>";
        $table .= "<table class='table' id='shuffledProfiles'>" . PHP_EOL;
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
        $table .= "</tr></table></div>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}

function getUserState($db, $user_id){
    try {
        $sql = $db->prepare("SELECT state FROM profiles WHERE user_id = :user_id");
        $sql->bindParam(':user_id', $user_id);
        $sql->execute();
        $state = $sql->fetch(PDO::FETCH_ASSOC);
        return $state['state'];
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}


function getProfilesByState($db, $state){
    try {
        $sql = $db->prepare("SELECT * FROM profiles WHERE state = :state AND genre <> 'Default'"); //need to add search parameter to only return Musicians
        $sql->bindParam(':state', $state);
        $sql->execute();
        $profiles = $sql->fetchAll(PDO::FETCH_ASSOC);
        shuffle($profiles);
        $intRow = 1;

        $table = "<div class='container' id='resultDiv' > <div class='row'>";
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
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}