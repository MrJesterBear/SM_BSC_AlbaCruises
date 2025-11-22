<!-- ? Name:  21005729 Saul Maylin
? Date: 121/11/2025
? v1.2
? Project: Alba Cruises
? -->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Account | Alba Cruises</title>

  <!-- * Meta data for indexing-->
  <meta name="description" content="The account page for Alba Cruises." />
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
// Double check user is not logged in.
session_start();

if (!isset($_SESSION['UID'])) {
  // If user is not logged in, redirect to the home page.
  header("Location: /");
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

  <!-- Error Warning -->
  <?php
  include_once("./php/imports/error-handling.php");
  ?>


  <!-- * Main Content -->
  <!-- Using some exerpts from some of my old unfinished projects: https://github.com/MrJesterBear/Portfolio & https://github.com/MrJesterBear/Project-Crawler -->
  <div class="container text-center">
    <h2> ALBA Cruises</h2>
    <p class="screen-header">Home</p>
  </div>

  <div class="container text-center Screen my-3">
    <!-- Fetch the home screen html page. -->
    <script>
      fetch("/assets/html/account-home.html")
        .then(response => response.text())
        .then(data => {
          document.getElementsByClassName('Screen')[0].innerHTML = data;
          document.getElementsByClassName('Screen')[0].setAttribute('id', 'Account-Home');
        });
    </script>
  </div>

  <!-- Navigaion for account pages. -->
  <div class="container-fluid secondary-background py-3">
    <div class="row">
      <div class="col d-flex justify-content-center">
        <a href="#" onclick=changeToBooking()><img src="/assets/account/calendar-nav.png" alt="Account booking graphic"
            class="img-fluid" /></a>
      </div>
      <div class="col d-flex justify-content-center">
        <a href="#" onclick=changeToHome()><img src="/assets/account/home-nav.png" alt="Account Home graphic"
            class="img-fluid" /></a>
      </div>
      <div class="col d-flex justify-content-center">
        <a href="#" onclick=changeToAccount()><img src="/assets/account/user-nav.png" alt="Account account graphic"
            class="img-fluid" /></a>
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

  <script src="./js/events/account-sections.js"></script>
  <script src="./js/events/account-function.js"></script>
</body>

</html>