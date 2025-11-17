<?php
//   Saul Maylin 21005729
//   17/11/2025
//   v1.2
//   Project: Alba Cruises
//   Booking details import file.

// Ensure main details have at least been set.
if (isset($_GET['Calling']) && isset($_GET['Destination']) && isset($_GET['departDate'])) {


    // Ensure the calling and destination are not the same.
    if ($_GET['Calling'] == $_GET['Destination']) {
        echo '<h2 class = "text-danger font-weight-bold"> Calling and Destination ports cannot be the same. Please select different ports. </h2>';
        exit();
    }

    // Gather the details.
    if (isset($_SESSION["return"])) { // Swap calling and destination for return trip.
        $calling = $_GET['Destination'];
        $destination = $_GET['Calling'];
        $departDate = $_GET['returnDate'];
    } else { // for just one way.
        $calling = $_GET['Calling'];
        $destination = $_GET['Destination'];
        $departDate = $_GET['departDate'];
    }
    $noOfAdults = $_GET['Adult'];
    $noOfTeens = $_GET['Teen'];
    $noOfChildren = $_GET['Child'];
    $noOfInfants = $_GET['Infant'];

    $totalOccupants = $noOfAdults + $noOfTeens + $noOfChildren; // infants do not occupy seats usually.

    // Connect to the database, path from executing file (tickets.php).

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
    $ferryQuery = new FerryQuery($callingID, $destinationID, $departDate);
    $route = $ferryQuery->routeExists($DB);

    // if empty, exit script.
    if (empty($route) || $route == false) {
        echo '<h2 class = "text-danger font-weight-bold"> No route exists for the selected ports. Please try different options. </h2>';
        exit();
    }

    // if route exists, get the sailing details.
    $timetable = $ferryQuery->getTimetable($DB, $route);
    $sailings = array();



    // render sailings.
    if (!empty($timetable) || $timetable != false) {

        foreach ($timetable as $ferry) {
            $sailings[] = new Sailings($ferry->getCallingName(), $ferry->getDestinationName(), date_create($ferry->getDepartureDate()), $ferry->getDepartureTime(), $ferry->getArivalTime(), $ferry->getTimetableID(), "Departure");

            // Check to see if enough seats available for total occupants by querying the database bookings for this route and date.
            $sailings[count($sailings) - 1]->renderSailing(); // render sailing as it's created.
        }
    }

    // If no sailings found, inform user.
    if (count($sailings) == 0) {
        echo '<h2 class = "text-danger font-weight-bold"> No sailings available for the selected route and date. Please try different options. </h2>';
    } else {
        // Setup for return sailings if return date set.
        if (isset($_GET['returnDate'])) {
            if (!isset($_SESSION['return'])) {
                $_SESSION['return'] = true;
                echo '<script>console.log("Return session set.");</script>';
            } else {
                unset($_SESSION['return']);
                echo '<script>console.log("Return session unset.");</script>';
            }
        }
    }


} else {
    echo '<h2 class = "text-danger font-weight-bold"> Please fill out the booking search form and submit to see available sailings. </h2>';
}
?>