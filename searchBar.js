$(document).ready(function () {
  $("#search").keyup(function () {
    var query = $(this).val();
    if (query.length > 1) {
      $.ajax({
        url: "search.php",
        method: "POST",
        data: { query: query },
        success: function (data) {
          $("#courseList").html(data);
          // console.log(data);
          if ((data.match(/<option>/g) || []).length == 1) {
            var button = document.getElementById("submit");
            button.setAttribute("onclick","courseExist();");
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

function courseExist() {
  document.getElementById("search").value = "";
}
