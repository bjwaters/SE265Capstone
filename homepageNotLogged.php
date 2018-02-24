<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 2/21/2018
 * Time: 4:18 PM
 */
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--Javascript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src= "soloJava.js"></script>

    <title>Solo Project</title>
</head>


<!-- Nav bar -->
<div id="myNavbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" onclick="returnToStart()" href="#">Solo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!--Search part -->
        <div id = "myNavbarSearch">
            <form method="post" class="form-inline my-2 my-lg-0">
                <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="simpleSearchTerm">-->
                <!--<button type="button" class="btn btn-outline-success my-2 my-sm-0" id="simpleSearchButton">Search</button> -->
                <input type="text" id="simpleSearchTerm" />
                <input type = "submit" name = "action" value = "test" />
            </form>
        </div>

        <!-- Sign in and sign up -->
        <div id = "myNavbarSign">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="modal" data-target="#signInModal" data-whatever="@getbootstrap">Sign in <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="modal" data-target="#signUpModal" data-whatever="@getbootstrap">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>



<div class="col-md-12" id = "contentOutput" ></div>

<div class="col-md-12" id = "phpresults"></div>



<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signInLabel">Sign In:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="modalSignInEmail">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password:</label>
                        <input type="text" class="form-control" id="modalSignInPassword">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modalLogin" data-dismiss="modal">Log In</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signInLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signUpLabel">Sign In:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="newUserEmail">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password:</label>
                        <input type="text" class="form-control" id="newUserPassword">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Confirm Password:</label>
                        <input type="text" class="form-control" id="newUserPassword2">
                    </div>

                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                            <input type="radio" name="options" value="Musician" autocomplete="off" checked> Musician
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="options" value="Booker" autocomplete="off"> Booker
                        </label>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary active" id="modalSignUp" data-dismiss="modal">Sign Up</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</html>