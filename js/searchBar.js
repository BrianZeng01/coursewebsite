window.addEventListener("pageshow", function (event) {
  var historyTraversal =
    event.persisted ||
    (typeof window.performance != "undefined" &&
      window.performance.navigation.type === 2);
  if (historyTraversal) {
    document.getElementById("searchCourse").value = "";
    document.getElementById("searchSubject").value = "";
  }
});

$(document).ready(function () {
  $("#searchCourse").keyup(function () {
    var query = $(this).val();
    if (query.length > 1) {
      $.ajax({
        url: "../php/ajax/search.php",
        method: "POST",
        data: { query: query, searchAction: "courses" },
        success: function (data) {
          $("#courseList").html(data);
          if ((data.match(/<option>/g) || []).length == 1) {
            var button = document.getElementById("submitCourse");
            button.setAttribute("onclick", "");
            button.setAttribute("type", "submit");
          }
        },
      });
    }
  });
  $("#searchSubject").keyup(function () {
    var query = $(this).val();
    if (query.length > 1) {
      $.ajax({
        url: "../php/ajax/search.php",
        method: "POST",
        data: { query: query, searchAction: "subject" },
        success: function (data) {
          $("#subjectList").html(data);
          if ((data.match(/<option>/g) || []).length == 1) {
            var button = document.getElementById("submitSubject");
            button.setAttribute("onclick", "");
            button.setAttribute("type", "submit");
          }
        },
      });
    }
  });
});

function courseDoesNotExist() {
  console.log("course does not exist");
  document.getElementById("courseDoesNotExist").innerHTML =
    "<h3>Course not found</h3>";
}

function subjectDoesNotExist() {
  console.log("subject does not exist");
  document.getElementById("subjectDoesNotExist").innerHTML =
    "<h3>Subject not found</h3>";
}
