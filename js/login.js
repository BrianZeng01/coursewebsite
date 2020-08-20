function displayLogin() {
  if (getCookie("id") == undefined) {
    document.getElementById("logout").style.display = "none";
    document.getElementById("account").style.display = "none";
    document.getElementById("login").style.display = "inline-block";
  } else {
    document.getElementById("logout").style.display = "inline-block";
    document.getElementById("account").style.display = "inline-block";
    document.getElementById("login").style.display = "none";
    console.log("Logged in via " + getCookie("thirdParty"));
  }
}

function onSignIn(googleUser) {
  if (getCookie("id") == undefined) {
    var myUserEntity = {};
    var profile = googleUser.getBasicProfile();
    myUserEntity.Id = profile.getId();
    myUserEntity.Name = profile.getGivenName();
    document.cookie =
      "id=" +
      myUserEntity.Id +
      "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/;  SameSite=None; Secure";
    document.cookie =
      "name=" +
      myUserEntity.Name +
      "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/; SameSite=None; Secure";
    document.cookie =
      "thirdParty=Google; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/; SameSite=None; Secure";

    sessionStorage.setItem("myUserEntity", JSON.stringify(myUserEntity));
    location.reload();
  }
}

function signOut() {
  if (getCookie("id") !== undefined) {
    if (getCookie("thirdParty") == "Google") {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log("User signed out of Google.");
      });
    }

    if (getCookie("thirdParty") == "Facebook") {
      FB.logout(function (response) {
        console.log("User signed out of Facebook");
      });
    }

    document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie =
      "thirdParty=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    sessionStorage.clear();
    location.reload();
  }
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

function statusChangeCallback(response) {
  console.log("statusChangeCallback");
  console.log(response);
  if (response.status === "connected") {
    testAPI();
  }
}

function checkLoginState() {
  // Called when a person is finished with the Login Button.
  FB.getLoginStatus(function (response) {
    statusChangeCallback(response);
  });
}

window.fbAsyncInit = function () {
  FB.init({
    appId: "289319202271527",
    cookie: true,
    xfbml: true,
    version: "v7.0",
  });

  // FB.getLoginStatus(function (response) {
  //   statusChangeCallback(response);
  // });
};

function testAPI() {
  FB.api("/me", function (response) {
    if (getCookie("id") == undefined) {
      // console.log("Successful login for: " + response.name + response.id);
      firstname = response.name.substr(0, response.name.indexOf(" "));
      document.cookie =
        "id=" +
        response.id +
        "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/; SameSite=None; Secure";
      document.cookie =
        "name=" +
        firstname +
        "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/; SameSite=None; Secure";
      document.cookie =
        "thirdParty=Facebook; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/; SameSite=None; Secure";

      location.reload();
    }
  });
}

function loginDropdown() {
  document.getElementById("loginDropdown").classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches(".dropdown")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

displayLogin();

const openModalButtons = document.querySelectorAll("[data-modal-target]");
const closeModalButtons = document.querySelectorAll("[data-close-button]");
const overlay = document.getElementById("overlay");

openModalButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const modal = document.querySelector(button.dataset.modalTarget);
    openModal(modal);
  });
});
closeModalButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const modal = button.closest(".modal");
    closeModal(modal);
  });
});

function openModal(modal) {
  if (modal == null) return;
  modal.classList.add("active");
  overlay.classList.add("active");
}

function closeModal(modal) {
  if (modal == null) return;
  modal.classList.remove("active");
  overlay.classList.remove("active");
}

overlay.addEventListener("click", () => {
  const modals = document.querySelectorAll(".modal.active");
  modals.forEach((modal) => {
    closeModal(modal);
  });
});
