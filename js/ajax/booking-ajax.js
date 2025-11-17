// Saul Maylin
// 13/11/2025
// v1.1
// Form handling for user booking via ajax.

class booking {
  timetableID;
  callingName;
  destinationName;
  departDate;
  occupants;

  constructor(
    timetableID,
    callingName,
    destinationName,
    departDate,
    adults,
    teens,
    children,
    infants
  ) {
    // apply variables.
    this.timetableID = timetableID;
    this.callingName = callingName;
    this.destinationName = destinationName;
    this.departDate = departDate;

    // Calculate total occupants.
    this.occupants = (adults + teens + children + infants);
  }

  bookSailing() {
    $.ajax({
      url: "./php/server/booking-process.php", // Where request is sent
      type: "POST", // Type of request
      data: {
        // Post Variables
        timetableID: this.timetableID,
        callingName: this.callingName,
        destinationName: this.destinationName,
        departDate: this.departDate,
        occupants: this.occupants,
      },
      success: function (data) {
        // When the php file has been executed succesfully.
        console.log("booking response:", data);
        switch (data.error) {
          case "ferry_not_found":
            console.log("Ferry not found.");
            break;

          case "booking_failed":
            console.log("Booking failed.");
            break;
          case "not_logged_in":
            console.log("User not logged in.");
            window.location.href = "./new-user.php?error=NOT_LOGGED_IN";
            break;

          case "NONE":
            console.log("depart ticket booked successfully.");
            // call the return booking function
            bookReturn();
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error processing booking:");
        return false;
      }
    });
  }

    bookReturn() {
    $.ajax({
      url: "./php/server/booking-process.php", // Where request is sent
      type: "POST", // Type of request
      data: {
        // Post Variables
        timetableID: this.timetableID,
        callingName: this.callingName,
        destinationName: this.destinationName,
        departDate: this.departDate,
        occupants: this.occupants,
      },
      success: function (data) {
        // When the php file has been executed succesfully.
        console.log("booking response:", data);
        switch (data.error) {
          case "ferry_not_found":
            console.log("Ferry not found.");
            break;

          case "booking_failed":
            console.log("Booking failed.");
            break;
          case "not_logged_in":
            console.log("User not logged in.");
            window.location.href = "./new-user.php?error=NOT_LOGGED_IN";
            break;

          case "NONE":
            console.log("Ticket booked successfully.");
            window.location.href = "./book-ticket.php";
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error processing booking:");
        return false;
      }
    });
  }

  toString() {
    return (
      "Booking Details: " +
      this.timetableID +
      " - " +
      this.callingName +
      " to " +
      this.destinationName +
      " on " +
      this.departDate +
      " for " +
      this.occupants +
      " occupants."
    );
  }
}
