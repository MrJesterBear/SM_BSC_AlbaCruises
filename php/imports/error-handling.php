<?php
//    Saul Maylin 21005729
//    29/10/2025
//    v1
// Error handling switch case for displaying error messages.

// If there is an error, display it.
if (isset($_GET['error'])) {
    $errortext;

    switch ($_GET['error']) {
        case 'NF': // Not Found
            $errortext = "The user you are trying to log in with does not exist. Please register an account or different credentials.";
            break;
        case 'DUP': // Duplicate Entry
            $errortext = "The email or username you are trying to register already exists. Please try a different email or username.";
            break;
        case 'PASS': // Incorrect Password
            $errortext = "The password you entered is incorrect. Please try again.";
            break;
        case 'REG': // Registration Failed
            $errortext = "The registration failed, Sorry about that! Please try again and if error persists, please contact website admin..";
            break;
        case 'UNKNOWN': // Unknown Error
            $errortext = "An unknown error occurred. Please try again later.";
            break;
        case 'UID': // User ID Error
            $errortext = "The user could not be registered due to a server error. Please try again later.";
            break;
        case 'NOT_LOGGED_IN': // Not logged in for booking
            $errortext = "You must be logged in to complete a booking. Please log in or register an account first.";
            break;
        default:
            break;
    }

    // Display the error using Bootstrap alert component.
    echo '<div class="alert alert-warning alert-dismissible fade show container text-center mt-3 mb-3" role="alert">' .
        $errortext .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>