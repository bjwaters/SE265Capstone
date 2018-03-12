<?php
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src= "messageCenter.js"></script>-->


<!-- Modal -->
<div class="modal fade" id="bookingUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    Date: <input type="date" name="booking-date" id="m-booking-date" required>
                    Time: <input type="time" name="start" id="m-booking-time" required/><br />
                    Hours: <input type="text" name="hours" id="m-booking-hours" onfocusout="getTotal()" required/><br />
                    Total: <input type="text" name="pay" id="m-booking-total" placeholder="0" disabled/><br />
                    Message: <br />
                    <input id="hiddenID" type="hidden" />
                    <textarea name="bookingText" rows="4" cols="50" id="m-booking-text"></textarea><br />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateBooking()" >Update Booking</button>
                    <div id="booking-errors"></div>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(modalBookingEvents());
</script>
