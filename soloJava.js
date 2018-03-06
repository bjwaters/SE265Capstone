
//Watching the events for stuff, some things in here outdated
function events(){


    $("#simpleSearchButtonNotLogged").on("click", simpleSearchNotLogged);
    $("#simpleSearchButtonNotLogged").on("click", showAdvancedSearchNotLogged);

    $("#simpleSearchButtonLogged").on("click", simpleSearchLogged);
    $("#simpleSearchButtonLogged").on("click", showAdvancedSearch);

    $("#modalLogin").on("click", loginClicks);
    $("#modalSignUp").on("click", signUpClicks);

}


//Calls the php function that logs you in and returns your user type
function loginClicks()
{
    $("#phpresults").html("");
    $("#contentOutput").html("");

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
            if(return_data == "Administrator")
            {
                //$("#contentOutput").html('admin boop');
            }
            else
            {
                if(~return_data.indexOf("Error")) //Checks if the word error is in the return data
                {
                    $('#phpresults').html(return_data);
                    console.log("Log in failed");

                    var pasteForm = "<div class=\"container\">\n" +
                        "    <div class=\"row\">\n" +
                        "    <form method = 'post' action = \"#\">\n" +
                        "\n" +
                        "        Sign In: <br>\n" +
                        "\n" +
                        "        Email Address: <input type=\"text\" name=\"signInEmail\" id=\"signInEmail\" /> <br>\n" +
                        "        Password: <input type=\"text\" name=\"signInPassword\" id=\"signInPassword\"/><br>\n" +
                        "        <button type=\"button\" id = \"manualLogin\" class=\"btn btn-secondary\" value = \"backup\" onclick=\"backupLoginClicks()\" >Log Me In</button>\n" +
                        "    </form>\n" +
                        "    </div>\n" +
                        "</div>"

                    $('#contentOutput').html(pasteForm);
                    $('#shuffledProfiles').html("");
                }
                else if(~return_data.indexOf("LOCKOUT"))
                {
                    $('#phpresults').html("Your account is locked. You cannnot sign in.");
                    console.log("Log in failed");
                }
                else
                {
                    console.log(return_data);
                    window.location.href = "indexLog.php";
                    console.log("Log in successful");
                }
            }
        }
    };

    hr.send(vars);
    console.log("Processing login..");

}

//Redundant, but necessary for now
function backupLoginClicks()
{
    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "logmein";
    var backupEmail = $('#signInEmail').val();
    var backupPassword = $('#signInPassword').val();
    var vars = "action=" + action + "&email=" + backupEmail + "&password=" + backupPassword;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            if (return_data == "Administrator") {
                $("#contentOutput").html('admin boop');

            }
            else {
                if (~return_data.indexOf("Error")) //Checks if the word error is in the return data
                {
                    console.log(return_data);
                    $('#phpresults').html(return_data);

                    var pasteForm = "<div class=\"container\">\n" +
                        "    <div class=\"row\">\n" +
                        "    <form method = 'post' action = \"#\">\n" +
                        "\n" +
                        "        Sign In: <br>\n" +
                        "\n" +
                        "        Email Address: <input type=\"text\" name=\"signInEmail\" id=\"signInEmail\" /> <br>\n" +
                        "        Password: <input type=\"text\" name=\"signInPassword\" id=\"signInPassword\"/><br>\n" +
                        "        <button type=\"button\" id = \"manualLogin\" class=\"btn btn-secondary\" value = \"backup\" onclick=\"backupLoginClicks()\" >Log Me In</button>\n" +
                        "    </form>\n" +
                        "    </div>\n" +
                        "</div>"
                    $('#contentOutput').html(pasteForm);
                }
                else {
                    console.log(return_data);
                    window.location.href = "indexLog.php";
                    console.log("Log in successful");
                }
            }
        }
    };

    hr.send(vars);
    console.log("Processing login..");
}


//Logout code
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

    var vars = "action=" + action + "&newUserEmail=" + newUserEmail + "&newUserPassword=" + newUserPassword
        + "&newUserPassword2=" + newUserPassword2 + "&userType=" + userType;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            console.log(return_data);
           // $("#phpresults").html(return_data);

            if (~return_data.indexOf("Error")) //Checks if the word error is in the return data
            {
                console.log(return_data);
                $('#phpresults').html(return_data);

                var signUpForm = "<div class=\"container\">\n" +
                    "    <div class=\"row\">\n" +
                    "    <form method = 'post' action = \"#\">\n" +
                    "\n" +
                    "        Sign In: <br>\n" +
                    "\n" +
                    "        Email Address: <input type=\"text\" name=\"newEmail\" id=\"newEmail\" /> <br>\n" +
                    "        Password: <input type=\"text\" name=\"newPassword\" id=\"newPassword\"/><br>\n" +
                    "        Retype Password:  <input type=\"text\" name=\"newPassword2\" id=\"newPassword2\"/></n>" +
                    "        <button type=\"button\" id = \"manualSignUp\" class=\"btn btn-secondary\" value = \"backup\" onclick=\"backupSignupClicks()\" >Sign Me Up</button>\n" +
                "    </form>\n" +
                "    </div>\n" +
                "</div>"

                $('#contentOutput').html(signUpForm);
                $('#shuffledProfiles').html("");
            }
            else {
                console.log(return_data);
                window.location.href = "indexLog.php";
                console.log("Log in successful");
            }
        }
    };

    hr.send(vars);
    console.log("Processing signup..");

}


