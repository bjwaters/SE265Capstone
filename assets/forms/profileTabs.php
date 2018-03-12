<?php ?>

<div id="profileTabsContent" class="container my-4 border col-7" onload="messageCenterEvents()">

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

        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="reviews-tab">
            <img src="assets/uploads/reviews.png" class="img-fluid" alt="Responsive image">
        </div>

        <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
            <span id="allBookings"></span>
            <form id="booking-form" class="border pt-forms" action="#" method="post">
                <h2>Book User</h2>
                Date: <input type="date" name="booking-date" id="booking-date" required>
                Time: <input type="time" name="start" id="booking-time" required/><br />
                Hours: <input type="text" name="hours" id="booking-hours" onfocusout="getTotal()" required/><br />
                Total: <input type="text" name="pay" id="booking-total" placeholder="0" disabled/><br />
                Message: <br />
                <textarea name="bookingText" rows="4" cols="50" id="booking-text"></textarea><br />

                <input type="button" name="action" value="Request Booking" onclick="sendBooking()">
                <div id="booking-errors"></div>
            </form>
        </div>

        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
            <span id="allMessages"></span>
            <form id= "message-form" class="border pt-forms" action="#" method="post">
                <h2>Message User</h2>
                Message: <br />
                <textarea name="message" id="message-text" rows="4" cols="50"></textarea><br />
                <input type="button" id="message-button" name="action" value="Send Message" onclick="sendMessage()">
            </form>
        </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(messageCenterEvents());
</script>

