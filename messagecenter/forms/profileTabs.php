<?php

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function(){

        $bID = getUrlParameter('bookerID');
        $mID = getUrlParameter('musicianID');
        console.log($bID);
        console.log($mID);

        $("#messages-tab").click(function(){
            $.get( "indextest.php?action=getMessages&bookerID="+$bID+"&musicianID="+$mID, function( messages ) {
                $( "#allMessages" ).html( messages );
                console.log( messages );
            });
        });
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



</script>
<div class="container">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="true">Reviews</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="false">Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="reviews-tab">Coming soon...</div>

        <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
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
            <form action="#" method="post">
                <h2>Message User</h2>
                Message: <br />
                <textarea name="message" rows="4" cols="50"></textarea><br />
                <input type="submit" name="action" value="Send Message">
            </form>
        </div>
        </div>
    </div>
</div>


