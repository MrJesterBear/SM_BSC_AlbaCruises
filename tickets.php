<?php
require("./php/classes/ferryquery.php");
require("./php/classes/ferries.php");
require("./php/pages/sailings.php");
require("./php/imports/connection.php");
?>

<!-- ? Name:  21005729 Saul Maylin
? Date: 17/11/2025
? v1.3
? Project: Alba Cruises
? -->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tickets | Alba Cruises</title>

  <!-- * Meta data for indexing-->
  <meta name="description" content="The home page for Alba Cruises." />
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

  <!-- Import booking select javascript -->
   <script src="./js/ajax/booking-ajax.js"></script>
  <script src="./js/events/booking-select.js"></script>


  <!-- ! Import custom stylesheet -->
  <link rel="stylesheet" href="/css/stylesheet.css" />

  <link rel="icon" type="image/x-icon" href="/assets/universal/logo.png" />


</head>

<body class="bodyDefault">

  <!-- * Secondary nav, Image & Nav -->

  <!-- ! Secondary Nav -->
  <div class="nav-colour">
    <ul class="list-group list-group-horizontal justify-content-end">
      <li class="list-group-item"><a class="nav-link" href="#">Languages</a></li>
      <li class="list-group-item"><a class="nav-link" href="/staff-login">Staff</a></li>
    </ul>
  </div>

  <!-- ! Image -->
  <div class="nav-colour d-flex justify-content-center">
    <a class="navbar-brand" href="index.html">
      <img src="/assets/universal/logo.png" alt="Alba Cruises logo" width="140">
    </a>
  </div>

  <!-- ! Main Nav -->
  <nav class="nav-colour nav navbar navbar-expand-lg d-flex justify-content-center pt-3">
    <script type="module">
      // imports setnav function and runs it.
      import { setNav } from "./js/html/nav.js";
      setNav();
    </script>
  </nav>

  <!-- * Main Content -->

  <div class="container-fluid text-center">
    <!-- Booking Box & Departure Select -->
    <div class="row mt-4">

      <div class="col-md booking-form"> <!-- Booking Box -->
        <script>
          // Fetch the booking form and insert it here.
          fetch('/assets/html/booking-form.html') // Fetches the booking form HTML file.
            .then(response => response.text()) // Converts the response to text.
            .then(data => { // Inserts the fetched HTML into the booking-form div.
              var bookingForm = document.getElementsByClassName('booking-form')[0];
              bookingForm.innerHTML += data;
            });
        </script>
      </div>

      <div class="col-md"> <!-- Departure Select -->
        <h2 class="text-center">Departures</h2>

        <div class="row main-background mx-3" id="departure-select-container">
          <!-- Will be populated by database query based on selected parameters -->
          <?php
          include('./php/imports/code-error.php');
          include('./php/imports/booking/details.php');
          ?>
        </div>

      </div>
    </div>
    <!-- Return Select (If selected) -->
    <div class="row mt-2">
      <div class="col-md"> <!-- Blank Space -->
      </div>
      <div class="col-md"> <!-- Return Select -->
        <?php
        if (isset($_GET['returnDate'])) {
          echo '<h2 class="text-center">Returns</h2>';
          echo '<div class="row main-background mx-3" id="return-select-container">';
          include('./php/imports/booking/details.php');
          echo '</div>';
        }
        ?>
      </div>
    </div>

    <!-- Payment Area -->
    <div class="row mt-4">
      <div class="col-md"> <!-- Blank Space -->
      </div>
      <div class="col-md"> <!-- Payment Select -->
        <!-- <h2 class="text-center font-weight-bold"> Price </h2> -->
        <div class="row main-background mx-3" id="price-container">
          <?php
          include('./php/imports/booking/pricing.php');
          ?>

          <div class="py-3 text-center">
            <button type="submit" class="btn primary-button" id="bookTicketsButton" onclick="bookTickets()" disabled>Book Tickets</button>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>


  <!-- Footer -->
  <div class="footer container-fluid text-center bg-secondary border border-border">
    <script type="module">
      // imports setfooter function and runs it.
      import { setFooter } from "./js/html/footer.js";
      setFooter();
    </script>
  </div>

  <!-- Import Booking Search javascript -->
  <script src="./js/events/booking-search.js"></script>

  <!-- import jquery -->
   <script src ="./js/imports/jquery-3.7.1.min.js"></script>
</body>

</html>