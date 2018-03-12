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

//This function updates a booking status for a specific booking in the bookings table
function getOneBooking($db, $booking_id){
    try {
        $sql = $db->prepare("SELECT * FROM bookings WHERE booking_id = :booking_id");
        $sql->bindParam(':booking_id', $booking_id);
        $sql->execute();
        $booking = $sql->fetchAll(PDO::FETCH_ASSOC);
        var_dump($booking);
        return $booking;

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

function deleteBooking($db, $booking_id) {
    try{
        $sql = $db->prepare("DELETE FROM bookings WHERE booking_id = :booking_id"); //sql statement to add placeholders to database
        $sql->bindParam(':booking_id', $booking_id);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        die("There was a problem adding the record."); //Error message if it fails to add new data to the db
    }
}

//This function gets all of the bookings based on each status type for one user
function getAllBookings($db, $user_id){ //

    $bookings = getPendingBookings($db, $user_id);
    $bookings .= getAcceptedBookings($db, $user_id);
    $bookings .= getCompletedBookings($db, $user_id);
    $bookings .= getCanceledBookings($db, $user_id);

    $bookingsDiv = "<div class='container col-7' id='mcOutput'>";
    if(!$bookings == ""){
        $bookingsDiv .= $bookings;
    } else {
        $bookingsDiv .= "You have no bookings at this time";
    }
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

        if($sql->rowCount() > 0){
            $table = "<table class='table'>" . PHP_EOL;
            $table .= "<tr><th>Pending Bookings</th></tr>";
            foreach ($bookings as $b) {
                if($_SESSION['userType'] == 'Booker') {
                    $picture = getProfilePicture($db, $b['musician_id']);
                    $profileID = $b['musician_id'];
                    $buttons = "<div><a href = '#' data-toggle='modal' data-target='#bookingUpdateModal' onclick='fillUpdateBookingForm(" . $b['booking_id']. ")'>Update</a> | ";
                    $buttons .= "<a href = 'indexLog.php?action=deleteBooking&bookingID=" . $b['booking_id'] .  "'>Cancel</a></div>";
                } else {
                    $picture = getProfilePicture($db, $b['booker_id']);
                    $profileID = $b['booker_id'];
                    $buttons = "<div><a href = 'indexLog.php?action=acceptBooking&bookingID=" . $b['booking_id'] .  "'>Accept</a> | ";
                    $buttons .= "<a href = 'indexLog.php?action=declineBooking&bookingID=" . $b['booking_id'] . "&musicianID=" . $b['musician_id'] . "&bookerID=" . $b['booker_id']."' >Decline</a></div>";
                }

                $table .= "<tr><td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' onclick='searchProfileClick($profileID)'></div><div id='profileID' hidden>". $profileID . "</div></td>";
                $table .= "<div id='bookingDetails'><td><label>Booking ID:</label><span id='bookingID'>" . $b['booking_id'] . "</span> </td>";
                $table .= "<td><label>Date:</label><span id='bookingDate'>" . $b['booking_date'] . "</span></td>";
                $table .= "<td><label>Payment Total:</label><span id='bookingPay'> $" . $b['pay'] . "</span></td></div>";
                $table .= "<td>$buttons</td></tr>";
            }
            $table .= "</table>";
        } else {
            $table = "";
        }



        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

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
            if($sql->rowCount() > 0) {
                $table = "<table class='table'>" . PHP_EOL;
                $table .= "<tr><th>Accepted Bookings</th></tr>";
                foreach ($bookings as $b) {
                    if ($_SESSION['userType'] == 'Booker') {
                        $picture = getProfilePicture($db, $b['musician_id']);
                        $profileID = $b['musician_id'];
                        $buttons = "<div><a href = '#' data-toggle='modal' data-target='#bookingUpdateModal' onclick='fillUpdateBookingForm()'>Update</a> | ";
                        $buttons .= "<a href = 'indexLog.php?action=cancelBooking&bookingID=" . $b['booking_id'] . "'>Cancel</a></div>";
                    } else {
                        $picture = getProfilePicture($db, $b['booker_id']);
                        $profileID = $b['booker_id'];
                        $buttons = "<a href = 'indexLog.php?action=cancelBooking&bookingID=" . $b['booking_id'] . "'>Cancel</a></div>";
                    }

                    $table .= "<tr><td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' onclick='searchProfileClick($profileID)'></div></td>";
                    $table .= "<div id='bookingDetails'><td id='bookingID'><label>Booking ID:</label> " . $b['booking_id'] . "</td>";
                    $table .= "<td id='bookingDate'><label>Date:</label> " . $b['booking_date'] . "</td>";
                    $table .= "<td id='bookingPay'><label>Payment Total:</label> $" . $b['pay'] . "</td></div>";
                    $table .= "<td>$buttons</td></tr>";
                }
                $table .= "</table>";
            } else {
                $table = "";
            }
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

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
        if($sql->rowCount() > 0) {
            $table = "<table class='table'>" . PHP_EOL;
            $table .= "<tr><th>Completed Bookings</th></tr>";
            foreach ($bookings as $b) {
                if ($_SESSION['userType'] == 'Booker') {
                    $picture = getProfilePicture($db, $b['musician_id']);
                    $profileID = $b['musician_id'];
                    $buttons = "<div><a href = '#'>Review this user!</a>";
                } else {
                    $picture = getProfilePicture($db, $b['booker_id']);
                    $profileID = $b['booker_id'];
                    $buttons = "<a href = 'indexLog.php?action=cancelBooking&bookingID=" . $b['booking_id'] . "'>Cancel</a></div>";
                }

                $table .= "<tr><td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' onclick='searchProfileClick($profileID)'></div></td>";
                $table .= "<div id='bookingDetails'><td id='bookingID'><label>Booking ID:</label> " . $b['booking_id'] . "</td>";
                $table .= "<td id='bookingDate'><label>Date:</label> " . $b['booking_date'] . "</td>";
                $table .= "<td id='bookingPay'><label>Payment Total:</label> $" . $b['pay'] . "</td></div>";
                $table .= "<td>$buttons</td></tr>";
            }
            $table .= "</table>";
        } else {
            $table = "";
        }
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}

function getCanceledBookings($db, $user_id){
    try {
        if($_SESSION['userType'] == 'Booker'){
            $sql = $db->prepare("SELECT * FROM bookings WHERE booker_id = :user_id AND status = 'canceled'");
        } else {
            $sql = $db->prepare("SELECT * FROM bookings WHERE musician_id = :user_id AND status = 'canceled'");
        }

        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $bookings = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0) {
            $table = "<table class='table'>" . PHP_EOL;
            $table .= "<tr><th>Canceled Bookings</th></tr>";
            foreach ($bookings as $b) {
                if ($_SESSION['userType'] == 'Booker') {
                    $picture = getProfilePicture($db, $b['musician_id']);
                    $profileID = $b['musician_id'];
                    $buttons = "<div><a href = '#'>Review this user!</a>";
                } else {
                    $picture = getProfilePicture($db, $b['booker_id']);
                    $profileID = $b['booker_id'];
                    $buttons = "<a href = 'indexLog.php?action=cancelBooking&bookingID=" . $b['booking_id'] . "'>Cancel</a></div>";
                }

                $table .= "<tr><td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' onclick='searchProfileClick($profileID)'></div></td>";
                $table .= "<div id='bookingDetails'><td id='bookingID'><label>Booking ID:</label> " . $b['booking_id'] . "</td>";
                $table .= "<td id='bookingDate'><label>Date:</label> " . $b['booking_date'] . "</td>";
                $table .= "<td id='bookingPay'><label>Payment Total:</label> $" . $b['pay'] . "</td></div>";
                $table .= "<td>$buttons</td></tr>";
            }
            $table .= "</table>";
        } else {
            $table = "";
        }
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}
/*
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
            if($_SESSION['userType'] == 'Booker') {
                $picture = getProfilePicture($db, $b['musician_id']);
                $profileID = $b['musician_id'];
                $buttons = "<div><a href = '#' data-toggle='modal' data-target='#bookingUpdateModal' onclick='fillUpdateBookingForm()'>Update</a> | <a href = 'indexLog.php?action=deleteBooking&bookingID=" . $b['booking_id'] .  "'>Cancel</a></div>";
            } else {
                $picture = getProfilePicture($db, $b['booker_id']);
                $profileID = $b['booker_id'];
                $buttons = "<div><a href = 'indexLog.php?action=deleteBooking&bookingID=" . $b['booking_id'] .  "'>Cancel</a></div>";
            }

            $table .= "<tr><td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' class='img-thumbs' width='75' onclick='searchProfileClick($profileID)'></div></td>";
            $table .= "<td id='bookingID'>" . $b['booking_id'] . "</td><td id='bookingDate'>" . $b['booking_date'] . "</td><td id='bookingPay'>" . "$" . $b['pay'] . $b['number_of_hours'] . "</td>";
            $table .= "<td>$buttons</td></tr>";
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem deleting the record."); //Error message if it fails to add new data to the db
    }
}*/

/*//This function gets all bookings with a status of complete for the logged in user
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
}*/

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
            $table = "You have no bookings with this user at this time.";
        }

        return $table;
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to add new data to the db
    }
}