<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:21 PM
 */
?>


<div id = "editProfile" class="container">
    <div class="row">
        <form name = "editForm" method = 'post' action = "indexLog.php" enctype = "multipart/form-data">
            <h3>Public Profile (Editing)</h3>

            <input type="hidden" name="user_id" value="<?php echo $editUserID;?>"/> <br>
            Public Name: <input type="text" name="userName" value="<?php echo $editUserName;?>"/> <br>
            Location: <input type="text" name="city" value="<?php echo $editCity;?>" />

            State: <select name='state_drop'
                <?php
                    echo("<option selected='selected' value=null>Please choose a state.</option>");
                    $stateList = stateArray();
                    foreach($stateList as $state)
                    if($editState == $state)
                    {
                        echo "<option selected = 'selected' value='" . $state . "'>" . $state . "</option>" . PHP_EOL;
                    }
                    else
                        echo "<option value='" . $state . "'>" . $state . "</option>" . PHP_EOL;
                ?>
            </select><br>

            <div = "little" <?php echo $hidden ?>>
            <select name='genre_drop'>
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
            Pay Rate: <input type="text" name="pay" value="<?php echo $editPay;?>"/><br>
            Availability: <input type="text" name="availability" value="<?php echo $editAvailability;?>"/><br>
            </div>



            Comments:<br> <textarea name="comments" rows="5" cols="40"> <?php echo $editComments;?> </textarea><br><br>

            Picture Upload here <input type = 'file' name = 'file' id="file">

            <br><br>
            Video Link: <input type="text" name="videoLink" value="<?php echo $editVideoLink;?>"/><br><br>

            <br><br>
            <input type = "submit" name = "action" value = "Save Edit" />
            <!--<button type="button" class="btn btn-secondary" onclick='saveEdit()'>Finish and Save</button>-->
        </form>
    </div>
</div>
