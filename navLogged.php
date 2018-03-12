<?php ?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
    <!--Javascript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script type="text/javascript" src= "soloJava.js"></script>
    <script type="text/javascript" src= "messageCenter.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>Solo Project</title>
</head>


<!-- Nav bar -->
<div id ="mynavBar soloNavContainer">
    <nav class="navbar navbar-expand-lg navbar-light">

        <!-- Home Button - Logo -->
        <div id="homeButton mr-auto order-1">
            <a href="indexLog.php"><img src="assets/uploads/soloLogo.png"/></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!--Search part -->
            <form class="form-inline my-2 mx-3 order-1">
                <div class="soloSearch">
                    <i class="fas fa-search"></i>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="simpleSearchLocationLogged">
                </div>
                <button class="btn btn-primary my-2 my-sm-0" id="simpleSearchButtonLogged">Search</button>
            </form>

            <!-- Message Center Link -->
            <ul class="navbar-nav ml-auto mr-2 order-3">
                <li class="nav-item">
                    <a class="nav-link" href="indexLog.php?action=myBookings">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="indexLog.php?action=myMessages">Messages</a>
                </li>
            </ul>

            <!-- Account Settings Menu -->
            <ul class="nav-item dropdown mx-0 my-auto order-3">
                <!--<a class="nav-link dropdown-toggle soloNav" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Control Panel</a>-->
                <img src="assets/uploads/soloLogo.png" class="nav-link dropdown-toggle soloNav" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" onclick="publicProfile()">Public Profile</a>
                    <a class="dropdown-item" href="indexLog.php?action=EditProfile">Edit Profile</a>
                    <a class="dropdown-item" href="#" onclick="accountSettingsForm()">Account Settings</a>
                    <a class="dropdown-item" href="#" onclick="reportForm()">Send Report</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="logoutClicks()">Log Out</a>
                </div>
            </ul>
        </div>

    </nav>
    <hr>
</div>




<div class="col-md-12" id = "contentOutput" ></div>

<div class="col-md-12" id = "phpresults"></div>

</html>
