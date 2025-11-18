// Saul Maylin 21005729
// Date: 18/11/2025
// v1
// JS for Account Sections

// Load the booking page.
function changeToBooking() {
  if (document.getElementById("Account-Booking")) {
    return; // Already on the booking page, do nothing.
  }
  fetch("/assets/html/account-booking.php")
    .then((response) => response.text())
    .then((data) => {
      document.getElementsByClassName("Screen")[0].innerHTML = data;
      document
        .getElementsByClassName("Screen")[0]
        .setAttribute("id", "Account-Details");
    });
  changeHeader("Bookings");
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
  changeHeader("Home");
}

// Load the account page
function changeToAccount() {
  if (document.getElementById("Account-Details")) {
    return; // Already on the account page, do nothing.
  }
  fetch("/assets/html/account-details.php")
    .then((response) => response.text())
    .then((data) => {
      document.getElementsByClassName("Screen")[0].innerHTML = data;
      document
        .getElementsByClassName("Screen")[0]
        .setAttribute("id", "Account-Details");
    })
    .then(() => {
      // Populate the user details after loading the account details section.
      // Php will echo out a box calling the updateDetails function with the user details.
      // take the details from the php and put them in their place, then destroy box.
      const detailBox = document.getElementById("hiddenDetails");
      if (detailBox !== null) {
        const userEmail = document.getElementById('email').textContent;
        const userFirstName = document.getElementById('firstName').textContent;
        const userLastName = document.getElementById('lastName').textContent;

        // call a function.
        updateDetails(userEmail, userFirstName, userLastName);
        detailBox.remove();
      }
    });
  changeHeader("Profile");
}

function changeHeader(title) {
  document.getElementsByClassName("screen-header")[0].textContent = title;
}
