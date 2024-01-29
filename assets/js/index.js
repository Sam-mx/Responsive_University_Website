function myFunction() {
    var x = document.getElementById("nav_head");
    if (x.className === "nav_header") {
      x.className += " responsive";
    } else {
      x.className = "nav_header";
    }
  }

  /*slides*/

  let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }

  slides[slideIndex-1].style.display = "block";
}
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000);    
}
  /*slides*/



//News
$(document).ready(function(){
  $("#news-slider").owlCarousel({
    items:3,
    navigation:true,
    navigationText:["",""],
    autoPlay:true
  });
});
//News

//Study Area Buttons
function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("buscontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("buslink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].parentElement.style.backgroundColor = "#fff";
    tablinks[i].style.color = "#303030";
    tablinks[i].style.backgroundColor = "";
  }
  
  
  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";
  
  // Add the specific color to the button used to open the tab content
  elmnt.parentElement.style.backgroundColor = "#303030";
  elmnt.style.color=color;
}
//Study Area Buttons


//Find Course

function findcourse() {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
          li[i].style.display = "";
      } else {
          li[i].style.display = "none";
      }
  }
}
//Find Course