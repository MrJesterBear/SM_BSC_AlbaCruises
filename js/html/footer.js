// 21005729 Saul Maylin
// 22/10/2025
// v2
// Footer HTML.

export function setFooter() {
  // get footer element
  const footer = document.getElementsByClassName("footer")[0];

  // Get current year for copyright notice
  const year = new Date().getFullYear();

  // set content.
  let footerHTML =
    "<div class='container-fluid text-center'>" +
    "<p class='text-white'>© " +
    year +
    " Alba Wildlife Cruises. All rights reserved.</p>" +
    "<a href='#' class='text-white'>Back to top</a>" +
    "</div>";
    
  footer.innerHTML = footerHTML;
}
