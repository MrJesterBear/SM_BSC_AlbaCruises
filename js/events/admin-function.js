// 21005729 Saul Maylin
// 22/11/2025
// v1
// Admin Functions.

function updateStatistics() {
  const routeSelect = document.getElementById("routeSelect");
  const dateInput = document.getElementById("datePicker");

  const thisRoute = routeSelect.value;
  const thisDate = dateInput.value;

  if (thisRoute !== "" && thisDate !== "") {
    // With both fields populated, do an jquery ajax call to get statistics
    $.ajax({
      url: "./php/admin/get-statistics.php",
      method: "POST",
      data: {
        routeID: thisRoute,
        date: thisDate,
      },
      success: function (response) {
        // Handle the response from the server
        document.getElementById("routeStatistics").innerHTML = response;
      },
      error: function () {
        // Handle any errors
        document.getElementById("routeStatistics").innerHTML =
          "<h3 class='text-danger'>Error fetching statistics.</h3>";
      },
    });
  } else {
    // If either field is empty, prompt user to fill both.
    document.getElementById("routeStatistics").innerHTML =
      "<h3> Please select a date and route to show statistics.</h3>";
  }
}
