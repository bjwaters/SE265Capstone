<?php

//Booking functions

function newBooking($db, $booker_id, $musician_id, $booking_date, $hours, $pay, $status){  //Function to add a new user to the users table
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

function updateBooking($db, $booking_id, $musician_id, $booking_date, $hours, $pay, $status){  //Function to add a new user to the users table
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

function getAllBookings($db, $user_id){ //Function to view products in a table with links to edit product details
    try {
        if($_SESSION['userType'] = 'Booker'){
            $sql = $db->prepare("SELECT * FROM bookings WHERE booker_id = :user_id");
        } else {
            $sql = $db->prepare("SELECT * FROM bookings WHERE musician_id = :user_id");
        }

        $sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sql->execute();
        $bookings = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>Bookings</th></tr>";
        foreach ($bookings as $b) {
            $table .= "<tr><td>" . $b['booking_id'] . "</td><td>" . $b['booking_date'] . "</td><td>" . "$" . $b['pay'] . $b['number_of_hours'] . "</td>";
            if($_SESSION['userType'] == 'Booker') {
                $table .= "<td><a href='indextest.php?action=Profile&bookerID=" . $user_id . "&musicianID=" . $b['musician_id']."'>UserID: " . $b['musician_id'] . "</a>";
            } else{
                $table .= "<td><a href='indextest.php?action=Profile&musicianID=" . $user_id . "&bookerID=" . $b['booker_id']."'>UserID: " . $b['booker_id'] . "</a>";
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
        $table = "<table class='table'>" . PHP_EOL;
        $table .= "<tr><th>Bookings</th></tr>";
        foreach ($bookings as $b) {
            $table .= "<tr><td>" . $b['booking_id'] . "</td><td>" . $b['booking_date'] . "</td><td>" . "$" . $b['pay'] . $b['number_of_hours'] . "</td>";
            //$table .= "<td><img src='images/" . $prod['image'] . "'></td>";
            //$table .= "<td><a href='prodcrud.php?action=Edit&prodID=".$prod['product_id']."&Categories=".$prod['category_id']."'>Edit</a> | <a href='prodcrud.php?action=Delete&prodID=".$prod['product_id']."'>Delete</a></td></tr>";
        }
        $table .= "</table>";
        return $table;
    }
    catch (PDOException $e){
        die("There was a problem getting the record."); //Error message if it fails to add new data to the db
    }
}

