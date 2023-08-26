/* Hiding Navigation_Bar on scrolling */
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("NavBar").style.top = "0";
  } else {
    document.getElementById("NavBar").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}

function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal);

// To check the scroll position on the page load
reveal();

function reveal_horizontal() {
  var reveals = document.querySelectorAll(".reveal_horizontal");

  for (var i = 0; i < reveals.length; i++) {
    var windowWidth = window.innerWidth; // Use window.innerWidth to get the window width
    var elementLeft = reveals[i].getBoundingClientRect().left; // Use getBoundingClientRect().left to get the element's distance from the left of the viewport
    var elementVisible = 150;

    if (elementLeft < windowWidth - elementVisible) { // Check if the element is visible within 150px from the right edge of the viewport
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal_horizontal);

reveal_horizontal();
