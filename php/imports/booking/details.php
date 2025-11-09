<?php
//   Saul Maylin 21005729
//   09/11/2025
//   v1.1
//   Project: Alba Cruises
//   Booking details import file.

// Ensure main details have at least been set.
if (isset($_GET['Calling']) && isset($_GET['Destination']) && isset($_GET['departDate'])) {
    require("./php/pages/sailings.php");

    // Gather the details.
    $calling = $_GET['Calling'];
    $destination = $_GET['Destination'];
    $departDate = $_GET['departDate'];
    $noOfAdults = $_GET['Adult'];
    $noOfTeens = $_GET['Teen'];
    $noOfChildren = $_GET['Child'];
    $noOfInfants = $_GET['Infant'];

    // Connect to the database, path from executing file (tickets.php).
    require("./php/imports/connection.php");

    // get the ids of the calling and destination.
    $callingID = null;
    $destinationID = null;
    $id = null;


    // Calling ID
    $idQuery = $DB->prepare("SELECT destinationID FROM AlbaDestinations WHERE destinationName = ?;");
    $idQuery->bind_param("s", $calling);
    $idQuery->bind_result($id);
    $idQuery->execute();
    $idQuery->store_result();
    if ($idQuery->fetch()) {
        $callingID = $id;
        echo '<script>console.log("Calling is id:' . $callingID . '");</script>';
    }
    $idQuery->close();

    // Destination ID
    $idQuery2 = $DB->prepare("SELECT destinationID FROM AlbaDestinations WHERE destinationName = ?;");
    $idQuery2->bind_param("s", $destination);
    $idQuery2->bind_result($id);
    $idQuery2->execute();
    $idQuery2->store_result();
    if ($idQuery2->fetch()) {
        $destinationID = $id;
        echo '<script>console.log("Destination is id:' . $destinationID . '");</script>';
    }
    $idQuery2->close();


    // Logic for creating a statement depending on search criteria.
    // Some nuance as due to test data, if calling from Mallaig to Eigg, query may find other callings to eigg that happen 

    // Mallaig = 1, Eigg = 2, Rum = 3, Muck = 4

    switch ($callingID) {
        case 1: // Mallaig
            echo '<script>console.log("Calling from Mallaig");</script>';
            if ($destinationID == 2) { // Eigg - Only show the morning sailings as Mallaig to Eigg will always be the first.
                echo '<script>console.log("Destination is Eigg");</script>';

                $query =
                    "SELECT 
                            AlbaDestinations.destinationName,
                            AlbaDestinationTimetable.departureDate, 
                            AlbaDestinationTimetable.departureTime, 
                            AlbaDestinationTimetable.arivalTime, 
                            AlbaDestinationTimetable.seatOccupancy
                    FROM 
                            AlbaDestinations
                    JOIN 
                            AlbaDestinationTimetable
                    ON 
                            AlbaDestinations.destinationID = AlbaDestinationTimetable.destinationID
                    WHERE 
                            AlbaDestinationTimetable.destinationID = ?
                    AND 
                            AlbaDestinationTimetable.departureDate >= ?
                    AND 
                            AlbaDestinationTimetable.departureTime = '11:00:00'
                    LIMIT 5;";

            }


            break;
        case 2: // Eigg
            $query = "";
            break;
        case 3: // Rum
            $query = "";
            break;
        case 4: // Muck
            $query = "";
        default:
            $query = null;
            break;
    }

    // Get available sailings based on search criteria.
    $sailing = $DB->prepare($query);
    $sailing->bind_param("is", $destinationID, $departDate);
    $sailing->bind_result($destinationName, $departureDate, $departureTime, $arivalTime, $seatOccupancy);
    $sailing->execute();
    $sailing->store_result();

    if ($sailing->num_rows() > 0) {
        if ($sailing->fetch()) {
            // call the sailings.php class to render the sailings in a loop
            $i = 0;

            while ($sailing->fetch()) {
                new Sailings($calling, $destinationName, date_create($departureDate), $departureTime, $arivalTime, 'option' . $i, 'Departure');
                $i++;
            }
        } else {
            echo '<h2 class = "text-danger font-weight-bold"> The application was unable to process your request at this time. Please try again later. </h2>';
        }
    } else {
        // No sailings found.
        echo '<h2 class = "text-danger font-weight-bold"> No sailings found matching your search criteria. Please try again with different details. </h2>';
    }



} else {
    echo '<h2 class = "text-danger font-weight-bold"> Please fill out the booking search form and submit to see available sailings. </h2>';
}
?>