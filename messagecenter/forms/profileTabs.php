<?php

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function(){

        $bID = getUrlParameter('bookerID');
        $mID = getUrlParameter('musicianID');
        console.log($bID);
        console.log($mID);

        /*$("#messages-tab").click(function(){
            $.get( "indextest.php?action=getMessages&bookerID="+$bID+"&musicianID="+$mID, function( messages ) {
                $( "#allMessages" ).html( messages );
                console.log( messages );
            });
        });*/


        /*$("#bookings-tab").click(function(){
            $.get( "indextest.php?action=getBookings&bookerID="+$bID+"&musicianID="+$mID, function( bookings ) {
                $( "#allBookings" ).html( bookings );
                console.log( bookings );
            });
        });*/


    });

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
            console.log( messages );
        });
    }

    function getBookings(){
        $.get( "indextest.php?action=getBookings&bookerID="+$bID+"&musicianID="+$mID, function( bookings ) {
            $( "#allBookings" ).html( bookings );
            console.log( bookings );
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
        var text = $("#message-text").val();
        if (text.length > 0) {
            var hr = new XMLHttpRequest();
            var url = "indextest.php";
            var action = "sendMessage"
            var data = "action=" + action + "&text=" + text + "&bookerID="+$bID+"&musicianID="+$mID;

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
            $("#message-text").val('');
        }

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
            <form action="#" method="post">
                <h2>Book User</h2>
                Date: <input type="datetime-local" name="bookingDate">
                Hours: <input type="text" name="hours" value=""/><br />
                Pay: <input type="text" name="pay" value=""/><br />
                Message: <br />
                <textarea name="bookingText" rows="4" cols="50"></textarea><br />

                <input type="submit" name="action" value="Request Booking">
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


