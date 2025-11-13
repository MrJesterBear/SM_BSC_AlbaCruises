<?php
// Saul Maylin
// 13/11/2025
// v1
// Creating booking and tickets

header ('content-type: text/json');

// Include connection
include('../imports/connection.php');
include('../imports/code-error.php');
session_start();

// Check if a current booking session exists
if (!isset($_SESSION['booking'])) {
    generateBooking($DB);
} 

// continue as normal.

// Grab post variables.
$callingName = $_GET('callingName');
$destinationName = $_GET('destinationName');
$departDate = $_GET('departDate');
$departTime = $_GET('departTime');
$arivalTime = $_GET('arivalTime');
$occupants = $_GET('occupants');

// Create the ticket.
$ticket = $DB->prepare("");

function generateBooking($DB) {
    // Generate a booking reference and capture that number.
    $bookingRef = $DB->prepare("INSERT INTO AlbaBookings (UID) VALUES (?)");
    $bookingRef->bind_param("i", $_SESSION['UID']);

    if ($bookingRef->execute()) {
        $bookingRef->close();
        // If the booking reference is created successfully, get the booking ID.
        $bookingID = $DB->prepare("SELECT bookingID FROM AlbaBookings WHERE UID = ? ORDER BY bookingID DESC LIMIT 1");
        $bookingID->bind_param("i", $_SESSION['UID']);
        
        if ($bookingID->execute()) { // if it runs, store this.
            // bind and store result
            $id = null;
            $bookingID->bind_result($id);
            $bookingID->fetch();
            $bookingID->store_result();
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