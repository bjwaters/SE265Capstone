<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/28/2018
 * Time: 12:51 PM
 */

function showAdvancedSearch()
{
    include_once('assets/forms/SearchForm.html');
}

//The basic search function for location
function searchLoc($db, $logged){

    $category = "city";

    $text = $_POST['term'];
    $text = strtolower($text);
    $_SESSION['searchHistory'] = $text;

    $_SESSION['searchType'] = "simple";

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
                $table .= "<td>" .  "<img src = 'assets/uploads/" . $result['picture'] . "' width='200'";

                if($logged == false)
                {
                    $table .= "onclick=\"searchProfileClickNotLogged($resultID)\"><br>";
                }  
                else
                {
                    $table .= "onclick=\"searchProfileClick($resultID)\"><br>";
                }
                $table .= $result['userName'] . "   " . $result['city'] . "</td>";
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

    if(isset($_POST['searchName']) && isset($_POST['searchLocation']) && isset($_POST['searchAvailability']) && isset($_POST['genreSearch_drop']) && isset($_POST['searchPayRate1']) && isset($_POST['searchPayRate2'])) {
        $searchName = $_POST['searchName'];
        $searchLocation = $_POST['searchLocation'];
        $searchAvailability = $_POST['searchAvailability'];
        $searchGenre = $_POST['genreSearch_drop'];
        $searchRate1 = $_POST['searchPayRate1'];
        $searchRate2 = $_POST['searchPayRate2'];

        $searchString = "SELECT * FROM profiles WHERE 0=0 ";

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

        var_dump($searchString);
        var_dump($searchRate1);
        var_dump($searchRate2);
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
            $table = "$size rows returned. <br> <br>";
            $table .= "<table>" . PHP_EOL;
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
                            $table .= "<td>" . "<img src = 'assets/uploads/" . $result['picture'] . "' width='200' onclick='searchProfileClick($resultID)'><br>";
                            $table .= $result['userName'] . "   " . $result['location'] . "</td>";
                            if ($intRow % 3 == 0) {
                                $table .= "</tr><tr>";
                            }
                            $intRow++;
                        }
                    }
                }
                else {
                    $resultID = $result['user_id'];
                    $table .= "<td>" . "<img src = 'assets/uploads/" . $result['picture'] . "' width='200' onclick='searchProfileClick($resultID)'><br>";
                    $table .= $result['userName'] . "   " . $result['city'] . "</td>";
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