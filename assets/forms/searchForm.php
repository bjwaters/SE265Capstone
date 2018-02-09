<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:38 PM
 */
?>

<div class="container">
    <div class="row">

        <form method = 'post' action = "#">

            Public Name: <input type="text" name="searchName" /> <br>
            Location: <input type= "text" name="searchLocation" />
            Radius: <input type="text" name="searchRadius" /><br>

            Genre:
            <select name='genreSearch_drop']>
                <?php
                echo("<option selected='selected' value=null>Please choose a genre.</option>");
                $genreList = genreArray();
                foreach($genreList as $genre)
                    if($editGenre == $genre)
                    {
                        echo "<option selected = 'selected' value='" . $genre . "'>" . $genre . "</option>" . PHP_EOL;
                    }
                    else
                        echo "<option value='" . $genre . "'>" . $genre . "</option>" . PHP_EOL;
                ?>
            </select>

            <br>Rates: <input type="text" name="searchPayRate1" /> to <input type="text" name="searchPayRate2" /><br><br>
            Availability: <input type="text" name="searchAvailability" /><br>
            <input type = "submit" name = "action" value = "Search" /><br><br>

            <input type = "submit" name = "action" value = "Main Page" />

        </form>
    </div>
</div>
