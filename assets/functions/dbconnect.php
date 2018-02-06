<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/22/2018
 * Time: 5:24 PM
 */


function dbConnect()
{
    $dsn = "mysql:host=localhost; dbname=capstone";
    $username = "bjwaters";
    $password = "php";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        //Error message
        die("There was a problem connection to the database.");
    }
}
