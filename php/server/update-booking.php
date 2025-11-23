<?php
// Saul Maylin - 21005729
// 23/11/2025
// v1
// Server side script to update a booking.

header('content-type: text/json');

// Get required files
require("../imports/connection.php");
session_start();

if (!isset($_SESSION['UID'])) {
    echo json_encode((array('error' => "not_logged_in")));
    exit(200);
}

// Booking id SHOULD BE SET. IF NOT, CRY!
if (!isset($_SESSION['selectedBookingID'])) {
    echo json_encode((array('error' => "no_booking_selected")));
    exit(200);
} else {
    // Grab bookingID
    $bookingID = $_SESSION['selectedBookingID'];
}

// How do you figure out what ticket to update? make a counter.
if (isset($_SESSION['updateCounter'])) {
    // if it's set, use the return ticket ID.
    $ticketID = $_SESSION['returnTicketID'];
    // Unset the counter for next time.
    unset($_SESSION['updateCounter']);
} else {
    // If it's not set, assume depart ticket, then make a counter.
    $ticketID = $_SESSION['departTicketID'];
    $_SESSION['updateCounter'] = true;
}

// Grab post variables.
$timetableID = $_POST['timetableID'];
$callingName = $_POST['callingName'];
$destinationName = $_POST['destinationName'];
$departDate = $_POST['departDate'];
$occupants = $_POST['occupants'];

// Follow similar logic to booking-process.php but update instead.

// get routeid.
$routeID = $DB->prepare("SELECT routeID FROM AlbaTimetable WHERE timetableID = ?;");
$routeID->bind_param("i", $timetableID);
$routeID->bind_result($ID);
if ($routeID->execute()) {
    $routeID->store_result();

    if ($routeID->fetch()) {
        $routeIDFinal = $ID;
    } else {
        echo json_encode((array('error' => "route_not_found"))); // no route found
    }
} else {
    echo json_encode((array('error' => "route_query_failed"))); // query failed / couldnt reach db.
}
$routeID->close();

// update ticket into db.
if (isset($routeIDFinal)) {
    $ticket = $DB->prepare("UPDATE AlbaTickets SET routeID = ?, timetableID = ?, bookingDate = ?, occupants = ? WHERE ticketID = ? AND bookingID = ?");
    $ticket->bind_param("iisiii", $routeIDFinal, $timetableID, $departDate, $occupants, $ticketID, $bookingID);
    if ($ticket->execute()) {
        // Great Success as Borat would say!
        echo json_encode((array('error' => "NONE")));
    } else {
        echo json_encode((array('error' => "update_failed")));
    }
    $ticket->close();

} else {
    echo json_encode((array('error' => "booking_failed")));
}

?>