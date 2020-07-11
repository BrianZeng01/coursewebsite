var overallRating = document.getElementsByClassName("ratings")
for (var i = 0; i<overallRating.length; i++) {
    var overall = overallRating[i].innerHTML;
    if(overall >= 4) {
        overallRating[i].style.backgroundColor = "#5CB862";
    } else if(overall >= 3) {
        overallRating[i].style.backgroundColor = "#F0AD4E";
    } else if(overall > 0) {
         overallRating[i].style.backgroundColor = "#D95350";
    } else {
         overallRating[i].style.backgroundColor = "#777777";
    }
}