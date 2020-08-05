<?php require_once("utils.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coursecritics Review</title>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <link rel="stylesheet" href="../css/reviewStyles.css" />
    <script src="https://kit.fontawesome.com/3efe0c799c.js" crossorigin="anonymous"></script>
    <script src="../js/ratings.js" async></script>
    <script src="../js/reportReview.js" async></script>
    <?php require 'repetitiveCode/commonHTML/head.php'; ?>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php require 'repetitiveCode/commonHTML/nav.php'; ?>
            <div class="subjectHeader">
                <h1 class="subjectTitle">
                    <?php echoXss($model["course"]["course_code"]); ?> Reviews
                </h1>
                <hr size="8px" color="#072145">
            </div>
        </div>

        <div class="content">

            <div class="overview">
                <h1>Overview</h1>
                <hr class="underline">
                <h1><?php echo $model["course"]["course_code"] ?>
                    <span class="numOfReviews">
                        (<?php echo num_rows($model["reviews"]); ?> reviews)
                    </span>
                </h1>
                <h2>
                    Title: <?php echoXss($model["course"]["course_title"]); ?>
                </h2>
                <span class="ratings scores">
                    <?php echo $model["aggregates"]["average_overall"]; ?>
                </span>
                <h1 style="display:inline;">&nbspOverall</h1><br><br>
                <span class="ratings_difficulty scores">
                    <?php echo $model["aggregates"]["average_difficulty"]; ?>
                </span>
                <h1 style="display:inline;">&nbspDifficulty</h1><br>
                <h2><?php if (num_rows($model["reviews"]) == 0) {
                    echo '0/0 People would take this course again';
                } else {
                    echo $model["aggregates"]["num_take_again"] . '/' .
                        num_rows($model["reviews"]) .
                        ' People would take this course again';
                }?></h2>

                <?php reviewState($model); ?>

                <h3>Note: Sign in to submit a review and upvote/downvote. Please be mindful
                    when submitting reviews, thank you and enjoy!</h3>
                <hr class="underline">
            </div>

            <div class=allReviews>
                <h1>Reviews<h1>
                        <h3>Sort by: Work in Progress</h3>
                        <hr class="underline">
                        <ul>
                            <?php foreach ($model["reviews"] as $review) : ?>
                                <?php
                                $mysql_date = strtotime($review["date"]);
                                $date = date("M d/Y", $mysql_date);
                                $difficulty = number_format((float) round($review["difficulty"], 1), 1, '.', '');
                                $overall = number_format((float) round($review["overall"], 1), 1, '.', '');
                                ?>
                                <li>
                                    <div class="review">
                                        <h2 style="display:inline-block;">
                                            <?php echoXss($review["anonymous"] ?
                                                "Anonymous" : $review["user_first_name"]); ?>
                                        </h2>
                                        <h4 class="date"><?php echoXss($date); ?></h4><br>
                                        <span class="ratings scores_review">
                                            <?php echo $overall; ?>
                                        </span>
                                        <h2 class="ratingHeaders">&nbspOverall</h2>
                                        <span class="ratings_difficulty scores_review">
                                            <?php echo $difficulty; ?>
                                        </span>

                                        <h2 class="ratingHeaders">&nbspDifficulty</h2><br>
                                        <h3 class="h3seperators">
                                            Prof: <?php echoXss($review["professor"]); ?>
                                        </h3>
                                        <h3>
                                            Textbook: <?php echoXss($review["textbook"]); ?>
                                        </h3><br>

                                        <h3 class="h3seperators">
                                            Grade: <?php echoXss($review["grade"]); ?>
                                        </h3>
                                        <h3 class="h3seperators">
                                            Year: <?php echoXss($review["year"]); ?>
                                        </h3>
                                        <h3>Take Again?
                                            <?php echoXss($review["take_again"] ? "Yes" : "No"); ?></h3>

                                        <h2 class="commentHeader">Comments</h2>
                                        <p class="comment">
                                            <?php echoXss($review["review_comment"]); ?>
                                        </p>
                                        <h2 class="commentHeader">Advice</h2>
                                        <p class="comment">
                                            <?php echoXss($review["advice"]); ?>
                                        </p>

                                        <!-- One of the below options depending on if its your review -->
                                        <?php editOrFlagReview($review); ?>
                                        
                                    </div>

                                    <?php voteState($review); ?>

                                <?php endforeach; ?>
                        </ul>
            </div>
        </div>

        <?php require 'repetitiveCode/commonHTML/footer.php'; ?>

    </div>
    <script>
        function deleteConfirmation() {
            if (confirm("Are you sure you want to Delete this Review?")) {
                document.getElementById("deleteReview").submit();
            };
        }
    </script>
    <script src="../js/votes.js"></script>
</body>

</html>