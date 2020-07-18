<?php include 'head.php' ?>
<?php include 'navigation.php' ?>

<div class="content">
  <div class="overview">
    <h1>Overview</h1>
    <hr class="underline">
    <h1><?php echo $model['course_code'] ?>
      <span class="numOfReviews">(<?php echoXss($model['aggregates']['num_of_reviews']) ?> reviews)</span>
    </h1>
    <h2>Title: <?php echoXss($model['course']['course_title']) ?></h2>
    <span class="ratings scores"><?php echoXss($model['aggregates']['total_overall']) ?></span>
    <h1 style="display:inline;"> Overall </h1><br><br>
    <span class="ratings_difficulty scores"><?php echoXss($model['aggregates']['difficulty']) ?></span>
    <h1 style="display:inline;"> Difficulty </h1><br>
    <h2><?php echoXss($model['aggregates']['num_take_again']) ?>/<?php echoXss($model['aggregates']['num_of_reviews']) ?>
      People would take this course again</h2>
    <form action="review.php" method="GET">
      <input type="hidden" name="course" value="' . $course_code . '">
      <button class="makeReview" type="submit">Write a Review</button>
    </form>
    <h3>Note: Sign in to submit a review. Please be mindful
      when submitting reviews, thank you and enjoy!</h3>
    <hr class="underline">
  </div>
  <div class=allReviews>
    <h1>Reviews<h1>
        <h3>Sort by: Work in Progress</h3>
        <hr class="underline">
        <ul>
          <?php foreach ($model['reviews'] as $review) : ?>
            <li>
              <div class="review">
                <h2 style="display:inline-block;"><?php echoXss($review['name']) ?></h2>
                <h4 class="date"><?php echoXss($review['date']) ?></h4><br>
                <span class="ratings scores_review"><?php echoXss($review['overall']) ?></span>
                <h2 class="ratingHeaders">Overall</h2>
                <span class="ratings_difficulty scores_review"><?php echoXss($review['difficulty']) ?></span>

                <h2 class="ratingHeaders">Difficulty</h2><br>
                <h3 class="h3seperators">Prof: <?php echoXss($review['professor']) ?></h3>
                <h3>Textbook: <?php echoXss($review['textbook']) ?> </h3><br>

                <h3 class="h3seperators">Grade: <?php echoXss($review['grade']) ?></h3>
                <h3 class="h3seperators">Year: <?php echoXss($review['year']) ?></h3>
                <h3>Take Again? <?php echoXss($review['take_again']) ?></h3>

                <h2 class="commentHeader">Comments</h2>
                <p class="comment"><?php echoXss($review['review_comment']) ?></p>
                <h2 class="commentHeader">Advice</h2>
                <p class="comment"><?php echoXss($review['advice']) ?></p>
              </div>
            </li>
          <?php endforeach; ?>