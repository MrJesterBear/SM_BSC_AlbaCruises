// Saul Maylin 21005729
// Booking Buttons Script
// 23/11/2025
// v2

// One way / Return buttons

// Get elements needed for the oneway / return trip buttons
document.addEventListener("DOMContentLoaded", () => {
  const oneWayBtn = document.getElementById("one-way-btn");
  const returnBtn = document.getElementById("return-btn");
  const returnDateInput = document.getElementById("return-date");
  const departDateInput = document.getElementById("depart-date");

  //  Event listeners for one way - add disabled tag to return date input.
  oneWayBtn.addEventListener("click", () => {
    if (!returnDateInput.hasAttribute("disabled")) {
      returnDateInput.setAttribute("disabled", "");
      returnDateInput.value = "";

      // Enable return button if disabled and disable one way button
      if (returnBtn.hasAttribute("disabled")) {
        returnBtn.removeAttribute("disabled");
        oneWayBtn.setAttribute("disabled", "");
      }
    }
  });

  // Event listener for return trip - remove disabled tag from return date input.
  returnBtn.addEventListener("click", () => {
    if (returnDateInput.hasAttribute("disabled")) {
      returnDateInput.removeAttribute("disabled");

      // Enable one way button if disabled and disable return button
      if (oneWayBtn.hasAttribute("disabled")) {
        oneWayBtn.removeAttribute("disabled");
        returnBtn.setAttribute("disabled", "");
      }
    }
  });

  // Set Minimum date for depart / return date based on the days date. https://stackoverflow.com/a/63154478
  //   const today = new Date().toISOString().split("T")[0];
  //   departDateInput.setAttribute("min", today);
  //   returnDateInput.setAttribute("min", today);

  // Ensure return date minimum is alwaays the same as the depart date
  //   departDateInput.addEventListener("change", () => {
  //     const departDateValue = departDateInput.value;
  //     returnDateInput.setAttribute("min", departDateValue);

  // if return isnt disabled, set the value of it to the new depart date to avoid errors.
  //     if (!returnDateInput.hasAttribute("disabled")) {
  //       if (returnDateInput.value < departDateValue)
  //       returnDateInput.value = departDateValue;
  //     }
  //   });

  if (
    document.URL.includes("tickets.php") ||
    document.URL.includes("change-booking.php")
  ) {
    // Update the values based on the URL parameters https://www.sitepoint.com/get-url-parameters-with-javascript/
    let urlParams = new URLSearchParams(window.location.search);

    const calling = urlParams.get("Calling");

    // set the parameters to the input values if they exist.

    if (calling != null) {
      document.getElementById("Calling").value = calling;
    }

    const destination = urlParams.get("Destination");

    if (destination != null) {
      document.getElementById("Destination").value = destination;
    }

    const adults = urlParams.get("Adult");

    if (adults != null) {
      document.getElementById("adult").value = adults;
    }

    const teens = urlParams.get("Teen");

    if (teens != null) {
      document.getElementById("Teen").value = teens;
    }

    const infants = urlParams.get("Infant");

    if (infants != null) {
      document.getElementById("Infant").value = infants;
    }

    const children = urlParams.get("Child");

    if (children != null) {
      document.getElementById("Child").value = children;
    }

    const departDate = urlParams.get("departDate");

    if (departDate != null) {
      departDateInput.value = departDate;
    }

    const returnDate = urlParams.get("returnDate");

    urlParams = null;

    if (returnDate != null) {
      // Enable return date input and disable return button and enable one way button
      if (returnDateInput.hasAttribute("disabled")) {
        returnDateInput.removeAttribute("disabled");
      }
      if (!returnBtn.hasAttribute("disabled")) {
        returnBtn.setAttribute("disabled", "");
      }
      if (oneWayBtn.hasAttribute("disabled")) {
        oneWayBtn.removeAttribute("disabled");
      }
    }
    returnDateInput.value = returnDate;
  }

  // Change the form submit action to become change-booking.php if on the change-booking.php page.
  if (document.URL.includes("change-booking.php")) {
    const form = document.getElementById("booking-search-form");
    form.setAttribute("action", "/change-booking.php");
  }
});
