<!--  
 Saul Maylin
 18/11/2025
 v1
Account booking Page.
-->

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container my-3">
        <div class="row mt-3 text-center">
            <div class="col-md">
                <div class="previous-bookings main-background text-white">
                    <h3>Bookings</h3>

                    <?php
                    // php to get user bookings and display.
                    require('../../php/imports/connection.php');
                    require('../../php/imports/code-error.php');
                    session_start();
                    // Run query to get bookings.
                    $query = "SELECT AlbaTickets.ticketID, AlbaTickets.bookingID, AlbaTickets.routeID, AlbaTickets.timetableID, AlbaTickets.bookingDate
                                    FROM AlbaTickets
                                    join AlbaBookings
                                    on AlbaTickets.bookingID = AlbaBookings.bookingID
                                    join AlbaCustomers
                                    on AlbaBookings.customerID = AlbaCustomers.customerID
                                    WHERE AlbaCustomers.customerID = ?";
                    $stmt = $DB->prepare($query);
                    $stmt->bind_param("i", $_SESSION['UID']);
                    if ($stmt->execute()) {
                        $stmt->store_result();
                        $stmt->bind_result($ticketID, $bookingID, $routeID, $timetableID, $bookingDate);

                        if ($stmt->num_rows > 0) {
                            // Sort bookings into a list. if a booking has more than one ticket, it is a return.
                            $numberOfTickets = $stmt->num_rows;
                            echo "<h4> You have " . $numberOfTickets . " tickets. </h4>";

                            

                        } else { // No bookings found.
                            echo "<h3> It seems you have no bookings... </h3>";
                            echo "<p> Why not make one now? </p>";

                            echo '<div class="container">',
                                '<div class="row py-4 text-center">',
                                '<a class="btn primary-button" href="/tickets.php" role="button">Search Tickets</a>',
                                '</div>',
                                '</div>';
                        }
                    } else {
                        echo "<h3 class='error-box text-danger'> An error occurred fetching your bookings. Please try again later. </h3>";
                    }
                    $stmt->close();
                    ?>
                </div>
            </div>

            <div class="col-md booking-details mt-3">
                <!-- if a booking is selected, populate this div! -->
                <!-- <h3> Booking Details</h3> -->
            </div>
        </div>
    </div>
</body>

</html>