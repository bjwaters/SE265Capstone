
//Watching the events for stuff, some things in here outdated
function events(){

    //$("#modalLogin").on("click", function(){alert("Log in clicked")})
    $("#modalLogin").on("click", loginClicks);
    $("#modalSignUp").on("click", signUpClicks);

    /*
    input = $('#file');
    for (var i = 0 ; i < input.length; i++) {
        input[i].addEventListener("change" , fileFunction );
    }
    */
}


//Calls the php function that logs you in and returns your user type
function loginClicks()
{
    $("#phpresults").html("");
    $("#contentOutput").html("");

    //console.log("In Loginclicks " + $('#modalSignInEmail').val() + " " + $('#modalSignInPassword').val());
    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "logmein";
    var email = $('#modalSignInEmail').val();
    var password = $('#modalSignInPassword').val();
    var vars = "action=" + action + "&email=" + email + "&password=" + password;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            console.log("Return data: " + return_data);
            if(return_data == "Administrator")
            {
                $("#contentOutput").html('admin boop');

            }
            else
            {
                if(return_data.length > 0)
                {
                    window.location.href = "indexLog.php";
                    console.log("Log in successful");
                }
                else
                {
                    console.log("Log in failed");
                }
            }
        }
    };

    hr.send(vars);
    console.log("Processing login..");

}

function logoutClicks()
{
    $("#phpresults").html("");
    $("#contentOutput").html("");
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "logmeout";
    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            console.log("Return data: " + return_data);
            window.location.href = "indexNotLog.php";
        }
    };

    hr.send(vars);
    console.log("Logging out..");
}

//Code for the advanced searching method
function signUpClicks()
{
    console.log("In SignupClicks");

    $("#phpresults").html("");

    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "signMeUp";

    var newUserEmail = $('#newUserEmail').val();
    var newUserPassword = $('#newUserPassword').val();
    var newUserPassword2 = $('#newUserPassword2').val();

    var userType = $('input[name=options]:checked').val()
    //var userType = $('#userType').val();

    var vars = "action=" + action + "&newUserEmail=" + newUserEmail + "&newUserPassword=" + newUserPassword
        + "&newUserPassword2=" + newUserPassword2 + "&userType=" + userType;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            console.log(return_data);
            $("#phpresults").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing signup..");

}


//Called to get the edit profile php code, returns the form with values in it(?!)
function editProfile()
{

    $("#phpresults").html("");
    console.log("In edit profile");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "EditProfile";


    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //console.log(return_data);
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing edit..");

}

/*
function saveEdit()
{
    console.log("Save edit clicked");
    $("#phpresults").html("");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "Save Edit";

    var editUserID = $('#user_id').val();
    var editUserName= $('#userName').val();
    var editLocation = $('#location').val();
    var editRadius = $('#radius').val();
    var editPay = $('#pay').val();
    var editAvailability= $('#availability').val();
    var editComments= $('#comments').val();
    var editVideoLink= $('#videoLink').val();
    var editProfileStatus = $('input[name=profileStatus]:checked').val();
    var editGenre = $('#genre_drop').val();
    var editFile = $('#file').val();
    //var editFile = $_FILES['file']['name'];

    console.log(editFile);

    var vars = "action=" + action + "&editUserID=" + editUserID + "&editUserName=" + editUserName + "&editLocation=" + editLocation
        + "&editRadius=" + editRadius + "&editPay=" + editPay + "&editAvailability=" + editAvailability
        + "&editComments=" + editComments + "&editProfileStatus=" + editProfileStatus
        + "&editGenre=" + editGenre + "&editFile=" + editFile + "&editVideoLink=" + editVideoLink;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //console.log(return_data);
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing edit save..");
}

*/

//Called to get the public profile php code, also returns a form with values in it(?!)
function publicProfile()
{

    console.log("In public profile");
    $("#phpresults").html("");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "Public Profile";

    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //console.log(return_data);
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing public..");

}

