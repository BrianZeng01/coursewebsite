<?php require_once("utils.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CourseCritics-My Account</title>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <link rel="stylesheet" href="../css/reviewStyles.css" />
    <script src="../js/ratings.js" defer></script>
    <script src="../js/review.js" defer></script>

    <?php require "repetitiveCode/commonHTML/head.php"; ?>
    <style>
        #account {
            font-weight: bold;
            text-decoration: underline;
        }

        .allReviews .title {
            padding-left: 0.5em;
            font-size: 2em;
        }
    </style>
</head>

<body>
    <?php require "repetitiveCode/commonHTML/nav.php"; ?>
    <div class="container">
        <div class="header">
            <div>
                <h1 class="subjectTitle">Your Account</h1>
            </div>
        </div>
        <hr>

        <div class="content">
            <div class="allReviews">
                <?php if (count($model) == 0) {
                    echo "<h2 class='title'>You haven't made any reviews yet :(</h2>";
                } else {
                    echo "<h2 class='title'>All Reviews</h2>";
                }
                ?>
                <ul>

                    <?php foreach ($model as $review) : ?>
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
                                        "Anonymous" : $review["user_first_name"]);
                                    echo " - ";
                                    echoXss($review["course_code"]); ?>
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
                                <h3>
                                    Prof: <span style="font-weight: normal;">
                                        <?php echoXss($review["professor"]); ?>
                                    </span>
                                </h3>
                                <h3>
                                    Textbook: <span style="font-weight: normal;">
                                        <?php echoXss($review["textbook"]); ?>
                                    </span>
                                </h3>

                                <h3>
                                    Grade: <span style="font-weight: normal;">
                                        <?php echoXss($review["grade"]); ?>
                                    </span>
                                </h3>
                                <h3>
                                    Year: <span style="font-weight: normal;">
                                        <?php echoXss($review["year"]); ?>
                                    </span>
                                </h3>
                                <h3>Take Again?
                                    <span style="font-weight: normal;">
                                        <?php echoXss($review["take_again"] ? "Yes" : "No"); ?>
                                    </span>
                                </h3>
                                <h2 class="commentHeader">Comments</h2>
                                <p class="comment">
                                    <?php echoXss($review["review_comment"]); ?>
                                </p>
                                <h2 class="commentHeader">Advice</h2>
                                <p class="advice">
                                    <?php echoXss($review["advice"]); ?>
                                </p>

                            </div>

                            <?php voteState($review); ?>
                            <div class="reviewBottom">
                                <?php editOrFlagReview($review); ?>
                            </div>
                        </li>

                    <?php endforeach; ?>
                </ul>

            </div>
        </div>

        <?php require "repetitiveCode/commonHTML/footer.php"; ?>
    </div>

    <script src="../js/votes.js"></script>
</body>

</html>