// Saul Maylin 21005729
// Date: 18/11/2025
// v1
// JS for Account Functions

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