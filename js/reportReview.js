function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

function report(reviewId) {
  $.ajax({
    url: "../php/ajax/reporting.php",
    type: "POST",
    data: { user: getCookie("id"), reviewId: reviewId, reportAction: "report" },
    success: function () {
      console.log("reported review");

      var flag = document.getElementById("flag" + reviewId);
      flag.onclick = function () {
        removeReport(reviewId);
      };

      flag.className = "reported";
      flag.title = "Remove Report";
    },
    error: function () {
      console.log("failed to flag review");
    },
  });
}

function removeReport(reviewId) {
  $.ajax({
    url: "../php/ajax/reporting.php",
    type: "POST",
    data: {
      user: getCookie("id"),
      reviewId: reviewId,
      reportAction: "removeReport",
    },
    success: function () {
      console.log("removed report on review");

      var flag = document.getElementById("flag" + reviewId);
      flag.onclick = function () {
        report(reviewId);
      };

      flag.className = "notReported";
      flag.title = "Report Review";
    },
    error: function () {
      console.log("failed to flag review");
    },
  });
}
