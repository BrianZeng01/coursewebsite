<?php require_once("utils.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coursecritics - UBC courses</title>
    <?php require 'repetitiveCode/commonHTML/head.php'; ?>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
</head>

<body>
    <?php require 'repetitiveCode/commonHTML/nav.php'; ?>
    <div class="container">
        <div class="header">
            <h1 class="subjectTitle">UBC Course Schedule:<br>
                <?php echoXss($_GET["courses"]) ?>
            </h1>
            <hr>
        </div>

        <div class="content">
            <div>
                <div class="searchinput">
                    <div>
                        <form action="course.php" method="GET">
                            <h1>Enter A Course Code</h1>
                            <div id="courseDoesNotExist"></div>
                            <input id="searchCourse" list="datalistCourse" type="text" name="course" placeholder="Eg. MATH 100" maxlength="10" />
                            <button type="button" id="submitCourse" onclick="courseDoesNotExist();">
                                <i class="fa fa-search"></i>
                            </button>
                            <div id="courseList"></div>
                        </form>
                    </div>
                    <div>
                        <h2>OR</h2>
                    </div>
                    <div>
                        <form action="sameSubjectCode.php" method="GET">
                            <h1>Enter a Subject Code</h1>
                            <div id="subjectDoesNotExist"></div>
                            <input id="searchSubject" list="datalistSubject" type="text" name="courses" placeholder="Eg. PHYS" maxlength="10" />
                            <button type="button" id="submitSubject" onclick="subjectDoesNotExist();">
                                <i class="fa fa-search"></i>
                            </button>
                            <div id="subjectList"></div>
                        </form>
                    </div>
                </div>
                <div class="note">
                    <h4>Note: Sign in to submit a review. Please be mindful
                        when submitting reviews, thank you and enjoy!</h4>
                </div>
            </div>
            <table>
                <col class="col1">
                <col class="col2">
                <col class="col3">
                <tr>
                    <td>Ratings</td>
                    <td>Course</td>
                    <td>Title</td>
                </tr>

                <?php
                $ratings = $model["ratings"];
                $text = $model["text"];

                for ($i = 0; $i < sizeof($ratings); $i++) : ?>
                    <tr class="clickable-row" data-href="https://coursecritics.test/php/course.php?course=<?php echoXss($text[$i]["course_code"]); ?>">
                        <td>
                            <span class="ratings"><?php echo $ratings[$i]["overall"]; ?></span>
                            <span style="color:gray;">(<?php echo $ratings[$i]["reviewCount"]; ?>)</span>
                        </td>
                        <td><?php echoXss($text[$i]["course_code"]); ?></td>
                        <td><?php echoXss($text[$i]["course_title"]); ?></td>
                    </tr>
                <?php endfor; ?>
            </table>

        </div>
        <?php require 'repetitiveCode/commonHTML/footer.php'; ?>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/searchBar.js"></script>
    <script>
        $(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

    <script src="../js/ratings.js"></script>
</body>

</html>