<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 1/14/2018
 * Time: 1:09 PM
 */
?>

<form method = 'get' action = "#">

    Reporting form: <br><br>

    Nature of problem: <input type="text" name="ReportType" /> <br><br>
    Details:<br> <textarea name="details" rows="5" cols="40"></textarea><br><br>

    <input type="checkbox" name="Resolved" value="Yes"> Resolved<br>
    <input type = "submit" name = "action" value = "Report" /><br><br>
    <input type = "submit" name = "action" value = "Back to User Page" />

</form>

<!-- This is going to be available for everyone, to be seen on the admin's side

The complainer's ID will be automatically supplied, as will the time of the report
A resolved data field will be hidden to normal users and usable by the admins
-->