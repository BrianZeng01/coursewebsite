var overallRating = document.getElementsByClassName("ratings")
for (var i = 0; i<overallRating.length; i++) {
    var overall = overallRating[i].innerHTML;
    if(overall >= 4) {
        overallRating[i].style.backgroundColor = "#28b463";
    } else if(overall >= 2.5) {
        overallRating[i].style.backgroundColor = "#F39C12";
    } else if(overall > 0) {
         overallRating[i].style.backgroundColor = "#E74C3C";
    } else {
         overallRating[i].style.backgroundColor = "#777777";
    }
}

var difficultyRating = document.getElementsByClassName("ratings_difficulty");
for (var i = 0; i<difficultyRating.length; i++) {
    var difficulty = difficultyRating[i].innerHTML;
    if(difficulty >= 4) {
        difficultyRating[i].style.backgroundColor = "#E74C3C";
    } else if(difficulty >= 2.5) {
        difficultyRating[i].style.backgroundColor = "#F39C12";
    } else {
         difficultyRating[i].style.backgroundColor = "#28b463";
    }
}