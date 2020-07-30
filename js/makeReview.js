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

