// Saul Maylin
// 27/06/2025
// v1.5
// Form Validation

function validateForm(event, form) {
  // Universal Variables
  const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  let passValid = true;
  let usernameValid = true;
  let emailValid = true;

  let password;
  let email;
  let firstName;
  let lastName;

  let passwordError;
  let emailError;
  let firstNameError;
  let lastNameError;

  switch (form) {
    case "register":
      password = document.getElementsByClassName("password")[1].value;
      firstName = document.getElementsByClassName("firstName")[0].value;
      lastName = document.getElementsByClassName("lastName")[0].value;
      email = document.getElementsByClassName("email")[1].value;

      passwordError = document.getElementsByClassName("passwordError")[1];
      firstNameError = document.getElementsByClassName("firstNameError")[0];
      lastNameError = document.getElementsByClassName("lastNameError")[0];
      emailError = document.getElementsByClassName("emailError")[1];

      //? Email Validation
      // ! Empty Field
      if (email === "") {
        emailValid = false;

        // Display error message
        emailError.textContent =
          "An email must be provided to register an account! please try again.";
        emailError.style.color = "red";
      }
      // ! Email Format
      if (!emailPattern.test(email) && email !== "") {
        emailValid = false;

        // Display error message
        emailError.textContent =
          "The email address provided is not valid! Please ensure that it ends in a domain. E.G '@gmail.com'";
        emailError.style.color = "red";
      }

      // if valid, clear error
      if (emailValid) {
        emailError.textContent = "";
      }

      //? Password Validation
      // ! Empty Field
      if (password === "") {
        passValid = false;

        // Error Message
        passwordError.textContent = "Password must be filled out to proceed";
        passwordError.style.color = "red";
      }

      // if valid, clear error
      if (passValid) {
        passwordError.textContent = "";
      }

      //? Name Validation
      // ! First Name Empty Field
      if (firstName === "") {
        usernameValid = false;

        // Display error message
        firstNameError.textContent = "First name must be provided to proceed.";
        firstNameError.style.color = "red";
      }

      //  ! Last Name Empty Field
      if (lastName === "") {
        usernameValid = false;

        // Display error message
        lastNameError.textContent = "Last name must be provided to proceed.";
        lastNameError.style.color = "red";
      }

      // if valid, clear error
      if (firstNameValid) {
        firstNameError.textContent = "";
      }

      if (lastNameValid) {
        lastNameError.textContent = "";
      }

      // if true, form passes. if not, form fails.
      if (passValid && emailValid && firstNameValid && lastNameValid) {
        event.preventDefault();
        const handler = new userFormHandling(
          firstName,
          lastName,
          email,
          password
        );
        handler.registerUser();
      } else {
        event.preventDefault();
      }
      break;

    case "login":
      password = document.getElementsByClassName("password")[0].value;
      email = document.getElementsByClassName("email")[0].value;

      passwordError = document.getElementsByClassName("passwordError")[0];
      emailError = document.getElementsByClassName("emailError")[0];

      //? Password Validation
      // ! Empty Field
      if (password === "") {
        passValid = false;

        // Error Message
        passwordError.textContent = "Password must be filled out to proceed";
        passwordError.style.color = "red";
      }

      // if valid, clear error
      if (passValid) {
        passwordError.textContent = "";
      }

      //? Email Validation
      // ! Empty Field
      if (email === "") {
        emailValid = false;

        // Display error message
        emailError.textContent =
          "An email must be provided to register an account! please try again.";
        emailError.style.color = "red";
      }

      // ! Email Format
      if (!emailPattern.test(email) && email !== "") {
        emailValid = false;

        // Display error message
        emailError.textContent =
          "The email address provided is not valid! Please ensure that it ends in a domain. E.G '@gmail.com'";
        emailError.style.color = "red";
      }

      // if valid, clear error
      if (emailValid) {
        emailError.textContent = "";
      }

      // if true, form passes. if not, form fails.
      if (passValid && emailValid) {
        event.preventDefault();
        // const handler = new userFormHandling(email, "", password);
        // handler.loginUser();
      } else {
        event.preventDefault();
      }
      break;

    case "reset":
      email = document.getElementsByClassName("email")[0].value;
      emailError = document.getElementsByClassName("emailError")[0];

      // ! Email Format
      if (!emailPattern.test(email) && email !== "") {
        emailValid = false;

        // Display error message
        emailError.textContent =
          "The email address provided is not valid! Please ensure that it ends in a domain. E.G '@gmail.com'";
        emailError.style.color = "red";
      }

      // if valid, clear error
      if (emailValid) {
        emailError.textContent = "";
      }

      if (emailValid) {
        event.preventDefault();
        // const handler = new userFormHandling(email, "", "");
        // handler.resetUser();
      } else {
        event.preventDefault();
      }
      break;
    case "default":
      event.preventDefault();
      break;
  }
}
