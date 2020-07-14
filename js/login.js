var myUserEntity = {};
function checkIfLoggedIn() {
  if (sessionStorage.getItem("myUserEntity") == null) {
    document.getElementById("logout").style.display = "none";
    document.getElementById("account").style.display = "none";
    document.getElementById("login").style.display = "inline-block";
  } else {
    document.getElementById("logout").style.display = "inline-block";
    document.getElementById("account").style.display = "inline-block";
    document.getElementById("login").style.display = "none";
  }
}

checkIfLoggedIn();

function onSignIn(googleUser) {
  console.log(getCookie("id"));
  if (getCookie("id") == undefined) {
    var profile = googleUser.getBasicProfile();
    myUserEntity.Id = profile.getId();
    myUserEntity.Name = profile.getName();
    document.cookie =
      "id=" +
      myUserEntity.Id +
      "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/;";
    location.reload();
  }
  // console.log(document.cookie)

  console.log("User logged in");
  sessionStorage.setItem("myUserEntity", JSON.stringify(myUserEntity));
  checkIfLoggedIn();
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log("User signed out.");
  });

  if (getCookie("id") !== undefined) {
    document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    sessionStorage.clear();
    location.reload();
    checkIfLoggedIn();
  }
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
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
