// 21005729 Saul Maylin
// 22/11/2025
// v2.1
// Nav HTML.

// Navbar Function.
import { checkCookie, setCookie } from "../util/cookies.js";

export function setNav() {
  // get nav element
  const nav = document.getElementsByClassName("nav")[0];

  // Sets the nav bar! Taken from Bootstrap and reformatted to fit the site.
  // https://getbootstrap.com/docs/5.3/components/navbar/

  let navHTML =
    // Nav Container and Hamburger Menu
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">' +
    '<span class="navbar-toggler-icon"></span>' +
    "</button>" +
    '<div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">' +
    '<ul class="navbar-nav">' +
    // Home Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="/">Home</a>' +
    "</li>" +
    // Tickets Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="/tickets.php">Tickets</a>' +
    "</li>" +
    // About Us Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="/about-us.html">About Us</a>' +
    "</li>" +
    // Contact Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="/contact.html">Contact</a>' +
    "</li>";

  if (document.URL.includes("/administration.php")) {
    // Acount link will be the actual account page instead for staff.
    navHTML +=
      '<li class="nav-item px-5">' +
      '<a class="nav-link border" href="/account.php">Account</a>' +
      "</li>";
  } else;
  {
    // Account Link
    '<li class="nav-item px-5">' +
      '<a class="nav-link border" href="/new-user.php">Account</a>' +
      "</li>";
  }

  // close up the nav and make inner html.
  navHTML += "</ul> </div>";
  nav.innerHTML = navHTML;
}

// Check if the cookie is set for logged in.
function checkNav() {
  if (!checkCookie("loggedIn")) {
    setCookie("loggedIn", 0, 30);
    return false;
  }

  if (checkCookie("loggedIn") == 1) {
    return true;
  }
}
