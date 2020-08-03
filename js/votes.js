function notLoggedIn() {
  document.getElementById("notLoggedIn").innerHTML =
    "Must be signed in to leave a review";
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

function upvote(votes, reviewId) {
  // console.log(
  //   typeof votes,
  //   typeof getCookie("id"),
  //   typeof reviewId,
  //   typeof upvoters,
  //   typeof downvoters
  // );
  $.ajax({
    url: "../php/ajax/voting.php",
    type: "POST",
    data: { user: getCookie("id"), reviewId: reviewId, voteAction: "upvote" },
    success: function () {
      console.log("upvote sent to database");

      var newVotes = parseInt(votes) + 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
      var downvoteBtn = document.getElementById("downvote" + reviewId);

      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      upvoteBtn.onclick = function () {
        alreadyUpvoted();
      };
      upvoteBtn.className = "upvoted";
      downvoteBtn.onclick = function () {
        removeUpvote(newVotes, reviewId);
      };
      downvoteBtn.className = "null";
    },
    error: function () {
      console.log("failed ajax vote call");
    },
  });
  console.log("upvoted");
}

function downvote(votes, reviewId) {
  $.ajax({
    url: "../php/ajax/voting.php",
    type: "POST",
    data: { user: getCookie("id"), reviewId: reviewId, voteAction: "downvote"},
    success: function () {
      console.log("upvote sent to database");

      var newVotes = parseInt(votes) - 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
     var downvoteBtn = document.getElementById("downvote" + reviewId);

      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      downvoteBtn.onclick = function () {
        alreadyDownvoted();
      };
      downvoteBtn.className = "downvoted";
      upvoteBtn.onclick = function () {
        removeDownvote(newVotes, reviewId);
      };
      upvoteBtn.className = "null";
      console.log("downvoted");
    },
    error: function () {
      console.log("failed ajax vote call");
    },
  });
}

function removeUpvote(votes, reviewId) {
  $.ajax({
    url: "../php/ajax/voting.php",
    type: "POST",
    data: { user: getCookie("id"), reviewId: reviewId, voteAction: "removeUpvote" },
    success: function () {
      console.log("upvote sent to database");

      var newVotes = parseInt(votes) - 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
      var downvoteBtn = document.getElementById("downvote" + reviewId);

      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      downvoteBtn.onclick = function () {
        downvote(newVotes, reviewId);
      };
      downvoteBtn.className = "null";
      upvoteBtn.onclick = function () {
        upvote(newVotes, reviewId);
      };
      upvoteBtn.className = "null";
      console.log("removeUpvote");
    },
    error: function () {
      console.log("failed ajax vote call");
    },
  });
}

function removeDownvote(votes, reviewId) {
  $.ajax({
    url: "../php/ajax/voting.php",
    type: "POST",
    data: { user: getCookie("id"), reviewId: reviewId, voteAction: "removeDownvote" },
    success: function () {
      console.log("upvote sent to database");

      var newVotes = parseInt(votes) + 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
      var downvoteBtn = document.getElementById("downvote" + reviewId);

      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      downvoteBtn.onclick = function () {
        downvote(newVotes, reviewId);
      };
      downvoteBtn.className = "null";
      upvoteBtn.onclick = function () {
        upvote(newVotes, reviewId);
      };
      upvoteBtn.className = "null";

      console.log("removeDownvote");
    },
    error: function () {
      console.log("failed ajax vote call");
    },
  });
}

function alreadyUpvoted() {
  console.log("Already Upvoted");
}

function alreadyDownvoted() {
  console.log("Already Downvoted");
}
