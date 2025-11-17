// Saul Maylin
// 03/11/2025
// v1.5
// Form handling for user registration and login.

class userFormHandling {
  firstName;
  lastName;
  email;
  password;

  constructor(firstName, lastName, email, password) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.email = email;
    this.password = password;
  }

  registerUser() {
    $.ajax({
      url: "./php/server/account-check.php?type=register", // Where request is sent
      type: "POST", // Type of request
      data: {
        // Post Variables
        firstName: this.firstName,
        lastName: this.lastName,
        email: this.email,
        password: this.password,
      },
      success: function (data) {
        // When the php file has been executed succesfully.
        console.log("register response:", data);
        switch (data.error) {
          case "NOT_FOUND": // User not found.
            window.location.href = "./new-user.php?error=NF";
            break;
          case "DUP": // email or username already exists.
            window.location.href = "./new-user.php?error=DUP";
            break;
          case "PASS": // Password incorrect.
            window.location.href = "./new-user.php?error=PASS";
            break;
          case "REG": // Registration failed, server down?
            window.location.href = "./new-user.php?error=REG";
            break;
          case "UID": // Failed UID check, server down?
            window.location.href = "./new-user.php?error=UID";
            break;
          case "NONE": // No error, user logged in successfully
            // get current url paramters.
            const urlParams = new URLSearchParams(window.location.search);
            const redirect = urlParams.get("error");
            if (redirect === "NOT_LOGGED_IN") {
              // if user was redirected here from a booking attempt, send them to tickets.
              window.location.href = "./tickets.php";
              break;
            }

            window.location.href = "./account.php";
            break;
          default: // Unknown error
            window.location.href = "./new-user.php?error=UNKNOWN";
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error registering in user:", error, status);
        window.location.href = "./new-user.php?error=UNKNOWN";
      },
    });
  }

  loginUser() {
    $.ajax({
      url: "./php/server/account-check.php?type=login",
      type: "POST",
      data: {
        email: this.email,
        password: this.password,
      },
      success: function (data) {
        console.log("Login response:", data);
        switch (data.error) {
          case "NOT_FOUND": // User not found.
            window.location.href = "./new-user.php?error=NF";
            break;
          case "DUP": // email or username already exists.
            window.location.href = "./new-user.php?error=DUP";
            break;
          case "PASS": // Password incorrect.
            window.location.href = "./new-user.php?error=PASS";
            break;
          case "REG": // Registration failed, server down?
            window.location.href = "./new-user.php?error=REG";
            break;
          case "UID": // Failed UID check, server down?
            window.location.href = "./new-user.php?error=UID";
            break;
          case "NONE": // No error, user logged in successfully
            // get current url paramters.
            const urlParams = new URLSearchParams(window.location.search);
            const redirect = urlParams.get("error");
            if (redirect === "NOT_LOGGED_IN") {
              // if user was redirected here from a booking attempt, send them to tickets.
              window.location.href = "./tickets.php";
              break;
            }
            window.location.href = "./account.php";
            break;
          default: // Unknown error
            window.location.href = "./new-user.php?error=UNKNOWN";
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error logging in user:", error, status);
        window.location.href = "./new-user.php?error=UNKNOWN";
      },
    });
  }
}
