<!-- ? Name:  21005729 Saul Maylin
? Date: 03/11/2025
? v2
? Project: Alba Cruises
? -->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>New User | Alba Cruises</title>

  <!-- * Meta data for indexing-->
  <meta name="description" content="The login/register page for Alba Cruises." />
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

if (isset($_SESSION['UID'])) {
  // If user is logged in, redirect to the account page.
  header("Location: account.php");
}

if (isset($_SESSION['staff'])) {
  // If user is staff, redirect to the staff dashboard.
  header("Location: /administration.php");
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

  <div class="container-fluid text-center mt-4 mb-4">
    <div class="row text-white font-weight-bold">
      <!-- Login -->
      <div class="main-background border col-md px-5">
        <h1> Login </h1>
        <p> Login to view & manage your ferry tickets.</p>
        <form id="Login" onsubmit="return validateForm(event, 'login')">

          <!-- Email Row -->
          <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control email" id="email" placeholder="Enter Your Email..." max="300">
          </div>

          <!-- Email Error Row -->
          <div class="row mb-2">
            <div class="col-sm-10">
              <span id="emailError" class="text-danger emailError"></span>
            </div>
          </div>

          <!-- Password Row -->
          <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control password" id="password"
              placeholder="Enter Your Password...">
          </div>

          <!-- Password Error Row -->
          <div class="row mb-2">
            <div class="col-sm-10">
              <span id="passwordError" class="text-danger passwordError"></span>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="text-center mb-3">
            <button type="submit" class="btn primary-button">Login</button>
          </div>

        </form>
      </div>

      <!-- Register -->
      <div class="main-background border col-md px-5">
        <h1> Register </h1>
        <p> Register to purchase ferry tickets now!</p>
        <form id="Register" onsubmit="return validateForm(event, 'register')">

          <!-- First Name Row -->
          <div class="mb-2">
            <label for="firstName" class="form-label">First Name</label>
            <input name="firstName" type="text" class="form-control firstName" id="firstName"
              placeholder="Enter Your First Name..." max="150">
          </div>

          <!-- First Name Error Row -->
          <div class="row mb-2">
            <div class="col-sm-10">
              <span id="firstNameError" class="text-danger firstNameError"></span>
            </div>
          </div>

          <!-- Last Name Row -->
          <div class="mb-2">
            <label for="lastName" class="form-label">Last Name</label>
            <input name="lastName" type="text" class="form-control lastName" id="lastName"
              placeholder="Enter Your Last Name..." max="150">
          </div>

          <!-- Last Name Error Row -->
          <div class="row mb-2">
            <div class="col-sm-10">
              <span id="lastNameError" class="text-danger lastNameError"></span>
            </div>
          </div>

          <!-- Email Row -->
          <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control email" id="email" placeholder="Enter Your Email..." max="300">
          </div>

          <!-- Email Error Row -->
          <div class="row mb-2">
            <div class="col-sm-10">
              <span id="emailError" class="text-danger emailError"></span>
            </div>
          </div>

          <!-- Password Row -->
          <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control password" id="password"
              placeholder="Enter Your Password...">
          </div>

          <!-- Password Error Row -->
          <div class="row mb-2">
            <div class="col-sm-10">
              <span id="passwordError" class="text-danger passwordError"></span>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="text-center mb-3">
            <button type="submit" class="btn primary-button">Register an Account</button>
          </div>

        </form>
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

  <!-- Import Form validation script. -->
  <script src="./js/util/formValidation.js"></script>

  <!-- Import form handling for ajax  -->
  <script src="./js/ajax/userFormHandling.js"></script>

</body>

</html>