//Showing the advanced search options, though there's extra text atm
function showAdvancedSearch()
{
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "showAdvancedSearch";

    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //console.log("advanced search return" + return_data);
            /// /$("#contentOutput").load('assets/forms/searchForm.html');
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
}

//Simple search result from the main navbar
function simpleSearch(e)
{
     e.preventDefault();

     //var sessName = '<?php echo $_SESSION['userID']?>';

     //console.log(sessName);

    console.log("In simple search function");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "simpleSearch";
    var term = $('#simpleSearchTerm').val();

    var vars = "action=" + action + "&term=" + term;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log("term is: " + term);
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //$("#contentOutput").load('assets/forms/searchForm.html');
            //console.log(return_data);
            $("#phpresults").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing simple searching..");
}

//Code for the advanced searching method
function advancedSearch()
{
    console.log("In advanced search");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "advancedSearch";

    var searchName = $('#searchName').val();
    var searchLocation = $('#searchLocation').val();
    var searchRadius = $('#searchRadius').val();
    var searchAvailability = $('#searchAvailability').val();
    var genreSearch_drop = $('#genreSearch_drop').val();
    var searchPayRate1 = $('#searchPayRate1').val();
    var searchPayRate2 = $('#searchPayRate2').val();
    var status = $('input[name=profileStatus]:checked').val()

    var vars = "action=" + action + "&searchName=" + searchName + "&searchLocation=" + searchLocation
        + "&searchRadius=" + searchRadius + "&searchAvailability=" + searchAvailability + "&genreSearch_drop="
        + genreSearch_drop + "&searchPayRate1=" + searchPayRate1 + "&searchPayRate2=" + searchPayRate2;

    console.log("vars are: " + vars);
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //console.log(return_data);
            $("#phpresults").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing advanced search..");

}

//Displays the report form
function reportForm()
{
    $("#phpresults").html("");
    var reportString =
        "    <form method = 'post' action = \"#\">\n" +
        "\n" +
        "        Reporting form: <br><br>\n" +
        "\n" +
        "        Nature of problem: <input type=\"text\" id=\"reportType\" /> <br><br>\n" +
        "        Details:<br> <textarea id=\"reportDetails\" rows=\"5\" cols=\"40\"></textarea><br><br>\n" +
        "\n" + " <button type=\"button\" class=\"btn btn-secondary\" onclick='reportIssues()'>Report</button>"
    " </form>"
    $('#contentOutput').html(reportString);
}

//sends the report form
function reportIssues()
{
    $("#phpresults").html("");
    $("#contentOutput").html("");
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "reportIssues";
    var type = $("#reportType").val();
    var details = $("#reportDetails").val();

    var vars = "action=" + action + "&reportType=" + type + "&reportDetails=" + details;

    console.log(vars);
    /*
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            console.log("Return data: " + return_data);
        }
    };

    hr.send(vars);
    console.log("Processing issue form..");
    */
}

function searchProfileClick(id)
{
    $("#phpresults").html("");
    console.log("ID is: " + id);

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "searchResultClick";
    var profileID = id;

    var vars = "action=" + action + "&profileID=" + profileID;

    console.log("Vars is " + vars);

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //console.log(return_data);
            $("#contentOutput").html(return_data);
        }
    };
    hr.send(vars);
    console.log("Processing search result click..");
}

function returnToStart()
{
    $("#phpresults").html("");
    $("#contentOutput").html("");
}


//At the start
$(document).ready(function(){

    events();
    $("#simpleSearchButton").on("click", simpleSearch);
    $("#simpleSearchButton").on("click", showAdvancedSearch);

    /*
    input = $('#myelement');
    for (var i = 0 ; i < input.length; i++) {
    input[i].addEventListener("change" , fileFunction );
    }
    */

    /*
    $('myNavbar').bind("DOMSubtreeModified",function(){
        alert('changed');
    });
    */
});