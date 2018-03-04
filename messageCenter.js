$(document).ready(function() {

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


  /*  $bID = getUrlParameter('bookerID');
    $mID = getUrlParameter('musicianID');
    console.log($bID);
    console.log($mID);*/
    debugger;
    getTodaysDate();
});



/*
    $(function(){



});*/

function getTotal(){
    $hours =  $('#booking-hours').val();
    if($hours.length != 0){
        $hourlyRate = 24;
        $total = $hourlyRate * parseFloat($hours);
    } else {
        $total = 0;
    }

    $('#booking-total').val($total);
}

function getTodaysDate(){

    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth()+1;
    if(month < 10)
    {
        month = '0' + month;
    }
    var day = today.getDate();

    var today = year+'-'+month+'-'+day;

    $('#booking-date').attr('min', today);

}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function getMessages(){
    $.get( "indexLog.php?action=getMessages&bookerID="+$bID+"&musicianID="+$mID, function( messages ) {
        $( "#allMessages" ).html( messages );
    });
}

function getBookings(){
    $.get( "indexLog.php?action=getBookings&bookerID="+$bID+"&musicianID="+$mID, function( bookings ) {
        $( "#allBookings" ).html( bookings );
    });
}

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


function sendBooking(){

    var date = $("#booking-date").val();
    var time = $("#booking-time").val();
    var hours = $("#booking-hours").val();
    var pay = $("#booking-total").val();
    var text = $("#booking-text").val();

    var date = date + ' ' + time;
    if (text.length == 0) {
        text = "";
    }
    console.log(date);
    console.log(hours);
    console.log(pay);
    console.log(text);

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
}