function backupSignupClicks(){

    console.log("In SignupClicks");

    $("#phpresults").html("");

    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "signMeUp";

    var newUserEmail = $('#newUserEmail').val();
    var newUserPassword = $('#newUserPassword').val();
    var newUserPassword2 = $('#newUserPassword2').val();

    var userType = $('input[name=options]:checked').val();
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

            if (~return_data.indexOf("Error")) //Checks if the word error is in the return data
            {
                console.log(return_data);
                $('#phpresults').html(return_data);

                var signUpForm = "<div class=\"container\">\n" +
                    "    <div class=\"row\">\n" +
                    "    <form method = 'post' action = \"#\">\n" +
                    "\n" +
                    "        Sign In: <br>\n" +
                    "\n" +
                    "        Email Address: <input type=\"text\" name=\"newEmail\" id=\"newEmail\" /> <br>\n" +
                    "        Password: <input type=\"text\" name=\"newPassword\" id=\"newPassword\"/><br>\n" +
                    "        Retype Password:  <input type=\"text\" name=\"newPassword2\" id=\"newPassword2\"/></n>" +
                    "        <button type=\"button\" id = \"manualSignUp\" class=\"btn btn-secondary\" value = \"backup\" onclick=\"backupSignupClicks()\" >Sign Me Up</button>\n" +
                "    </form>\n" +
                "    </div>\n" +
                "</div>"

                $('#contentOutput').html(signUpForm);

            }
            else {
                console.log(return_data);
                window.location.href = "indexLog.php";
                console.log("Log in successful");
            }
        }

    };

    hr.send(vars);
    console.log("Processing signup..");

}

function createAdmin()
{

    $("#phpresults").html("");
    console.log("In create admin");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "createAdmin";

    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing admin creation form..");
}

function adminEntry()
{

    $("#phpresults").html("");
    console.log("In create admin");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "adminEntry";
    var adminEmail = $('#newAdminEmail').val();
    var adminPass1 = $('#newAdminPassword').val();
    var adminPass2 = $('#newAdminPassword2').val();

    var vars = "action=" + action + "&adminEmail=" + adminEmail + "&adminPass1=" + adminPass1 + "&adminPass2=" + adminPass2;

    console.log(vars);

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing admin addition..");
}

//Called to get the edit profile php code, returns the form with values in it(?!)
function editProfile()
{
    $("#phpresults").html("");
    $('#stateProfiles').html("");
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
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing edit..");

}

//Called to get the public profile php code, also returns a form with values in it(?!)
function publicProfile()
{

    console.log("In public profile");
    $("#phpresults").html("");
    $('#editProfile').html("");
    $('#stateProfiles').html("");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "Public Profile";

    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing public..");

}


