<?php

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function(){

        $bID = getUrlParameter('bookerID');
        $mID = getUrlParameter('musicianID');
        console.log($bID);
        console.log($mID);

        getTodaysDate();

    });

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
        $.get( "indextest.php?action=getMessages&bookerID="+$bID+"&musicianID="+$mID, function( messages ) {
            $( "#allMessages" ).html( messages );
        });
    }

    function getBookings(){
        $.get( "indextest.php?action=getBookings&bookerID="+$bID+"&musicianID="+$mID, function( bookings ) {
            $( "#allBookings" ).html( bookings );
        });
    }

    function sendMessage(){
        var text = $("#message-text").val();
        if (text.length > 0) {
            var hr = new XMLHttpRequest();
            var url = "indextest.php";
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
        var url = "indextest.php";
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



</script>
<div class="container">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="true">Reviews</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="false" onclick="getBookings()">Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false" onclick="getMessages()">Messages</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="reviews-tab">Coming soon...</div>

        <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
            <span id="allBookings"></span>
            <form id="booking-form" action="#" method="post">
                <h2>Book User</h2>
                Date: <input type="date" name="booking-date" id="booking-date" required>
                Time: <input type="time" name="start" id="booking-time" required/><br />
                Hours: <input type="text" name="hours" id="booking-hours" onfocusout="validateForm() getTotal()" required/><br />
                Total: <input type="text" name="pay" id="booking-total" placeholder="0" disabled/><br />
                Message: <br />
                <textarea name="bookingText" rows="4" cols="50" id="booking-text"></textarea><br />

                <input type="button" name="action" value="Request Booking" disabled="true" onclick="sendBooking()">
            </form>
        </div>

        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <span id="allMessages"></span>
            <form id= "messageForm" action="#" method="post">
                <h2>Message User</h2>
                Message: <br />
                <textarea name="message" id="message-text" rows="4" cols="50"></textarea><br />
                <input type="button" id="message-button" name="action" value="Send Message" onclick="sendMessage()">
            </form>
        </div>
        </div>
    </div>
</div>


