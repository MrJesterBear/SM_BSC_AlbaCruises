<?php
//   Saul Maylin 21005729
//   09/11/2025
//   v1.1
//   Project: Alba Cruises
//   Booking details import file.

// Ensure main details have at least been set.
if (isset($_GET['Calling']) && isset($_GET['Destination']) && isset($_GET['departDate'])) {
    require("./php/pages/sailings.php");

    // Ensure the calling and destination are not the same.
    if ($_GET['Calling'] == $_GET['Destination']) {
        echo '<h2 class = "text-danger font-weight-bold"> Calling and Destination ports cannot be the same. Please select different ports. </h2>';
        exit();
    }

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

    // Create FerryQuery object to get sailings.
    require("./php/classes/ferryquery.php");
    require("./php/classes/ferries.php");
    $ferryQuery = new FerryQuery($callingID, $destinationID, $departDate);
    $callingRoutes = $ferryQuery->getPortOfCall($DB);
    $destinationRoutes = $ferryQuery->getDestination($DB);

    // Render the sailings, as long as the dates of both the calling and destination match.
    $i = 0;
    $sailings = array();
    foreach ($callingRoutes as $callingferries) {
        foreach ($destinationRoutes as $destinationferries) {
            if ($callingferries->getDepartureDate() == $destinationferries->getDepartureDate()) {

                if ($i != 4) {
                    $sailings[] = new Sailings($calling, $destinationferries->getDestinationName(), date_create($callingferries->getDepartureDate()), $callingferries->getDepartureTime(), $destinationferries->getArivalTime(), $i, "Departure");
                    $i++;
                }
            }
        }
    }

    // If no sailings found, inform user.
    if (count($sailings) == 0) {
        echo '<h2 class = "text-danger font-weight-bold"> No sailings available for the selected route and date. Please try different options. </h2>';
    }


} else {
    echo '<h2 class = "text-danger font-weight-bold"> Please fill out the booking search form and submit to see available sailings. </h2>';
}
?>