function changeProfileStatus()
{
    $("#phpresults").html("");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "saveStatus";
    var profileStatus =  $('input[name=profileStatus]:checked').val();
    var user_id =  $('#hiddenID').val();

    var vars = "action=" + action + "&user_id=" + user_id + "&profileStatus=" + profileStatus;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            console.log(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing profile status..");
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
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
}

function showAdvancedSearchNotLogged()
{
    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "showAdvancedSearch";

    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
}

function simpleSearchLogged(e)
{
    e.preventDefault();
    console.log("simple search, logged");
    $('#stateProfiles').html("");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "simpleSearch";
    var term = $('#simpleSearchLocationLogged').val();

    var vars = "action=" + action  + "&term=" + term;

    console.log("vars are " + vars);

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#phpresults").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing simple logged searching..");
}



//Simple search result from the main navbar
function simpleSearchNotLogged(e)
{
     e.preventDefault();
     console.log("Simple search, not logged.");
     $('#shuffledProfiles').html("");

    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "simpleSearch";
    var term = $('#simpleSearchLocationNotLogged').val();

    var vars = "action=" + action + "&term=" + term;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //$("#contentOutput").load('assets/forms/SearchForm.html');
            $("#phpresults").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing simple unlogged searching..");
}

function advancedChoice()
{
    if (!document.getElementById("simpleSearchButtonNotLogged")) {
        //console.log("Is logged.")
        advancedSearch();
    }
    else {
        //console.log("Not logged");
        advancedSearchNotLogin();
    }
}

//Code for the advanced searching method
function advancedSearch()
{
    console.log("In advanced search");
    $('#resultDiv').html("");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "advancedSearch";

    var searchName = $('#searchName').val();
    var searchCity = $('#searchCity').val();
    var searchState = $('#stateSearch_drop').val();
    var searchAvailability = $('#searchAvailability').val();
    var genreSearch_drop = $('#genreSearch_drop').val();
    var searchPayRate1 = $('#searchPayRate1').val();
    var searchPayRate2 = $('#searchPayRate2').val();
    var status = $('input[name=profileStatus]:checked').val()

    var vars = "action=" + action + "&searchName=" + searchName + "&searchCity=" + searchCity
        + "&searchState=" + searchState + "&searchAvailability=" + searchAvailability + "&genreSearch_drop="
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

function advancedSearchNotLogin()
{
    console.log("In advanced search");
    $('#resultDiv').html("");

    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "advancedSearch";

    var searchName = $('#searchName').val();
    var searchCity = $('#searchCity').val();
    var searchState = $('#stateSearch_drop').val();
    var searchAvailability = $('#searchAvailability').val();
    var genreSearch_drop = $('#genreSearch_drop').val();
    var searchPayRate1 = $('#searchPayRate1').val();
    var searchPayRate2 = $('#searchPayRate2').val();
    var status = $('input[name=profileStatus]:checked').val()

    var vars = "action=" + action + "&searchName=" + searchName + "&searchCity=" + searchCity
        + "&searchState=" + searchState + "&searchAvailability=" + searchAvailability + "&genreSearch_drop="
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


function accountSettingsForm()
{
    $('#stateProfiles').html("");
    $('#phpresults').html("");
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "accountSettingsForm";

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
    console.log("Processing account settings..");
}

function accountSettingsSet()
{
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "accountSettingsSet";
    var email1 = $('#accountEmail').val();
    var email2 = $('#accountEmail2').val();
    var pass1 = $('#newPassword').val();
    var pass2 = $('#newPassword2').val();

    var vars = "action=" + action + "&email1=" + email1 + "&email2=" + email2 +"&pass1=" + pass1 + "&pass2=" + pass2;

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
    console.log("Processing account settings..");

}

//Displays the report form
function reportForm()
{
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "reportForm";
    $('#stateProfiles').html("");

    var vars = "action=" + action;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing report form..");
}

//sends the report form
function reportIssues()
{
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "reportIssues";
    var type = $("#reportType").val();
    var details = $("#reportDetails").val();

    var vars = "action=" + action + "&reportType=" + type + "&reportDetails=" + details;

    console.log(vars);

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            console.log("Return data: " + return_data);
            $('#phpresults').html("Report sent.")
        }
    };

    hr.send(vars);
    console.log("Processing issue form..");

}

function searchProfileClick(id)
{
    $("#phpresults").html("");
    $('#stateProfiles').html("");
    $('#mcOutput').html("");

    var userID = id;


    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "searchResultClick";

    var vars = "action=" + action + "&profileID=" + userID;

    console.log("Vars is " + vars);

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };
    hr.send(vars);
    console.log("Processing search result click..");
}

function searchProfileClickNotLogged(id)
{
    $("#phpresults").html("");
    $('#shuffledProfiles').html("");

    var userID = id;


    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "searchResultClick";

    var vars = "action=" + action + "&profileID=" + userID;

    console.log("Vars is " + vars);

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };
    hr.send(vars);
    console.log("Processing search result click..");
}

function searchHistory()
{
    console.log("Burp");

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "Back to Search Page";

    var vars = "action=" + action;

    console.log("Vars is " + vars);

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
            $("#phpresults").html("");
        }
    };
    hr.send(vars);
    console.log("Processing back button..");
}

function checkReports(){

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "checkReports";

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var vars = "action=" + action;
    console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            $('#contentOutput').html(return_data);
        }
    };

    hr.send(vars);
    console.log("Checking reports..");
}

function changeReportStatus()
{
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "changeReportStatus";
    var count = $('#counter').val();

    var valArray = Array();
    var loop;
    for(loop = 0; loop < count; loop++)
    {
        if($("#" + loop).is(':checked')) {
            valArray[loop] = $("#" + loop).val();
        }
    }
    //console.log(valArray);
    valArray = valArray.filter(function(e){return e});
    //console.log(valArray);


    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var vars = "action=" + action + "&counter=" + count + "&valArray=" + valArray;
    console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            $('#contentOutput').html(return_data);
            //console.log("Return data is: " + return_data);
        }
    };

    hr.send(vars);
    console.log("Updating reports..");
}


function returnToStart()
{
    $("#phpresults").html("");
    $("#contentOutput").html("");
}

//At the start
$(document).ready(function(){

    events();
    /*
    input = $('#myelement');
    for (var i = 0 ; i < input.length; i++) {
    input[i].addEventListener("change" , fileFunction );
    }
    */

});