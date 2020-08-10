<?php require_once("utils.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CourseCritics-My Account</title>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <link rel="stylesheet" href="../css/reviewStyles.css" />
    <script src="../js/ratings.js" defer></script>

    <?php require "repetitiveCode/commonHTML/head.php"; ?>
    <style>
        #account {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php require "repetitiveCode/commonHTML/nav.php"; ?>
        </div>

        <div style="padding-top: 4rem;" class="content">
            <div class="allReviews">
                <h2>All Reviews</h2>

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
                            <?php editReviewAccountPage($review["review_id"]); ?>

                        </div>

                        <?php voteState($review); ?>

                    <?php endforeach; ?>

            </div>
        </div>

        <?php require "repetitiveCode/commonHTML/footer.php"; ?>
    </div>

    <script>
        function deleteConfirmation() {
            if (confirm("Are you sure you want to Delete this Review?")) {
                document.getElementById("deleteReview").submit();
            };
        }
    </script>

    <script src="../js/votes.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>