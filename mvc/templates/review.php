<!DOCTYPE html>
<html>

<head>
    <title><?php echo ($course); ?> Review</title>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <link rel="stylesheet" href="../css/makeReviewStyles.css" />
    <?php require 'repetitiveCode/commonHTML/head.php'; ?>
    <script src="../js/makeReview.js"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php require 'repetitiveCode/commonHTML/nav.php'; ?>
            <div class="subjectHeader">
                <h1 class="subjectTitle">Write a Review for <?php echo ($course) ?></h1>
                <hr size="8px" color="#072145">
            </div>
        </div>

        <div class="content">

            <div>
                <div id="overallRating">
                    <h2>Overall: </h2>
                    <label>
                        <input type="radio" name="overall" value="1" onclick="overallRating(1)">
                        <img id=" overallRating1" class="starBox overallRating1" onmouseover="hoverOverall(1)" onmouseout="hoverOffOverall()" src=" ../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="overall" value="2" onclick="overallRating(2)">
                        <img id="overallRating2" class="starBox overallRating2" onmouseover="hoverOverall(2)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="overall" value="3" onclick="overallRating(3)">
                        <img id="overallRating3" class="starBox overallRating3" onmouseover="hoverOverall(3)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="overall" value="4" onclick="overallRating(4)">
                        <img id="overallRating4" class="starBox overallRating4" onmouseover="hoverOverall(4)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="overall" value="5" onclick="overallRating(5)">
                        <img id="overallRating5" class="starBox overallRating5" onmouseover="hoverOverall(5)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                    </label>

                </div>

                <div id="difficultyRating">
                    <h2>Difficulty: </h2>
                    <label>
                        <input type="radio" name="difficulty" value="1" onclick="difficultyRating(1)">
                        <img id=" difficultyRating1" class="starBox " onmouseover="hoverDifficulty(1)" onmouseout="hoverOffDifficulty()" src=" ../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="difficulty" value="2" onclick="difficultyRating(2)">
                        <img id="difficultyRating2" class="starBox " onmouseover="hoverDifficulty(2)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="difficulty" value="3" onclick="difficultyRating(3)">
                        <img id="difficultyRating3" class="starBox " onmouseover="hoverDifficulty(3)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="difficulty" value="4" onclick="difficultyRating(4)">
                        <img id="difficultyRating4" class="starBox " onmouseover="hoverDifficulty(4)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                    </label>
                    <label>
                        <input type="radio" name="difficulty" value="5" onclick="difficultyRating(5)">
                        <img id="difficultyRating5" class="starBox " onmouseover="hoverDifficulty(5)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                    </label>

                </div>
            </div>
        </div>
        <?php require "repetitiveCode/commonHTML/footer.php"; ?>
    </div>
</body>

</html>