<?php
echo '
<!DOCTYPE html>
<html>

<head>
    <title>Coursecritics - UBC courses</title>
    <link rel="stylesheet" href="../css/subjectStyles.css"/>
';
require 'repetitiveCode/head.php';
echo '
    </head>
    <style>
      #courses {
        background-color: #1c77ac;
        text-decoration: underline;
      }
    </style>
<body>
    <div class="container">
        <div class="header">
';
require 'repetitiveCode/nav.php';
echo '
            <div class="subjectHeader">
                <h1 class="subjectTitle">CourseCritics: UBC Course Schedule</h1>
                <hr>
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
require 'repetitiveCode/credentials.php';

$query = "SELECT * FROM subjects";
$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$count = 1;
$output = '
<table>
    <tr>
        <th>Subject Code</th>
        <th>Title</th>
        <th>Faculty or School</th>
    </tr>';

while ($row = mysqli_fetch_array($result)) {
    $output .= '<tr class="clickable-row" data-href="https://coursecritics.test/php/sameSubjectCode.php?courses=' . $row["subject_code"] .'">
                        <td>' . $row["subject_code"] . '</td>
                        <td>' . $row["subject_title"] . '</td>
                        <td>' . $row["faculty_or_school"] . '</td>
                    </tr>';
}
$output .= "</table>";

echo $output;

$connection->close();
//closing content and container tags
echo '
        </div>
';
require 'repetitiveCode/footer.php';
echo '
   </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/searchBar.js"></script>
    <script>
        $(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

</body>

</html>
';
