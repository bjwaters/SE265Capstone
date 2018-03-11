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
function searchLoc($db, $logged){

    $category = "city";

    $text = $_POST['term'];
    $text = strtolower($text);
    $_SESSION['searchHistory'] = $text;

    $_SESSION['searchType'] = "simple";

    try {

        if(isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin") {
            $sql = $db->prepare("SELECT * FROM profiles WHERE $category LIKE '%$text%'");
        }
        else{
            $sql = $db->prepare("SELECT * FROM profiles WHERE genre <> 'Default' AND $category LIKE '%$text%'");
        }
        $sql->execute();

        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
        {
            $size = $sql ->rowCount();
            $table = "<div class='container border id='resultDiv'><div class='row'>";
            //$table .= "$size items returned. <br> <br>";
            $table .= "<table class='table'>" . PHP_EOL;
            $intRow = 1;
            $table .= "<tr>";
            foreach ($results as $result)
            {
                $resultID = $result['user_id'];
                $table .= "<td><div class='crop-container'><img src='assets/uploads/" . $result['picture'] . "' ";

                if($logged == false)
                {
                    $table .= "onclick='searchProfileClickNotLogged($resultID)'></div><br>";
                }  
                else
                {
                    $table .= "onclick='searchProfileClick($resultID)'></div><br>";
                }
                $table .= "<span class='subheader sub-username'>" . $result['userName'] . "</span><br>";
                $table .= "<span class='subheader sub-location'>" . $result['city'] . ",   " . $result['state'] . "</span></td>";
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
function searchAll($db, $back){

    if(isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin") {
        $searchString = "SELECT * FROM profiles WHERE 0=0 ";
    }else {
        $searchString = "SELECT * FROM profiles WHERE 0=0 AND genre <> 'Default'";
    }

    if(isset($_POST['searchName']) && isset($_POST['searchState']) && isset($_POST['searchCity']) && isset($_POST['searchAvailability']) && isset($_POST['genreSearch_drop']) && isset($_POST['searchPayRate1']) && isset($_POST['searchPayRate2'])) {
        $searchName = $_POST['searchName'];
        $searchLocation = $_POST['searchCity'];
        $searchAvailability = $_POST['searchAvailability'];
        $searchGenre = $_POST['genreSearch_drop'];
        $searchRate1 = $_POST['searchPayRate1'];
        $searchRate2 = $_POST['searchPayRate2'];
        $searchState = $_POST['searchState'];

        if ($searchName != "") {
            $searchName = strtolower($searchName);
            $searchString .= "AND userName LIKE '%$searchName%'";
        }
        if ($searchLocation != "") {
            $searchLocation = strtolower($searchLocation);
            $searchString .= "AND location LIKE '%$searchLocation%'";
        }
        if ($searchGenre != "null") {
            $searchGenre = strtolower($searchGenre);
            $searchString .= "AND genre LIKE '%$searchGenre%'";
        }
        if ($searchAvailability != "") {
            $searchAvailability = strtolower($searchAvailability);
            $searchString .= "AND availability LIKE '%$searchAvailability%'";
        }
        if($searchState != "null"){
            $searchState = strtolower($searchState);
            $searchString .= "AND state LIKE '%$searchState%'";
        }
    }
    else
    {
        $searchRate1 = "";
        $searchRate2 = "";
    }

    if($back == false)
    {
        $_SESSION['searchHistory'] = $searchString;
        $_SESSION['searchType'] = "advanced";
    }
    else
    {
        $searchString = $_SESSION['searchHistory'];
    }

    try {

        $sql = $db->prepare($searchString);
        $sql->execute();

        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
        {
            $size = $sql ->rowCount();
            //$table = "$size rows returned. <br> <br>";
            $table = "<div class='container border' id='resultDiv'><div class='row'>";
            $table .= "<table class='table'>" . PHP_EOL;
            $intRow = 1;
            $table .= "<tr>";
            foreach ($results as $result)
            {
                //if(isset($searchRate1) && isset($searchRate2)
                if($searchRate1 != "" and $searchRate2 != "")  //If both are contain a value
                {
                    settype($searchRate1, "float");
                    settype($searchRate2, "float");
                    if($searchRate1 <= $searchRate2)             //If the first value is less than the second
                    {
                        settype($result['pay'], "float");

                        if($searchRate1 <= $result['pay'] && $searchRate2 >= $result['pay'])  //if the return value is between or = the 2 values
                        {

                            $resultID = $result['user_id'];
                            $table .= "<td><div class='crop-container'><img src = 'assets/uploads/" . $result['picture'] . "' onclick='profileClickChoice($resultID)'></div><br>";
                            $table .= "<span class='subheader sub-username'>" . $result['userName'] . "</span><br>";
                            $table .= "<span class='subheader sub-location'>" . $result['city'] . ",   " . $result['state'] . "</span></td>";
                            if ($intRow % 3 == 0) {
                                $table .= "</tr><tr>";
                            }
                            $intRow++;
                        }
                    }
                }
                else {
                    $resultID = $result['user_id'];
                    $table .= "<td><div class='crop-container'><img src = 'assets/uploads/" . $result['picture'] . "' onclick='profileClickChoice($resultID)'></div><br>";
                    $table .= "<span class='subheader sub-username'>" . $result['userName'] . "</span><br>";
                    $table .= "<span class='subheader sub-location'>" . $result['city'] . ",   " . $result['state'] . "</span></td>";
                    if ($intRow % 3 == 0) {
                        $table .= "</tr><tr>";
                    }
                    $intRow++;
                }
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