window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  var navbar = document.querySelector('.navbar');
  if (window.pageYOffset > 0) {
    navbar.classList.add("fixed");
  } else {
    navbar.classList.remove("fixed");
  }
}

var currentUrl = window.location.href;

var dashboardElement = document.getElementById("dashboard");
var ticketsElement = document.getElementById("tickets");
var studentsElement = document.getElementById("students");
var teachersElement = document.getElementById("teachers");
var subjectsElement = document.getElementById("subjects");

if (currentUrl.includes("dashboard")) {
  if (dashboardElement) {
    dashboardElement.classList.add("active");
    ticketsElement.classList.remove("active");
    studentsElement.classList.remove("active");
    teachersElement.classList.remove("active");
    subjectsElement.classList.remove("active");
  }
}else if(currentUrl.includes("tickets")){
    if (ticketsElement) {
        dashboardElement.classList.remove("active");
        ticketsElement.classList.add("active");
        studentsElement.classList.remove("active");
        teachersElement.classList.remove("active");
        subjectsElement.classList.remove("active");
      }
}else if(currentUrl.includes("studentView")){
    dashboardElement.classList.remove("active");
    ticketsElement.classList.remove("active");
    studentsElement.classList.add("active");
    teachersElement.classList.remove("active");
    subjectsElement.classList.remove("active");
}else if(currentUrl.includes("subjectView")){
    dashboardElement.classList.remove("active");
    ticketsElement.classList.remove("active");
    studentsElement.classList.remove("active");
    teachersElement.classList.remove("active");
    subjectsElement.classList.add("active");
}else if(currentUrl.includes("teacherView")){
    dashboardElement.classList.remove("active");
    ticketsElement.classList.remove("active");
    studentsElement.classList.remove("active");
    teachersElement.classList.add("active");
    subjectsElement.classList.remove("active");
}else{
    dashboardElement.classList.remove("active");
    ticketsElement.classList.remove("active");
    studentsElement.classList.remove("active");
    teachersElement.classList.remove("active");
    subjectsElement.classList.remove("active");
}
