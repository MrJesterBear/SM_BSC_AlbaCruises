<?php
// Saul Maylin - 21005729
// 22/11/2025
// v1.0
// Get statistics for a selected route and date.

require('../imports/connection.php');
// require('../imports/code-error.php');

// Get the date and routeID from the post request.
$date = $_POST['date'];
$routeID = $_POST['routeID'];
// $date = $_GET['date'];
// $routeID = $_GET['routeID'];


// Variables to hold statistics.
$ferrySeats = 0;
$totalOccupancy = 0;

// Fare Collection
$adultFare = 0.00;

// The rest of the fare types remain the same.
$teenFare = 10.00;
$childFare = 7.00;

// Always free.
$infantFare = "Free";


// Prepare the SQL statement to get occupancy statistics.
$ferrystmt = $DB->prepare("SELECT DISTINCT seatOccupancy FROM AlbaTimetable WHERE routeID = ? AND ? BETWEEN timetableStart AND timetableEnd");
$ferrystmt->bind_param("is", $routeID, $date);
if ($ferrystmt->execute()) {
    $ferrystmt->store_result();
    $ferrystmt->bind_result($seatOccupancy);
    while ($ferrystmt->fetch()) {
        $ferrySeats = $seatOccupancy;
    }
    $ferrystmt->close();
} else {
    echo "<p class = 'text-danger'>Error fetching ferry seat data.";
    exit();
}

// Prepare the SQL statement to get total occupancy for this route and date.
$occupancystmt = $DB->prepare("SELECT SUM(occupants) FROM AlbaTickets WHERE routeID = ? AND bookingDate = ?");
$occupancystmt->bind_param("is", $routeID, $date);
if ($occupancystmt->execute()) {
    $occupancystmt->store_result();
    $occupancystmt->bind_result($occupants);
    while ($occupancystmt->fetch()) {
        $totalOccupancy = $occupants;
    }
    $occupancystmt->close();
} else {
    echo "<p class = 'text-danger'>Error fetching occupancy data.";
    exit();
}

// Get the adult ticket price for this route.
$routestmt = $DB->prepare("SELECT callingID, destinationID FROM AlbaRoutes WHERE routeID = ?");
$routestmt->bind_param("i", $routeID);

if ($routestmt->execute()) {

    $routestmt->store_result();
    $routestmt->bind_result($callingID, $destinationID);

    if ($routestmt->fetch()) {

        // Get the adult fare based on callingID and destinationID.
        $faresetmt = $DB->prepare("SELECT fare FROM AlbaFares WHERE callingID = ? AND destinationID = ? AND category = 'Adult'");
        $faresetmt->bind_param("ii", $callingID, $destinationID);

        if ($faresetmt->execute()) {

            $faresetmt->store_result();
            $faresetmt->bind_result($price);

            if ($faresetmt->fetch()) {
                $adultFare = $price;
            } else {
                echo "<p class = 'text-danger'>Error fetching adult fare data.";
                exit();
            }
            $faresetmt->close();
        } else {
            echo "<p class = 'text-danger'>Error fetching adult fare data.";
            exit();
        }
    } else {
        echo "<p class = 'text-danger'>Error fetching route data.";
        exit();
    }
    $routestmt->close();
} else {
    echo "<p class = 'text-danger'>Error fetching route data.";
    exit();
}

// If needed, similar queries can be made to get other fare types.

// With all data gathered, output a html response.

// First, calculate how many seats are left.
$seatsLeft = $ferrySeats - $totalOccupancy;
if ($seatsLeft < 0) {
    $seatsLeft = 0; // Prevent negative seats.
}

echo
    "<h3> Statistics for " .$date. " </h3>" .
    "<div class='row'>",
        "<div class='col-md'>",
            "<h4> Fare Costs: </h4>",
            "<p> Adult: £" . number_format($adultFare, 2) . "</p>",
            "<p> Teen: £" . number_format($teenFare, 2) . "</p>",
            "<p> Child: £" . number_format($childFare, 2) . "</p>",
            "<p> Infant: " . $infantFare . "</p>",
        "</div>",

        "<div class='col-md'>",
            "<h4> Occupancy: </h4>",
            "<p> Total Ferry Seats: " . $ferrySeats . "</p>",
            "<p> Total Occupancy: " . $totalOccupancy . "</p>",
            "<p> Seats Left: " . $seatsLeft . "</p>",
        "</div>",
    "</div>";

?>