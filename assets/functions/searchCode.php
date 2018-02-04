<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/28/2018
 * Time: 12:51 PM
 */


//The basic search function
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

//Pay rate coming later
function searchAll($db, $searchName, $searchLocation, $searchRadius, $searchGenre, $searchAvailability){

    $searchString = "SELECT * FROM profiles WHERE 0=0 ";

    if($searchName != "")
    {
        $searchName = strtolower($searchName);
        $searchString .= "AND userName LIKE '%$searchName%'";
    }
    if($searchLocation != "")
    {
        $searchLocation = strtolower($searchLocation);
        $searchString .= "AND location LIKE '%$searchLocation%'";
    }
    if($searchRadius != "")
    {
        $searchString .= "AND radius LIKE '%$searchRadius%'";
    }
    if($searchGenre != "")
    {
        $searchGenre = strtolower($searchGenre);
        $searchString .= "AND genre LIKE '%$searchGenre%'";
    }
    if($searchAvailability != "")
    {
        $searchAvailability = strtolower($searchAvailability);
        $searchString .= "AND availability LIKE '%$searchAvailability%'";
    }

    var_dump($searchString);
    try {

        $sql = $db->prepare($searchString);
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