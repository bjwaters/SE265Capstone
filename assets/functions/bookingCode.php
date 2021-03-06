<?php
//Booking functions

//Function to add a new booking to the bookings table
function newBooking($db, $booker_id, $musician_id, $booking_date, $hours, $pay, $status){
    try{
        $sql = $db->prepare("INSERT INTO bookings VALUES (null, :booker_id, :musician_id, :booking_date, :hours, :pay, :status)");
        $sql->bindParam(':booker_id', $booker_id);
        $sql->bindParam(':musician_id', $musician_id);
        $sql->bindParam(':booking_date', $booking_date);
        $sql->bindParam(':hours', $hours);
        $sql->bindParam(':pay', $pay);
        $sql->bindParam(':status', $status);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        //Error message if it fails to access the db
        die("There was a problem adding the record.");
    }
}

//This function updates a booking status for a specific booking in the bookings table
function updateBookingStatus($db, $booking_id, $status){
    try {
        $sql = $db->prepare("UPDATE bookings SET status = :status WHERE booking_id = :booking_id");
        $sql->bindParam(':booking_id', $booking_id);
        $sql->bindParam(':status', $status);
        $sql->execute();
        
        return $sql->rowCount() . " row updated";
    } catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem updating the record.");
    }
}

//This function updates a booking status for a specific booking in the bookings table
function getOneBooking($db, $booking_id){
    try {
        $sql = $db->prepare("SELECT * FROM bookings WHERE booking_id = :booking_id");
        $sql->bindParam(':booking_id', $booking_id);
        $sql->execute();
        $booking = $sql->fetch(PDO::FETCH_ASSOC);

        return $booking;

    } catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem updating the record.");
    }
}

//This function updated the booking details for a specific booking
function updateBooking($db, $booking_id, $booking_date, $hours, $pay, $status){  //Function to update a booking in the bookings table
    try{
        $sql = $db->prepare("UPDATE bookings SET booking_date = :booking_date, number_of_hours = :hours, pay = :pay, status = :status WHERE booking_id = :booking_id"); //sql statement to add placeholders to database
        $sql->bindParam(':booking_id', $booking_id);
        $sql->bindParam(':booking_date', $booking_date);
        $sql->bindParam(':hours', $hours);
        $sql->bindParam(':pay', $pay);
        $sql->bindParam(':status', $status);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        //Error message if it fails to access the db
        die("There was a problem adding the record.");
    }
}

function deleteBooking($db, $booking_id) {
    try{
        $sql = $db->prepare("DELETE FROM bookings WHERE booking_id = :booking_id"); //sql statement to add placeholders to database
        $sql->bindParam(':booking_id', $booking_id);
        $sql->execute();
        return $sql->rowCount() . " rows inserted";
    } catch (PDOException $e) {
        //Error message if it fails to access the db
        die("There was a problem adding the record.");
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

                $table .= "<tr><td><div class='mc-crop-container'><img src = 'assets/uploads/" . $picture . "' onclick='searchProfileClick($profileID)'></div></td>";
                $table .= "<div id='bookingDetails'><td><label>Booking ID:</label><span id='bookingID'> " . $b['booking_id'] . "</span> </td>";
                $table .= "<td><label>Date:</label><span id='bookingDate'> " . $b['booking_date'] . "</span></td>";
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
        //Error message if it fails to access the db
        die("There was a problem deleting the record.");
    }
}

//Function to get all bookings with a status of accepted from the db
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
                        $buttons = "<div><a href = '#' data-toggle='modal' data-target='#bookingUpdateModal' onclick='fillUpdateBookingForm(" . $b['booking_id']. ")'>Update</a> | ";
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
        //Error message if it fails to access the db
        die("There was a problem deleting the record.");
    }
}

//Function to get all bookings with a status of completed from the db
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
        //Error message if it fails to access the db
        die("There was a problem deleting the record.");
    }
}

//Function to get all bookings with a status of canceled from the db
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
        //Error message if it fails to access the db
        die("There was a problem deleting the record.");
    }
}

//Function to bookings based on two userIDs
function getBookingsByIDs($db, $booker_id, $musician_id){
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
                $date =  preg_split('~ ~', $b['booking_date'], PREG_SPLIT_OFFSET_CAPTURE)[0];
                $time = preg_split('~ ~', $b['booking_date'], PREG_SPLIT_OFFSET_CAPTURE)[1];
                $table .= "<tr><td><label>Booking ID:</label> " . $b['booking_id'] . "</td>";
                $table .= "<td><lable>On:</lable> " . $date . "<br><label>At:</label> " . $time . "</td>";
                $table .= "<td><label>Total: $</label>" . $b['pay'] . "</td>";
            }
            $table .= "</table>";
        } else{
            $table = "You have no bookings with this user at this time.";
        }

        return $table;
    }
    catch (PDOException $e){
        //Error message if it fails to access the db
        die("There was a problem getting the record.");
    }
}