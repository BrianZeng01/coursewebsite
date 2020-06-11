//Currently testing only one school but will implement redirection using
//mySQL by querying the given school and redirecting to the relevant page
function redirect() {
    var school = document.getElementById("search").value;
    console.log(school)
    if (school == "University of British Columbia") {
        window.location.pathname = "ubc.html"
    }
}
