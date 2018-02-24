<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/28/2018
 * Time: 12:51 PM
 */

function showAdvancedSearch()
{
    include_once('assets/forms/searchForm.html');
}

//The basic search function for location
function searchLoc($db){

    $category = "location";
    //$text = $_POST['term'];
    $text = $_POST['simpleSearchTerm'];
    echo("text is: " . $text);
    $text = strtolower($text);

    try {

        $sql = $db->prepare("SELECT * FROM profiles WHERE $category LIKE '%$text%'");
        $sql->execute();

        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
        {
            $size = $sql ->rowCount();
            $table = "<div class=\"container\"> <div class=\"row\">";
            $table .= "$size items returned. <br> <br>";
            $table .= "<table>" . PHP_EOL;
            $intRow = 1;
            $table .= "<tr>";
            foreach ($results as $result)
            {
                $resultID = $result['user_id'];
                $table .= "<td>" .  "<img src = 'assets/Uploads/" . $result['picture'] . "' width='200' onclick='searchProfileClick($resultID)'><br>";
                $table .= $result['userName'] . "   " . $result['location'] . "</td>";
                if($intRow %3 == 0)
                {
                    $table .= "</tr><tr>";
                }
                $intRow++;
            }
            $table .= "</tr></table></div></div>" . PHP_EOL;
        }
        else
        {
            $table = "No profiles.";
        }
        echo $table;
    } catch (PDOException $e){
        die("There was a problem retrieving the profiles.");

    }
}

//Pay rate coming later, searches all things
function searchAll($db){

    $searchName = $_POST['searchName'];
    $searchLocation = $_POST['searchLocation'];
    $searchRadius = $_POST['searchRadius'];
    $searchAvailability = $_POST['searchAvailability'];
    $searchGenre =  $_POST['genreSearch_drop'];
    $searchRate1 = $_POST['searchPayRate1'];
    $searchRate2 = $_POST['searchPayRate2'];

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
    if($searchGenre != "null")
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
            $intRow = 1;
            $table .= "<tr>";
            foreach ($results as $result)
            {
                $resultID = $result['user_id'];
                $table .= "<td>" .  "<img src = 'assets/Uploads/" . $result['picture'] . "' width='200' onclick='searchProfileClick($resultID)'><br>";
                $table .= $result['userName'] . "   " . $result['location'] . "</td>";
                if($intRow %3 == 0)
                {
                    $table .= "</tr><tr>";
                }
                $intRow++;
            }
            $table .= "</tr></table></div></div>" . PHP_EOL;
        }
        else
        {
            $table = "No profiles.";
        }
        echo $table;
    } catch (PDOException $e){
        die("There was a problem retrieving the profiles.");

    }

}