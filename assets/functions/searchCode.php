<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/28/2018
 * Time: 12:51 PM
 */


function searchLoc($db, $category){

    $text = $_GET['searchTerm'];
    $text = strtolower($text);

    try {

        $sql = $db->prepare("SELECT * FROM profiles WHERE $category LIKE '%$text%'");
        $sql->execute();

        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
        {
            $size = $sql ->rowCount();
            $table = "$size rows returned. <br> <br>";
            $table .= "<table>" . PHP_EOL;
            foreach ($results as $result)
            {
                $table .= "<tr><td>User name: " . $result['userName'] .  "</td>" . "<td>User location: " .  $result['location'] . "<td>";
                $table .= "</td></tr>";
            }
            $table .= "</table>" . PHP_EOL;
        }
        else
        {
            $table = "No profiles.";
        }
        return $table;
    } catch (PDOException $e){
        die("There was a problem retrieving the profiles.");

    }
}