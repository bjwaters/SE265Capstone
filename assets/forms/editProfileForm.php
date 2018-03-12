<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/17/2018
 * Time: 4:41 PM
 */
?>


<div id="editProfile" class="container my-4 border col-7">

    <div class="d-flex ">
        <div class="row ">
            <aside id="profile-content-left" class="col">
                <form name="editForm2" method='post' action="indexLog.php" enctype="multipart/form-data">
                <div id="mediaBox" class="m-0">
                    <h3 class="soloHeader">Edit Profile</h3>
                    <div id="publicPicture">
                        <div class='profile-crop-container'>
                            <img src='assets/Uploads/<?php echo $editPicture?>' height='250'>
                        </div>
                    </div>

                    <div>
                        <div id="pic">Picture: <input type = 'file' name='file' id="file"></div>
                        <div id="vid" <?php echo $hidden ?>> Video Link: <input type="text" name="videoLink" value="<?php echo $editVideoLink;?>"/><br>
                            <p>Please enter a youtube link only.</p>
                        </div>

                    </div>
                </div>

            </aside>

            <!---Video and Comments-->
            <aside id="profile-content-right" class="col col-3 " >
                <div id="userData" class="mr-auto">
                    <section><input type="hidden" name="user_id" value="<?php echo $editUserID;?>"/></section>
                    <section>Name: <input type="text" name="userName" value="<?php echo $editUserName;?>"/></section>
                    <section>Location: <input type="text" name="city" value="<?php echo $editCity;?>" /></section>

                    <section>State: <select name='state_drop'>
                        <?php
                        echo("<option selected='selected' value=null>Please choose a state.</option>");
                        $stateList = stateArray();
                        foreach($stateList as $state)
                        if($editState == $state)
                        {
                        echo "<option selected='selected' value='" . $state . "'>" . $state . "</option>" . PHP_EOL;
                        }
                        else
                        echo "<option value='" . $state . "'>" . $state . "</option>" . PHP_EOL;
                        ?>
                        </select>
                    </section>

                    <!---Musician Only content-->
                    <div id="musicianContent" <?php echo $hidden ?>>
                        <section>Genre:<select name='genre_drop'>
                            <?php
                            echo("<option selected='selected' value=null>Please choose a genre.</option>");
                            $genreList = genreArray();
                            foreach($genreList as $genre)
                            if($editGenre == $genre)
                            {
                            echo "<option selected='selected' value='" . $genre . "'>" . $genre . "</option>" . PHP_EOL;
                            }
                            else
                            echo "<option value='" . $genre . "'>" . $genre . "</option>" . PHP_EOL;
                            ?>
                        </select></section>
                        <section>Pay Rate: <input type="text" name="pay" value="<?php echo $editPay;?>"/> </section>
                        <section>Availability: <input type="text" name="availability" value="<?php echo $editAvailability;?>"/> </section>
                    </div>
                </div>
                <div id="commentBox">
                    Description:<br> <textarea name="comments" rows="5" cols="60" maxlength="1000"> <?php echo $editComments;?> </textarea>
                    <div id="saveEditDiv"><input type="submit" name="action" value="Save Edit" /></div>
                </div>
            </aside>
    </div>
</div>


<!--Hidden input holding user values--->
<br> <input type="hidden" id="hiddenID" value="<?php echo $editUserID ?>" />
<br> <input type="hidden" id="hiddenUserID" value="<?php echo $_SESSION['userID'] ?>" />
<br> <input type="hidden" id="hiddenUserType" value="<?php echo $_SESSION['userType'] ?>" />

</div>