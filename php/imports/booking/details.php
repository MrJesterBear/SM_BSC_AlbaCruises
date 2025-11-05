<?php
//   Saul Maylin 21005729
//   04/11/2025
//   v1
//   Project: Alba Cruises
//   Booking details import file.

// Ensure main details have at least been set.
if (isset($_GET['route']) && isset($_GET['departDate'])) {

    // Gather the details.
    $route = $_GET['route'];
    $departDate = $_GET['departDate'];
    $noOfAdults = $_GET['Adult'];
    $noOfTeens = $_GET['Teen'];
    $noOfChildren = $_GET['Child'];
    $noOfInfants = $_GET['Infant'];

    // Connect to the database, path from executing file (tickets.php).
    require("./php/imports/connection.php"); 

    

} else {
    echo '<h2 class = "text-danger font-weight-bold"> Please fill out the booking search form and submit to see available sailings. </h2>';
}
?>