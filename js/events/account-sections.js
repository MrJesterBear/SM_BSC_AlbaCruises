// Saul Maylin 21005729
// Date: 18/11/2025
// v1
// JS for Account Sections

// Load the booking page.
function changeToBooking() {
  if (document.getElementById("Account-Booking")) {
    return; // Already on the booking page, do nothing.
  }
  fetch("/assets/html/account-booking.html")
    .then((response) => response.text())
    .then((data) => {
      document.getElementsByClassName("Screen")[0].innerHTML = data;
      document
        .getElementsByClassName("Screen")[0]
        .setAttribute("id", "Account-Details");
    });
}
// Load the home page
function changeToHome() {
  if (document.getElementById("Account-Home")) {
    return; // Already on the home page, do nothing.
  }
  fetch("/assets/html/account-home.html")
    .then((response) => response.text())
    .then((data) => {
      document.getElementsByClassName("Screen")[0].innerHTML = data;
      document
        .getElementsByClassName("Screen")[0]
        .setAttribute("id", "Account-Home");
    });
}

// Load the account page
function changeToAccount() {
  if (document.getElementById("Account-Details")) {
    return; // Already on the account page, do nothing.
  }
  fetch("/assets/html/account-details.html")
    .then((response) => response.text())
    .then((data) => {
      document.getElementsByClassName("Screen")[0].innerHTML = data;
      document
        .getElementsByClassName("Screen")[0]
        .setAttribute("id", "Account-Details");
    });
}
