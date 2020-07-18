<?php
require_once('utils.php');
require_once('./Controllers/CourseController.php');

return;

// $host = "localhost";
// $user = "etpjiwmy_WP1GK";
// $pass = "Hostforme123.";
// $db_name = "etpjiwmy_WP1GK";

// $connection = new mysqli($host, $user, $pass, $db_name);
// if ($connection->connect_error) {
//     die("Failed to connect to MySQL: " . $connection->connect_error);
// }
// $course_code = $_GET["course"];

// echo '
// <!DOCTYPE html>
// <html>

// <head>
//     <title>Coursecritics Review</title>
//     <link rel="stylesheet" href="style.css" />
//     <link rel="stylesheet" href="subjectStyle.css"/>
//     <link rel="stylesheet" href="reviews.css"/>
//     <link
//       rel="stylesheet"
//       href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
//     />

//     <script src="login.js" async></script>
//     <script src="ratings.js" async></script>
//     <script src="https://apis.google.com/js/platform.js" async defer></script>
//     <meta name="google-signin-client_id" content="795327503596-iibptgqdd2l49s4qphdsa8619gttjpfp.apps.googleusercontent.com" />
// </head>

// <body>
//     <div class="container">
//         <div class="header">
//             <div class="nav">
//                 <div class="mainNav">
//                     <a href="ubc.html">Home</a>
//                     <a href="subjects.php">Courses</a>
//                     <a href="contactus.html">Contact Us</a>
//                     <a id="account" href="account.php">Account</a>
//                     <div id="login">
//                         <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
//                     </div>
//                     <div id="logout">
//                         <a id="signout" href="#" onclick="signOut();">Sign out</a>
//                     </div>
//                 </div>
//             </div>

//             <div class="subjectHeader">
//                 <h1 class="subjectTitle">
//                     UBC: ' . $course_code . ' reviews
//                 </h1>
//                 <hr size="8px" color="#072145">
//             </div>
//         </div>
        
//         <div class="content">';

// $query_course_id = "SELECT * FROM courses WHERE course_code=?";
// $stmt = $connection->prepare($query_course_id);
// $stmt->bind_param('s', $course_code);
// $stmt->execute();
// $courses_result = $stmt->get_result();
// $stmt->close();
// $columns = mysqli_fetch_array($courses_result);
// $course_id = $columns["course_id"];

// $query_reviews = "SELECT * FROM reviews 
// WHERE course_id_fk=?";
// $stmt = $connection->prepare($query_reviews);
// $stmt->bind_param('i', $course_id);
// $stmt->execute();
// $reviews_result = $stmt->get_result();
// $stmt->close();

// $query_aggregates = "SELECT AVG(overall) 'total_overall',
// AVG(difficulty) 'total_difficulty',COUNT(take_again) 'num_take_again'
//  FROM reviews WHERE course_id_fk=?";
// $stmt = $connection->prepare($query_aggregates);
// $stmt->bind_param('s', $course_id);
// $stmt->execute();
// $result_aggregates = $stmt->get_result();
// $stmt->close();
// $row_aggregates = mysqli_fetch_array($result_aggregates);
// // All information needed for the main(aggregated) review box
// // excluding $course_code which is above
// $course_title = $columns["course_title"];
// $total_overall = number_format((float) round($row_aggregates["total_overall"], 1), 1, '.', '');
// $total_difficulty = number_format((float) round($row_aggregates["total_difficulty"], 1), 1, '.', '');
// $num_take_again = $row_aggregates["num_take_again"];
// $num_of_reviews = mysqli_num_rows($reviews_result);

// echo '      <div class="overview">
//                 <h1>Overview</h1>
//                 <hr class="underline">
//                 <h1>' . $course_code . ' <span class="numOfReviews">
//                     (' . $num_of_reviews . ' reviews)</span>
//                 </h1>
//             <h2>Title: ' . $course_title . '</h2>
//             <span class="ratings scores">' . $total_overall . '</span>
//             <h1 style="display:inline;"> Overall </h1><br><br>
//             <span class="ratings_difficulty scores">' . $total_difficulty . '</span>
//             <h1 style="display:inline;"> Difficulty </h1><br>
//             <h2>' . $num_take_again . '/' . $num_of_reviews . '  People would take this course again</h2>
//             <form action="review.php" method="GET">
//                 <input type="hidden" name="course" value="' . $course_code . '">
//                 <button class="makeReview" type="submit">Write a Review</button>
//             </form>
//             <h3>Note: Sign in to submit a review. Please be mindful
//             when submitting reviews, thank you and enjoy!</h3>
//             <hr class="underline">
//         </div>
// ';

// $output = '<div class=allReviews>
//                 <h1>Reviews<h1>
//                 <h3>Sort by: Work in Progress</h3>
//                 <hr class="underline">
//                 <ul>';

// while ($row = mysqli_fetch_array($reviews_result)) {
//     $votes = $row["votes"];
//     if ($row["anonymous"]) {
//         $name = "Anonymous";
//     } else {
//         $name = $row["user_first_name"];
//     }
//     $mysql_date = strtotime($row["date"]);
//     $date = date("M d/Y" , $mysql_date);
//     $difficulty = number_format((float) round($row["difficulty"], 1), 1, '.', '');
//     $overall = number_format((float) round($row["overall"], 1), 1, '.', '');
//     $professor = $row["professor"];
//     $textbook = $row["textbook"];
//     $grade = $row["grade"];
//     $year = $row["year"];
//     if ($row["take_again"]) {
//         $take_again = "Yes";
//     } else {
//         $take_again = "No";
//     }
//     $comment = $row["review_comment"];
//     $advice = $row["advice"];

//     $output .= '<li>
//                 <div class="review">
//                     <h2 style="display:inline-block;">' . $name .'</h2>
//                     <h4 class="date">'.$date.'</h4><br>
//                     <span class="ratings scores_review">'
//         . $overall .
//         '</span>
//                     <h2 class="ratingHeaders">Overall</h2>
//                     <span class="ratings_difficulty scores_review">'
//         . $difficulty .
//         '</span>

//                     <h2 class="ratingHeaders">Difficulty</h2><br>
//                     <h3 class="h3seperators">Prof: ' . $professor . '</h3>
//                     <h3>Textbook: ' . $textbook . ' </h3><br>

//                     <h3 class="h3seperators">Grade: ' . $grade . '</h3>
//                     <h3 class="h3seperators">Year: ' . $year . '</h3>
//                     <h3>Take Again? ' . $take_again . '</h3>

//                     <h2 class="commentHeader">Comments</h2>
//                     <p class="comment">' . $comment . '</p>
//                     <h2 class="commentHeader">Advice</h2>
//                     <p class="comment">'.$advice.'</p>
//                 </div>
//             </li>';
// }

// $output .= '</ul></div>';
// echo $output;
// echo '
//         </div>

//         <div class="footer">
//             <div class="contactus">
//                 <h1>Something wrong?</h1>
//                 <a href="contactus.html">CONTACT US</a>
//                 <h1 class="footerTitle">coursecritics.ca</h1>
//             </div>
//         </div>
//     </div>

// </body>
// </html>
// ';
