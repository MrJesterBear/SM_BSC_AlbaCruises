<?php
//   Saul Maylin 21005729
//   04/11/2025
//   v1
//   Project: Alba Cruises
//   Booking details import file.

// Ensure main details have at least been set.
if (isset($_GET['Calling']) && isset($_GET['Destination']) && isset($_GET['departDate'])) {

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
    }
    $idQuery2->close();


    // Logic for creating a statement depending on search criteria.
    // Some nuance as due to test data, if calling from Mallaig to Eigg, quuery may find other callings to eigg.

    switch ($callingID) {
        case 1: // Mallaig
            $query = "";
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
    $sailing = $DB->prepare ($query);


} else {
    echo '<h2 class = "text-danger font-weight-bold"> Please fill out the booking search form and submit to see available sailings. </h2>';
}
?>