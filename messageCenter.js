
//Function called when profileTabs page is loaded
function messageCenterEvents(){

    getTodaysDate();

    $userID = $('#hiddenUserID').val();
    $userType = $('#hiddenUserType').val();
    $profileID = $('#hiddenID').val();

    if($userType == 'Booker'){
        $bID = $userID;
        $mID = $profileID;
    } else if ($userType == 'Musician') {
        $mID = $userID;
        $bID = $profileID;
    }

    console.log($bID);
}

//This gets the musician's hourly rate from their profile and  updates the booking form based on user input
function getTotal(){
    $hours =  $('#booking-hours').val();
    $hourlyRate = $('#profileRate').text();
    console.log($hourlyRate);
    if($hours.length != 0){
        $total = parseFloat($hourlyRate) * parseFloat($hours);
    } else {
        $total = 0;
    }

    $('#booking-total').val($total);
}

//Function to get the current date and disable past dates on the booking form date-picker
function getTodaysDate(){
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth()+1;
    if(month < 10)
    {
        month = '0' + month;
    }
    var day = today.getDate();
    if(day < 10)
    {
        day = '0' + day;
    }

    var today = year+'-'+month+'-'+day;

    $('#booking-date').attr('min', today);
}

//This function updates the content for the messages link on the nav bar
function getMessages(){
    $.get("indexLog.php?action=getMessages&bookerID="+$bID+"&musicianID="+$mID, function(messages) {
        $("#allMessages").html( messages);
    });
}

//This function updates the content for the bookings link on the nav bar
function getBookings(){
    $.get("indexLog.php?action=getBookings&bookerID="+$bID+"&musicianID="+$mID, function(bookings) {
        $("#allBookings").html(bookings);
    });
}

//This function sends a message from the messages tab on a profile page
function sendMessage(){
    var text = $("#message-text").val();
    if (text.length > 0) {
        var hr = new XMLHttpRequest();
        var url = "indexLog.php";
        var action = "sendMessage"
        var data = "action="+action+"&text="+text+"&bookerID="+$bID+"&musicianID="+$mID;

        hr.open("POST", url, true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        hr.onreadystatechange = function(){
            if (hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                console.log("return data:" + return_data);
            }
        };
        hr.send(data);
        getMessages();
        $("#message-text").val('');
    }
}

//This function creates a new booking request from the bookings tab on a profile page
function sendBooking(){

    var requiredCheck = true;
    var errorMsg = '';

    $('#booking-errors').val('');
    var date = $("#booking-date").val();
    var time = $("#booking-time").val();
    var hours = $("#booking-hours").val();
    var pay = $("#booking-total").val();
    var text = $("#booking-text").val();

    console.log('Time: ' + time);

    if(time.length == 0 || time == undefined || time == "00:00"){
        requiredCheck = false;
        errorMsg += "Time is a required field. Ex: 1:00 PM"
    }

    if(requiredCheck == true) {
        var date = date + ' ' + time;
        if (text.length == 0) {
            text = "";
        }

        var hr = new XMLHttpRequest();
        var url = "indexLog.php";
        var action = "requestBooking"
        var data = "action=" + action + "&date=" + date + "&hours=" + hours  + "&pay=" + pay + "&text=" + text + "&bookerID="+$bID+"&musicianID="+$mID;

        hr.open("POST", url, true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        hr.onreadystatechange = function(){
            if (hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                console.log("return data:" + return_data);
            }
        };
        hr.send(data);
        getBookings();
        $("#booking-date").val('');
        $("#booking-hours").val('');
        $("#booking-pay").val('');
        $("#booking-text").val('');
        $("#booking-total").val('');

    } else {
        $('#booking-errors').html(errorMsg);
        console.log(errorMsg);
    }
}

//This function is called when the modalBookingUpdateForm is loaded
function modalBookingEvents(){
    getTodaysDate();
}

//This function populates the update booking modal
function fillUpdateBookingForm(bookingID) {

    $.get( "indexLog.php?action=getOneBooking&bookingID="+bookingID, function(booking) {
        var details = JSON.parse(booking);

        var fullDate = details['booking_date'];
        var hours = details['number_of_hours'];

        var date =  fullDate.split(" ")[0];
        var time = fullDate.split(" ")[1];
        var pay = "10";

        $("#m-booking-date").val(date);
        $("#m-booking-total").val(pay);
        $("#m-booking-time").val(time);
        $("#m-booking-hours").val(hours);
        $("#hiddenID").val(bookingID);

    });
}

//This function sends the data to update an existing booking
function updateBooking(){

    var bookingID = $("#hiddenID").val();
    var date = $("#m-booking-date").val();
    var time = $("#m-booking-time").val();
    var hours = $("#m-booking-hours").val();
    var pay = $("#m-booking-total").val();
    var text = $("#m-booking-text").val();

    var date = date + ' ' + time;
    if (text.length == 0) {
        text = "";
    }

    var hr = new XMLHttpRequest();
    var url = "indexLog.php";
    var action = "updateBooking"
    var data = "action=" + action + "&bookingID=" + bookingID + "&date=" + date + "&hours=" + hours  + "&pay=" + pay + "&text=" + text;

    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    hr.onreadystatechange = function(){
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            console.log("return data:" + return_data);
        }
    };
    hr.send(data);
}
