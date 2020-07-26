function notLoggedIn() {
  document.getElementById("notLoggedIn").innerHTML =
    "Must be signed in to leave a review";
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

function upvote(votes, reviewId, upvoters, downvoters) {
  // console.log(
  //   typeof votes,
  //   typeof getCookie("id"),
  //   typeof reviewId,
  //   typeof upvoters,
  //   typeof downvoters
  // );
  $.ajax({
    url: "../php/ajax/voting/upvote.php",
    type: "POST",
    data: { user: getCookie("id"), review_id: reviewId },
    success: function () {
      console.log("upvote sent to database");

      var newVotes = parseInt(votes) + 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
      var downvoteBtn = document.getElementById("downvote" + reviewId);

      upvoters.push(getCookie("id"));
      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      upvoteBtn.onclick = function () {
        alreadyUpvoted();
      };
      upvoteBtn.className = "upvoted";
      downvoteBtn.onclick = function () {
        fromUpvotedToNull(newVotes, reviewId, upvoters, downvoters);
      };
      downvoteBtn.className = "null";
    },
    error: function () {
      console.log("failed ajax call");
    },
  });
  console.log("upvoted");
}

function downvote(votes, reviewId, upvoters, downvoters) {
  $.ajax({
    url: "../php/ajax/voting/downvote.php",
    type: "POST",
    data: { user: getCookie("id"), review_id: reviewId },
    success: function () {
      console.log("upvote sent to database");

      var newVotes = parseInt(votes) - 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
     var downvoteBtn = document.getElementById("downvote" + reviewId);

      downvoters.push(getCookie("id"));
      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      downvoteBtn.onclick = function () {
        alreadyDownvoted();
      };
      downvoteBtn.className = "downvoted";
      upvoteBtn.onclick = function () {
        fromDownvotedToNull(newVotes, reviewId, upvoters, downvoters);
      };
      upvoteBtn.className = "null";
      console.log("downvoted");
    },
    error: function () {
      console.log("failed ajax call");
    },
  });
}

function fromUpvotedToNull(votes, reviewId, upvoters, downvoters) {
  $.ajax({
    url: "../php/ajax/voting/fromUpvotedToNull.php",
    type: "POST",
    data: { user: getCookie("id"),upvoters: upvoters, review_id: reviewId },
    success: function () {
      console.log("upvote sent to database");

      var index = upvoters.indexOf(getCookie("id"));
      var newVotes = parseInt(votes) - 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
      var downvoteBtn = document.getElementById("downvote" + reviewId);

      upvoters.splice(index);
      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      downvoteBtn.onclick = function () {
        downvote(newVotes, reviewId, upvoters, downvoters);
      };
      downvoteBtn.className = "null";
      upvoteBtn.onclick = function () {
        upvote(newVotes, reviewId, upvoters, downvoters);
      };
      upvoteBtn.className = "null";
      console.log("fromUpvotedToNUll");
    },
    error: function () {
      console.log("failed ajax call");
    },
  });
}

function fromDownvotedToNull(votes, reviewId, upvoters, downvoters) {
  $.ajax({
    url: "../php/ajax/voting/fromDownvotedToNull.php",
    type: "POST",
    data: { user: getCookie("id"),downvoters: downvoters, review_id: reviewId },
    success: function () {
      console.log("upvote sent to database");

      var index = downvoters.indexOf(getCookie("id"));
      var newVotes = parseInt(votes) + 1;
      var upvoteBtn = document.getElementById("upvote" + reviewId);
      var downvoteBtn = document.getElementById("downvote" + reviewId);

      downvoters.splice(index);
      document.getElementById("votes" + reviewId).innerHTML = newVotes;
      downvoteBtn.onclick = function () {
        downvote(newVotes, reviewId, upvoters, downvoters);
      };
      downvoteBtn.className = "null";
      upvoteBtn.onclick = function () {
        upvote(newVotes, reviewId, upvoters, downvoters);
      };
      upvoteBtn.className = "null";

      console.log("fromDownvotedtoNull");
    },
    error: function () {
      console.log("failed ajax call");
    },
  });
}

function alreadyUpvoted() {
  console.log("Already Upvoted");
}

function alreadyDownvoted() {
  console.log("Already Downvoted");
}
