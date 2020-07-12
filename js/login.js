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
    // console.log(sessionStorage.getItem("myUserEntity"));
  }
}

checkIfLoggedIn();

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  myUserEntity.Id = profile.getId();
  myUserEntity.Name = profile.getName();

  if(document.getElementById("makeReview") != null) {
    console.log("here");
    document.getElementById("makeReview").setAttribute("type", "submit");
  }
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

// window.fbAsyncInit = function () {
//   FB.init({
//     appId: "289319202271527",
//     cookie: true,
//     xfbml: true,
//     version: "v7.0.",
//   });

//   FB.AppEvents.logPageView();
// };

// (function (d, s, id) {
//   var js,
//     fjs = d.getElementsByTagName(s)[0];
//   if (d.getElementById(id)) {
//     return;
//   }
//   js = d.createElement(s);
//   js.id = id;
//   js.src = "https://connect.facebook.net/en_US/sdk.js";
//   fjs.parentNode.insertBefore(js, fjs);
// })(document, "script", "facebook-jssdk");

// function checkLoginState() {
//   FB.getLoginStatus(function (response) {
//     statusChangeCallback(response);
//   });
// }