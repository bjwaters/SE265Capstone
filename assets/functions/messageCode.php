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
        //Error message if it fails to access the db
        die("There was a problem adding the record.");
    }
}

//Function to get all messages sent to a specific user
function getAllMessages($db, $user_id){
    try {
        if($_SESSION['userType'] == 'Booker') {
            $sql = $db->prepare("SELECT * FROM messages WHERE booker_id = :user_id AND sender != :user_id ORDER BY time DESC");
        } else{
            $sql = $db->prepare("SELECT * FROM messages WHERE musician_id = :user_id AND sender != :user_id ORDER BY time DESC");
        }
        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $messages = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
        {
            $table = "<div class='container col-7'><table class='table' id='mcOutput'>" . PHP_EOL;
            $table .= "<tr><th>MESSAGES</th></tr>";
            foreach ($messages as $m) {
                //Splits dateTime table data into two variables
                $date =  preg_split('~ ~', $m['time'], PREG_SPLIT_OFFSET_CAPTURE)[0];
                $time = preg_split('~ ~', $m['time'], PREG_SPLIT_OFFSET_CAPTURE)[1];

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
                $table .= "<td>" . $userName . "</td>";
                $table .= "<td><lable>Message:</lable> " . $m['text'] . "</td>";
                $table .= "<td><lable>Sent: </lable> " . $date;
                $table .= "<br>" . substr($time, 0, -3) . "</td></tr>";
            }
            $table .= "</table></div>";
        } else{
            $table = "<div class='container col-7' id='mcOutput'>";
            $table .= "You have no messages at this time.</div>";
        }

        return $table;
    }
    catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem getting the record."); //Error message if it fails to get the data
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
                //Splits dateTime table data into two variables
                $date =  preg_split('~ ~', $m['time'], PREG_SPLIT_OFFSET_CAPTURE)[0];
                $time = preg_split('~ ~', $m['time'], PREG_SPLIT_OFFSET_CAPTURE)[1];
                if($m['sender'] == $_SESSION['userID']){
                    $table .= "<tr><td></td><td>" . $m['text'] . "<br>";
                    $table .= "<span class='msg-date'><lable>" . "Sent: </lable>" . $m['time'] . "</td>";
                    $table .= "<td><div class='mc-crop-container'><img src='assets/uploads/" . $myPic ."' height='75'></div></td></tr>";
                } else {
                    $table .= "<tr><td><div class='mc-crop-container'><img src='assets/uploads/" . $profilePic ."' height='75'></div></td>";
                    $table .= "<td><lable>Message:</lable> " . $m['text'] . "<br>";
                    $table .= "<span class='msg-date'><lable>Sent: </lable> " . $date . " " . substr($time, 0, -3) . "</span></td><td></td></tr>";
                }
            }
            $table .= "</table>";
        } else {
            $table = "You have no messages with this user at this time";
        }
        return $table;
    }
    catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem getting the record.");
    }
}