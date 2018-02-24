<?php

function dbConn() //function to connect to database
{
    $dsn = "mysql:host=localhost; dbname=capstone"; //saves info to separate variables for security
    $username = "jbrandt";
    $password = "php";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("There was a problem connecting to the db."); //error message if it fails to connect
    }
}
