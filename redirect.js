<<<<<<< HEAD
var myUserEntity = {};
=======
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

var myUserEntity = {}
>>>>>>> bfacd71890765563e9fd7171ca0a8587986c4586
function checkIfLoggedIn() {
  if (sessionStorage.getItem("myUserEntity") == null) {
    document.getElementById("logout").style.display = "none";
    document.getElementById("login").style.display = "block";
    console.log("signed out");
  } else {
    document.getElementById("logout").style.display = "block";
    document.getElementById("login").style.display = "none";
    document.getElementById("logoutmessage").innerHTML =
      "Welcome, " + JSON.parse(sessionStorage.getItem("myUserEntity"))["Name"];
    console.log(sessionStorage.getItem("myUserEntity"));
  }
}

checkIfLoggedIn();

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  myUserEntity.Id = profile.getId();
  myUserEntity.Name = profile.getName();

<<<<<<< HEAD
=======
  /*
    document.getElementById("signin").style.display = "none";
    document.getElementById("signout").style.display = "inline";
    document.getElementById("loginmessage").style.display = "none";
    document.getElementById("logoutmessage").innerHTML = "Welcome, " +
    myUserEntity.Name
    document.getElementById("logoutmessage").style.display = "block";
*/
>>>>>>> bfacd71890765563e9fd7171ca0a8587986c4586
  console.log("User logged in");
  sessionStorage.setItem("myUserEntity", JSON.stringify(myUserEntity));
  checkIfLoggedIn();
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log("User signed out.");
  });
<<<<<<< HEAD

  sessionStorage.clear();
  checkIfLoggedIn();
}

=======
  /*
    document.getElementById("signin").style.display = "inline";
    document.getElementById("signout").style.display = "none";
    document.getElementById("loginmessage").style.display = "inline";
    document.getElementById("logoutmessage").style.display = "none";
*/
  sessionStorage.clear();
  checkIfLoggedIn();
}
>>>>>>> bfacd71890765563e9fd7171ca0a8587986c4586
