
//Watching the events for stuff to happen, namely with the search, login, and logup buttons
function events(){


    $("#simpleSearchButtonNotLogged").on("click", simpleSearchNotLogged);
    $("#simpleSearchButtonLogged").on("click", simpleSearchLogged);

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

    //console.log(vars);

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
                    $('#phpresults').html("<div class=\"container my-4 col-4 px-3\">" + return_data + "</div>");
                    console.log("Log in failed");

                    var pasteForm = "<div class=\"container my-4 border col-4\">\n" +
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
                    $('#phpresults').html("<div class=\"container my-4 col-4\"> Your account is locked. You cannnot sign in. </div>");
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

//Adds a layer of redundancy for the login when the first time fails
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

    //console.log(vars);

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            if (return_data == "Administrator") {

            }
            else {
                if (~return_data.indexOf("Error")) //Checks if the word error is in the return data
                {
                    console.log(return_data);
                    $('#phpresults').html("<div class=\"container my-4 col-4\">" + return_data + "</div>");

                    var pasteForm = "<div class=\"container my-4 border col-4\">\n" +
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
                else if(~return_data.indexOf("LOCKOUT"))
                {
                    $('#phpresults').html("<div class=\"container my-4 col-4\"> Your account is locked. You cannnot sign in. </div>");
                    console.log("Log in failed");
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


//Logout code, destroys the current session
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


//Code for the signing up of a new user
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
                $('#phpresults').html("<div class=\"container my-4 col-4\">" + return_data + "</div>");

                var signUpForm = "<div class=\"container my-4 border col-4\">\n" +
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


//Code for signing up when the first time fails
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
                $('#phpresults').html("<div class=\"container my-4 col-4\">" + return_data + "</div>");

                var signUpForm = "<div class=\"container my-4 border col-4\">\n" +
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

//Code to allow the form for admin creation
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

//code to actually call the function which adds the new admin
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

//Called to get the edit profile php code, returns the form with values in it
function editProfile()
{
    $("#phpresults").html("");
    $('#stateProfiles').html("");
    $('#editProfile').html("");
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

//Called to get the public profile php code, also returns a form with values in it
function publicProfile()
{

    console.log("In public profile");
    $("#phpresults").html("");
    $('#editProfile').html("");
    $('#editProfile').hide();
    $('#stateProfiles').html("");
    $('#mcOutput').html("");
    $('#resultDiv').html("");

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

//This code changes the status of the current profile, only available to admins
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

//Showing the advanced search options, used when logged in
function showAdvancedSearch()
{
    $('#editProfile').html("");
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "showAdvancedSearch";

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
}

//Showing the advanced search when not logged in
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

//Calls the function which does a search by location, logged in
function simpleSearchLogged(e)
{
    e.preventDefault();
    console.log("simple search, logged");
    $('#stateProfiles').html("");
    $('#resultDiv').html("");
    $('#mcOutput').html("");

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

    showAdvancedSearch();
}



//Simple search based on location when not logged in
function simpleSearchNotLogged(e)
{
     e.preventDefault();
     console.log("Simple search, not logged.");
     $('#shuffledProfiles').html("");
     $('#resultDiv').html("");

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
            //$("#contentOutput").load('assets/forms/searchForm.html');
            $("#phpresults").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing simple unlogged searching..");

    showAdvancedSearchNotLogged();
}

function advancedChoice()
{
    if (!document.getElementById("simpleSearchButtonNotLogged")) {
        advancedSearch();
    }
    else {
        advancedSearchNotLogin();
    }
}

//Code for the advanced searching method, when logged in
function advancedSearch()
{
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

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#phpresults").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing advanced search..");
}

//code for the advanced searching method, when not logged in
function advancedSearchNotLogin()
{
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

//This shows the account settings form
function accountSettingsForm()
{

    $('#editProfile').html("");
    $('#editProfile').hide();
    $('#stateProfiles').html("");
    $('#mcOutput').html("");
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
            $("#contentOutput").html(return_data);
        }
    };

    hr.send(vars);
    console.log("Processing account settings..");
}

//This calls the function to change a user's account settings
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
    $('#editProfile').html("");
    $('#editProfile').hide();
    $('#phpresults').html("");
    $('#phpresults').hide();

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "reportForm";
    $('#stateProfiles').html("");
    $('#mcOutput').html("");
    $('#resultDiv').html("");

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

//sends the report form's data
function reportIssues()
{
    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "reportIssues";
    var type = $("#reportType").val();
    var details = $("#reportDetails").val();

    var vars = "action=" + action + "&reportType=" + type + "&reportDetails=" + details;

    //console.log(vars);

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

//Chooses which searchprofileclick function to use, based on the nav bar
function profileClickChoice(id)
{

    if (!document.getElementById("simpleSearchButtonNotLogged")) {
        //console.log("Is logged.")
        searchProfileClick(id);
    }
    else {
        //console.log("Not logged");
        searchProfileClickNotLogged(id);
    }
}

//Going to a user's profile page from the search when  logged in
function searchProfileClick(id)
{
    $("#phpresults").html("");
    $('#stateProfiles').html("");
    $('#resultDiv').html("");
    $('#mcOutput').html("");

    var userID = id;


    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "searchResultClick";

    var vars = "action=" + action + "&profileID=" + userID;


    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };
    hr.send(vars);
    console.log("Processing search result click (logged)..");
}

//Going to a user's profile page from the search when not logged in
function searchProfileClickNotLogged(id)
{
    $("#phpresults").html("");
    $('#shuffledProfiles').html("");
    $('#resultDiv').html("");

    var userID = id;


    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "searchResultClick";

    var vars = "action=" + action + "&profileID=" + userID;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            $("#contentOutput").html(return_data);
        }
    };
    hr.send(vars);
    console.log("Processing search result click (not logged)..");
}

//Chooses which history choice to use based on nav bar
function searchHistoryChoice()
{

    if (!document.getElementById("simpleSearchButtonNotLogged")) {
        //console.log("Is logged.")
        searchHistory();
    }
    else {
        //console.log("Not logged");
        searchHistoryNotLogged();
    }
}

//Search history option for logged in
function searchHistory()
{

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "Back to Search Page";

    var vars = "action=" + action;


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
    console.log("Processing back button (logged)..");
}

//Search history function for not logging in
function searchHistoryNotLogged()
{
    console.log("Burp");

    var hr = new XMLHttpRequest();
    var url = "indexNotLog.php";
    var action = "Back to Search Page";

    var vars = "action=" + action;

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
    console.log("Processing back button (not logged)..");
}

//Admin function for checking unresolved reports
function checkReports(){

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "checkReports";

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var vars = "action=" + action;

    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {

            var return_data = hr.responseText;
            $('#phpresults').html(return_data);
        }
    };

    hr.send(vars);
    console.log("Checking reports..");
}

//Taking the reports which are checked and resolving them
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
    valArray = valArray.filter(function(e){return e});


    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var vars = "action=" + action + "&counter=" + count + "&valArray=" + valArray;

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

//Clears the screen
function returnToStart()
{
    $("#phpresults").html("");
    $("#contentOutput").html("");
}

//At the start
$(document).ready(function(){

    events();

});