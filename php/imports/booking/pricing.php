<?php
// Saul Maylin 21005729
//  17/11/2025
// v1
// Booking pricing import file.

// get number of passengers
$noOfAdults = $_GET['Adult'];
$noOfTeens = $_GET['Teen'];
$noOfChildren = $_GET['Child'];
$noOfInfants = $_GET['Infant'];

// Get calling and destination ids
$calling = $_GET['Calling'];
$destination = $_GET['Destination'];

// run query to get IDs
$ferry = new FerryQuery(null, null, null);
$calling = $ferry->getDestinationID($DB, $calling);
$destination = $ferry->getDestinationID($DB, $destination);

// if empty, exit.
if (!empty($calling) && !empty($destination)) {
    echo '<script>console.log("Calling ID: ' . $calling . ' Destination ID: ' . $destination . '");</script>';
} else {
    echo '<h2 class = "text-danger font-weight-bold"> Error retrieving prices. IDs. Please try again. </h2>';
    exit();
}

// initialize prices
$adult = 0.00;
$teen = 0.00;
$child = 0.00;
$infant = 0.00; // infant is always free.

// get pricing for each type from DB
if ($noOfAdults > 0) {
    $Query = $DB->prepare("SELECT fare FROM AlbaFares WHERE category = 'Adult';");
    $Query->bind_result($adultPrice);
    $Query->execute();
    if ($Query->fetch()) {
        $adult = $adultPrice;
    }
    $Query->close();
}

if ($noOfTeens > 0) {
    $Query = $DB->prepare("SELECT fare FROM AlbaFares WHERE category = 'Teen';");
    $Query->bind_result($teenPrice);
    $Query->execute();
    if ($Query->fetch()) {
        $teen = $teenPrice;
    }
    $Query->close();
}

if ($noOfChildren > 0) {
    $Query = $DB->prepare("SELECT fare FROM AlbaFares WHERE category = 'Child';");
    $Query->bind_result($childPrice);
    $Query->execute();
    if ($Query->fetch()) {
        $child = $childPrice;
    }
    $Query->close();
}


// Calculate the return or single price. a single is 70% of the return price.
if (isset($_GET['returnDate'])) {
    $tripType = "Return";
    $adult = $adult * $noOfAdults;
    $teen = $teen * $noOfTeens;
    $child = $child * $noOfChildren;


} else {
    $tripType = "Single";
    $adult = ($adult * 0.7) * $noOfAdults;
    $teen = ($teen * 0.7) * $noOfTeens;
    $child = ($child * 0.7) * $noOfChildren;
}
// no matter what, total price will be the combination of these all.
$totalPrice = $adult + $teen + $child;

// echo everything out.

if ($noOfAdults > 0) {
    echo '<p class = "text-white">' . $tripType . ' Adult Ticket: £' . number_format($adult, 2) . ' x ' . $noOfAdults . '</p>';
}

if ($noOfTeens > 0) {
    echo '<p class = "text-white">' . $tripType . ' Teen Ticket: £' . number_format($teen, 2) . ' x ' . $noOfTeens . '</p>';
}

if ($noOfChildren > 0) {
    echo '<p class = "text-white">' . $tripType . ' Child Ticket: £' . number_format($child, 2) . ' x ' . $noOfChildren . '</p>';
}

if ($noOfInfants > 0) {
    echo '<p class = "text-white">' . $tripType . ' Infant Ticket: Free x ' . $noOfInfants . '</p>';
}

echo '<h3 class ="text-white font-weight-bold">Total Price: £' . number_format($totalPrice, 2) . '</h3>';

?>