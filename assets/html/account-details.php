<!--  
 Saul Maylin
 18/11/2025
 v1
Account Details Page.
-->
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container my-3">
        <!-- Row, Big user Details changer & buttons.-->
        <div class="row mt-3 text-center">
            <!-- Details Row  -->
            <div class="col-md">
                <h3>Account Details</h3>
                <div class="account-details-box main-background text-white">
                    <p><strong>Email: </strong></p>
                    <p id="account-email"> </p>

                    <p><strong> Password: </strong></p>
                    <p id="account-password"> ********** </p> <!-- never store a password plaintext. -->

                    <p><strong> First Name </strong></p>
                    <p id="account-firstname"> </p>

                    <p><strong> Last Name </strong></p>
                    <p id="account-lastname"> </p>


                </div>

            </div>

            <!-- Buttons Row  -->
            <div class="col-md">
                <!-- Logout -->
                <h3 class="text-black"> Account Actions </h3>
                <div class="row">
                    <div class="col logout-box">
                        <a class="btn btn-primary my-2" href="/php/server/logout.php">Logout</a>
                        <a class="btn btn-danger my-2" onclick="deleteAccount()">Delete Account</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="checkbox" id="confirm-delete-account" hidden />
                        <label id="delete-label" for="confirm-delete-account" class="text-danger" hidden> I confirm I
                            want to delete my account. </label>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- php to find the user details and store. -->
    <?php
    require('../../php/imports/connection.php');
    require('../../php/imports/code-error.php');
    session_start();
    // Run query to get details, then call previously defined function.
    $stmt = $DB->prepare(("SELECT firstName, lastName, email FROM AlbaCustomers WHERE customerID = ?"));
    $stmt->bind_param("i", $_SESSION['UID']);
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($firstName, $lastName, $email);
        $stmt->fetch();

        echo
            // Display a hidden div for later purposes.
            '<div id = "hiddenDetails" class = "d-none">',
            '<p id = "email">' . $email . '</p>',
            '<p id = "firstName">' . $firstName . '</p>',
            '<p id = "lastName">' . $lastName . '</p>',
            '</div>';

    } else {
        // if error, echo out at the bottom.
        echo "<h3 class='text-danger'> An error occurred fetching your details. Please try again later. </h3>";
    }


    ?>

</body>

</html>