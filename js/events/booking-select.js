//   Saul Maylin 21005729
//   23/11/2025
//   v1.1
//   Project: Alba Cruises
//   Booking select events script

// Classes for booking.
let departure = new booking("null", "null", "null", "null", "null", 0, 0, 0, 0);
let returning = new booking("null", "null", "null", "null", "null", 0, 0, 0, 0);

// Option ints
let lastSelectedDeparture = null;
let lastSelectedReturn = null;

// Bools
let departureSelected = null;
let returnSelected = null;

// get number of occupants from booking form.
let urlParams = new URLSearchParams(window.location.search);

let noOfAdults = parseInt(urlParams.get("Adult"));
let noOfTeens = parseInt(urlParams.get("Teen"));
let noOfChildren = parseInt(urlParams.get("Child"));
let noOfInfants = parseInt(urlParams.get("Infant"));

// close object
urlParams = null;

function selectDeparture(event, option) {
  event.preventDefault();
  console.log("Departure option selected: " + option);

  // disable the selected button to prevent multiple selections
  if (lastSelectedDeparture === null) {
    lastSelectedDeparture = option;
    // disable selected button.
    document
      .getElementById("Departurebutton" + option)
      .setAttribute("disabled", "");
    // Change text of the button.
    document.getElementById("Departurebutton" + option).textContent =
      "Selected";
  } else {
    // enable last selected button.
    document
      .getElementById("Departurebutton" + lastSelectedDeparture)
      .removeAttribute("disabled");

    // disable new selected button.
    document
      .getElementById("Departurebutton" + option)
      .setAttribute("disabled", "");
    // Change text of the button.
    document.getElementById(
      "Departurebutton" + lastSelectedDeparture
    ).textContent = "Select";
    document.getElementById("Departurebutton" + option).textContent =
      "Selected";

    // update last selected variable.
    lastSelectedDeparture = option;
  }
  // get the needed details from the selected form.

  let timetableID = document.getElementsByClassName(
    "DepartureTimetableID" + option
  )[0].value;
  let callingName = document.getElementsByClassName(
    "DepartureCallingName" + option
  )[0].value;
  let destinationName = document.getElementsByClassName(
    "DepartureDestinationName" + option
  )[0].value;
  let departDate = document.getElementsByClassName(
    "DepartureDepartDate" + option
  )[0].value;

  // set the booking object.
  departure = new booking(
    timetableID,
    callingName,
    destinationName,
    departDate,
    noOfAdults,
    noOfTeens,
    noOfChildren,
    noOfInfants
  );

  console.log("Checking Selections.");
  checkSelections();
}

function selectReturn(event, option) {
  event.preventDefault();
  console.log("Return option selected: " + option);

  // disable the selected button to prevent multiple selections
  if (lastSelectedReturn === null) {
    lastSelectedReturn = option;
    // disable selected button.
    document
      .getElementById("Returnbutton" + option)
      .setAttribute("disabled", "");
    // Change text of the button.
    document.getElementById("Returnbutton" + option).textContent = "Selected";
  } else {
    // enable last selected button.
    document
      .getElementById("Returnbutton" + lastSelectedReturn)
      .removeAttribute("disabled");

    // Change text of the last selected button back to its original state.

    // disable new selected button.
    document
      .getElementById("Returnbutton" + option)
      .setAttribute("disabled", "");

    // Change text of the button.
    document.getElementById("Returnbutton" + option).textContent = "Selected";
    document.getElementById("Returnbutton" + lastSelectedReturn).textContent =
      "Select";

    // update last selected variable.
    lastSelectedReturn = option;
  }
  // check to see if both selections have been made.
  console.log("Checking Selections.");

  // get the needed details from the selected form.

  let timetableID = document.getElementsByClassName(
    "ReturnTimetableID" + option
  )[0].value;
  let callingName = document.getElementsByClassName(
    "ReturnCallingName" + option
  )[0].value;
  let destinationName = document.getElementsByClassName(
    "ReturnDestinationName" + option
  )[0].value;
  let departDate = document.getElementsByClassName(
    "ReturnDepartDate" + option
  )[0].value;

  // set the booking object.
  returning = new booking(
    timetableID,
    callingName,
    destinationName,
    departDate,
    noOfAdults,
    noOfTeens,
    noOfChildren,
    noOfInfants
  );

  checkSelections();
}

function checkSelections() {
  // collect the departure forms.
  const departures = document.getElementsByClassName("Departureform");

  // loop through to see if any have the disabled tag, showing they are selected.
  for (let i = 0; i < departures.length; i++) {
    for (let j = 0; j < departures[i].elements.length; j++) {
      if (departures[i].elements[j].disabled) {
        departureSelected = true; // Set variable to true if one is found.
      }
    }
  }

  if (departureSelected) {
    console.log("Departure has a selection");
  }

  // collect the return forms if exists.
  if (document.getElementsByClassName("Returnform").length != 0) {
    const returns = document.getElementsByClassName("Returnform");

    // loop through to see if any have the disabled tag, showing they are selected.
    for (let i = 0; i < returns.length; i++) {
      for (let j = 0; j < returns[i].elements.length; j++) {
        if (returns[i].elements[j].disabled) {
          returnSelected = true;
        }
      }
    }

    if (returnSelected) {
      console.log("Return has a selection");
    }

    // if both have been selected, enable the book tickets button.
    if (departureSelected && returnSelected) {
      console.log("Both selections made, enabling book tickets button.");
      document.getElementById("bookTicketsButton").removeAttribute("disabled");
    } else {
      document.getElementById("bookTicketsButton").setAttribute("disabled", "");
    }
  } else {
    // no return sailings exist, so enable book tickets button.
    if (departureSelected) {
      console.log(
        "Departure selection made but no return tickets needed, enabling book tickets button."
      );
      // also nullify the return booking object.
      returnBooking = null;

      document.getElementById("bookTicketsButton").removeAttribute("disabled");
    } else {
      document.getElementById("bookTicketsButton").setAttribute("disabled", "");
    }
  }
}

function bookTickets() {
  console.log("Booking Tickets...");
  console.log("Departure " + departure.toString());
  if (document.URL.includes("change-booking.php")) {
    departure.updateDepart();
  } else {
    departure.bookSailing();
  }
}

// Run by the ajax function to book the return.
function bookReturn() {
  if (returnSelected != null) {
    // do the return booking.
    console.log("Return " + returning.toString());

    if (document.URL.includes("change-booking.php")) {
      returning.updateReturn();
    } else {
      returning.bookReturn();
    }
  } else {
    // If there is no return, just redirect to the confirmation page.
    console.log("No return booking needed, redirecting to confirmation page.");

    if (document.URL.includes("change-booking.php")) {
      window.location.href = "./confirmation.php?type=edit";
    } else {
      window.location.href = "./confirmation.php";
    }
  }
}
