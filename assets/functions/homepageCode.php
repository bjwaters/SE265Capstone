<?php


//Function to get all of the messages based on a set of two user ids
function getShuffledProfiles($db){
    try {
        $sql = $db->prepare("SELECT * FROM profiles");
        $sql->execute();
        $profiles = $sql->fetchAll(PDO::FETCH_ASSOC);
        shuffle($profiles);

        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>Profiles</th></tr>";
        foreach ($profiles as $p) {
            $table .= "<tr><td><img src='assets/uploads/" . $p['picture'] . "' height='200' onclick='searchProfileClick(" . $p['user_id'] . ")'></td></td>";
            $table .= "<td>" . $p['userName'] . "</td>";
            $table .= "<td>" . $p['state'] . "</td>";
        }
        $table .= "</table>";
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
        $sql = $db->prepare("SELECT * FROM profiles WHERE state = :state"); //need to add search parameter to only return Musicians
        $sql->bindParam(':state', $state);
        $sql->execute();
        $profiles = $sql->fetchAll(PDO::FETCH_ASSOC);
        shuffle($profiles);

        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>Profiles</th></tr>";
        foreach ($profiles as $p) {
            $table .= "<tr><td><img src='assets/uploads/" . $p['picture'] . "' height='200' onclick='searchProfileClick(" . $p['user_id'] . ")'></td></td>";
            $table .= "<td>" . $p['userName'] . "</td>";
            $table .= "<td>" . $p['state'] . "</td>";
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}