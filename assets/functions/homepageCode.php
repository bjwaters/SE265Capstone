<?php


//Function to get all of the messages based on a set of two user ids
function getShuffledProfiles($db){
    try {
        $sql = $db->prepare("SELECT * FROM profiles");
        $sql->execute();
        $profiles = $sql->fetchAll(PDO::FETCH_ASSOC);
        shuffle($profiles);
        var_dump($profiles);

        /*$table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>MESSAGES</th></tr>";
        foreach ($messages as $m) {
            $table .= "<tr><td>" . $m['text'] . "</td><td>" . "Sent: " . $m['time'] . "</td></td>";
            //$table .= "<td><img src='images/" . $prod['image'] . "'></td>";
            //$table .= "<td><a href='prodcrud.php?action=Edit&prodID=".$prod['product_id']."&Categories=".$prod['category_id']."'>Edit</a> | <a href='prodcrud.php?action=Delete&prodID=".$prod['product_id']."'>Delete</a></td></tr>";
        }
        $table .= "</table>";
        return $table;*/
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
        var_dump($state);
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
        var_dump($profiles);

        /*$table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>MESSAGES</th></tr>";
        foreach ($messages as $m) {
            $table .= "<tr><td>" . $m['text'] . "</td><td>" . "Sent: " . $m['time'] . "</td></td>";
            //$table .= "<td><img src='images/" . $prod['image'] . "'></td>";
            //$table .= "<td><a href='prodcrud.php?action=Edit&prodID=".$prod['product_id']."&Categories=".$prod['category_id']."'>Edit</a> | <a href='prodcrud.php?action=Delete&prodID=".$prod['product_id']."'>Delete</a></td></tr>";
        }
        $table .= "</table>";
        return $table;*/
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to get the data
    }
}