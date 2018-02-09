<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 12:13 PM
 */
?>


<div class="container">
    <div class="row">
        <div class="col-md-12 bg-info" style="height: 150px;"> Homepage Banner here </div>

        <div class="col-md-4 my-2 bg-info">
            <form method = 'get' action = "#">
                <input type="text" name="searchTerm" value="Location"/> <input type = "submit" name = "action" value = "Search Page" />
            </form>
        </div>
        <div class="col-md-4 my-2 bg-info">
            <form method = 'get' action = "#">
                <input type = "submit" name = "action" value = "Login/Sign Up Page" />
            </form>
        </div>

        <div class="col-md-4 my-2 bg-info">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
    </div>
</div>
