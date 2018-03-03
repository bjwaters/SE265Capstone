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
    <script type="text/javascript" src= "soloJava.js"></script>

    <title>Solo Project</title>
</head>


<!-- Nav bar -->
<div id ="mynavBar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div id="homeButton">
            <img src="assets/Uploads/soloLogo.png" onclick="returnToStart()"/>
        </div>


        <!--Search part -->
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="simpleSearchLocationLogged">
            <button class="btn btn-outline-success my-2 my-sm-0" id="simpleSearchButtonLogged">Search</button>
        </form>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Bookings <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                </li>
            </ul>
        </div>


        <ul class="nav-item dropdown">
            <a class="nav-link dropdown-toggle soloNav" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Control Panel</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" onclick="publicProfile()">Public Profile</a>
                <a class="dropdown-item" href="indexLog.php?action=EditProfile">Edit Profile</a>
                <a class="dropdown-item" href="#" onclick="accountSettingsForm()">Account Settings</a>
                <a class="dropdown-item" href="#" onclick="reportForm()">Send Report</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="logoutClicks()">Log Out</a>
            </div>
        </ul>
    </nav>
</div>




<div class="col-md-12" id = "contentOutput" ></div>

<div class="col-md-12" id = "phpresults"></div>

</html>
