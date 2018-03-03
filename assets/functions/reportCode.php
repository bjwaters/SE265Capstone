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
        $stmt = $db->prepare("INSERT INTO reports VALUES (null, :user_id, :title, :comments, NOW(), :resolved)");
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
    $resolution = "No";
    $reportTable = "<form method = 'post' action = \"#\"><table><thead><tr> <th> Report # </th><th> User ID </th><th>Title</th><th>Comment</th><th>Time</th></tr></thead>";
    try{
        $stmt = $db->prepare("SELECT * FROM reports WHERE resolved =:resolution");
        $stmt->bindParam(':resolution', $resolution);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            $counter = 0;
            $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($reports as $report)
            {
                $reportNumber = $report['reportNumber'];
                $reportID = $report['user_id'];
                $reportTitle = $report['title'];
                $reportComments = $report['comments'];
                $reportTime = $report['created'];

            $reportTable .= "<tr><td>" . $reportNumber . "</td><td>" . $reportID . "</td> . <td>" . $reportTitle . "</td><td>"
                    . $reportComments . "</td><td>" . $reportTime . "</td> <td>
                <input type=\"checkbox\" name=\"reportStatus\" id=\"$counter\" value=\"$reportNumber\"> Resolved
                </td></tr>";
            $counter++;
            }
            $reportTable .= "</table><input type=\"hidden\" id = \"counter\" value=\"$counter\"><input type = \"button\" value = \"Save Changes\" onclick = \"changeReportStatus()\" /></form>";
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

function deleteReport($db)
{
    $valArray = $_POST['valArray'];
    $properArray = explode(",", $valArray);
    foreach ($properArray as $id) {
        //echo("Id is " . $id);
        $resolved = "Yes";
        try{
            $stmt = $db->prepare("UPDATE reports SET resolved=:resolved WHERE reportNumber = :reportNumber");
            $stmt->bindParam(':reportNumber', $id);
            $stmt->bindParam(':resolved', $resolved);
            $stmt->execute();
            echo("Reports resolved.");
        }catch(PDOException $e)
        {
            die("Reports shuffling didn't work.");
        }
    }
}