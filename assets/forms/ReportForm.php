<?php
/**
 * Created by PhpStorm.
 * User: 001427082
 * Date: 3/1/2018
 * Time: 12:24 PM
 */
?>

<div class="container border my-4 col-5">
    <form method = 'post' action = "#">
     Reporting form: <br><br>
    Nature of problem: <input type=\"text\" name=\"reportType\" id=\"reportType\"/> <br><br>
    Details:<br> <textarea name=\"reportDetails\" id=\"reportDetails\" rows=\"5\" cols=\"40\"></textarea><br><br>
    <button type=\"button\" class=\"btn btn-secondary\" onclick='reportIssues()'>Report</button>
    </form>
</div>