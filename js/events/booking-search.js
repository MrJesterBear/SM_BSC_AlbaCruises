// Saul Maylin 21005729
// Booking Buttons Script
// 29/10/2025
// v1

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
  const today = new Date().toISOString().split("T")[0];
  departDateInput.setAttribute("min", today);
  returnDateInput.setAttribute("min", today);

  // Ensure return date minimum is alwaays the same as the depart date
  departDateInput.addEventListener("change", () => {
    const departDateValue = departDateInput.value;
    returnDateInput.setAttribute("min", departDateValue);

    // if return isnt disabled, set the value of it to the new depart date to avoid errors.
    if (!returnDateInput.hasAttribute("disabled")) {
      returnDateInput.value = departDateValue;
    }
  });
});
