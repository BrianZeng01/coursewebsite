<?php require_once("utils.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coursecritics Review</title>
    <?php require 'repetitiveCode/commonHTML/head.php'; ?>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <link rel="stylesheet" href="../css/reviewStyles.css" />

    <script src="../js/ratings.js" defer></script>
    <script src="../js/review.js" defer></script>
</head>

<body>
    <?php require 'repetitiveCode/commonHTML/nav.php'; ?>
    <div class="container">
        <div class="header">
            <h1 class="subjectTitle">
                <?php echoXss($model["course"]["course_code"]); ?> Reviews
            </h1>
            <hr>
        </div>

        <div class="content">

            <div class="overview">
                <h1>Overview</h1>
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
                    } ?></h2>
            </div>
            <div id="reviewBox">
                <?php reviewState($model); ?>
            </div>

            <hr>
            <div class="sort">
                <h1>Reviews</h1>
                <h3>Sort by: Work in Progress</h3>
                <h3>Note: Sign in to submit a review and upvote/downvote. Please be mindful
                    when submitting reviews, thank you and enjoy!</h3>

            </div>

            <hr>
            <div class="allReviews">
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
                                <div>
                                    <span class="ratings scores_review">
                                        <?php echo $overall; ?>
                                    </span>
                                    <h2 class="ratingHeaders">&nbspOverall</h2>
                                </div>
                                <div>
                                    <span class="ratings_difficulty scores_review">
                                        <?php echo $difficulty; ?>
                                    </span>
                                    <h2 class="ratingHeaders">&nbspDifficulty</h2><br>
                                </div>
                                <h3 class="h3seperators">
                                    Prof: <span style="font-weight: normal;">
                                        <?php echoXss($review["professor"]); ?>
                                    </span>
                                </h3>
                                <h3>
                                    Textbook: <span style="font-weight: normal;">
                                        <?php echoXss($review["textbook"]); ?>
                                        </style>
                                </h3><br>

                                <h3 class="h3seperators">
                                    Grade: <span style="font-weight: normal;">
                                        <?php echoXss($review["grade"]); ?>
                                        </style>
                                </h3>
                                <h3 class="h3seperators">
                                    Year: <span style="font-weight: normal;">
                                        <?php echoXss($review["year"]); ?>
                                        </style>
                                </h3>
                                <h3>Take Again?
                                    <span style="font-weight: normal;">
                                        <?php echoXss($review["take_again"] ? "Yes" : "No"); ?></h3>
                                </style>
                                <h2 class="commentHeader">Comments</h2>
                                <p class="comment">
                                    <?php echoXss($review["review_comment"]); ?>
                                </p>
                                <h2 class="commentHeader">Advice</h2>
                                <p class="advice">
                                    <?php echoXss($review["advice"]); ?>
                                </p>
                            </div>

                            <!-- One of the below options depending on if its your review -->


                            <?php voteState($review); ?>
                            <?php editOrFlagReview($review); ?>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <?php require 'repetitiveCode/commonHTML/footer.php'; ?>

    </div>
    <script src="../js/votes.js"></script>
</body>

</html>