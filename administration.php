<!-- ? Name:  21005729 Saul Maylin
? Date: 22/11/2025
? v1.1
? Project: Alba Cruises
? -->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Administration | Alba Cruises</title>

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

  <!-- ! Import custom stylesheet -->
  <link rel="stylesheet" href="/css/stylesheet.css" />

  <link rel="icon" type="image/x-icon" href="/assets/universal/logo.png" />


</head>

<?php
session_start();
if (!isset($_SESSION['staff']) || $_SESSION['staff'] != true) {
  // If user is not staff, redirect to the login page.
  header("Location: /new-user.php");
}
?>

<body class="bodyDefault">

  <!-- * Secondary nav, Image & Nav -->

  <!-- ! Secondary Nav -->
  <div class="nav-colour">
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
  <nav class="nav-colour nav navbar navbar-expand-lg d-flex justify-content-center pt-3">
    <script type="module">
      // imports setnav function and runs it.
      import { setNav } from "./js/html/nav.js";
      setNav();
    </script>
  </nav>

  <!-- * Main Content -->
  <div class="container text-center">
    <h2> ALBA Cruises</h2>
    <p>Staff</p>
  </div>

  <div class="container text-center text-white py-3">
    <div class="row my-2">

      <div class="col-md">

        <div class="py-2 main-background">
          <h3> Select a date: </h3>
          <input type="date" id="datePicker" name="datePicker" />

          <h3> Select a route: </h3>
          <select id="routeSelect" name="routeSelect">
            <option value="">Select a route: </option>
            <?php
            include("./php/imports/connection.php");
            include("./php/imports/code-error.php");

            // Fetch routes from the database to populate the select options.
            $routes = $DB->prepare("SELECT routeID, routeDesc FROM AlbaRoutes");
            if ($routes->execute()) {
              $routes->store_result();
              $routes->bind_result($routeID, $routeDesc);
              while ($routes->fetch()) {
                echo "<option value='" . $routeID . "'>" . $routeDesc . "</option>";
              }
              echo "</select>";
            } else {
              echo "<option value='error'>Error fetching routes</option>";
              echo "</select>";
            }

            $routes->close();
            ?>
            <!-- Button to fetch statistics -->
            <br>
            <button class="btn primary-button mt-3" onclick="updateStatistics()">Get Statistics</button>

        </div>

      </div>

      <div class="col-md mt-2 main-background" id="routeStatistics">
        <h3> Please select a date and route to show statistics.</h3>
      </div>

    </div>

    <div class="row">
      <div class="col-md">
        <!-- Spacer Row  -->
      </div>

      <div class="col-md main-background" id="SeasonStatistics">
        <?php
        // Assume that the season start/end dates are defined by the first timetable.
        $stmt = $DB->prepare("SELECT timetableStart, timetableEnd FROM AlbaTimetable LIMIT 1");
        if ($stmt->execute()) {
          $stmt->store_result();
          $stmt->bind_result($timetableStart, $timetableEnd);
          if ($stmt->fetch()) {
            // Format dates for display then echo out the season.
            $startDate = date_create($timetableStart);
            $endDate = date_create($timetableEnd);
            $formattedStart = date_format($startDate, "jS F Y");
            $formattedEnd = date_format($endDate, "jS F Y");
            echo "<h3> Season " . $formattedStart . " to " . $formattedEnd . " </h3>";

            // Calculate total revenue for the season.
            $revenueStmt = $DB->prepare("SELECT SUM(totalPaid) FROM AlbaBookings 
                                                        WHERE bookingID IN
                                                        (SELECT DISTINCT bookingID
                                                        FROM AlbaTickets
                                                        WHERE bookingDate >= ? and bookingDate <= ?)");
            $revenueStmt->bind_param("ss", $timetableStart, $timetableEnd);
            if ($revenueStmt->execute()) {
              // Store and bind.
              $revenueStmt->store_result();
              $revenueStmt->bind_result($totalRevenue);

              if ($revenueStmt->fetch()) {
                // Display total revenue formatted to 2 decimal places.
                $formattedRevenue = number_format($totalRevenue, 2);
                echo "<p class='my-2'> Total Revenue: £" . $formattedRevenue . "</p>";
              } else {
                echo "<p class = 'text-danger'>Error calculating season revenue.</p>";
              }

              $revenueStmt->close();
            } else {
              echo "<p class = 'text-danger'>Error calculating season revenue.</p>";
            }

            // Calculate total tickets (holders of tickets, not occupants) sold in the season.
            $ticketsStmt = $DB->prepare("SELECT COUNT(ticketID) FROM AlbaTickets 
                                                    WHERE bookingDate >= ? and bookingDate <= ?");
            $ticketsStmt->bind_param("ss", $timetableStart, $timetableEnd);
            if ($ticketsStmt->execute()) {
              // Store and bind.
              $ticketsStmt->store_result();
              $ticketsStmt->bind_result($totalTickets);

              if ($ticketsStmt->fetch()) {
                // Display total tickets sold.
                echo "<p class='my-2'> Total Tickets Sold: " . $totalTickets . "</p>";
              } else {
                echo "<p class = 'text-danger'>Error calculating season tickets sold.</p>";
              }

              $ticketsStmt->close();
            } else {
              echo "<p class = 'text-danger'>Error calculating season tickets sold.</p>";
            }

          } else {
            echo "<p class = 'text-danger'>No season data found.</p>";
          }
        } else {
          echo "<p class = 'text-danger'>Error fetching season dates.</p>";
        }
        $stmt->close();
        ?>
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

  <!-- Javascript import for data functionality -->
  <script src="./js/imports/jquery-3.7.1.min.js"></script>
  <script src="./js/events/admin-function.js"></script>
</body>

</html>