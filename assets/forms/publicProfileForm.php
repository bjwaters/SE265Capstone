<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/17/2018
 * Time: 4:41 PM
 */
?>




<div class="container my-4 border col-7">

    <div class="d-flex ">
        <div class="row ">
            <aside id="profile-content-left" class="col">

                <div id="mediaBox" class="m-0">
                    <h3 class="soloHeader">Solo Profile</h3>
                    <div id="publicPicture">
                        <div class='profile-crop-container'>
                            <img src = 'assets/Uploads/<?php echo $editPicture?>' height='250'>
                        </div>
                    </div>

                    <div id="video" <?php echo $hidden ?>>
                        <iframe width='350' height='197' src='https://www.youtube.com/embed/<?php echo $videoEmbed ?>' frameborder='0' allowfullscreen></iframe>
                    </div>
                </div>


                <div id="adminContent">
                    <!-- Admin controls and search button-->
                    <form method='get' action="#">
                        <div>
                            <?php
                if(isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin")
                    echo "Profile status:<br> Locked";; ?>
                            <input type =
                                           <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin")
                            { echo "radio"; }
                            else echo "hidden"; ?>
                            name='profileStatus' <?php if($editProfileStatus == "Locked") echo "checked" ?> value = "Locked") />

                            <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin") echo "Unlocked"; ?>
                            <input type =
                                           <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin")
                            { echo "radio"; }
                            else echo "hidden"; ?>
                            name='profileStatus' <?php if($editProfileStatus == "Unlocked") echo "checked" ?> value = "Unlocked" /><br>

                            <input type =
                                           <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin")
                            {echo "button";}
                            else
                            {echo "hidden";} ?>
                            value = "Save Profile Status" onclick="changeProfileStatus()" />
                        </div>

                        <!--- Search history button-->
                        <input type=<?php if( isset($_SESSION['searchHistory'])) {echo "button";}
                        else echo "hidden"; ?> onclick="searchHistoryChoice()" value="Back to Search Page" >
                        </input>
                    </form>
                </div>
            </aside>

            <!---Video and Comments-->
            <aside id="profile-content-right" class="col">
                <div id="userData" class="mr-auto">
                    <span class="sub-username"><?php echo $editUserName?></span><br>
                    <span class="sub-location"><?php echo $editCity?>, <?php echo $editState?></span><br><br>

                    <!---Musician Only content-->
                    <div id="musicianContent" <?php echo $hidden ?>>
                    <label>Music genre: </label> <span id="profileGenre"><?php echo $editGenre?></span><br>
                    <label>Availability: </label> <span id="profileAvailability"><?php echo $editAvailability?></span><br>
                    <label>Rate: $</label><span id="profileRate"><?php echo $editPay?></span><br>
                    </div>
                </div>
                <div id="commentBox" class="border">
                    <label>Description: </label><br>
                    <?php echo $editComments?>
                </div>
            </aside>
        </div>
    </div>





    <!--Hidden input holding user values--->
    <br> <input type="hidden" id="hiddenID" value="<?php echo $editUserID ?>" />
    <br> <input type="hidden" id="hiddenUserID" value="<?php echo $_SESSION['userID'] ?>" />
    <br> <input type="hidden" id="hiddenUserType" value="<?php echo $_SESSION['userType'] ?>" />

</div>
