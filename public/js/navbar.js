/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function menu() {
    var x = document.getElementById("navbar");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
} 

window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

$(document).ready(function() {
  // get current URL path and assign 'active' class
  var pathname = window.location.pathname;
  $('.navbar > a[href="'+pathname+'"]').parent().addClass('active');
})