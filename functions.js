var myUserEntity = {};
function checkIfLoggedIn() {
  if (sessionStorage.getItem("myUserEntity") == null) {
    document.getElementById("logout").style.display = "none";
    document.getElementById("account").style.display = "none";
    document.getElementById("login").style.display = "inline-block";
    console.log("signed out");
  } else {
    document.getElementById("logout").style.display = "inline-block";
    document.getElementById("account").style.display = "inline-block";
    document.getElementById("login").style.display = "none";
    // document.getElementById("logoutmessage").innerHTML =
    //  JSON.parse(sessionStorage.getItem("myUserEntity"))["Name"] + ",";
    console.log(sessionStorage.getItem("myUserEntity"));
  }
}

checkIfLoggedIn();

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  myUserEntity.Id = profile.getId();
  myUserEntity.Name = profile.getName();

  console.log("User logged in");
  sessionStorage.setItem("myUserEntity", JSON.stringify(myUserEntity));
  checkIfLoggedIn();
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log("User signed out.");
  });

  sessionStorage.clear();
  checkIfLoggedIn();
}

