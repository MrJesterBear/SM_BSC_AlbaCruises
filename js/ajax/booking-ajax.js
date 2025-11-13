// Saul Maylin
// 13/11/2025
// v1.1
// Form handling for user booking via ajax.

class booking {
  callingName;
  destinationName;
  departDate;
  departTime;
  arivalTime;
  occupants;

  constructor(
    callingName,
    destinationName,
    departDate,
    departTime,
    arivalTime,
    adults,
    teens,
    children,
    infants
  ) {
    // apply variables.
    this.callingName = callingName;
    this.destinationName = destinationName;
    this.departDate = departDate;
    this.departTime = departTime;
    this.arivalTime = arivalTime;

    // Calculate total occupants.
    this.occupants =
      parseInt(adults) +
      parseInt(teens) +
      parseInt(children) +
      parseInt(infants);

  }

  bookSailing() {
    $.ajax({
      url: "./php/server/booking-process.php", // Where request is sent
      type: "POST", // Type of request
      data: {
        // Post Variables
        callingName: this.callingName,
        destinationName: this.destinationName,
        departDate: this.departDate,
        departTime: this.departTime,
        arivalTime: this.arivalTime,
        occupants: this.occupants,
      },
      success: function (data) {
        // When the php file has been executed succesfully.
        console.log("booking response:", data);
        switch (data.error) {
          case "ferry_not_found":
            windows.location.href = ""
            break;

          case "booking_failed":
            break;

          case "none":
            return true;
            break;
        }
      },
    });
  }
}
