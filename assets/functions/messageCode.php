<?php

//Function to add a new message to the messages table
function newMessage($db, $booker_id, $musician_id, $sender_id, $text, $seen){
    try{
        $sql = $db->prepare("INSERT INTO messages VALUES (null, :booker_id, :musician_id, :sender_id, :text, now(), :seen) "); //sql statement to add placeholders to database
        $sql->bindParam(':booker_id', $booker_id);
        $sql->bindParam(':musician_id', $musician_id);
        $sql->bindParam(':sender_id', $sender_id);
        $sql->bindParam(':text', $text);
        $sql->bindParam(':seen', $seen);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        echo $e;
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

//Function to get all of the messages based on a set of two user ids
function getMessagesByIDs($db, $booker_id, $musician_id){
    try {
        $sql = $db->prepare("SELECT * FROM messages WHERE booker_id = :booker_id AND musician_id = :musician_id ORDER BY time");
        $sql->bindParam(':booker_id', $booker_id, PDO::PARAM_INT);
        $sql->bindParam(':musician_id', $musician_id, PDO::PARAM_INT);
        $sql->execute();
        $messages = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0) {
            $table = "<table class='table'>" . PHP_EOL;
            $table .= "<tr><th>MESSAGES</th></tr>";
            if($_SESSION['userType'] == 'Booker') {
                $myPic = getProfilePicture($db, $booker_id);
                $profilePic = getProfilePicture($db, $musician_id);
            } else if ($_SESSION['userType'] == 'Musician') {
                $myPic = getProfilePicture($db, $musician_id);
                $profilePic = getProfilePicture($db, $booker_id);
            }
            foreach ($messages as $m) {
                if($m['sender'] == $_SESSION['userID']){
                    $table .= "<tr><td>" . $m['text'] . "</td><td>" . "Sent: " . $m['time'] . "</td><td><img src='assets/uploads/" . $myPic ."' height='75'></td></tr>";
                } else {
                    $table .= "<tr><td><div class='mc-crop-container'><img src='assets/uploads/" . $profilePic ."' height='75'></div></td><td>" . $m['text'] . "</td><td>" . "Sent: " . $m['time'] . "</td></tr>";
                }
            }
            $table .= "</table>";
        } else {
            $table = "You have no messages at this time";
        }

        return $table;
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}

//Function to get all messages sent to a specific user
function getAllMessages($db, $user_id){
    try {
        if($_SESSION['userType'] == 'Booker') {
            $sql = $db->prepare("SELECT * FROM messages WHERE booker_id = :user_id AND sender != :user_id ORDER BY time");
        } else{
            $sql = $db->prepare("SELECT * FROM messages WHERE musician_id = :user_id AND sender != :user_id ORDER BY time");
        }
        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $messages = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
        {
            $table = "<div class='container col-7'><table class='table' id='mcOutput'>" . PHP_EOL;
            $table .= "<tr><th>MESSAGES</th></tr>";
            foreach ($messages as $m) {
                if($_SESSION['userType'] == 'Booker') {
                    $picture = getProfilePicture($db, $m['musician_id']);
                    $userName = getUserName($db, $m['musician_id']);
                    $profileID = $m['musician_id'];
                } else {
                    $picture = getProfilePicture($db, $m['booker_id']);
                    $profileID = $m['booker_id'];
                    $userName = getUserName($db, $m['booker_id']);
                }
                $table .= "<tr><td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' class='img-thumbs' width='75' onclick='searchProfileClick($profileID)'></div></td>";
                $table .= "<td>" . $userName . "</td><td>" . $m['text'] . "</td><td>" . $m['time'] . "</td></tr>";
            }
            $table .= "</table></div>";
        } else{
            $table = "You have no messages at this time.";
        }

        return $table;
    }
    catch (PDOException $e){
        echo $e;
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}