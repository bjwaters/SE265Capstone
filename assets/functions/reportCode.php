<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/28/2018
 * Time: 12:51 PM
 */

function addReport($db)
{
    $user_id = $_SESSION['userID'];
    $title = $_POST['reportType'];
    $comments = $_POST['details'];
    $resolved = "No";

    try{
        $stmt = $db->prepare("INSERT INTO reports VALUES (:user_id, :title, :comments, NOW(), :resolved)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':resolved', $resolved);
        $stmt->execute();
        echo("Report made.");
    }catch(PDOException $e)
    {
        die("<br>Adding a report did not work");
    }
}