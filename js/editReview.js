var currentOverall = document.getElementById("currentOverall").value;
var currentDifficulty = document.getElementById("currentDifficulty").value;
var currentAnonymous = document.getElementById("currentAnonymous").value;
var currentTakeAgain = document.getElementById("currentTakeAgain").value;
var currentTextbook = document.getElementById("currentTextbook").value;
var currentGrade = document.getElementById("currentGrade").value;
//current year selected in bottom of makeReview.js due to javascript loading order
var currentProfessor = document.getElementById("currentProfessor").value;
var currentComment = document.getElementById("currentComment").value;
var currentAdvice = document.getElementById("currentAdvice").value;

$("input[name=overall][value=" + currentOverall + "]").attr("checked", true);
$("input[name=difficulty][value=" + currentDifficulty + "]").attr(
  "checked",
  true
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
document.getElementById("comment").value = currentComment;
document.getElementById("advice").value = currentAdvice;