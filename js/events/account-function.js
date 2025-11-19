// Saul Maylin 21005729
// Date: 19/11/2025
// v1.1
// JS for Account Functions

// Global Variables
let lastChosenBooking = null;

// Account Details Section

// Details Update
function updateDetails(newEmail, newFirstName, newLastName) {
  // get the ids of the boxes needed.
  const emailShowcase = document.getElementById("account-email");
  const firstNameShowcase = document.getElementById("account-firstname");
  const lastNameShowcase = document.getElementById("account-lastname");

  // then change the details with the new ones.
  emailShowcase.textContent = newEmail;
  firstNameShowcase.textContent = newFirstName;
  lastNameShowcase.textContent = newLastName;
}

// Delete Account Function
function deleteAccount() {
  const confirmCheckbox = document.getElementById("confirm-delete-account");

  if (!confirmCheckbox.checked) {
    // Show the checkbox and label if not already visible
    confirmCheckbox.hidden = false;
    const label = document.getElementById("delete-label");
    label.hidden = false;
    return; // Exit the function to allow user to confirm
  } else {
    // Proceed with account deletion
  }
}

// Booking Details Section

// Show/Hide booking details.
function showBookingDetails(bookingID) {
  // If the last booking is null, just unhide the current one.
  if (lastChosenBooking === null) {
    const bookingDiv = document.getElementById("bookingDetails" + bookingID);
    bookingDiv.hidden = false;
    lastChosenBooking = bookingID;
    return;
  } else {
    // If the last booking is the same as the current one, just hide it, otherwise switch.
    if (lastChosenBooking === bookingID) {
      const bookingDiv = document.getElementById("bookingDetails" + bookingID);
      bookingDiv.hidden = true;
      lastChosenBooking = null;
      return;
    } else {
      // Hide the last one
      const lastBookingDiv = document.getElementById(
        "bookingDetails" + lastChosenBooking
      );
      lastBookingDiv.hidden = true;

      // Show the current one
      const bookingDiv = document.getElementById("bookingDetails" + bookingID);
      bookingDiv.hidden = false;
      lastChosenBooking = bookingID;
    }
  }
}

// Delete Booking Function (Like Delete Account)
function cancelBooking(bookingID) {
  const confirmCheckbox = document.getElementById(
    "confirm-cancel-booking-" + bookingID
  );

  if (!confirmCheckbox.checked) {
    // Show the checkbox and label if not already visible
    confirmCheckbox.hidden = false;
    const label = document.getElementById("cancel-label-" + bookingID);
    label.hidden = false;
    return; // Exit the function to allow user to confirm
  } else {
    // Proceed with booking cancellation
  }
}
