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
    $comments = $_POST['reportDetails'];
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

function grabReports($db)
{
    $type = "Edit";
    $resolution = "No";
    $reportTable = "<table><thead><tr><th> User ID </th> <th>Title</th><th>Comment</th><th>Time</th></tr></thead>";
    try{
        $stmt = $db->prepare("SELECT * FROM reports WHERE resolved =:resolution");
        $stmt->bindParam(':resolution', $resolution);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($reports as $report)
            {
                $reportID = $report['user_id'];
                $reportTitle = $report['title'];
                $reportComments = $report['comments'];
                $reportTime = $report['time'];

            $reportTable .= "<tr><td>" . $reportID . "</td><td>" . $reportTitle . "</td><td>"
                    . $reportComments . "</td><td>" . $reportTime . "</td> <td>" . "</td></tr>";
            }
            $reportTable .= "</table>";
            echo $reportTable;
        }

        else
        {
            echo "No reports stored.";
        }
    }catch(PDOException $e)
    {
        die("Grabbing the report list didn't work.");
    }
}