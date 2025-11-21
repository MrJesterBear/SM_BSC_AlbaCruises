<!--  
 Saul Maylin
 19/11/2025
 v1.1
Account booking Page.
-->

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container my-3">
        <div class="row my-3 text-center">
            <div class="col-sm">
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
                            // echo "<h4> You have " . $numberOfTickets . " tickets. </h4>";
                    
                            $tickets = array();
                            require('../../php/classes/tickets.php');
                            require('../../php/classes/booking.php');
                            while ($stmt->fetch()) {
                                $tickets[] = new Tickets($ticketID, $bookingID, $routeID, $timetableID, $bookingDate, null, null, null);
                            }

                            // get more info for each ticket. (Route names, depart time, arrival time).
                            foreach ($tickets as $ticket) {
                                $query = "SELECT AlbaRoutes.routeDesc, AlbaTimetable.departureTime, AlbaTimetable.arivalTime
                                        FROM AlbaRoutes
                                        join AlbaTimetable
                                        on AlbaRoutes.routeID = AlbaTimetable.routeID
                                        WHERE AlbaTimetable.routeID = ?
                                    GROUP BY AlbaTimetable.routeID;";
                                $stmt = $DB->prepare($query);
                                $route = $ticket->getRouteID();
                                $stmt->bind_param("i", $route);
                                if ($stmt->execute()) {
                                    $stmt->store_result();
                                    $stmt->bind_result($routeNames, $departTime, $arrivalTime);
                                    while ($stmt->fetch()) {
                                        // set the route names etc.
                                        $ticket->setRouteNames($routeNames);
                                        $ticket->setDepartTime($departTime);
                                        $ticket->setArrivalTime($arrivalTime);
                                    }
                                } else {
                                    echo "<h3 class='error-box text-danger'> An error occurred fetching your bookings. Please try again later. </h3>";
                                    break;
                                }
                            }

                            $lastBooking = 0; // to track change in booking ids.
                            $i = 0; // row counter 
                            $counter = 0; // count bookings
                            $loopNumber = 0; // count the loops

                            // Create objects to hold booking info in general.
                            $bookings = array();

                            // Display each ticket.
                            foreach ($tickets as $ticket) {
                                $loopNumber++;
                                if ($lastBooking != $ticket->getBookingID()) {
                                    // end previous booking row. for single tickets mainly.
                                    if ($i > 0) {
                                        echo '</div>'; // close previous row.
                                        $i = 0; // reset counter.
                                        $counter++;
                                    }

                                    // new booking, start a new row.
                                    $lastBooking = $ticket->getBookingID();
                                    echo
                                        '<div class = "row my-2 actionDiv booking' . $lastBooking . '" onclick="showBookingDetails(' . $lastBooking . ')">',
                                        '<div class = "col-sm">';
                                    $date = date_create($ticket->getBookingDate());
                                    echo '<h4>' . date_format($date, 'd/m/y') . '</h4>',
                                        '<p>' . $ticket->getRouteNames() . '</p>',
                                        '</div>',

                                        '<div class = "col-sm">',
                                        '<p> Depart: ' . $ticket->getDepartTime() . '</p>',
                                        '<p> Arrive: ' . $ticket->getArrivalTime() . '</p>',
                                        '</div>';
                                    $i++;

                                    // Start a new booking for later display, and populate.
                                    $bookings[$counter] = new bookingDisplay($ticket->getBookingID());
                                    $bookings[$counter]->setDepartTicketID($ticket->getTicketID());
                                    $bookings[$counter]->setDepartRouteID($ticket->getRouteID());
                                    $bookings[$counter]->setDepartTimetableID($ticket->getTimetableID());
                                    $bookings[$counter]->setRouteNames($ticket->getRouteNames());
                                    $bookings[$counter]->setDepartDate($ticket->getBookingDate());
                                    $bookings[$counter]->setDepartureDepartTime($ticket->getDepartTime());
                                
                                    // if the final ticket in list, close the row.
                                    if ($loopNumber == (count($tickets)) ) {
                                        echo '</div>'; // close row and button.
                                    }
                                
                                } else {
                                    // same booking, continue row.
                                    echo
                                        '<div class = "col-sm">';
                                    $date = date_create($ticket->getBookingDate());
                                    echo '<h4>' . date_format($date, 'd/m/y') . '</h4>',
                                        '<p>' . $ticket->getRouteNames() . '</p>',
                                        '</div>',

                                        '<div class = "col-sm">',
                                        '<p> Depart: ' . $ticket->getDepartTime() . '</p>',
                                        '<p> Arrive: ' . $ticket->getArrivalTime() . '</p>',
                                        '</div>';

                                    // As bookings will have at most 2 tickets, we can close the row here.
                                    echo '</div>'; // close row and button.
                                    // set lastBooking.
                                    $lastBooking = $ticket->getBookingID();
                                    $i = 0; // Row has been ended, so reset counter.
                    
                                    // Populate return ticket info for booking display.
                                    $bookings[$counter]->setReturnTicketID($ticket->getTicketID());
                                    $bookings[$counter]->setReturnRouteID($ticket->getRouteID());
                                    $bookings[$counter]->setReturnTimetableID($ticket->getTimetableID());
                                    $bookings[$counter]->setReturnDate($ticket->getBookingDate());
                                    $bookings[$counter]->setReturnDepartTime($ticket->getDepartTime());

                                    // Concatinate route names for return.
                                    $existingRoutes = $bookings[$counter]->getRouteNames();
                                    $newRoutes = $ticket->getRouteNames();
                                    $combinedRoutes = $existingRoutes . "," . $newRoutes;

                                    $bookings[$counter]->setRouteNames($combinedRoutes);

                                    // increase counter.
                                    $counter++;
                                }

                            }

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

            <div class="col-sm booking-details my-3">
                <!-- Storage of ticket information. all hidden unless option selected -->
                <?php
                if (!empty($bookings)) {
                    // Store bookings in a session - https://www.tutorialspoint.com/storing-objects-in-php-session
                    $_SESSION['bookings'] = serialize($bookings); // Serialize the bookings array for session storage.

                    // check if redirect to print.
                    if (isset($_GET['redirect']) && $_GET['redirect'] == 'print' && isset($_GET['bookingID'])) {
                        header('Location: /print-booking.php?bookingID=' . $_GET['bookingID']);
                    }
                        
                    foreach ($bookings as $trip) {
                        $trip->renderBooking();
                    }
                }

                ?>
            </div>
        </div>
    </div>
</body>

</html>