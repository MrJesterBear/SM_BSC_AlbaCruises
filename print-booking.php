<!-- ? Name:  21005729 Saul Maylin
? Date: 03/11/2025
? v2
? Project: Alba Cruises
? -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Booking | Alba Cruises</title>

    <!-- * Meta data for indexing-->
    <meta name="description" content="The booking print page for Alba Cruises." />
    <meta name="keywords" content="Alba, Cruises, Travel, Adventure, booking, ferry" />
    <meta name="author" content="21005729 Saul Maylin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- * Links for both the stylesheet for pazas and a favicon for the site.-->

    <!-- ! Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />

    <!-- ! Import bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>

    <!-- ! Import custom stylesheet -->
    <link rel="stylesheet" href="/css/stylesheet.css" />

    <!-- Import jQuery for ajax -->
    <script src="./js/imports/jquery-3.7.1.min.js"></script>

    <link rel="icon" type="image/x-icon" href="/assets/universal/logo.png" />


</head>

<?php
// Double check user is  logged in.
session_start();

if (!isset($_SESSION['UID'])) {
    // If user is not logged in, redirect to the index page.
    header("Location: /");

    if (!isset($_SESSION['bookings'])) {
        // If no booking data, redirect to account page.
        header("Location: account.php");
    }

    if (!isset($_GET['bookingID'])) {
        // If no booking ID, redirect to account page.
        header("Location: account.php");

    }
}
?>

<body class="bodyDefault">

    <!-- * Secondary nav, Image & Nav -->

    <!-- ! Secondary Nav -->
    <div class="no-print nav-colour">
        <ul class="list-group list-group-horizontal justify-content-end">
            <li class="list-group-item"><a class="nav-link" href="#">Languages</a></li>
            <li class="list-group-item"><a class="nav-link" href="/new-user.php">Staff</a></li>
        </ul>
    </div>

    <!-- ! Image -->
    <div class="nav-colour d-flex justify-content-center">
        <a class="navbar-brand" href="index.html">
            <img src="/assets/universal/logo.png" alt="Alba Cruises logo" width="140">
        </a>
    </div>

    <!-- ! Main Nav -->
    <nav class="no-print nav-colour nav navbar navbar-expand-lg d-flex justify-content-center pt-3">
        <script type="module">
            // imports setnav function and runs it.
            import { setNav } from "./js/html/nav.js";
            setNav();
        </script>
    </nav>

    <!-- * Main Content -->

    <div class="container-fluid text-center mt-4 mb-4">
        <?php

        // require the booking class.
        require('./php/classes/booking.php');
        // include('./php/imports/code-error.php');

        // Get booking ID from URL.
        $bookingID = $_GET['bookingID'];

        // Get bookings from session.
        $bookings = array();
        $bookings = unserialize($_SESSION['bookings']);


        // Find booking with matching ID.
        foreach ($bookings as $booking) {
            if ($bookingID = $booking->getBookingID()) {
                // Render booking details for printing.
                $booking->renderPrintableBooking();
                break;
            }
        }
        ?>
    </div>

    <!-- Footer -->
    <div class="no-print footer container-fluid text-center bg-secondary border border-border">
        <script type="module">
            // imports setfooter function and runs it.
            import { setFooter } from "./js/html/footer.js";
            setFooter();
        </script>
    </div>

    <script>
        // Auto open print. https://developer.mozilla.org/en-US/docs/Web/API/Window/print
        document.addEventListener("DOMContentLoaded", function() {
            window.print();
        });
    </script>

</body>

</html>