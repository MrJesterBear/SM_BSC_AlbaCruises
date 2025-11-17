<?php
// Saul Maylin
// 13/11/2025
// v1
// Creating booking and tickets

header('content-type: text/json');

// Include connection
include('../imports/connection.php');
include('../imports/code-error.php');
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
// $ticket = $DB->prepare("");
unset($_SESSION['bookingID']);
echo json_encode((array('error' => "none")));

function generateBooking($DB)
{
    // Generate a booking reference and capture that number.
    $bookingRef = $DB->prepare("INSERT INTO AlbaBookings (customerID) VALUES (?)");
    $bookingRef->bind_param("i", $_SESSION['UID']);

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