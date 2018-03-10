<?php

//Booking functions


//Function to add a new booking to the bookings table
function newBooking($db, $booker_id, $musician_id, $booking_date, $hours, $pay, $status){
    try{
        $sql = $db->prepare("INSERT INTO bookings VALUES (null, :booker_id, :musician_id, :booking_date, :hours, :pay, :status)"); //sql statement to add placeholders to database
        $sql->bindParam(':booker_id', $booker_id);
        $sql->bindParam(':musician_id', $musician_id);
        $sql->bindParam(':booking_date', $booking_date);
        $sql->bindParam(':hours', $hours);
        $sql->bindParam(':pay', $pay);
        $sql->bindParam(':status', $status);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

function changeBookingStatus($db, $booking_id, $status) {
    try{
        $sql = $db->prepare("UPDATE bookings SET status = :status WHERE booking_id = :booking_id"); //sql statement to add placeholders to database
        $sql->bindParam(':booking_id', $booking_id);
        $sql->bindParam(':status', $status);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}


//This function updates a booking status for a specific booking in the bookings table
function updateBookingStatus($db, $booking_id, $status){
    try {
        $sql = $db->prepare("UPDATE bookings SET status = :status WHERE booking_id = :booking_id");
        $sql->bindParam(':booking_id', $booking_id);
        $sql->bindParam(':status', $status);
        $sql->execute();
        //return "Update complete.";
        return $sql->rowCount() . " row updated";
    } catch (PDOException $e){
        die("There was a problem updating the record."); //Error message if it fails to add new data to the db
    }
}

//This function updated the booking details for a specific booking
function updateBooking($db, $booking_id, $musician_id, $booking_date, $hours, $pay, $status){  //Function to update a booking in the bookings table
    try{
        $sql = $db->prepare("UPDATE bookings SET booking_date = :booking_date, hours = :hours, pay = :pay, status = :status WHERE booking_id = :booking_id"); //sql statement to add placeholders to database
        $sql->bindParam(':booking_date', $booking_date);
        $sql->bindParam(':booking_id', $booking_id);
        $sql->bindParam(':musician_id', $musician_id);
        $sql->bindParam(':hours', $hours);
        $sql->bindParam(':pay', $pay);
        $sql->bindParam(':status', $status);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

//This function gets all of the bookings for one user (not used currently)
function getAllBookings($db, $user_id){ //
    $bookingsDiv = "<div id='mcOutput'>";
    $bookingsDiv .= getPendingBookings($db, $user_id);
    $bookingsDiv .= getAcceptedBookings($db, $user_id);
    $bookingsDiv .= getCompletedBookings($db, $user_id);
    $bookingsDiv .= "</div>";

    return $bookingsDiv;
}

//This function gets all bookings with a status of pending for the logged in user
function getPendingBookings($db, $user_id){
    try {
        if($_SESSION['userType'] == 'Booker'){
            $sql = $db->prepare("SELECT * FROM bookings WHERE booker_id = :user_id AND status = 'pending'");
        } else {
            $sql = $db->prepare("SELECT * FROM bookings WHERE musician_id = :user_id AND status = 'pending'");
        }

        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $bookings = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>Pending Bookings</th></tr>";
        foreach ($bookings as $b) {
            if($_SESSION['userType'] == 'Booker') {
                $picture = getProfilePicture($db, $b['musician_id']);
                $profileID = $b['musician_id'];
            } else {
                $picture = getProfilePicture($db, $b['booker_id']);
                $profileID = $b['booker_id'];
            }

            $table .= "<td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' class='img-thumbs' width='75' onclick='searchProfileClick($profileID)'></div></td>";
            $table .= "<td>" . $b['booking_id'] . "</td><td>" . $b['booking_date'] . "</td><td>" . "$" . $b['pay'] . $b['number_of_hours'] . "</td>";
            $table .= "<td>Buttons</td>";
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

//This function gets all bookings with a status of accepted for the logged in user
function getAcceptedBookings($db, $user_id){
    try {
        if($_SESSION['userType'] == 'Booker'){
            $sql = $db->prepare("SELECT * FROM bookings WHERE booker_id = :user_id AND status = 'accepted'");
        } else {
            $sql = $db->prepare("SELECT * FROM bookings WHERE musician_id = :user_id AND status = 'accepted'");
        }

        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $bookings = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>Accepted Bookings</th></tr>";
        foreach ($bookings as $b) {

            $table .= "<tr><td>" . $b['booking_id'] . "</td><td>" . $b['booking_date'] . "</td><td>" . "$" . $b['pay'] . $b['number_of_hours'] . "</td>";
            if($_SESSION['userType'] == 'Booker') {
                $pic = getProfilePicture();
                $table .= "<td><div class='mc-crop-container'><a href='indexLog.php?action=Profile&bookerID=" . $user_id . "&musicianID=" . $b['musician_id']."'>UserID: " . $b['musician_id'] . "</a></div>";
            } else{
                $table .= "<td><div class='mc-crop-container'><a href='indexLog.php?action=Profile&musicianID=" . $user_id . "&bookerID=" . $b['booker_id']."'>UserID: " . $b['booker_id'] . "</a></div>";
            }
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

//This function gets all bookings with a status of complete for the logged in user
function getCompletedBookings($db, $user_id){
    try {
        if($_SESSION['userType'] == 'Booker'){
            $sql = $db->prepare("SELECT * FROM bookings WHERE booker_id = :user_id AND status = 'completed'");
        } else {
            $sql = $db->prepare("SELECT * FROM bookings WHERE musician_id = :user_id AND status = 'completed'");
        }

        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $bookings = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>Completed Bookings</th></tr>";
        foreach ($bookings as $b) {
            $table .= "<tr><td>" . $b['booking_id'] . "</td><td>" . $b['booking_date'] . "</td><td>" . "$" . $b['pay'] . $b['number_of_hours'] . "</td>";
            if($_SESSION['userType'] == 'Booker') {
                $table .= "<td><div class='mc-crop-container'><a href='indexLog.php?action=Profile&bookerID=" . $user_id . "&musicianID=" . $b['musician_id']."'>UserID: " . $b['musician_id'] . "</a></div>";
            } else{
                $table .= "<td><div class='mc-crop-container'><a href='indexLog.php?action=Profile&musicianID=" . $user_id . "&bookerID=" . $b['booker_id']."'>UserID: " . $b['booker_id'] . "</a></div>";
            }
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function getBookingsByIDs($db, $booker_id, $musician_id){ //Function to view products in a table with links to edit product details
    try {
        $sql = $db->prepare("SELECT * FROM bookings WHERE booker_id = :booker_id AND musician_id = :musician_id");
        $sql->bindParam(':booker_id', $booker_id);
        $sql->bindParam(':musician_id', $musician_id);
        $sql->execute();
        $bookings = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
        {
            $table = "<table class='table'>" . PHP_EOL;
            $table .= "<tr><th>Bookings</th></tr>";
            foreach ($bookings as $b) {
                $table .= "<tr><td>" . $b['booking_id'] . "</td><td>" . $b['booking_date'] . "</td><td>" . "$" . $b['pay'] . $b['number_of_hours'] . "</td>";
                //$table .= "<td><img src='images/" . $prod['image'] . "'></td>";
                //$table .= "<td><a href='prodcrud.php?action=Edit&prodID=".$prod['product_id']."&Categories=".$prod['category_id']."'>Edit</a> | <a href='prodcrud.php?action=Delete&prodID=".$prod['product_id']."'>Delete</a></td></tr>";
            }
            $table .= "</table>";
        } else{
            $table = "You have no bookings at this time.";
        }

        return $table;
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to add new data to the db
    }
}

