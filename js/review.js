var difficultyValue = 0;
var overallValue = 0;

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

if (getCookie("id") === undefined) {
  window.location.replace("https://coursecritics.test");
}

function writeReview(courseId) {
  $.ajax({
    url: "../mvc/controllers/reviewController.php",
    method: "POST",
    data: { courseId: courseId, action: "reviewBox" },
    success: function (data) {
      document.getElementById("writeReview").style.display = "none";
      reviewBox = document.getElementById("reviewBox");
      reviewBox.innerHTML = data;
      if (data.length > 1000) {
        //default checked radio buttons
        overallRating(
          document.querySelector("input[name=overall]:checked").value
        );
        difficultyRating(
          document.querySelector("input[name=difficulty]:checked").value
        );
        //Year dropdown
        var end = 1970;
        var start = new Date().getFullYear();
        var options = "<option value='' disabled selected>Year</option>";
        for (var year = start; year >= end; year--) {
          options += "<option value=" + year + ">" + year + "</option>";
        }
        document.getElementById("year").innerHTML = options;
        var currentYear = document.getElementById("currentYear");
        if (typeof currentYear != "undefined" && currentYear != null) {
          document.getElementById("year").value = currentYear.value;
        }
      }
    },
  });
}

function editReviewInputs() {
  var currentOverall = document.getElementById("currentOverall").value;
  var currentDifficulty = document.getElementById("currentDifficulty").value;
  var currentAnonymous = document.getElementById("currentAnonymous").value;
  var currentTakeAgain = document.getElementById("currentTakeAgain").value;
  var currentTextbook = document.getElementById("currentTextbook").value;
  var currentGrade = document.getElementById("currentGrade").value;
  //current year selected in bottom of makeReview.js due to javascript loading order
  var currentProfessor = document.getElementById("currentProfessor").value;

  //Year dropdown
  var end = 1970;
  var start = new Date().getFullYear();
  var options = "<option value='' disabled selected>Year</option>";
  for (var year = start; year >= end; year--) {
    options += "<option value=" + year + ">" + year + "</option>";
  }
  document.getElementById("year").innerHTML = options;
  var currentYear = document.getElementById("currentYear");
  if (typeof currentYear != "undefined" && currentYear != null) {
    document.getElementById("year").value = currentYear.value;
  }

  $("input[name=overall][value=" + currentOverall + "]").attr("checked", true);
  $("input[name=difficulty][value=" + currentDifficulty + "]").attr(
    "checked",
    true
  );
  overallRating(document.querySelector("input[name=overall]:checked").value);
  difficultyRating(
    document.querySelector("input[name=difficulty]:checked").value
  );
  if (currentAnonymous == 1) {
    document.getElementById("anonymous").checked = true;
  }
  if (currentTakeAgain == 1) {
    document.getElementById("takeAgain").checked = true;
  }
  document.getElementById("textbook").value = currentTextbook;
  document.getElementById("grade").value = currentGrade;
  //current year selected in bottom of makeReview.js due to javascript loading order
  if (currentProfessor != "N/A") {
    document.getElementById("professor").value = currentProfessor;
  }
}

function report(reviewId, action) {
  $.ajax({
    url: "../php/review.php",
    method: "POST",
    data: { user: getCookie("id"), reviewId: reviewId, action: action },
    success: function (data) {
      if (JSON.parse(data) == "report") {
        console.log("reported review");
        var flag = document.getElementById("flag" + reviewId);
        flag.onclick = function () {
          report(reviewId, "removeReport");
        };
        flag.className = "reported";
        flag.title = "Remove Report";
      } else {
        console.log("removed report on review");
        var flag = document.getElementById("flag" + reviewId);
        flag.onclick = function () {
          report(reviewId, "report");
        };
        flag.className = "notReported";
        flag.title = "Report Review";
      }
    },
    error: function () {
      console.log("failed to flag review");
    },
  });
}

function editReview(reviewId) {
  $.ajax({
    url: "../mvc/controllers/reviewController.php",
    method: "POST",
    data: { reviewId: reviewId, action: "editReviewBox" },
    success: function (data) {
      console.log("editing review");
      reviewBox = document.getElementById("reviewBox");
      reviewBox.innerHTML = data;
      editReviewInputs();
    },
  });
}

$(document).ready(function () {
  $("#comment").on("keyup keypress keydown", function () {
    var commentLength = document.getElementById("comment").value.length;
    document.getElementById("commentCounter").value = 500 - commentLength;
  });

  $("#advice").on("keyup keypress", function () {
    var adviceLength = document.getElementById("advice").value.length;
    document.getElementById("adviceCounter").value = 500 - adviceLength;
  });

  $("#professor").on("keyup keypress keydown", function () {
    var professor = document.getElementById("professor");
    var regex = /^[a-zA-Z]+[\s]?[a-zA-Z]*$/;

    if (!regex.test(professor.value)) {
      professor.value = professor.value.substr(0, professor.value.length - 1);
    }
  });
});

