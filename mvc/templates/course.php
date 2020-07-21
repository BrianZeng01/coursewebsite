<?php require_once("utils.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Coursecritics Review</title>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <link rel="stylesheet" href="../css/reviewStyles.css" />
    <script src="../js/ratings.js" async></script>

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
                        (<?php echo mysqli_num_rows($model["reviews"]); ?> reviews)
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
                <h2><?php echo $model["aggregates"]["num_take_again"] . '/' .
                        mysqli_num_rows($model["reviews"]) .
                        ' People would take this course again' ?></h2>
                <form action="review.php" method="GET">
                    <input type="hidden" name="course" value="<?php echoXss($model["course"]["course_code"]); ?>">
                    <?php
                    if (isset($model["cookies"]["id"])) {
                        echo '
                    <button id="makeReview" type="submit">
                        Write a Review
                    </button>
                    ';
                    } else {
                        echo '
                    <button id="makeReview" type="button" onclick="notLoggedIn();">
                        Write a Review
                    </button>
                    ';
                    }
                    ?>
                    <h4 id="notLoggedIn"></h4>
                </form>
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
                                <?php if ($review["anonymous"]) {
                                    $name = "Anonymous";
                                } else {
                                    $name = $review["user_first_name"];
                                }
                                if ($review["take_again"]) {
                                    $take_again = "Yes";
                                } else {
                                    $take_again = "No";
                                }
                                $mysql_date = strtotime($review["date"]);
                                $date = date("M d/Y", $mysql_date);
                                $difficulty = number_format((float) round($review["difficulty"], 1), 1, '.', '');
                                $overall = number_format((float) round($review["overall"], 1), 1, '.', '');
                                ?>
                                <li>
                                    <div class="review">
                                        <h2 style="display:inline-block;"><?php echoXss($name); ?></h2>
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
                                        <h3>Take Again? <?php echoXss($take_again); ?></h3>

                                        <h2 class="commentHeader">Comments</h2>
                                        <p class="comment">
                                            <?php echoXss($review["review_comment"]); ?>
                                        </p>
                                        <h2 class="commentHeader">Advice</h2>
                                        <p class="comment">
                                            <?php echoXss($review["advice"]); ?>
                                        </p>
                                    </div>
                                    <?php
                                    if (isset($user_id)) {
                                        echo '
                                    <div class="vote">
                                        <img id="upvote" src="../images/upvote.png" width="50px" /><br>
                                        <h2 style="text-align:center;">' . $review["votes"] . '</h2>
                                        <img id="downvote" src="../images/downvote.png" width="50px" />
                                    </div>
                                </li>
                                ';
                                    } else {
                                        echo '
                                <div class="vote">
                                    <img id="upvote" src="../images/upvote.png" width="50px" /><br>
                                    <h2 style="text-align:center;">' . $review["votes"] . '</h2>
                                    <img id="downvote" src="../images/downvote.png" width="50px" />
                                </div>
                                </li>
                                ';
                                    }
                                    ?>

                                <?php endforeach; ?>
                        </ul>
            </div>
        </div>

        <?php require 'repetitiveCode/commonHTML/footer.php'; ?>

    </div>
    <script src="../js/makeReview.js"></script>
</body>

</html>