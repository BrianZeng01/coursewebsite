<?php
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
                <h1 class="subjectTitle">The University of British Columbia: Course Schedule</h1>
                <hr size="8px" color="#072145">
            </div>
        </div>

        <div class="content">
            <div class="searchinput">
                <form action="course.php">
                    <h1>Enter A Course Code</h1>
                    <div id="courseDoesNotExist"></div>
                    <input id="search" list="datalist1" type="text" name="course" placeholder="Eg. MATH 100" />
                    <button type="button" id="submit" onclick="courseDoesNotExist();">
                            <i class="fa fa-search"></i>
                    </button>
                </form>
                <div id="courseList"></div>
            </div>
        

            <div class="note">
                <h3>Note: Sign in to submit a review. Please be mindful
                when submitting reviews, thank you and enjoy!</h3>
            </div>
        ';


$host = "localhost";
$user = "root";
$pass = "Hostforme123.";
$db_name = "Coursecritics";

$connection = new mysqli($host, $user, $pass, $db_name);
if ($connection->connect_error) {
    die("Failed to connect to MySQL: " . $connection->connect_error);
}
echo $_POST["courses"];
$query = "SELECT * FROM courses JOIN subjects
 ON subjects.subject_id=courses.subject_id_fk
  WHERE subjects.subject_code = ?";

$subject_code = $_GET["courses"];

$stmt = $connection->prepare($query);
$stmt->bind_param('s', $subject_code);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$output = '
<table>
    <tr>
        <th>Ratings</th>
        <th>Course</th>
        <th>Title</th>
    </tr>';

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $id = $row["course_id"];
    $query = "SELECT AVG(overall) 'overall', COUNT(*) 'count' FROM reviews WHERE course_id_fk=?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
    $r = mysqli_fetch_array($res);
    $review_count = round($r["count"]);
    if ($review_count != 0) {
        $overall = number_format((float)round($r["overall"],1), 1, '.', '');
    } else {
        $overall = "0.0";
    }
    // echo $overall, $review_count;

    $output .= '<tr class="clickable-row" data-href="http://coursecritics.test/course.php?course=' . $row["course_code"] . '">
                        <td><span class="ratings">' . $overall . '</span>
                            <span style="color:gray;">(' . $review_count . ')</span>
                        </td>
                        <td>' . $row["course_code"] . '</td>
                        <td>' . $row["course_title"] . '</td>
                    </tr>';
}
$output .= "</table>";
echo $output;
$connection->close();

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="searchBar.js"></script>
    <script>
        $(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

    <script src="ratings.js" ></script>
</body>

</html>
';