function overallRating(value) {
  overallValue = value;
  var elements = document
    .getElementById("overallRating")
    .getElementsByTagName("img");
  for (i = 0; i < elements.length; i++) {
    elements[i].style.filter =
      "invert(98%) sepia(2%) saturate(422%) hue-rotate(167deg) brightness(93%) contrast(85%)";
  }
  if (value == 5) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        " invert(62%) sepia(15%) saturate(6906%) hue-rotate(101deg) brightness(115%) contrast(64%)";
    }
  } else if (value == 4) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(72%) sepia(67%) saturate(687%) hue-rotate(359deg) brightness(103%) contrast(89%)";
    }
  } else if (value == 3) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(67%) sepia(77%) saturate(2069%) hue-rotate(354deg) brightness(99%) contrast(92%)";
    }
  } else if (value == 2) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(74%) sepia(35%) saturate(7495%) hue-rotate(349deg) brightness(96%) contrast(87%)";
    }
  } else {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(40%) sepia(51%) saturate(4752%) hue-rotate(11deg) brightness(91%) contrast(101%)";
    }
  }
}

function hoverOverall(value) {
  var elements = document
    .getElementById("overallRating")
    .getElementsByTagName("img");

  for (i = 0; i < elements.length; i++) {
    elements[i].style.filter =
      "invert(98%) sepia(2%) saturate(422%) hue-rotate(167deg) brightness(93%) contrast(85%)";
  }

  if (value == 5) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        " invert(62%) sepia(15%) saturate(6906%) hue-rotate(101deg) brightness(115%) contrast(64%)";
    }
  } else if (value == 4) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(72%) sepia(67%) saturate(687%) hue-rotate(359deg) brightness(103%) contrast(89%)";
    }
  } else if (value == 3) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(67%) sepia(77%) saturate(2069%) hue-rotate(354deg) brightness(99%) contrast(92%)";
    }
  } else if (value == 2) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(74%) sepia(35%) saturate(7495%) hue-rotate(349deg) brightness(96%) contrast(87%)";
    }
  } else {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(40%) sepia(51%) saturate(4752%) hue-rotate(11deg) brightness(91%) contrast(101%)";
    }
  }
}

function hoverOffOverall() {
  overallRating(overallValue);
}

function difficultyRating(value) {
  difficultyValue = value;
  var elements = document
    .getElementById("difficultyRating")
    .getElementsByTagName("img");

  for (i = 0; i < elements.length; i++) {
    elements[i].style.filter =
      "invert(98%) sepia(2%) saturate(422%) hue-rotate(167deg) brightness(93%) contrast(85%)";
  }
  if (value == 5) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(40%) sepia(51%) saturate(4752%) hue-rotate(11deg) brightness(91%) contrast(101%)";
    }
  } else if (value == 4) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(74%) sepia(35%) saturate(7495%) hue-rotate(349deg) brightness(96%) contrast(87%)";
    }
  } else if (value == 3) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(67%) sepia(77%) saturate(2069%) hue-rotate(354deg) brightness(99%) contrast(92%)";
    }
  } else if (value == 2) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(72%) sepia(67%) saturate(687%) hue-rotate(359deg) brightness(103%) contrast(89%)";
    }
  } else {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        " invert(62%) sepia(15%) saturate(6906%) hue-rotate(101deg) brightness(115%) contrast(64%)";
    }
  }
}

function hoverDifficulty(value) {
  var elements = document
    .getElementById("difficultyRating")
    .getElementsByTagName("img");

  for (i = 0; i < elements.length; i++) {
    elements[i].style.filter =
      "invert(98%) sepia(2%) saturate(422%) hue-rotate(167deg) brightness(93%) contrast(85%)";
  }

  if (value == 5) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(40%) sepia(51%) saturate(4752%) hue-rotate(11deg) brightness(91%) contrast(101%)";
    }
  } else if (value == 4) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(74%) sepia(35%) saturate(7495%) hue-rotate(349deg) brightness(96%) contrast(87%)";
    }
  } else if (value == 3) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(67%) sepia(77%) saturate(2069%) hue-rotate(354deg) brightness(99%) contrast(92%)";
    }
  } else if (value == 2) {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        "invert(72%) sepia(67%) saturate(687%) hue-rotate(359deg) brightness(103%) contrast(89%)";
    }
  } else {
    for (i = 0; i < value; i++) {
      elements[i].style.filter =
        " invert(62%) sepia(15%) saturate(6906%) hue-rotate(101deg) brightness(115%) contrast(64%)";
    }
  }
}

function hoverOffDifficulty() {
  difficultyRating(difficultyValue);
}
