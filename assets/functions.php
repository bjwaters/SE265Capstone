<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/19/2018
 * Time: 6:48 PM
 */

function searchTable()
{
    $table = "<table><br>";

    $table .= "<thead><th>Name</th><th>Link</th></thead>";
    $table .= "<tr><td>Bob </td><td>This will be a link to Bob's profile. </td></tr>";
    $table .= "<tr><td>Joe </td><td>This will be a link to Joe's profile. </td></tr>";

    $table .= "</table>";

    echo $table;
}

function requestTable()
{
    $table = "<table><br>";

    $table .= "<thead><th>Requests</th><th>User</th><th>Request</th></thead>";
    $table .= "<tr><td>Bob </td><td>This will be a link to Bob's profile. </td><td><?php include_once(\"assets/reviewRequestForm.php\"); ?></td></tr>";
    $table .= "<tr><td>Joe </td><td>This will be a link to Joe's profile. </td></tr>";
    $table .= "</table>";

    echo $table;
}
?>