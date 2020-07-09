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

    <script src="functions.js" async></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="795327503596-iibptgqdd2l49s4qphdsa8619gttjpfp.apps.googleusercontent.com" />
</head>

<body>
    <div class="nav">
        <div class="mainNav">
            <a href="ubc.html">Home</a>
            <a href="courses.php">Courses</a>
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
        <div class="searchinput">
            <form action="course.php">
                <h1>Enter A Course Code</h1>
                <input id="search" list="datalist1" type="text" name="course" placeholder="Eg. MATH 100" />
                <button type="submit" class="submit">
                        <i class="fa fa-search"></i>
                </button>
            </form>
            <div id="courseList"></div>
        </div>

    </div>
    ';

$host = "localhost";
$user = "root";
$pass = "Hostforme123.";
$db_name = "Coursecritics";

$connection = mysqli_connect($host, $user, $pass, $db_name);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT * FROM subjects";
$result = mysqli_query($connection, $query);
$count = 1;
$output = '
<table>
    <tr>
        <th>Subject Code</th>
        <th>Title</th>
        <th>Faculty or School</th>
    </tr>';

while ($row = mysqli_fetch_array($result)) {
    $output .= '<tr class="clickable-row" data-href="http://coursecritics.test/course.php/?courses=' . $row["subject_code"] . '">
                        <td>' . $row["subject_code"] . '</td>
                        <td>' . $row["subject_title"] . '</td>
                        <td>' . $row["faculty_or_school"] . '</td>
                    </tr>';
}
$output .= "</table>";

echo $output;

echo '
    <div class="footer">
      <div class="contactus">
        <h1>Something wrong?</h1>
        <a href="contactus.html">CONTACT US</a>
        <h1 class="footerTitle">CourseCritics</h1>
      </div>
    </div>
';

echo '
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#search").keyup(function() {
                var query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $("#courseList").html(data);
                        },
                    });
                }
            });
        });

        $(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

</body>

</html>
';
