
//Currently testing only one school but will implement redirection using
//mySQL by querying the given school and redirecting to the relevant page
function redirect() {
    var school = document.getElementById("search").value;
    console.log(school);
    if (school == "University of British Columbia") {
        window.location.pathname = "ubc.html";
    } else {
        document.getElementById("invalidschool").innerHTML =
        "Sorry, school not found";
    }
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var myUserEntity = {};
    myUserEntity.Id = profile.getId();
    myUserEntity.Name = profile.getName();

    document.getElementById("signin").style.display = "none";
    document.getElementById("signout").style.display = "inline";
    console.log("User logged in");
    sessionStorage.setItem("myUserEntity",JSON.stringify(myUserEntity));
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function (){
        console.log("User signed out.");
    });

    document.getElementById("signin").style.display = "inline";
    document.getElementById("signout").style.display = "none";
    sessionStorage.clear();
}