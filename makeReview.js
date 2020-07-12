function loggedIn() {
  if (sessionStorage.getItem("myUserEntity") == null) {
    document.getElementById("makeReview").setAttribute("type", "button");
    document.getElementById("makeReview").setAttribute("onclick", "notLoggedIn();");
  } else {
    document.getElementById("makeReview").setAttribute("type", "submit");
    document.getElementById("makeReview").removeAttribute("onclick");
  }
}
function notLoggedIn() {
  document.getElementById("notLoggedIn").innerHTML =
    "Must be signed in to leave a review";
}

loggedIn();
