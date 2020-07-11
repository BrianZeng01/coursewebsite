var overallRating = document.getElementsByClassName("ratings")
for (var i = 0; i<overallRating.length; i++) {
    var overall = overallRating[i].innerHTML;
    if(overall >= 4) {
        overallRating[i].style.backgroundColor = "#56bc5b";
    } else if(overall >= 3) {
        overallRating[i].style.backgroundColor = "#eaa544";
    } else if(overall > 0) {
         overallRating[i].style.backgroundColor = "#e258560";
    } else {
         overallRating[i].style.backgroundColor = "#777777";
    }
}