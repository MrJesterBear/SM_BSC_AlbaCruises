<!-- ? Name:  21005729 Saul Maylin
? Date: 22/10/2025
? v1
? Project: Alba Cruises
? -->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Account | Alba Cruises</title>

  <!-- * Meta data for indexing-->
  <meta name="description" content="The home page for Alba Cruises." />
  <meta name="keywords" content="Alba, Cruises, Travel, Adventure, booking, ferry" />
  <meta name="author" content="21005729 Saul Maylin" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- * Links for both the stylesheet for pazas and a favicon for the site.-->
  <link rel="stylesheet" href="/css/stylesheet.css" />

  <!-- ! Import Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />

  <!-- ! Import bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

  <link rel="icon" type="image/x-icon" href="/assets/universal/logo.png" />


</head>

<body class="bodyDefault">

  <!-- * Secondary nav, Image & Nav -->

<!-- ! Secondary Nav -->
 <div class="nav-colour">
    <ul class = "list-group list-group-horizontal justify-content-end">
      <li class ="list-group-item"><a class = "nav-link" href="#">Languages</a></li>
      <li class ="list-group-item"><a class = "nav-link" href="/staff-login">Staff</a></li>
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

  </div>

  <!-- Footer -->
  <div class="footer container-fluid text-center bg-secondary border border-border">
    <script type="module">
      // imports setfooter function and runs it.
      import { setFooter } from "./js/html/footer.js";
      setFooter();
    </script>
  </div>


</body>

</html>