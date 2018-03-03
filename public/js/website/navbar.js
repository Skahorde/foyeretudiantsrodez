/* Déroulement du menu responsive */
function menu() {
    var x = document.getElementById("navbar");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

/**
 * Application de la classe sticky lors du dépassement de la navbar.
 */
window.onscroll = function() { myFunction() };

function myFunction()
{
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky");
    $('#student_home_section').css('padding-top', 109);
  } else {
    navbar.classList.remove("sticky");
    $('#student_home_section').css('padding-top', 60);
  }

  let section = '';

  if (window.pageYOffset >= ($('#student_home_section').offset().top - $('#navbar').height() - 5))
  {
    section = 'student_home_section';
  }

  if (window.pageYOffset >= ($('#animations_section').offset().top - $('#navbar').height() - 5))
  {
    section = 'animations_section';
  }
  
  if (window.pageYOffset >= ($('#places_section').offset().top - $('#navbar').height() - 5))
  {
    section = 'places_section';
  }
  
  if (window.pageYOffset >= ($('#feedbacks_section').offset().top - $('#navbar').height() - 5))
  {
    section = 'feedbacks_section';
  }
  
  if (window.pageYOffset >= ($('#prices_section').offset().top - $('#navbar').height() - 5))
  {
    section = 'prices_section';
  }
  
  if (window.pageYOffset >= ($('#registration_section').offset().top - $('#navbar').height() - 5))
  {
    section = 'registration_section';
  }
  
  if (window.pageYOffset >= ($('#contacts_section').offset().top - $('#navbar').height() - 5))
  {
    section = 'contacts_section';
  }

  if (!$('#navbar a[href="#' + section + '"]').hasClass('active'))
  {
    $('#navbar a').removeClass('active');
    $('#navbar a[href="#' + section + '"]').addClass('active');
  }
}
