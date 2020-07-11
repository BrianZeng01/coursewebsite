<?php

$host = "localhost";
$user = "root";
$pass = "Hostforme123.";
$db_name = "Coursecritics";

$connection = new mysqli($host, $user, $pass, $db_name);
if ($connection->connect_error) {
    die("Failed to connect to MySQL: " . $connection->connect_error);
}
$course_code = $_GET["course"];

echo '
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="subjectStyle.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <script src="login.js" async></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="795327503596-iibptgqdd2l49s4qphdsa8619gttjpfp.apps.googleusercontent.com" />
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="mainNav">
                    <a href="ubc.html">Home</a>
                    <a href="subjects.php">Courses</a>
                    <a href="contactus.html">Contact Us</a>
                    <a id="account" href="account.php">Account</a>
                    <div id="login">
                        <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
                    </div>
                    <div id="logout">
                        <a id="signout" href="#" onclick="signOut();">Sign out</a>
                    </div>
                </div>
            </div>

            <div class="subjectHeader">
                <h1 class="subjectTitle">
                    UBC: ';
echo $course_code . ' reviews';
echo '
                </h1>
                <hr size="8px" color="#072145">
            </div>
        </div>
        
        <div class="content">';

$query_course_id = "SELECT * FROM courses WHERE course_code=?";
$stmt = $connection->prepare($query_course_id);
$stmt->bind_param('s', $course_code);
$stmt->execute();
$courses_result = $stmt->get_result();
$stmt->close();

$columns = mysqli_fetch_array($courses_result);
$course_id = $columns["course_id"];
$course_level  = $columns["course_level"];
$course_title = $course_title["course_title"];

$query_reviews = "SELECT * FROM reviews WHERE course_id_fk=?";
$stmt->prepare($query_reviews);
$stmt->bind_param('i', $course_id);
$stmt->execute();
$reviews_result = $stmt->get_result();
$stmt->close();

echo '
        </div>

        <div class="footer">
            <div class="contactus">
                <h1>Something wrong?</h1>
                <a href="contactus.html">CONTACT US</a>
                <h1 class="footerTitle">coursecritics.ca</h1>
            </div>
        </div>
    </div>
';


