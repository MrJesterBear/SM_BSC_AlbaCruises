<?php
// Saul Maylin
// 23/11/2025
// v1.1
// Creating booking and tickets

header('content-type: text/json');

// Include connection
include('../imports/connection.php');
// include('../imports/code-error.php');
session_start();

// Check if user is logged in, otherwise say goodbye.
if (!isset($_SESSION['UID'])) {
    echo json_encode((array('error' => "not_logged_in")));
    exit(200);
}

// Check if a current booking session exists
if (!isset($_SESSION['bookingID'])) {
    generateBooking($DB);
}

// continue as normal.

// Grab post variables.
$timetableID = $_POST['timetableID'];
$callingName = $_POST['callingName'];
$destinationName = $_POST['destinationName'];
$departDate = $_POST['departDate'];
$occupants = $_POST['occupants'];
// Create the ticket.
// unset($_SESSION['bookingID']);

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

// insert ticket into db.
if (isset($routeIDFinal)) {
    $ticket = $DB->prepare("INSERT INTO AlbaTickets (bookingID, routeID, timetableID, bookingDate, occupants) VALUES (?, ?, ?, ?, ?)");
    $ticket->bind_param("iiisi", $_SESSION['bookingID'], $routeIDFinal, $timetableID, $departDate, $occupants);
    if ($ticket->execute()) {
        // Great Success as Borat would say!
        echo json_encode((array('error' => "NONE")));
    } else {
        echo json_encode((array('error' => "ticket_creation_failed")));
    }
    $ticket->close();

} else {
    echo json_encode((array('error' => "booking_failed")));
}



function generateBooking($DB)
{
    // Generate a booking reference and capture that number.
    $bookingRef = $DB->prepare("INSERT INTO AlbaBookings (customerID, totalPaid) VALUES (?, ?)");
    $bookingRef->bind_param("id", $_SESSION['UID'], $_SESSION['totalPrice']);

    if ($bookingRef->execute()) {
        $bookingRef->close();
        // If the booking reference is created successfully, get the booking ID.
        $bookingID = $DB->prepare("SELECT bookingID FROM AlbaBookings WHERE customerID = ? ORDER BY bookingID DESC LIMIT 1");
        $bookingID->bind_param("i", $_SESSION['UID']);

        if ($bookingID->execute()) { // if it runs, store this.
            // bind and store result
            $bookingID->store_result();

            $id = null;
            $bookingID->bind_result($id);
            $bookingID->fetch();
            $bookingID->close();
            // store in session for later use.
            $_SESSION['bookingID'] = $id;
        } else {
            echo json_encode((array('error' => "id_fetch_failed")));
            exit();
        }

    } else {
        // If the booking reference fails, return an error.
        echo json_encode((array('error' => "booking_not_created")));
        exit();
    }
}
?>